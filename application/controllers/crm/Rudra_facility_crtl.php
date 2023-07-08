
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_facility_crtl extends CI_Controller
{                   
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_facility';
        $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
        //$this->set_data();
        $this->base_id = 0;
        $this->load->model('crudmaster_model','crd');
        $this->load->model('rudra_facility_rudra_model','rudram');
        // Uncomment Following Codes for Session Check and change accordingly 
        /*
        if (!$this->session->userdata('rudra_admin_logged_in'))
        {			
            $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
            $return_url = uri_string();
            redirect(base_url("admin-login?req_uri=$return_url"), 'refresh');
        }
        else
        {
            $this->admin_id = $this->session->userdata('rudra_admin_id');
            $this->return_data = array('status' => false, 'msg' => 'Working', 'login' => true, 'data' => array());
        }
        */
    }
    /***********
	//Rudra_facility_crtl ROUTES
        $crud_master = $crm . "Rudra_facility_crtl/";
        $route['rudra_facility'] = $crud_master . 'index';
        $route['rudra_facility/index'] = $crud_master . 'index';
        $route['rudra_facility/list'] = $crud_master . 'list';
        $route['rudra_facility/post_actions/(:any)'] = $crud_master.'post_actions/$1';
	**************/

    public function index()
    {
        // main index codes goes here
        $data['pageTitle'] = 'ManageFacility';                        
        $data['page_template'] = '_rudra_facility';
        $data['page_header'] = ' Facility';
        $data['load_type'] = 'all';                
        $this->load->view('crm/template', $data);
    }
    public function list()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array(  'id', 'fo_id', 'fc_name', 'fc_country', 'fc_state', 'fc_city', 'fc_address', 'fc_landmark', 'fc_image', );
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
		$rows = $this->rudram->get_table_data($limit, $start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table);
		$rows_count = $this->rudram->count_table_data($filter_data,$this->full_table);
		$totalFiltered = $rows_count;
        // echo "<pre>"; print_r($rows); die();
		if(!empty($rows))
		{
			$res_json = array();
			foreach ($rows as $row)
			{
				$actions_base_url = 'facility/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'facility/post_actions';
				$action_url = 'facility/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
	
				$actions_button ="<a id='edt$row->id' href='javascript:void(0)' class='label label-success text-white f-12' onclick =\"static_form_modal('$form_data_url/get_data?id=$row->id','$action_url/update_data','md','Update Details')\" >Edit</a>";
				$row->actions = $actions_button;
	
				//JOINS LOGIC
                $row->added_on = date('d M, Y',strtotime($row->added_on));

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
        $data['fo_data'] = $this->db->get('rudra_facility_owner')->result();
        $data['country_data'] = $this->db->get('rudra_countries')->result();
        $data['state_data'] = $this->db->get_where('rudra_states',array('country_id'=>233))->result(); 
        $data['ownership_data'] = $this->db->get('rudra_ownership_type')->result();
        
        // echo "<pre>"; print_r($data['state_data']); die();
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

            $data['form_data'] = $this->db->get_where($this->full_table,array('id'=>$id))->row(); 
            // echo "<pre>"; print_r($data[form_data]); die();
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            //print_r($data);exit;

            $html = $this->load->view("crm/forms/_ajax_rudra_facility_form", $data, TRUE);
            $this->return_data['data']['form_data'] = $html;
        }
        // Post Methods
        //Update Codes
        if($action == "update_data")
        {
            if(!empty($_POST))
            {
                $id = $_POST['id'];
                $updateArray = 
				array(
				 'id' => $this->input->post('id',true),
				 'fc_name' => $this->input->post('fc_name',true),
                 'fc_country' => $this->input->post('fc_country',true),
                 'fc_state' => $this->input->post('fc_state',true),
                 'fc_city' => $this->input->post('fc_city',true),
				 'fc_ownership_type' => $this->input->post('fc_ownership_type',true),
				 'fc_address' => $this->input->post('fc_address',true),
				 'fc_landmark' => $this->input->post('fc_landmark',true),
				);

                $this->db->where('id',$id);
                $this->db->update($this->full_table,$updateArray);
            }
            if(isset($_FILES['fc_image']) && $_FILES['fc_image']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads/facility';
                // $thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('fc_image'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    exit('Errors');
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
                }
                $up_array = array(
                                    'fc_image' => $bannerpath . '/' . $uploadedImage['file_name']
                                );
                $this->db->where('id', $id);
                $this->db->update($this->full_table, $up_array);
            }
        }
        //Insert Method
        if($action == "insert_data")
        {
            $id = 0;
            if(!empty($_POST))
            { 
                //Insert Codes goes here 
                $updateArray = 
				array(
                 'id' => $this->input->post('id',true),
                 'fc_name' => $this->input->post('fc_name',true),
                 'fc_country' => $this->input->post('fc_country',true),
                 'fc_state' => $this->input->post('fc_state',true),
                 'fc_city' => $this->input->post('fc_city',true),
                 'fc_ownership_type' => $this->input->post('fc_ownership_type',true),
                 'fc_address' => $this->input->post('fc_address',true),
                 'fc_landmark' => $this->input->post('fc_landmark',true),
                );
                
                $this->db->insert($this->full_table,$updateArray);
                $id = $this->db->insert_id();
            }
            if(isset($_FILES['fc_image']) && $_FILES['fc_image']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads/facility';
                // $thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('fc_image'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    exit('Errors');
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
                }
                $up_array = array(
                                    'fc_image' => $bannerpath . '/' . $uploadedImage['file_name']
                                );
                $this->db->where('id', $id);
                $this->db->update($this->full_table, $up_array);
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
            $filename = strtolower('rudra_facility').'_'.date('d-m-Y').".csv";
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