
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_facility_owner_crtl extends CI_Controller
{                   
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_facility_owner';
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
        //$this->set_data();
        $this->base_id = 0;
        $this->load->model('crudmaster_model','crd');
        $this->load->model('rudra_facility_owner_rudra_model','rudram');
		$this->load->helper('User_helper'); 
        // Uncomment Following Codes for Session Check and change accordingly 
        
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
        
    }
    /***********
	//Rudra_facility_owner_crtl ROUTES
        $crud_master = $crm . "Rudra_facility_owner_crtl/";
        $route['rudra_facility_owner'] = $crud_master . 'index';
        $route['rudra_facility_owner/index'] = $crud_master . 'index';
        $route['rudra_facility_owner/list'] = $crud_master . 'list';
        $route['rudra_facility_owner/post_actions/(:any)'] = $crud_master.'post_actions/$1';
	**************/

    public function index()
    {
        // main index codes goes here
        $data['pageTitle'] = ' Facility Owner';                        
        $data['page_template'] = '_rudra_facility_owner';
        $data['page_header'] = ' Facility Owner';
        $data['load_type'] = 'all';     	
//$wallet = $this->db->select('*')->get_where('rudra_facility_wallet',array('fo_id'=>99))->row_array();	
//print_r($wallet);die;
//$current_amount = wallet(100,35,$this->admin_id,'credit','admin');
//print_r($current_amount);die;
        $this->load->view('crm/template', $data);
		
    }
    public function list()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array('id','fo_name', 'fo_email','fo_mobile','fo_password','credit_amount', 'status',);
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$dir   = $this->input->post('order')[0]['dir'];
		$order = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$start = html_escape($this->input->post('start'));
		$general_search = $this->input->post('search')['value'];
		//$filter = $this->input->post('filter');
		//$fo_id = $this->input->post('fo_id);
		$general_search = $this->input->post('search');
		//$filter_data['filter'] = $filter;
		//$filter_data['fo_id'] = $fo_id;
		$filter_data['general_search'] = $general_search;
		$totalData = $this->rudram->count_table_data($filter_data,$this->full_table);
		$totalFiltered = $totalData; //Initailly Total and Filtered count will be same
		$rescheck = '';
		$rows = $this->rudram->get_table_data($limit, $start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table);
		$rows_count = $this->rudram->count_table_data($filter_data,$this->full_table);
						
		$totalFiltered = $rows_count;
		if(!empty($rows))
		{
			$res_json = array();
			foreach ($rows as $row)
			{
				$actions_base_url = 'facility-owner/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'facility-owner/post_actions';
				$action_url = 'facility-owner/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
	            $actions_button ="<a id='edt$row->id' href='javascript:void(0)' class='label label-success text-white f-12' onclick =\"static_form_modal('$form_data_url/get_data?id=$row->id','$action_url/update_data','md','Update Details')\" >Edit</a>";
				$row->actions = $actions_button;
				$current_amount = balance($row->id);
				$row->credit_amount = $current_amount;

				//JOINS LOGIC
				$data[] = $row;
			}
		}
		else
		{
			$data = array();
		}
		$json_data = array('draw' => intval($this->input->post('draw')),
			'recordsTotal'    => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data'           => $data
            );
		echo json_encode($json_data);
	
    }
	public function search()
	{   
		$find = $this->input->post('name',true);
        $ajax_data = $this->rudram->find($find);
		
		if(!empty($ajax_data)){
			$this->data =array('ajax_data'=> $ajax_data);
			$message = $this->load->view('crm/ajax/FacilityName',$this->data,TRUE);
			$response = array(
                'status' => 'success',
                'message' => $message
            );
		}else{
			$response = array(
                'status' => 'error',
                'message' => 'No Result'
            );			
		}
	    $this->output->set_content_type('application/json')->set_output(json_encode($response));
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
			$data['form_data'] = $this->db->get_where($this->full_table,array('id'=>$id))->row(); 
			
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            $html = $this->load->view("crm/forms/_ajax_rudra_facility_owner_form", $data, TRUE);
            $this->return_data['data']['form_data'] = $html;
        }
        // Post Methods
        //Update Codes
		$adminData = $this->session->userdata();
        if($action == "update_data")
        {   if($this->input->post('fo_email') != $this->input->post('original_email')) {
			   $is_unique =  '|is_unique[rudra_facility_owner.fo_email]';
			} else {
			   $is_unique =  '';
			}
			$validations = array( 
							array('field' => 'fo_mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|numeric|min_length[9]|max_length[11]'), 
							array('field' => 'fo_email', 'label' => 'Facility Owner Email', 'rules' => 'trim|required'.$is_unique), 
						 );
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $this->return_data = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { $fwt_amount=$this->input->post('fwt_amount',true);
            if(!empty($_POST))
            {
                $id = $_POST['id'];
                $updateArray = array(
				 'fo_fname' => $this->input->post('fo_fname',true),
				 'fo_lname' => $this->input->post('fo_lname',true),
				 'fo_email' => $this->input->post('fo_email',true),
				 'fo_mobile' => $this->input->post('fo_mobile',true),
				 'fo_password' => $this->input->post('fo_password',true),
				 'status' => $this->input->post('status',true),
				);
                $this->db->where('id',$id);
                $this->db->update($this->full_table,$updateArray);
				//echo $this->db->last_query();die;
				//echo $this->input->post('debit',true); die;
				if($this->input->post('debit',true)==1){
					$current_amount = wallet($fwt_amount,$id,$this->admin_id,'debit','admin');
				}else{
					$current_amount = wallet($fwt_amount,$id,$this->admin_id,'credit','admin');
				}
				$this->return_data = array(
			'status' => 'success',
                'msg' => 'Updated Successfully');
            }
		  }
            
        }
        //Insert Method
        if($action == "insert_data")
        {
			$validations = array( 
							array('field' => 'fo_mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|numeric|min_length[9]|max_length[11]'), 
							array('field' => 'fo_email', 'label' => 'Facility Owner Email', 'rules' => 'trim|required|is_unique[rudra_facility_owner.fo_email]'), 
						 );
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $this->return_data = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else {$fwt_amount=$this->input->post('fwt_amount',true);
            $id = 0;
            if(!empty($_POST))
            { 
                //Insert Codes goes here 
                $updateArray = array('fo_fname' => $this->input->post('fo_fname',true),
				 'fo_lname' => $this->input->post('fo_lname',true),
				 'fo_email' => $this->input->post('fo_email',true),
				 'fo_mobile' => $this->input->post('fo_mobile',true),
				 'fo_password' => $this->input->post('fo_password',true),
				 'status' => $this->input->post('status',true));
                $this->db->insert($this->full_table,$updateArray);
                $id = $this->db->insert_id();
				if($this->input->post('debit',true)==1){
					$current_amount = wallet($fwt_amount,$id,$this->admin_id,'debit','admin');
				}else{
					$current_amount = wallet($fwt_amount,$id,$this->admin_id,'credit','admin');
				}
				
				$this->return_data = array('status' => 'success',
                'msg' => 'Added Successfully');
            }
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
            $filename = strtolower('rudra_facility_owner').'_'.date('d-m-Y').".csv";
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