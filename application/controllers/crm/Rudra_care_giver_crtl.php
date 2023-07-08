
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_care_giver_crtl extends CI_Controller
{   public  $default_data = array();        
    public function __construct()
    {
        parent::__construct();                
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_care_giver';
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
        //$this->set_data();
        $this->base_id = 0;
        $this->load->helper('User_helper'); 
        $this->load->model('crudmaster_model','crd');
        $this->load->model('rudra_care_giver_rudra_model','rudram');
		// FO Edit Job Notifications
		$this->db->select('concat(rudra_facility_owner.fo_fname," ",rudra_facility_owner.fo_lname) as fo_name,notifications.*');
		$this->db->join('rudra_facility_owner', 'rudra_facility_owner.id = notifications.user_id');
		$FoJobNotifications = $this->db->from('notifications')->where('notifications.user_type','fo')->where('notifications.not_type','job')->where('notifications.admin_status','unread')->order_by('id', 'desc')->get()->result_array();
       
	   foreach($FoJobNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
		   $data['FoJobNotifications'][] = $job;
	   }
		// SM Job Notifications
		$this->db->select('concat(rudra_shift_manager.sm_fname," ",rudra_shift_manager.sm_lname) as sm_name,notifications.*');
		$this->db->join('rudra_shift_manager', 'rudra_shift_manager.id = notifications.user_id');
		$JobNotifications = $this->db->from('notifications')->where('notifications.user_type','sm')->where('notifications.not_type','job')->where('notifications.admin_status','unread')->order_by('id', 'desc')->get()->result_array();
       
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
		$CGJobNotifications = $this->db->from('notifications')->where('notifications.user_type','cg')->where('notifications.not_type','job')->where('notifications.admin_status','unread')->order_by('id', 'desc')->get()->result_array();
	   foreach($CGJobNotifications as $job){
			 $job['added_on'] = $this->timeago($job['added_on']);
			 $job['cg_profile_pic'] = base_url($job['cg_profile_pic']);
		   $data['CGJobNotifications'][] = $job;
	   }
	   // FO  Transactions Notifications- 
		$this->db->select('concat(rudra_facility_owner.fo_fname," ",rudra_facility_owner.fo_lname) as fo_name,notifications.*');
		$this->db->join('rudra_facility_owner', 'rudra_facility_owner.id = notifications.user_id');
		$FOTranNotifications = $this->db->from('notifications')->where('notifications.user_type','fo')->where('notifications.not_type','transaction')->where('notifications.admin_status','unread')->order_by('id', 'desc')->get()->result_array();
       foreach($FOTranNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
		   $data['FOTranNotifications'][] = $job;
	   }
	   //echo "----";print_r($smIds);
		   
		//echo "----";print_r($job_ids);
		//echo "----";print_r($cg_ids);die;
		// CG  Transactions Notifications
		if(!empty($job_ids)&&!empty($cg_ids)){
		$this->db->select('concat(rudra_care_giver.cg_fname," ",rudra_care_giver.cg_lname) as cg_name,rudra_care_giver.cg_profile_pic,notifications.*');
		$this->db->join('rudra_care_giver', 'rudra_care_giver.id = notifications.user_id');
		$CGTransNotifications = $this->db->from('notifications')->where('notifications.user_type','cg')->where('notifications.not_type','transaction')->where('notifications.admin_status','unread')->order_by('id', 'desc')->get()->result_array();
        foreach($CGTransNotifications as $job){
		     $job['added_on'] = $this->timeago($job['added_on']);
			 $job['cg_profile_pic'] = base_url($job['cg_profile_pic']);
		   $data['CGTransNotifications'][] = $job;
	   }
		}
	   $this->default_data = array('data'=>$data);
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
	//Rudra_care_giver_crtl ROUTES
        $crud_master = $crm . "Rudra_care_giver_crtl/";
        $route['rudra_care_giver'] = $crud_master . 'index';
        $route['rudra_care_giver/index'] = $crud_master . 'index';
        $route['rudra_care_giver/list'] = $crud_master . 'list';
        $route['rudra_care_giver/post_actions/(:any)'] = $crud_master.'post_actions/$1';
	**************/
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
    public function index()
    {
        // main index codes goes here
        $data['pageTitle'] = ' Care Giver';                        
        $data['page_template'] = '_rudra_care_giver';
        $data['page_header'] = ' Care Giver';
        $data['load_type'] = 'all';                
        $this->load->view('crm/template', $data);
    }
    public function list()
    {
        // main index codes goes here
        //Creating Cols Array used for Ordering the table: ASC and Descending Order
        //If you change the Columns(of DataTable), please change here too
        $orderArray = array(  'id', 'cg_name', 'cg_mobile', 'cg_fcm_token', 'cg_device_token', 'cg_profile_pic', 'cg_lat', 'cg_long', 'cg_address', 'cg_zipcode',  'hours_completed', 'total_earned', 'average_rating','status', );
		$limit = html_escape($this->input->post('length'));
		$start = html_escape($this->input->post('start'));
		$order = '';
		$dir   = $this->input->post('order')[0]['dir'];
		$order   = $this->input->post('order')[0]['column'];
		$orderColumn = $orderArray[$order];
		$general_search = $this->input->post('search')['value'];
		$filter_data['general_search'] = $general_search;
		$filter_data['id'] = html_escape($this->input->post('id',true));
		$filter_data['searchBy'] = html_escape($this->input->post('searchBy',true));
		$filter_data['start_date'] = html_escape($this->input->post('start_date',true));
		$filter_data['end_date'] = html_escape($this->input->post('end_date',true));
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
				// $row->total_earned = "$".$row->total_earned;
                $actions_base_url = 'care-giver/post_actions';
				$actions_query_string = "?id= $row->id.'&target_table='.$row->id";
				$form_data_url = 'care-giver/post_actions';
				$action_url = 'care-giver/post_actions';
				$sucess_badge =  "class=\'badge badge-success\'";
				$danger_badge =  "class=\'badge badge-danger\'";
				$info_badge =  "class=\'badge badge-info\'";
				$warning_badge =  "class=\'badge badge-warning\'";
				$row->cg_profile_pic = '<img src="'.base_url($row->cg_profile_pic).'" width="50%" />';
                $actions_button ="<a id='edt$row->id' href='javascript:void(0)' class='label label-success text-white f-12' onclick =\"static_form_modal('$form_data_url/get_data?id=$row->id','$action_url/update_data','md','Update Details')\" >Edit</a>";
                $actions_button .= "<a href='" . base_url('care-giver/view/' . $row->id) . "' class='label label-primary text-white f-12'>View</a> ";

                $row->actions = $actions_button;

                $row->total_earned = "$".number_format((float)$row->total_earned, 2, '.', '');
				//JOINS LOGIC
                $row->added_on = date('d M, Y',strtotime($row->added_on));

				$data[] = $row;
                // $echo "<pre>"; print_r($data); die();
                
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
            if(!empty($data['json_cols']))
            {
                foreach($data['json_cols'] as $k => $v)
                {
                    $data['json_values'][$v] = $data['form_data']->$v;
                }
            }
            //print_r($data);exit;

            $html = $this->load->view("crm/forms/_ajax_rudra_care_giver_form", $data, TRUE);
            $this->return_data['data']['form_data'] = $html;
        }
        // Post Methods
        //Update Codes
        if($action == "update_data")
        {
			$validations = array(
							array('field' => 'cg_mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|numeric|min_length[9]|max_length[11]'), 
							array('field' => 'cg_zipcode', 'label' => 'Zip Code', 'rules' => 'trim|required|numeric|min_length[4]|max_length[7]') 
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
				 'cg_fname' => $this->input->post('cg_fname',true),
				 'cg_lname' => $this->input->post('cg_lname',true),
				 'cg_mobile' => $this->input->post('cg_mobile',true),
				 'cg_address' => $this->input->post('cg_address',true),
				 'cg_zipcode' => $this->input->post('cg_zipcode',true),
				 'status' => $this->input->post('status',true),
				 'hours_completed' => $this->input->post('hours_completed',true),
				 'total_earned' => $this->input->post('total_earned',true),
				 'average_rating' => $this->input->post('average_rating',true),
                 'nurse_degree' => $this->input->post('nurse_degree',true),
                 'job_type' => $this->input->post('job_type',true),
                 'premium' => $this->input->post('premium',true),
                 'speciality' => $this->input->post('speciality',true),
                 'license_state' => $this->input->post('license_state',true),
                 'license_number' => $this->input->post('license_number',true),
                 'license_type' => $this->input->post('license_type',true),
                 'search_status' => $this->input->post('search_status',true),
                 'university_name' => $this->input->post('university_name',true),
                 'university_country' => $this->input->post('university_country',true),
                 'university_state' => $this->input->post('university_state',true),
                 'university_city' => $this->input->post('university_city',true),
                 'slot' => $this->input->post('slot',true),
                 'job_title' => $this->input->post('job_title',true),
                 'feedback' => $this->input->post('feedback',true),
                 'search_cred' => $this->input->post('search_cred',true),
                 'expiration_date' => $this->input->post('expiration_date',true),
                 'effective_date' => $this->input->post('effective_date',true),
                 'hourly_charges' => $this->input->post('hourly_charges',true),
                 'preferred_days' => $this->input->post('preferred_days',true),
                 'preferred_geography' => $this->input->post('preferred_geography',true),
                 'preferred_shift' => $this->input->post('preferred_shift',true),
                 'assignment_duration' => $this->input->post('assignment_duration',true),
                 'shift_duration' => $this->input->post('shift_duration',true),
                 'availability' => $this->input->post('availability',true),
                 'earliest_start_date' => $this->input->post('earliest_start_date',true),
                //  'speciality' => $this->input->post('speciality',true),
                //  'speciality' => $this->input->post('speciality',true),

				);

                $this->db->where('id',$id);
				
                $this->db->update($this->full_table,$updateArray);
				if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads/careGiver';
                //$thumbpath = 'app_assets/uploads/careGiver/thumb';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('cg_profile_pic'))
                {
                    //$error = array('error' => $this->upload->display_errors());
                    //print_r($error);
					$this->return_data = array(
			'status' => 'error',
                'msg' => $this->upload->display_errors());
                    
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
					$up_array = array(
                                    'cg_profile_pic' => $bannerpath . '/' . $uploadedImage['file_name']
                                );
					$this->db->where('id', $id);
					$this->db->update($this->full_table, $up_array);
					$this->return_data = array(
				'status' => 'success',
                'msg' => 'Updated successfully.');
                }
            }
				$this->return_data = array(
				'status' => 'success',
                'msg' => 'Updated successfully.');
            }
            
			
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
				 'cg_fname' => $this->input->post('cg_fname',true),
				 'cg_lname' => $this->input->post('cg_lname',true),
				 'cg_mobile' => $this->input->post('cg_mobile',true),
				 'cg_address' => $this->input->post('cg_address',true),
				 'cg_zipcode' => $this->input->post('cg_zipcode',true),
				 'status' => $this->input->post('status',true),
				 'hours_completed' => $this->input->post('hours_completed',true),
				 'total_earned' => $this->input->post('total_earned',true),
				 'average_rating' => $this->input->post('average_rating',true),
                 'nurse_degree' => $this->input->post('nurse_degree',true),
                 'job_type' => $this->input->post('job_type',true),
                 'premium' => $this->input->post('premium',true),
                 'speciality' => $this->input->post('speciality',true),
                 'license_state' => $this->input->post('license_state',true),
                 'license_number' => $this->input->post('license_number',true),
                 'license_type' => $this->input->post('license_type',true),
                 'search_status' => $this->input->post('search_status',true),
                 'university_name' => $this->input->post('university_name',true),
                 'university_country' => $this->input->post('university_country',true),
                 'university_state' => $this->input->post('university_state',true),
                 'university_city' => $this->input->post('university_city',true),
                 'slot' => $this->input->post('slot',true),
                 'job_title' => $this->input->post('job_title',true),
                 'feedback' => $this->input->post('feedback',true),
                 'search_cred' => $this->input->post('search_cred',true),
                 'expiration_date' => $this->input->post('expiration_date',true),
                 'effective_date' => $this->input->post('effective_date',true),
                 'hourly_charges' => $this->input->post('hourly_charges',true),
                 'preferred_days' => $this->input->post('preferred_days',true),
                 'preferred_geography' => $this->input->post('preferred_geography',true),
                 'preferred_shift' => $this->input->post('preferred_shift',true),
                 'assignment_duration' => $this->input->post('assignment_duration',true),
                 'shift_duration' => $this->input->post('shift_duration',true),
                 'availability' => $this->input->post('availability',true),
                 'earliest_start_date' => $this->input->post('earliest_start_date',true),
				);
                $this->db->insert($this->full_table,$updateArray);
                $id = $this->db->insert_id();
            }
            if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
            {
                $bannerpath = 'app_assets/uploads/careGiver';
                //$thumbpath = 'uploads/intro_banner';
                $config['upload_path'] = $bannerpath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('cg_profile_pic'))
                {
                    $this->return_data = array('status' => 'error','msg' => $this->upload->display_errors());
                }
                else
                {
                    $imagedata = array('image_metadata' => $this->upload->data());
                    $uploadedImage = $this->upload->data();
					$up_array = array( 'cg_profile_pic' => $bannerpath . '/' . $uploadedImage['file_name']);
					$this->db->where('id', $id);
					$this->db->update($this->full_table, $up_array);
					$this->return_data = array('status' => 'success','msg' => 'Updated successfully.');
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
            $filename = strtolower('rudra_care_giver').'_'.date('d-m-Y').".csv";
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


    public function viewDetail($id)
    {
        $data['nurseData'] = $this->db->get_where($this->full_table,array('id'=>$id))->row(); 

        $data['nurseData']->docs = $this->db->get_where('rudra_nurse_docs',array('cg_id'=>$id))->result(); 


        $data['pageTitle'] = ' View Care giver';
        $data['page_template'] = '_rudra_care_giver_view';
        $data['page_header'] = 'View Care giver';
        $data['load_type'] = 'all';
        $this->load->view('crm/template', $data);
    }
                    
}