
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_videos_crtl extends CI_Controller
{                   
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_videos';
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
        //$this->set_data();
        $this->base_id = 0;
        $this->load->model('crudmaster_model','crd');
        $this->load->model('rudra_videos_rudra_model','rudram');
        // Uncomment Following Codes for Session Check and change accordingly 
        
        if (!$this->session->userdata('rudra_tv_logged_in'))
        {			
            $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
            $return_url = uri_string();
            redirect(base_url("tv-login?req_uri=$return_url"), 'refresh');
        }
        else
        {
            $this->admin_id = $this->session->userdata('rudra_tv_id');
            $this->return_data = array('status' => false, 'msg' => 'Working', 'login' => true, 'data' => array());
        }
    }
    /***********
	//Rudra_videos_crtl ROUTES
        $crud_master = $crm . "Rudra_videos_crtl/";
        $route['rudra_videos'] = $crud_master . 'index';
        $route['rudra_videos/index'] = $crud_master . 'index';
        $route['rudra_videos/list'] = $crud_master . 'list';
        $route['rudra_videos/post_actions/(:any)'] = $crud_master.'post_actions/$1';
	**************/

    public function index()
    {
        // main index codes goes here
        $data['pageTitle'] = ' Videos';                        
        $data['page_template'] = '_rudra_videos';
        $data['page_header'] = ' Videos';
        $data['load_type'] = 'all';                
        $this->load->view('tv/template', $data);
    }
    public function list()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array(  'id', 'cat_name', 'subcat_name', 'video_url', 'status', );
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$dir   = $this->input->post('order')[0]['dir'];
		$order   = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$general_search = $this->input->post('search')['value'];
		$filter_data['general_search'] = $general_search;
		$totalData = $this->rudram->count_table_data($filter_data,$this->full_table);
		$totalFiltered = $totalData; //Initailly Total and Filtered count will be same
			$rescheck = '';
			$leftJoin1 ="cat_id";
		$rows = $this->rudram->get_table_data($limit, $start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table,$leftJoin1);
		$rows_count = $this->rudram->count_table_data($filter_data,$this->full_table);
		$totalFiltered = $rows_count;
		if(!empty($rows))
		{
			$res_json = array();
			foreach ($rows as $row)
			{
				$actions_base_url = 'rudra_videos/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'rudra_videos/post_actions';
				$action_url = 'rudra_videos/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
	
				$actions_button ="<a id='edt$row->id' href='javascript:void(0)' class='label label-success text-white f-12' onclick =\"static_form_modal('$form_data_url/get_data?id=$row->id','$action_url/update_data','md','Update Details')\" >Edit</a>";
				$row->actions = $actions_button;

                $row->video_url = "<a target='_blank' href='".base_url('app_assets/uploads/videos/').$row->video_url."' >".$row->video_url."</a>";
                $image_url = base_url('app_assets/uploads/').$row->image_url;
	
                $row->image_url = '<a target="_blank" href="'.$image_url.'" ><img src="'.$image_url.'" width="75px" /></a>';

				//JOINS LOGIC
				
				$data[] = $row;
			}
		}
		else
		{
			$data = array();
		}
		$json_data = array
			(
			'draw'           => intval($this->input->post('draw')),
			'recordsTotal'    => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data'           => $data
            );
		echo json_encode($json_data);
	
    }
    public function post_actions($param1)
    {
        // main index codes goes here
        $action = (isset($_GET['act']) ? $_GET['act'] : $param1);
		$id = (isset($_GET['id']) ? $_GET['id'] : 0);
		$this->return_data['status'] = true;
        $col_json = $this->db->get_where($this->bdp.'crud_master_tables',array('tbl_name'=>$this->full_table))->row(); 
        $data['col_json'] = $col_json;
        $json_cols = json_decode($data['col_json']->col_strc);
        $data['json_cols'] = array();
        $data['json_values'] = array();
        //Get Data Methods
        if($action == "get_data")
        {
            $data['id'] = $id;                           
            foreach($json_cols as $ck => $cv)
            {
                if($cv->form_type == 'ddl')
                {
                    $data[$cv->col_name] = $cv->ddl_options;
                }
                if($cv->form_type == 'json')
                {
                    $data['json_cols'][] = $cv->col_name;
                }

                //Foreign Key Logics
                if($cv->f_key)
                {
                    $ref_table_name = $cv->ref_table;
                    $data[$cv->col_name] = $this->db->get($ref_table_name)->result();
                }
            }
            $video_categories = $this->db->get('rudra_video_category')->result(); 
			$data['video_categories'] = $video_categories;
			$subvideo_categories = $this->db->get('rudra_video_subcategory')->result(); 
			$data['subvideo_categories'] = $subvideo_categories;
            $data['form_data'] = $this->db->get_where($this->full_table,array('id'=>$id))->row(); 
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            //print_r($data);exit;

            $html = $this->load->view("tv/forms/_ajax_rudra_videos_form", $data, TRUE);
            $this->return_data['data']['form_data'] = $html;
        }
        // Post Methods
        //Update Codes
        if($action == "update_data")
        {
			$validations = array(array('field' => 'cat_id', 'label' => 'Category Name', 'rules' => 'trim|required'),
			array('field' => 'subcat_id', 'label' => 'Sub Category Name', 'rules' => 'trim|required')
			);
			$this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $this->return_data = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else {
            if(!empty($_POST))
            {
                $id = $_POST['id'];
                $updateArray = 
				array(
				 'id' => $this->input->post('id',true),
				 'cat_id' => $this->input->post('cat_id',true),
				 'subcat_id' => $this->input->post('subcat_id',true),
				 'status' => $this->input->post('status',true),
                 'title' => $this->input->post('title'),
                 'description' => $this->input->post('description')
				);

                $this->db->where('id',$id);
                $this->db->update($this->full_table,$updateArray);
            }
            if(isset($_FILES['video_url']) && $_FILES['video_url']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads/videos';
                //$thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|mp4';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('video_url'))
                {
                    //$error = array('error' => $this->upload->display_errors());
                   $this->return_data = array(
			'status' => 'error',
                'msg' => $this->upload->display_errors());
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
                }
                $up_array = array(
                                    'video_url' => $uploadedImage['file_name']
                                );
                $this->db->where('id', $id);
                $this->db->update($this->full_table, $up_array);
            }
            if(isset($_FILES['image_url']) && $_FILES['image_url']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads';
                //$thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|mp4';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('image_url'))
                {
                    //$error = array('error' => $this->upload->display_errors());
                   $this->return_data = array(
			        'status' => 'error',
                    'msg' => $this->upload->display_errors());
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
                }
                $up_array = array(
                                    'image_url' => $uploadedImage['file_name']
                                );
                $this->db->where('id', $id);
                $this->db->update($this->full_table, $up_array);
            }
			$this->return_data = array(
				'status' => 'success',
                'msg' => 'Updated successfully.');
		}
        }
        //Insert Method
        if($action == "insert_data")
        {
            $id = 0;
			$validations = array(array('field' => 'cat_id', 'label' => 'Category Name', 'rules' => 'trim|required'),
			array('field' => 'subcat_id', 'label' => 'Sub Category Name', 'rules' => 'trim|required')
			);
			$this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $this->return_data = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else {
            if(!empty($_POST))
            { 
                //Insert Codes goes here 
                $updateArray = 
				array(
				 'id' => $this->input->post('id',true),
				 'cat_id' => $this->input->post('cat_id',true),
				 'subcat_id' => $this->input->post('subcat_id',true),
				 'status' => $this->input->post('status',true),
                 'title' => $this->input->post('title'),
                 'description' => $this->input->post('description')
				);

                $this->db->insert($this->full_table,$updateArray);
                $id = $this->db->insert_id();
            }
			if(isset($_FILES['video_url']) && $_FILES['video_url']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads/videos';
                //$thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|mp4';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('video_url'))
                {
                   $this->return_data = array(
			'status' => 'error',
                'msg' => $this->upload->display_errors());
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
                }
                $up_array = array(
                                    'video_url' =>  $uploadedImage['file_name']
                                );
                $this->db->where('id', $id);
                $this->db->update($this->full_table, $up_array);
            }
            if(isset($_FILES['image_url']) && $_FILES['image_url']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads';
                //$thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('image_url'))
                {
                    $this->return_data = array(
			        'status' => 'error',
                    'msg' => $this->upload->display_errors());
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
                }
                $up_array = array(
                                    'image_url' =>  $uploadedImage['file_name']
                                );
                $this->db->where('id', $id);
                $this->db->update($this->full_table, $up_array);
            }
			$this->return_data = array(
				'status' => 'success',
                'msg' => 'Updated successfully.');
		}
            
            
        }

        // Export CSV Codes 
        if($action == "export_data")
        {
            $header = array();
            foreach($json_cols as $ck => $cv)
            {
                $header[] = $cv->list_caption;
            }
            $filename = strtolower('rudra_videos').'_'.date('d-m-Y').".csv";
            $fp = fopen('php://output', 'w');                         
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            fputcsv($fp, $header);
            $result_set = $this->db->get($this->full_table)->result();
            foreach($result_set as $k)
            {  
                $row = array();
                foreach($json_cols as $ck => $cv)
                {
                    $cl = $cv->col_name;                                    
                    $row[] = $k->$cl;
                }                              
                fputcsv($fp,$row);
            }
        }
        echo json_encode($this->return_data);
		exit;
    }
                    
}