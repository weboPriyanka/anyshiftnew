
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_facility_transactions_crtl extends CI_Controller
{   public  $default_data = array();           
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_facility_transactions';
		$this->load->helper('User_helper');
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
		$this->load->model('Rudra_facility_owner_rudra_model');
        $this->load->model('rudra_facility_transactions_rudra_model','rudram');
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
	//Rudra_facility_transactions_crtl ROUTES
        $crud_master = $crm . "Rudra_facility_transactions_crtl/";
        $route['rudra_facility_transactions'] = $crud_master . 'index';
        $route['rudra_facility_transactions/index'] = $crud_master . 'index';
        $route['rudra_facility_transactions/list'] = $crud_master . 'list';
        $route['rudra_facility_transactions/post_actions/(:any)'] = $crud_master.'post_actions/$1';
	**************/

    public function index()
    {
        // main index codes goes here
        $data['pageTitle'] = ' Facility Transactions';                        
        $data['page_template'] = '_rudra_facility_transactions';
        $data['page_first_header'] = ' Admin Transactions';
        $data['page_second_header'] = ' Nurse Transactions';
        $data['load_type'] = 'all';  
        $data['account_balance'] =  balance($this->session->userdata('rudra_fo_id'));	
//print_r($data['account_balance']);die;		
        $this->load->view('facility/template', $data);
    }
	public function invoice($transactionID)
    {
        // main index codes goes here
		$fo_id = $this->session->userdata('rudra_fo_id');
        $data['pageTitle'] = 'Facility Invoice';                        
        $data['page_template'] = '_rudra_facility_invoice';
        $data['page_header'] = ' Facility Transactions';
        $data['load_type'] = 'all';  
		$whereSearch->kind = "id";
		$whereSearch->Value = $fo_id;
		$data['FacilityDetails'] = $this->Rudra_facility_owner_rudra_model->facility($whereSearch);
		
		if(!empty($data['FacilityDetails'])){
			$data['TransactionDetails'] = $this->rudram->transaction(array('id'=>$transactionID));
			
			$this->db->select('rudra_jobs.id,rudra_facility_category.fc_name,rudra_nurse_category.nc_name,rudra_shift_manager.sm_fname,rudra_shift_manager.sm_lname,rudra_shift_manager.sm_mobile,rudra_jobs.job_title,rudra_jobs.job_description,rudra_jobs.shift_type,rudra_jobs.end_date,rudra_jobs.status,rudra_jobs.job_hours,rudra_jobs.job_rate,rudra_jobs.job_prem_rate,rudra_jobs.start_date,rudra_jobs.end_date,rudra_jobs.is_premium');
			$this->db->join('rudra_shift_manager', 'rudra_shift_manager.id = rudra_jobs.sm_id');
			$this->db->join('rudra_facility_category', 'rudra_facility_category.id = rudra_jobs.fc_cat_id');
			$this->db->join('rudra_nurse_category', 'rudra_nurse_category.id = rudra_jobs.cg_cat_id');
			$data['JobDetails'] = $this->db->get_where('rudra_jobs',array('rudra_jobs.id'=>$data['TransactionDetails']['ad_id'],'rudra_jobs.fo_id'=>$fo_id))->row_array();
			$data['JobNurseDetails'] = $this->db->get_where('rudra_jobs_nurse',array('rudra_jobs_nurse.job_id'=>$data['JobDetails']['id']))->result_array();
			$i=0;
			foreach($data['JobNurseDetails'] as $row){
				$data['NurseDetails'][$i] =  $this->db->get_where('rudra_care_giver',array('id'=>$row['cg_id']))->row_array();
				
				$data['NurseEarnings'][$i] =  $this->db->get_where('rudra_nurse_earnings',array('job_id'=>$data['JobDetails']['id'],'cg_id'=>$row['cg_id']))->row_array();
				//echo $this->db->last_query();die;
				$i++;
			}
		}
		$this->load->view('facility/template', $data);
    }
	
	public function searchByNurse()
	{   
		$find = $this->input->post('searchBy',true);
        $ajax_data = $this->rudram->find($find);
		
		if(!empty($ajax_data)){
			$this->data =array('ajax_data'=> $ajax_data);
			$message = $this->load->view('crm/ajax/CareGiverName',$this->data,TRUE);
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
	public function searchbyjob()
	{   
		$find = $this->input->post('searchBy2',true);
		$whereSearch->kind = "fo_id";
		$whereSearch->Value = $this->session->userdata('rudra_fo_id');
        $ajax_data = $this->rudram->findbyJob($find,$whereSearch);
		
		if(!empty($ajax_data)){
			$this->data =array('ajax_data'=> $ajax_data);
			$message = $this->load->view('crm/ajax/JobName',$this->data,TRUE);
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
        $orderArray = array('id', 'fwt_amount', 'fwt_type', 'status','name','job_title', 'ad_type', );
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$add_type = "Admin";
		$dir   = $this->input->post('order')[0]['dir'];
		$order   = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$general_search = $this->input->post('search')['value'];
		$whereSearch->kind = "fo_id";
		$whereSearch->Value = $this->session->userdata('rudra_fo_id');
		$filter_data['job_id'] = html_escape($this->input->post('job_id',true));
		$filter_data['searchByJob'] = html_escape($this->input->post('searchByJob',true));
		$filter_data['cg_id'] = html_escape($this->input->post('cg_id',true));
		$filter_data['searchByCare'] = html_escape($this->input->post('searchByCare',true));
		$job_id1 = array();
		$job_id2 = array();
		$job_id3 = array();
		if((!empty($filter_data['job_id']))&&!empty($filter_data['cg_id']))
		{ 
			$this->db->select('GROUP_CONCAT( job_id SEPARATOR ",") as job_ids ');
			$res = $this->db->where('rudra_jobs_nurse.cg_id',$filter_data['cg_id'])->where('job_id',$filter_data['job_id'])->get('rudra_jobs_nurse')->row_array();
			$job_id1 = explode(',',$res['job_ids']);
		}else{
		if(!empty($filter_data['searchByCare']))
		{
			$find = $filter_data['searchByCare'];
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids');
			$this->db->group_start();
			$this->db->like('cg_fname',$find);
			$this->db->or_like('cg_lname',$find);
			$this->db->or_like('cg_mobile',$find);
			$this->db->group_end();
			$res = $this->db->get('rudra_care_giver')->row_array();
			$cg_ids = explode(',',$res['ids']);
			// cg_id got find job ids
			$this->db->select('GROUP_CONCAT( job_id SEPARATOR ",") as job_ids ');
			$res = $this->db->where_in('rudra_jobs_nurse.cg_id',$cg_ids)->get('rudra_jobs_nurse')->row_array();
			$job_id1 = explode(',',$res['job_ids']);
		}
		if(!empty($filter_data['searchByJob'])){ 	
		    //Job Ids
			$find = $filter_data['searchByJob'];
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids');
			$this->db->group_start();
			$this->db->where('fo_id',$this->session->userdata('rudra_fo_id'));
			$this->db->like('job_title',$find);
			$this->db->or_like('job_description',$find);
			$this->db->group_end();
			$res = $this->db->get('rudra_jobs')->row_array();
			$job_id2 = explode(',',$res['ids']);
		}
		if(!empty($filter_data['cg_id'])){	
		    $this->db->select('GROUP_CONCAT(job_id SEPARATOR ",") as job_ids ');
			$data = $this->db->where_in('rudra_jobs_nurse.cg_id',$filter_data['cg_id'])->where_in('',)->get('rudra_jobs_nurse')->row_array();
			$job_id3 = explode(',',$data['job_ids']);
			}
		}
		$job_id2 = array_merge($job_id1,$job_id2);
		$filter_data['job_id'] = array_merge($job_id2,$job_id3);
		$filter_data['job_id'] =array_filter($filter_data['job_id']);
		$filter_data['job_id'] = implode(',',$filter_data['job_id']);
		$filter_data['start_date'] = html_escape($this->input->post('start_date',true));
		$filter_data['end_date'] = html_escape($this->input->post('end_date',true));
		$totalData = $this->rudram->count_table_data($filter_data,$add_type,$this->full_table,$whereSearch);
		$totalFiltered = $totalData; //Initailly Total and Filtered count will be same
		$rescheck = '';
		$leftJoin1= '';
		$leftJoin2= '';
		$leftJoin3= '';
		$rows = $this->rudram->get_table_data($add_type,$limit,$start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table,$leftJoin1,$leftJoin2,$leftJoin3,$whereSearch);
		$rows_count = $this->rudram->count_table_data($filter_data,$add_type,$this->full_table,$whereSearch);
		$totalFiltered = $rows_count;
		$new->previous_balance = 0;
		$new->current_balance = 0;
		$new->credit_amount = 0;
		$new->debit_amount = 0;  
		// echo "<pre>"; print_r($rows); die();
		if(!empty($rows))
		{
			$res_json = array();
			foreach ($rows as $row)
			{
				$row->fwt_amount = "$".$row->fwt_amount;
				$row->job_title = '';
				$row->name = '';
				if($row->ad_type=='job'){
					$JobDetails = $this->db->get_where('rudra_jobs',array('rudra_jobs.id'=>$row->ad_id))->row_array();
					$row->job_title = $JobDetails['job_title'];
				}else{
					$admin = $this->db->get_where('rudra_admin',array('rudra_admin.id'=>$row->ad_id))->row_array();
					$row->name = $admin['name'];
				}
				$actions_base_url = 'facility-facility-transactions/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'facility-facility-transactions/post_actions';
				$action_url = 'facility-facility-transactions/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
				$actions_button ="<a id='edt$row->id' href='facility-facility-invoice/$row->id' class='label label-success text-white f-12'  >Invoice</a>";
				$row->actions = $actions_button;
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
							'data'           => $data);
		echo json_encode($json_data);
    }
    
    public function nurselist()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array('id', 'fwt_amount', 'fwt_type', 'status','name','job_title', 'ad_type', );
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$add_type = "Nurse";
		$dir   = $this->input->post('order')[0]['dir'];
		$order   = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$general_search = $this->input->post('search')['value'];
		$whereSearch->kind = "fo_id";
		$whereSearch->Value = $this->session->userdata('rudra_fo_id');
		$filter_data['job_id'] = html_escape($this->input->post('job_id',true));
		$filter_data['searchByJob'] = html_escape($this->input->post('searchByJob',true));
		$filter_data['cg_id'] = html_escape($this->input->post('cg_id',true));
		$filter_data['searchByCare'] = html_escape($this->input->post('searchByCare',true));
		$job_id1 = array();
		$job_id2 = array();
		$job_id3 = array();
		if((!empty($filter_data['job_id']))&&!empty($filter_data['cg_id']))
		{ 
			$this->db->select('GROUP_CONCAT( job_id SEPARATOR ",") as job_ids ');
			$res = $this->db->where('rudra_jobs_nurse.cg_id',$filter_data['cg_id'])->where('job_id',$filter_data['job_id'])->get('rudra_jobs_nurse')->row_array();
			$job_id1 = explode(',',$res['job_ids']);
		}else{
		if(!empty($filter_data['searchByCare']))
		{
			$find = $filter_data['searchByCare'];
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids');
			$this->db->group_start();
			$this->db->like('cg_fname',$find);
			$this->db->or_like('cg_lname',$find);
			$this->db->or_like('cg_mobile',$find);
			$this->db->group_end();
			$res = $this->db->get('rudra_care_giver')->row_array();
			$cg_ids = explode(',',$res['ids']);
			// cg_id got find job ids
			$this->db->select('GROUP_CONCAT( job_id SEPARATOR ",") as job_ids ');
			$res = $this->db->where_in('rudra_jobs_nurse.cg_id',$cg_ids)->get('rudra_jobs_nurse')->row_array();
			$job_id1 = explode(',',$res['job_ids']);
		}
		if(!empty($filter_data['searchByJob'])){ 	
		    //Job Ids
			$find = $filter_data['searchByJob'];
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids');
			$this->db->group_start();
			$this->db->where('fo_id',$this->session->userdata('rudra_fo_id'));
			$this->db->like('job_title',$find);
			$this->db->or_like('job_description',$find);
			$this->db->group_end();
			$res = $this->db->get('rudra_jobs')->row_array();
			$job_id2 = explode(',',$res['ids']);
		}
		if(!empty($filter_data['cg_id'])){	
		    $this->db->select('GROUP_CONCAT(job_id SEPARATOR ",") as job_ids ');
			$data = $this->db->where_in('rudra_jobs_nurse.cg_id',$filter_data['cg_id'])->where_in('',)->get('rudra_jobs_nurse')->row_array();
			$job_id3 = explode(',',$data['job_ids']);
			}
		}
		$job_id2 = array_merge($job_id1,$job_id2);
		$filter_data['job_id'] = array_merge($job_id2,$job_id3);
		$filter_data['job_id'] =array_filter($filter_data['job_id']);
		$filter_data['job_id'] = implode(',',$filter_data['job_id']);
		$filter_data['start_date'] = html_escape($this->input->post('start_date',true));
		$filter_data['end_date'] = html_escape($this->input->post('end_date',true));
		$totalData = $this->rudram->count_table_data($filter_data,$add_type,$this->full_table,$whereSearch);
		$totalFiltered = $totalData; //Initailly Total and Filtered count will be same
		$rescheck = '';
		$leftJoin1= '';
		$leftJoin2= '';
		$leftJoin3= '';
		$rows = $this->rudram->get_table_data($add_type,$limit, $start, $orderColumn, $dir, $filter_data,$rescheck,$this->full_table,$leftJoin1,$leftJoin2,$leftJoin3,$whereSearch);
		$rows_count = $this->rudram->count_table_data($filter_data,$add_type,$this->full_table,$whereSearch);
		$totalFiltered = $rows_count;
		$new->previous_balance = 0;
		$new->current_balance = 0;
		$new->credit_amount = 0;
		$new->debit_amount = 0;  
		// echo "<pre>"; print_r($rows); die();
		if(!empty($rows))
		{
			$res_json = array();
			foreach ($rows as $row)
			{
				$row->fwt_amount = "$".$row->fwt_amount;
				$row->job_title = '';
				$row->name = '';
				if($row->ad_type=='job'){
					$JobDetails = $this->db->get_where('rudra_jobs',array('rudra_jobs.id'=>$row->ad_id))->row_array();
					$row->job_title = $JobDetails['job_title'];
				}else{
					$admin = $this->db->get_where('rudra_admin',array('rudra_admin.id'=>$row->ad_id))->row_array();
					$row->name = $admin['name'];
				}
				$actions_base_url = 'facility-facility-transactions/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'facility-facility-transactions/post_actions';
				$action_url = 'facility-facility-transactions/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
				$actions_button ="<a id='edt$row->id' href='facility-facility-invoice/$row->id' class='label label-success text-white f-12'  >Invoice</a>";
				$row->actions = $actions_button;
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
							'data'           => $data);
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
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            //print_r($data);exit;

            $html = $this->load->view("crm/forms/_ajax_rudra_facility_transactions_form", $data, TRUE);
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
				 'fo_id' => $this->input->post('fo_id',true),
				 'fwt_amount' => $this->input->post('fwt_amount',true),
				 'fwt_type' => $this->input->post('fwt_type',true),
				 'status' => $this->input->post('status',true),
				 'ad_id' => $this->input->post('ad_id',true),
				 'ad_type' => $this->input->post('ad_type',true),
				);

                $this->db->where('id',$id);
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
				 'fo_id' => $this->input->post('fo_id',true),
				 'fwt_amount' => $this->input->post('fwt_amount',true),
				 'fwt_type' => $this->input->post('fwt_type',true),
				 'status' => $this->input->post('status',true),
				 'ad_id' => $this->input->post('ad_id',true),
				 'ad_type' => $this->input->post('ad_type',true),
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
            $filename = strtolower('rudra_facility_transactions').'_'.date('d-m-Y').".csv";
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

    public function nurse()
    {
        // main index codes goes here
        $data['pageTitle'] = ' Facility Nurse Transactions';                        
        $data['page_template'] = '_rudra_facility_nurse_transactions';
        $data['page_first_header'] = ' Admin Transactions';
        $data['page_second_header'] = ' Nurse Transactions';
        $data['load_type'] = 'all';  
        $data['account_balance'] =  balance($this->session->userdata('rudra_fo_id'));	
		// echo "<pre>"; print_r($data);die();		
        $this->load->view('facility/template', $data);
    }
                    
}