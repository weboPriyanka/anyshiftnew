<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_jobs_crtl extends CI_Controller
{   public  $default_data = array();
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_jobs';
		$this->load->helper('form');
		$this->load->library('form_validation');
		// Notifications
		$fo_id = $this->session->userdata('rudra_fo_id');
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
        $this->load->model('crudmaster_model','crd');
        $this->load->model('rudra_jobs_rudra_model','rudram');
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
	public function timeago($date){
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
	public function searchbySM()
	{   
		$find = $this->input->post('searchBy2',true);
		$whereSearch->kind = "fo_id";
		$whereSearch->Value = $this->session->userdata('rudra_fo_id');
        $ajax_data = $this->Rudra_shift_manager_rudra_model->search($find,$whereSearch);
		if(!empty($ajax_data)){
			$this->data =array('ajax_data'=> $ajax_data);
			$message = $this->load->view('crm/ajax/ShiftManagerName',$this->data,TRUE);
			$response = array(
                'status' => 'success',
                'message' => $message);
		}else{
			$response = array(
                'status' => 'error',
                'message' => 'No Result');			
		}
	    $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
    public function index()
    {
        // main index codes goes here
        $data['pageTitle'] = ' Jobs';                        
        $data['page_template'] = '_rudra_jobs';
        $data['page_header'] = ' Jobs';
        $data['load_type'] = 'all';                
        $this->load->view('facility/template', $data);
    }
    public function list()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array('id','fc_name','nc_name','sm_name','job_title', 'shift_type', 'job_hours', 'job_rate', 'job_prem_rate', 'status', );
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$dir   = $this->input->post('order')[0]['dir'];
		$order   = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$general_search = $this->input->post('search')['value'];
		$filter_data['general_search'] = $general_search;
		$filter_data['job_id'] = html_escape($this->input->post('job_id',true));
		$filter_data['searchBy'] = html_escape($this->input->post('searchBy',true));
		$filter_data['sm_id'] = html_escape($this->input->post('sm_id',true));
		$filter_data['searchBySM'] = html_escape($this->input->post('searchBySM',true));
		$totalData = $this->rudram->count_table_data($filter_data,$this->full_table);
		$totalFiltered = $totalData; //Initailly Total and Filtered count will be same
		$rescheck = '';
		$leftJoin1= 'sm_id';
		$leftJoin2= 'nc_name';
		$leftJoin3= 'fc_name';
		$whereSearch->kind = "fo_id";
		$whereSearch->Value = $this->session->userdata('rudra_fo_id');
		$rows = $this->rudram->get_table_data($limit, $start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table,$leftJoin1,$leftJoin2,$leftJoin3,$whereSearch);
		$rows_count = $this->rudram->count_table_data($filter_data,$this->full_table);
		$totalFiltered = $rows_count;
		if(!empty($rows)){
			$res_json = array();
			foreach ($rows as $row){
				$row->job_rate = "$".$row->job_rate;
				
				$actions_base_url = 'facility-jobs/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'facility-jobs/post_actions';
				$action_url = 'facility-jobs/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
				$actions_button ="<a id='edt$row->id' href='javascript:void(0)' class='label label-success text-white f-12' onclick =\"static_form_modal('$form_data_url/get_data?id=$row->id','$action_url/update_data','md','Update Details')\" >Edit</a>";
				$row->actions = $actions_button;
				//JOINS LOGIC
				$data[] = $row;
			}
		}else{		$data = array(); }
		$json_data = array(
			'draw'           => intval($this->input->post('draw')),
			'recordsTotal'    => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data'           => $data );
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
			$shift_managers = $this->db->get_where('rudra_shift_manager',array('fo_id'=>$this->session->userdata('rudra_fo_id'),'status'=>'Active'))->result(); 
			$data['shift_managers'] = $shift_managers;
			$facility_categories = $this->db->get_where('rudra_facility_category',array('status'=>'Active'))->result(); 
			$data['facility_categories'] = $facility_categories;
			$nurse_categories = $this->db->get_where('rudra_nurse_category',array('status'=>'Active'))->result(); 
			$data['nurse_categories'] = $nurse_categories;
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            $html = $this->load->view("facility/forms/_ajax_rudra_jobs_form", $data, TRUE);
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
				 'sm_id' => $this->input->post('sm_id',true),
				 'fc_cat_id' => $this->input->post('fc_cat_id',true),
				 'cg_cat_id' => $this->input->post('cg_cat_id',true),
				 'job_title' => $this->input->post('job_title',true),
				 'job_description' => $this->input->post('job_description',true),
				 'shift_type' => $this->input->post('shift_type',true),
				 'job_hours' => $this->input->post('job_hours',true),
				 'is_premium' => $this->input->post('is_premium',true),
				 'job_rate' => $this->input->post('job_rate',true),
				 'job_prem_rate' => $this->input->post('job_prem_rate',true),
				 'status' => $this->input->post('status',true),
				);
                $this->db->where('id',$id);
				$this->db->where('fo_id',$this->session->userdata('rudra_fo_id'));
                $this->db->update($this->full_table,$updateArray);
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
				 'fo_id' => $this->session->userdata('rudra_fo_id'),
				 'sm_id' => $this->input->post('sm_id',true),
				 'fc_cat_id' => $this->input->post('fc_cat_id',true),
				 'cg_cat_id' => $this->input->post('cg_cat_id',true),
				 'job_title' => $this->input->post('job_title',true),
				 'job_description' => $this->input->post('job_description',true),
				 'shift_type' => $this->input->post('shift_type',true),
				 'job_hours' => $this->input->post('job_hours',true),
				 'is_premium' => $this->input->post('is_premium',true),
				 'job_rate' => $this->input->post('job_rate',true),
				 'job_prem_rate' => $this->input->post('job_prem_rate',true),
				 'status' => $this->input->post('status',true),
				);

                $this->db->insert($this->full_table,$updateArray);
                $id = $this->db->insert_id();
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
            $filename = strtolower('rudra_jobs').'_'.date('d-m-Y').".csv";
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