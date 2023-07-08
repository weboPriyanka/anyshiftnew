<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{   public  $default_data = array(); 
	public function __construct()
	{
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Rudra_facility_owner_rudra_model');
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
		$this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
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
	public function profile()
	{
		$data['page_title'] = "Admin Profile";
		$data['page_template'] = '_rudra_admin_profile';
        $data['page_header'] = 'Admin Profile';
        $data['load_type'] = 'all';
		//Facility Owners
		$this->db->select('COUNT(id) as counts');
		$data['facility_owners'] = $this->db->get('rudra_facility_owner')->row_array();
		// Shift Managers
		$this->db->select('COUNT(id) as counts');
		$data['shift_managers'] = $this->db->get('rudra_shift_manager')->row_array();
		// Care Givers
		$this->db->select('COUNT(id) as counts');
		$data['care_givers'] = $this->db->get('rudra_care_giver')->row_array();
		// Active JObs  
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
		$data['activeJobs'] = $this->db->where('rudra_jobs.status','Active')->get('rudra_jobs')->row_array();
		// Completed JObs  
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
		$data['completedJobs'] = $this->db->where('rudra_jobs.status','Published')->get('rudra_jobs')->row_array();
		
		$data['profileDetails'] = $this->db->get_where($this->bdp . 'admin', array('id' => $this->session->userdata('rudra_admin_id')))->row_array();
		$this->load->view('crm/template', $data);
	}
	public function update_profile()
    {
        
        //Update Codes
		$id = $this->session->userdata('rudra_admin_id');
			if($this->input->post('username') != $this->input->post('original')) {
			   $is_unique =  '|is_unique[rudra_admin.username]';
			} else {
			   $is_unique =  '';
			}
			$validations = array(array('field' => 'name', 'label' => ' Full Name', 'rules' => 'trim|required'),
			array('field' => 'username', 'label' => ' Username', 'rules' => 'trim|required'.$is_unique));
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $this->return_data = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { 
				if(!empty($_POST))
				{
					$updateArray = array( 
					 'name' => $this->input->post('name',true),
					 'username' => $this->input->post('username',true));
					$this->db->where('id',$id);
					$this->db->update('rudra_admin',$updateArray);
					$this->session->set_userdata($updateArray);
				}
			    $this->return_data = array('status' => 'success','msg' => 'Profile updated successfully.');
			}
        echo json_encode($this->return_data);
		exit;
    }
	public function oldpassword_check($old_password){
	   $old_password_hash =SHA1($old_password);
	   $where = array('id'=>$this->session->userdata('rudra_admin_id'));
	   $old_password_db_hash = $this->db->get_where('rudra_admin',$where)->row_array();
	   $old_password_db_hash = @$old_password_db_hash['password'];
	   if($old_password_hash != $old_password_db_hash)
	   {
		  $this->form_validation->set_message('oldpassword_check', 'Current Password doesnot match.');
		  return FALSE;
	   } 
	   return TRUE;
	}
	public function edit_password()
	{   
		$validations = array(array('field' => 'password', 'label' => 'Current Password', 'rules' => 'trim|required|callback_oldpassword_check'),
							
		array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|min_length[4]|max_length[10]'),
							array('field' => 'confirm_password', 'label' => 'Confirm New Password ', 'rules' => 'trim|required|min_length[4]|max_length[10]|matches[new_password]') 
						 );
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $response = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { 
				$updateArray = array('password' => SHA1($this->input->post('new_password',true)));
				$where = array('id'=>$this->session->userdata('rudra_admin_id'));
				$id = $this->db->update($this->bdp .'admin',$updateArray);
			if($id){
				$response = array(
                'status' => 'success',
                'msg' => " Password changed successfully.");
                }else{ 
                    $response = array(
					'status' => 'error',
                'msg' => 'Something went wrong, please try again later.');  
                } 
        }
		echo json_encode($response);
        exit;		
	}
	public function index()
	{
		if ($this->session->userdata('rudra_admin_logged_in')) {
			$data['pageTitle'] = "Admin Dashboard";
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['facility'] = $this->db->get('rudra_facility_owner')->row_array();	
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['nurses'] = $this->db->get('rudra_care_giver')->row_array();
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['shift_managers'] = $this->db->get('rudra_shift_manager')->row_array();
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['jobs'] = $this->db->get('rudra_jobs')->row_array();
			$data['nurseDetails'] = $this->db->select('*')->from('rudra_care_giver')->order_by('id', 'desc')->limit(10)->get()->result_array();
			$this->db->select('rudra_jobs.id,rudra_facility_category.fc_name,rudra_jobs.job_title,rudra_jobs.shift_type,rudra_jobs.end_date,rudra_jobs.status,rudra_jobs.job_hours,rudra_jobs.job_rate,rudra_jobs.job_prem_rate,rudra_jobs.start_date,rudra_jobs.end_date,rudra_jobs.is_premium');
			
			$this->db->join('rudra_facility_category', 'rudra_facility_category.id = rudra_jobs.fc_cat_id');
			$data['jobDetails'] = $this->db->from('rudra_jobs')->order_by('id', 'desc')->limit(10)->get()->result_array();
			$data['facilityDetails'] = $this->db->select('*')->from('rudra_facility_owner')->order_by('id', 'desc')->limit(10)->get()->result_array();
			$this->db->select('rudra_facility_owner.fo_fname,rudra_facility_owner.fo_lname,rudra_shift_manager.id,rudra_shift_manager.sm_fname,rudra_shift_manager.sm_lname,rudra_shift_manager.sm_mobile,rudra_shift_manager.status');
			$this->db->join('rudra_facility_owner', 'rudra_facility_owner.id = rudra_shift_manager.fo_id');
			$data['smDetails'] = $this->db->from('rudra_shift_manager')->order_by('id', 'desc')->limit(10)->get()->result_array();
			$data['page_template'] = "empty";
			// echo "<pre>"; print_r($data); die();
			$this->load->view('crm/template', $data);
		} else {
		    redirect(site_url('admin-login'), 'refresh');
		}
	}
	public function login()
	{
		$data['page_title'] = " Admin Login";
		$this->load->view('crm/login', $data);
	}
	public function check_login_admin()
	{
		// if (!$this->input->is_ajax_request()) {
		// 	exit('No direct script access allowed');
		// } else {
			$username = $this->input->post('username', true);
			$password = SHA1($this->input->post('password', true));
			$check = $this->db->get_where($this->bdp . 'admin', array('username' => $username, 'password' => $password))->row();
			//echo $this->db->last_query().'<br>'.sha1(123456);
			//print_r($check);exit;
			if(!empty($check))
			{
				if ($check->status == 1) {
					$adminlogin = array(
						'rudra_admin_status'            => $check->status,
						'rudra_admin_id'            => $check->id,
						'rudra_admin_name'          => $check->name,
						'rudra_admin_username'          => $check->username,
						'rudra_admin_logged_in'         => TRUE,
						'rudra_admin_utype'         => 1,
					);
					$return = 'admin/dashboard';
					$post = ($_POST['req_uri'] != '' ? ($_POST['req_uri'] == 'admin' ? $return : $_POST['req_uri']) : $return);
					$return_url = $post;
					$this->session->set_userdata($adminlogin);
					$this->return_data['msg'] = "Login Successfull, redirecting...";
					$this->return_data['login'] = true;
					$this->return_data['status'] = true;
					$this->return_data['data'] = array('url' => base_url("$return_url"));
				} 
				if ($check->status == 0) {
					$this->return_data['msg'] = "Account deactivated, Please contact to admin.";
				}
			} else {
				$this->return_data['msg'] = "Wrong credentials, Please try again";
			}
			echo json_encode($this->return_data);
			exit;
		// }
	}
	public function logout()
	{
		session_destroy();
		redirect(base_url('crm/admin'), 'refresh');
	}


	
}
