<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FacilityOwner extends CI_Controller
{   public  $default_data = array();
	public function __construct()
	{
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		$this->load->helper('User_helper');
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
		
	}
	public function fo_clear_notifications()
	{   // FO Edit Job Notifications
	    // Notifications
		$fo_id = $this->session->userdata('rudra_fo_id');
		// Shift Manager Job Notifications
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts');
		$data['shift_managers'] = $this->db->where('rudra_shift_manager.fo_id',$fo_id)->get('rudra_shift_manager')->row_array();
		$smIds = explode(',',$data['shift_managers']['ids']);
		// Job Notifications
		$JobNotifications = $this->db->where_in('notifications.user_id', $smIds)->where('notifications.user_type','sm')->where('notifications.not_type','job')->where('notifications.status','unread')->update('notifications',array('status'=>'read'));
       
	    // For Getting job Ids of Current FO
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts');
		$job_ids = $this->db->from('rudra_jobs')->where_in('rudra_jobs.sm_id', $smIds)->order_by('id', 'desc')->get()->row_array();
        $job_ids = explode(',',$job_ids['ids']);
		// For Getting Nurse Ids of current 
        $this->db->select('GROUP_CONCAT(cg_id SEPARATOR ",") as cg_ids');
		$cg_ids = $this->db->from('rudra_jobs_nurse')->where_in('rudra_jobs_nurse.job_id', $job_ids)->order_by('id', 'desc')->get()->row_array();
		$cg_ids = explode(',',$cg_ids['cg_ids']);
	   // CG  Job Notifications
	   
		$CGJobNotifications = $this->db->where_in('notifications.user_id', $cg_ids)->where_in('notifications.job_id', $job_ids)->where('notifications.user_type','cg')->where('notifications.not_type','job')->where('notifications.status','unread')->update('notifications',array('status'=>'read'));
		   
	   // FO  Transactions Notifications- 
		$FOTranNotifications = $this->db->where('notifications.user_id',$fo_id)->where('notifications.user_type','fo')->where('notifications.not_type','transaction')->where('notifications.status','unread')->update('notifications',array('status'=>'read'));
       
		// CG  Transactions Notifications
		if(!empty($job_ids)&&!empty($cg_ids)){
		$CGTransNotifications = $this->db->where_in('notifications.user_id', $cg_ids)->where_in('notifications.job_id', $job_ids)->where('notifications.user_type','cg')->where('notifications.not_type','transaction')->where('notifications.status','unread')->update('notifications',array('status'=>'read'));
        
		}
		if($CGTransNotifications && $FOTranNotifications&&$CGJobNotifications&&$JobNotifications){
			$response = array(
                'status' => 'success',
                'msg' => 'All Notifications marked as read.'
            );
		}else{
			$response = array(
                'status' => 'error',
                'msg' => 'No Result'
            );			
		}
	    echo json_encode($response);
		exit;
	}
	public function update_profile()
    {
        
        //Update Codes
		$fo_id = $this->session->userdata('rudra_fo_id');
			if($this->input->post('fo_email') != $this->input->post('fo_original')) {
			   $is_unique =  '|is_unique[rudra_facility_owner.fo_email]';
			} else {
			   $is_unique =  '';
			}
			$validations = array(array('field' => 'fo_fname', 'label' => ' First Name', 'rules' => 'trim|required'),
							array('field' => 'fo_lname', 'label' => ' Last Name', 'rules' => 'trim|required'), 
							array('field' => 'fo_mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|numeric|min_length[9]|max_length[11]'), 
							array('field' => 'fo_email', 'label' => ' Email', 'rules' => 'trim|required'.$is_unique));
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $this->return_data = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { 
				if(!empty($_POST))
				{
					$updateArray = array( 
					 'fo_fname' => $this->input->post('fo_fname',true),
					 'fo_lname' => $this->input->post('fo_lname',true),
					 'fo_mobile' => $this->input->post('fo_mobile',true),
					 'fo_email' => $this->input->post('fo_email',true));
					$this->db->where('id',$fo_id);
					$this->db->update('rudra_facility_owner',$updateArray);
					$this->session->set_userdata($updateArray);
				}
			    $this->return_data = array('status' => 'success','msg' => 'Profile updated successfully.');
			}
        echo json_encode($this->return_data);
		exit;
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
	public function index()
	{
		if ($this->session->userdata('rudra_fo_logged_in')) {
			$data['pageTitle'] = "Facility Owner Dashboard";
			$data['page_template'] = "empty";
			$fo_id = $this->session->userdata('rudra_fo_id');
			// Payment 
			$data['payment'] = $this->db->where('rudra_facility_wallet.fo_id',$fo_id)->get('rudra_facility_wallet')->row_array();
			// Shift Managers Details
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['shift_managers'] = $this->db->where('rudra_shift_manager.fo_id',$fo_id)->get('rudra_shift_manager')->row_array();
			$data['smDetails'] = $this->db->select('*')->from('rudra_shift_manager')->where('rudra_shift_manager.fo_id',$fo_id)->order_by('id', 'desc')->limit(5)->get()->result_array();
			// Active JObs Details 
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['jobs'] = $this->db->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Active')->get('rudra_jobs')->row_array();
			$this->db->select('rudra_jobs.id,rudra_facility_category.fc_name,rudra_jobs.job_title,rudra_jobs.shift_type,rudra_jobs.end_date,rudra_jobs.status,rudra_jobs.job_hours,rudra_jobs.job_rate,rudra_jobs.job_prem_rate,rudra_jobs.start_date,rudra_jobs.end_date,rudra_jobs.is_premium');
			$this->db->join('rudra_facility_category', 'rudra_facility_category.id = rudra_jobs.fc_cat_id');
			$data['jobDetails'] = $this->db->from('rudra_jobs')->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Active')->order_by('id', 'desc')->limit(5)->get()->result_array();
			// Pending JObs Details 
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['Pendingjobs'] = $this->db->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Pending')->get('rudra_jobs')->row_array();
			$this->db->select('rudra_jobs.id,rudra_facility_category.fc_name,rudra_jobs.job_title,rudra_jobs.shift_type,rudra_jobs.end_date,rudra_jobs.status,rudra_jobs.job_hours,rudra_jobs.job_rate,rudra_jobs.job_prem_rate,rudra_jobs.start_date,rudra_jobs.end_date,rudra_jobs.is_premium');
			$this->db->join('rudra_facility_category', 'rudra_facility_category.id = rudra_jobs.fc_cat_id');
			$data['PendingjobDetails'] = $this->db->from('rudra_jobs')->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Pending')->order_by('id', 'desc')->limit(5)->get()->result_array();
			// Published JObs Details 
			$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
			$data['Publishedjobs'] = $this->db->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Published')->get('rudra_jobs')->row_array();
			//echo $this->db->last_query();die;
			//print_r($data['Publishedjobs']); die;
			$this->db->select('rudra_jobs.id,rudra_facility_category.fc_name,rudra_jobs.job_title,rudra_jobs.shift_type,rudra_jobs.end_date,rudra_jobs.status,rudra_jobs.job_hours,rudra_jobs.job_rate,rudra_jobs.job_prem_rate,rudra_jobs.start_date,rudra_jobs.end_date,rudra_jobs.is_premium');
			$this->db->join('rudra_facility_category', 'rudra_facility_category.id = rudra_jobs.fc_cat_id');
			$data['PublishedjobDetails'] = $this->db->from('rudra_jobs')->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Published')->order_by('id', 'desc')->limit(5)->get()->result_array();
			
			// echo "<pre>"; print_r($data); die();
			$this->load->view('facility/template', $data);
		} else {
		    redirect(site_url('fo-login'), 'refresh');
		}
	}
	public function profile()
	{
		$data['page_title'] = "Facility Owner Profile";
		$data['page_template'] = '_rudra_facility_profile';
        $data['page_header'] = 'Facility Owner Profile';
        $data['load_type'] = 'all';
		$fo_id = $this->session->userdata('rudra_fo_id');
		// Shift Manager Job Notifications
		$this->db->select('COUNT(id) as counts');
		$data['shift_managers'] = $this->db->where('rudra_shift_manager.fo_id',$fo_id)->get('rudra_shift_manager')->row_array();
		// Active JObs  
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
		$data['activeJobs'] = $this->db->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Active')->get('rudra_jobs')->row_array();
		// Completed JObs  
		$this->db->select('GROUP_CONCAT(id SEPARATOR ",") as ids,COUNT(id) as counts ');
		$data['completedJobs'] = $this->db->where('rudra_jobs.fo_id',$fo_id)->where('rudra_jobs.status','Published')->get('rudra_jobs')->row_array();
		
		// $data['walletDetails'] =  fo_wallet_details($this->session->userdata('rudra_fo_id'));
		
		$data['profileDetails'] = $this->db->get_where($this->bdp . 'facility_owner', array('id' => $this->session->userdata('rudra_fo_id')))->row_array();
		$this->load->view('facility/template', $data);
	}
	public function login()
	{
		$data['page_title'] = " Facility Owner Login";
		$this->load->view('facility/login', $data);
	}
	public function fo_reset_pass()
	{
		$data['page_title'] = "Facility Owner - Reset Password Link ";
		
		$this->load->view('facility/reset_link', $data);
	}
	public function fo_ajaxreset_pass()
	{
		$validations = array(array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
							);
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $response = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { 
		$email = $this->input->post('email',true);
		
		$check = $this->db->get_where($this->bdp . 'facility_owner', array('fo_email' => $email))->row();	
		if(empty($check))
		{
			 $response = array(
					'status' => 'error',
                'msg' => 'Email doesnot exists.');  
		}else{
			  $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
				$random_key = substr(str_shuffle($permitted_chars), 0, 15);
				$updateArray = array('fo_forget_link' => $random_key);
				$this->db->where('fo_email',$email);
				$id = $this->db->update($this->bdp .'facility_owner',$updateArray);
				// Code for Email
			if($id){
					$response = array(
                'status' => 'success',
                'msg' => " Password Link send successfully.");
                }else{ 
                    $response = array(
					'status' => 'error',
                'msg' => 'Something went wrong, please try again later.');  
                } 
			}
        }
		echo json_encode($response);
        exit;
	}
	public function fo_forget_pass($params1)
	{
		$data['page_title'] = "Facility Owner - Change Password";
		$data['forget_link'] = $params1;
		$check = $this->db->get_where($this->bdp . 'facility_owner', array('fo_forget_link' => $params1))->row();	
		if(empty($check))
		{
			redirect(site_url('fo-login'));
		}
		$this->load->view('facility/forget_pass', $data);
	}
	public function fo_ajaxforget_pass()
	{   
		$validations = array(array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|min_length[4]|max_length[10]'),
							array('field' => 'confirm_password', 'label' => 'Confirm New Password ', 'rules' => 'trim|required|min_length[4]|max_length[10]|matches[new_password]') 
						 );
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $response = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { 
		$fo_forget_link = $this->input->post('fo_forget_link',true);
		$check = $this->db->get_where($this->bdp . 'facility_owner', array('fo_forget_link' => $fo_forget_link))->row();	
		if(empty($check))
		{
			 $response = array(
					'status' => 'error',
                'msg' => 'Forgot Password link expires.');  
		}else{
				$updateArray = array('fo_password' => $this->input->post('new_password',true),'fo_forget_link'=>'');
				$where = array('id'=>$check->id);
				$id = $this->db->update($this->bdp .'facility_owner',$updateArray);
			if($id){
				$response = array(
                'status' => 'success',
                'msg' => " Password changed successfully.");
                }else{ 
                    $response = array(
					'status' => 'error',
                'msg' => 'Something went wrong ,Please try again later.');  
                } 
			}
        }
		echo json_encode($response);
        exit;		
	}
	public function fo_change_pass()
	{
		$data['page_title'] = "Facility Owner - Change Password";
		$email = $this->session->userdata('changePass');
		$check = $this->db->get_where($this->bdp . 'facility_owner', array('fo_email' => $email))->row();	
		if(empty($check))
		{
			redirect(site_url('fo-login'));
		}
		$this->load->view('facility/changePass', $data);
	}
	public function oldpassword_check($old_password){
	   $old_password_hash =$old_password;
	   $where = array('id'=>$this->session->userdata('rudra_fo_id'));
	   $old_password_db_hash = $this->db->get_where('rudra_facility_owner',$where)->row_array();
	   $old_password_db_hash = @$old_password_db_hash['fo_password'];
	   if($old_password != $old_password_db_hash)
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
				$updateArray = array('fo_password' => $this->input->post('new_password',true));
				$where = array('id'=>$this->session->userdata('rudra_fo_id'));
				$id = $this->db->update($this->bdp .'facility_owner',$updateArray);
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
	public function AjaxChangePass()
	{   
		$email = $this->session->userdata('changePass');
		$validations = array(array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|min_length[4]|max_length[10]'),
							array('field' => 'confirm_password', 'label' => 'Confirm New Password ', 'rules' => 'trim|required|min_length[4]|max_length[10]|matches[new_password]') 
						 );
        $this->form_validation->set_rules($validations);	
        if ($this->form_validation->run() == false) {
            $response = array(
			'status' => 'error',
                'msg' => validation_errors());
        } else { 
				$updateArray = array('fo_password' => $this->input->post('new_password',true),'fo_last_login' => date('Y-m-d H:i:s'));
				$this->db->where('fo_email',$email);
				$id = $this->db->update($this->bdp .'facility_owner',$updateArray);
			if($id){
				$this->session->unset_userdata('changePass');
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
	public function check_login_facility()
	{
		// if (!$this->input->is_ajax_request()) {
		// 	exit('No direct script access allowed');
		// } else {
			$email = $this->input->post('email', true);
			$password = $this->input->post('password', true);
			$check = $this->db->get_where($this->bdp . 'facility_owner', array('fo_email' => $email))->row();
			//echo "fgfdg";
			//print_r($check);die;
			if(!empty($check))
			{//echo date('Y-m-d H:i:s',strtotime($check->added_on)).'=='.date('Y-m-d H:i:s',strtotime($check->fo_last_login)); 
				if(date('Y-m-d H:i:s',strtotime($check->added_on))==date('Y-m-d H:i:s',strtotime($check->fo_last_login))){
					
					$this->session->set_userdata('changePass',$email);
					$this->return_data['success'] = 'Redirect';
					$this->return_data['msg'] = "Redirect";
					echo json_encode($this->return_data);
					exit;
				}
			}
			$check = $this->db->get_where($this->bdp . 'facility_owner', array('fo_email' => $email, 'fo_password' => $password))->row();
			
			if(!empty($check))
			{
				if(date('Y-m-d H:i:s',strtotime($check->added_on))==date('Y-m-d H:i:s',strtotime($check->fo_last_login))){
					$this->session->set_userdata('changePass',$email);
					$this->return_data['success'] = 'Redirect';
					$this->return_data['msg'] = "Redirect";
				}elseif ($check->status == 'Active') {
					$facilitylogin = array(
						'rudra_fo_status'    => $check->status,
						'rudra_fo_id'        => $check->id,
						'rudra_fo_fname'     => $check->fo_fname,
						'rudra_fo_lname'     => $check->fo_lname,
						'rudra_fo_email'     => $check->fo_email,
						'rudra_fo_mobile'    => $check->fo_mobile,
						'rudra_fo_last_login'=> $check->fo_last_login,
						'rudra_fo_logged_in' => TRUE,
						'rudra_fo_utype'     => 1,
					);
					$return = 'facility';

					$post = ($_POST['req_uri'] != '' ? ($_POST['req_uri'] == 'facility' ? $return : $_POST['req_uri']) : $return);
					$return_url = $post;
					$this->session->set_userdata($facilitylogin);
					$updateArray = array('fo_last_login' => date('Y-m-d H:i:s'));
					$where = array('id'=>$this->session->userdata('rudra_fo_id'));
					$id = $this->db->update($this->bdp .'facility_owner',$updateArray);
					$this->return_data['msg'] = "Login Successfull, redirecting...";
					$this->return_data['login'] = true;
					$this->return_data['status'] = 'success';
					$this->return_data['data'] = array('url' => base_url("$return_url"));
				} else{
					$this->return_data['status'] = 'error';
					$this->return_data['msg'] = "Account deactivated, Please contact to admin.";
				}
			} else {
				$this->return_data['status'] = 'error';
				$this->return_data['msg'] = "Wrong credentials, Please try again";
			}
			echo json_encode($this->return_data);
			exit;
		// }
	}
	public function logout()
	{
		session_destroy();
		redirect(base_url('facility-login'), 'refresh');
	}


	
}
