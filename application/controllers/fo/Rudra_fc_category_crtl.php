
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_fc_category_crtl extends CI_Controller
{   public  $default_data = array();             
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_fc_category';
		$this->load->helper('form');
		$this->load->library('form_validation');
		// Notifications
		$fo_id = $this->session->userdata('rudra_fo_id');
		$this->load->model('rudra_facility_category_rudra_model');
		// Shift Manager Job Notifications
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
		$data['shift_managers'] = $this->db->where('rudra_shift_manager.fo_id',$fo_id)->get('rudra_shift_manager')->row_array();
		$smIds = explode(',',$data['shift_managers']['ids']);
		// Job Notifications
		$this->db->select('concat(rudra_shift_manager.sm_fname," ",rudra_shift_manager.sm_lname) as sm_name,notifications.*');
		$this->db->join('rudra_shift_manager', 'rudra_shift_manager.id = notifications.user_id');
		$JobNotifications = $this->db->from('notifications')->where_in('notifications.user_id', $smIds)->where('notifications.user_type','sm')->where('notifications.not_type','job')->where('notifications.status','unread')->order_by('id', 'desc')->get()->result_array();
       foreach($JobNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
		   $data['JobNotifications'][] = $job;
	   }
	    // For Getting job Ids of Current FO
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts');
		$job_ids = $this->db->from('rudra_jobs')->where_in('rudra_jobs.sm_id', $smIds)->order_by('id', 'desc')->get()->row_array();
        $job_ids = explode(',',$job_ids['ids']);
		// For Getting Nurse Ids of current 
        $this->db->select('GROUP_CONCAT(cg_id SEPARATOR ",") as cg_ids');
		$cg_ids = $this->db->from('rudra_jobs_nurse')->where_in('rudra_jobs_nurse.job_id', $job_ids)->order_by('id', 'desc')->get()->row_array();
		$cg_ids = explode(',',$cg_ids['cg_ids']);
	   // CG  Job Notifications
	   
		$this->db->select('concat(rudra_care_giver.cg_fname," ",rudra_care_giver.cg_lname) as cg_name,rudra_care_giver.cg_profile_pic,notifications.*');
		$this->db->join('rudra_care_giver', 'rudra_care_giver.id = notifications.user_id');
		$CGJobNotifications = $this->db->from('notifications')->where_in('notifications.user_id', $cg_ids)->where_in('notifications.job_id', $job_ids)->where('notifications.user_type','cg')->where('notifications.not_type','job')->where('notifications.status','unread')->order_by('id', 'desc')->get()->result_array();
       foreach($CGJobNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
			 $job['cg_profile_pic'] = base_url($job['cg_profile_pic']);
		   $data['CGJobNotifications'][] = $job;
	   }
	   // FO  Transactions Notifications- 
		$this->db->select('concat(rudra_facility_owner.fo_fname," ",rudra_facility_owner.fo_lname) as fo_name,notifications.*');
		$this->db->join('rudra_facility_owner', 'rudra_facility_owner.id = notifications.user_id');
		$FOTranNotifications = $this->db->from('notifications')->where('notifications.user_id',$fo_id)->where('notifications.user_type','fo')->where('notifications.not_type','transaction')->where('notifications.status','unread')->order_by('id', 'desc')->get()->result_array();
       foreach($FOTranNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
		   $data['FOTranNotifications'][] = $job;
	   }
		// CG  Transactions Notifications
		if(!empty($job_ids)&&!empty($cg_ids)){
		$this->db->select('concat(rudra_care_giver.cg_fname," ",rudra_care_giver.cg_lname) as cg_name,rudra_care_giver.cg_profile_pic,notifications.*');
		$this->db->join('rudra_care_giver', 'rudra_care_giver.id = notifications.user_id');
		$CGTransNotifications = $this->db->from('notifications')->where_in('notifications.user_id', $cg_ids)->where_in('notifications.job_id', $job_ids)->where('notifications.user_type','cg')->where('notifications.not_type','transaction')->where('notifications.status','unread')->order_by('id', 'desc')->get()->result_array();
        foreach($CGTransNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
			 $job['cg_profile_pic'] = base_url($job['cg_profile_pic']);
		   $data['CGTransNotifications'][] = $job;
	   }
		}
	   $this->default_data = array('data'=>$data);
        $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
        //$this->set_data();
        $this->base_id = 0;
        $this->load->model('rudra_fc_category_rudra_model','rudram');
        // Uncomment Following Codes for Session Check and change accordingly 
        if (!$this->session->userdata('rudra_fo_id'))
        {		
            $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
            $return_url = uri_string();
            redirect(base_url("fo-login?req_uri=$return_url"), 'refresh');
        }
        else
        {
            $this->admin_id = $this->session->userdata('rudra_fo_id');
            $this->return_data = array('status' => false, 'msg' => 'Working', 'login' => true, 'data' => array());
        }  
    }
	public function timeago($date) {
	   $timestamp = strtotime($date);
	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");
	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}
			$diff = round($diff);
			if($diff==1){
				return $diff . " " . $strTime[$i] . " ago ";
			}else{
				return $diff . " " . $strTime[$i] . "s ago ";
			}
	   }
	}
    /***********
	//Rudra_fc_category_crtl ROUTES
        $crud_master = $crm . "Rudra_fc_category_crtl/";
        $route['rudra_fc_category'] = $crud_master . 'index';
        $route['rudra_fc_category/index'] = $crud_master . 'index';
        $route['rudra_fc_category/list'] = $crud_master . 'list';
        $route['rudra_fc_category/post_actions/(:any)'] = $crud_master.'post_actions/$1';
	**************/

    public function index()
    {
        // main index codes goes here 
        $data['pageTitle'] = 'Facility Owner Category';                        
        $data['page_template'] = '_rudra_fc_category';
        $data['page_header'] = ' Facility Owner Category';
        $data['load_type'] = 'all';                
        $this->load->view('facility/template', $data);
    }
	public function searchCat()
	{   
		$find = $this->input->post('searchBy',true);
        $ajax_data = $this->rudra_facility_category_rudra_model->search($find);
		if(!empty($ajax_data)){
			$this->data =array('ajax_data'=> $ajax_data);
			$message = $this->load->view('crm/ajax/FCatName',$this->data,TRUE);
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
    public function list()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array(  'id', 'fc_name', 'normal_rate', 'premium_rate', );
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$dir   = $this->input->post('order')[0]['dir'];
		$order   = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$general_search = $this->input->post('search')['value'];
		$filter_data['general_search'] = $general_search;
		$leftJoin= 'fcat_id';
		$whereSearch->kind = "fc_id";
		$whereSearch->Value = $this->session->userdata('rudra_fo_id');
		$filter_data['fcat_id'] = html_escape($this->input->post('category_id',true));
		$filter_data['searchBy'] = html_escape($this->input->post('searchBy',true));
		$filter_data['start_date'] = html_escape($this->input->post('start_date',true));
		$filter_data['end_date'] = html_escape($this->input->post('end_date',true));
		$totalData = $this->rudram->count_table_data($filter_data,$this->full_table,$whereSearch);
		$totalFiltered = $totalData; //Initailly Total and Filtered count will be same
			$rescheck = '';
		
		 $rows = $this->rudram->get_table_data($limit, $start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table,$leftJoin,$whereSearch);
		
		$rows_count = $this->rudram->count_table_data($filter_data,$this->full_table,$whereSearch);
		$totalFiltered = $rows_count;
		if(!empty($rows))
		{
			$res_json = array();
			foreach ($rows as $row)
			{
				$row->normal_rate = "$".$row->normal_rate;
				$row->premium_rate = "$".$row->premium_rate;
				$actions_base_url = 'facility-fc-category/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'facility-fc-category/post_actions';
				$action_url = 'facility-fc-category/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
				$actions_button ="<a id='edt$row->id' href='javascript:void(0)' class='label label-success text-white f-12' onclick =\"static_form_modal('$form_data_url/get_data?id=$row->id','$action_url/update_data','md','Update Details')\" >Edit</a>";
				$row->actions = $actions_button;
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
            $data['form_data'] = $this->db->get_where($this->full_table,array('id'=>$id))->row(); 
			
			$fc_category = $this->db->get_where('rudra_facility_category',array('status'=>'Active'))->result(); 
			$data['categories'] = $fc_category;
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            //print_r($data);exit;

            $html = $this->load->view("facility/forms/_ajax_rudra_fc_category_form", $data, TRUE);
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
				 'fcat_id' => $this->input->post('fcat_id',true),
				 'normal_rate' => $this->input->post('normal_rate',true),
				 'premium_rate' => $this->input->post('premium_rate',true),
				);

                $this->db->where('id',$id);
                $this->db->update($this->full_table,$updateArray);
            }
			$this->return_data = array(
				'status' => 'success',
                'msg' => 'Updated successfully.');
            
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
				 'fc_id' => $this->session->userdata('rudra_fo_id'),
				 'fcat_id' => $this->input->post('fcat_id',true),
				 'normal_rate' => $this->input->post('normal_rate',true),
				 'premium_rate' => $this->input->post('premium_rate',true),
				);
                $this->db->insert($this->full_table,$updateArray);
                $id = $this->db->insert_id();
            }
			$this->return_data = array(
				'status' => 'success',
                'msg' => 'Added successfully.');
            
        }

        // Export CSV Codes 
        if($action == "export_data")
        {
            $header = array();
            foreach($json_cols as $ck => $cv)
            {
                $header[] = $cv->list_caption;
            }
            $filename = strtolower('rudra_fc_category').'_'.date('d-m-Y').".csv";
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