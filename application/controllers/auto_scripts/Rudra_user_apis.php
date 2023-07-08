
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_user_apis extends CI_Controller
{                   
    
    private $api_status = false;
	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->bdp = $this->db->dbprefix;
        $this->table = 'rudra_facility_owner';
		$this->msg = 'input error';
		$this->return_data = array();
        $this->chk = 0;
        $this->load->model('Rudra_user_rudra_model', 'user_model');
        $this->load->model('Email_model', 'email_model');
        $this->load->helper('User_helper'); 

		$this->set_data();
		
	}
	public function set_data()
    {
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			$this->json_output(200,array('status' => 200,'api_status' => false,'message' => 'Bad request.'));exit;
		} 
		
        /*
        $api_key = $this->db->get_where($this->bdp.'app_setting',array('meta_key' =>'rudra_key'))->row();
        $api_password =  $this->input->post('api_key',true);
        if (MD5($api_key->meta_value) == $api_password) {

            $this->api_status = true;
          
        } else {
           
		json_encode(array('status' => 505,'message' => 'Enter YourgMail@gmail.com to get access.', 'data' => array() ));
		  exit;
		  
          
        }
        */
    }

    /***********************Page Route
     
     //rudra_facility_owner API Routes
	$t_name = 'auto_scripts/Rudra_facility_owner_apis/';    
	$route[$api_ver.'facility_owner/(:any)'] = $t_name.'rudra_rudra_facility_owner/$1';

    **********************************/
    function json_output($statusHeader,$response)
	{
		$ci =& get_instance();
		$ci->output->set_content_type('application/json');
		$ci->output->set_status_header($statusHeader);
		$ci->output->set_output(json_encode($response));
	}

    public function index()
	{
		$this->json_output(200,array('status' => 200,'api_status' => false,'message' => 'Bad request.'));
	}

    public function rudra_user($param1)
    {
        $call_type = $param1;
        $res = array();
        if($call_type == 'login')
        {            
            $res = $this->rudra_login_data($_POST);        
        }
        elseif($call_type == 'update')
        {           
            $res = $this->rudra_update_data($_POST);        
        }
        elseif($call_type == 'get')
        {
            $res = $this->rudra_get_data($_POST);        
        }
        elseif($call_type == 'paged_data')
        {
            $res = $this->rudra_paged_data($_POST);        
        }
        elseif($call_type == 'setting_list')
        {
            $res = $this->rudra_setting_list_data($_POST);        
        }
        elseif($call_type == 'delete')
        {
            $res = $this->rudra_delete_data($_POST);        
        } 
        elseif ($call_type == 'forgot-password') 
        {
            $res = $this->rudra_user_forgotPassword($_POST);
        }
        elseif ($call_type == 'verify-otp') 
        {
            $res = $this->rudra_user_checkotp($_POST);
        }
        elseif ($call_type == 'reset-password') 
        {
            $res = $this->rudra_user_resetPassword($_POST);
        }
        elseif($call_type == 'update-shift-manager')
        {           
            $res = $this->rudra_update_sm_data($_POST);        
        }
        elseif($call_type == 'get-shift-manager')
        {           
            $res = $this->rudra_get_sm_data($_POST);        
        }
        elseif($call_type == 'get-notifications-all')
        {           
            $res = $this->rudra_get_notifications($type = '', $_POST);        
        }
        elseif($call_type == 'get-notifications-recent')
        {           
            $res = $this->rudra_get_notifications($type = 'unread', $_POST);        
        }
        elseif($call_type == 'get-notifications-earlier')
        {           
            $res = $this->rudra_get_notifications($type = 'read', $_POST);        
        }
        elseif($call_type == 'get-notifications-archieved')
        {           
            $res = $this->rudra_get_notifications($type = 'archived', $_POST);        
        }
        elseif($call_type == 'read-notification')
        {           
            $res = $this->rudra_read_notification($_POST);        
        }
        elseif($call_type == 'home-screen')
        {           
            $res = $this->rudra_home_screen($_POST);        
        }
        elseif($call_type == 'about-app')
        {           
            $res = $this->rudra_about_app($_POST);        
        }
        elseif($call_type == 'privacy-policy')
        {           
            $res = $this->rudra_privacy_policy($_POST);        
        }
        elseif($call_type == 'get-notifications-general')
        {           
            $res = $this->rudra_get_notificationsGeneralApp($type = 'general', $_POST);        
        }
        elseif($call_type == 'get-notifications-applications')
        {           
            $res = $this->rudra_get_notificationsGeneralApp($type = 'application', $_POST);        
        }
        elseif($call_type == 'help')
        {           
            $res = $this->rudra_help($_POST);        
        }
        elseif($call_type == 'update-profile-pic')
        {           
            $res = $this->rudra_update_profile_pic($_POST);        
        }

        $this->json_output(200,array('status' => 200,'message' => $this->msg,'data'=>$this->return_data,'chk' => $this->chk));

    }


    public function rudra_login_data(){


        if ($_POST && !empty($_POST)) {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            // $this->form_validation->set_rules('user_type', 'user_type', 'required');
            $this->form_validation->set_rules('fcm_token', 'fcm_token', 'required');
            $input = $this->input->post();

            if ($this->form_validation->run() == FALSE) {
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            } else {
                $email = (isset($input['email']) && $input['email'] != "") ? $input['email'] : "";
                $password = (isset($input['password']) && $input['password'] != "") ? $input['password'] : "";
                $fcm_token = (isset($input['fcm_token']) && $input['fcm_token'] != "") ? $input['fcm_token'] : "";

                $where = "WHERE `status` = 'Active' AND `sm_email` = '" . $email . "' AND `sm_password` = '" . $password . "' ";

                $sql = "SELECT * FROM `rudra_shift_manager` " . $where . " ";
                $check_user_exists = $this->db->query($sql)->row();
                
                
                if (isset($check_user_exists) && !empty($check_user_exists)) {

                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					    'sm_last_login' => $std,
                        'sm_fcm_token' => $fcm_token
					);

                    $this->db->where('id',$check_user_exists->id);
                    $this->db->update("rudra_shift_manager",$updateArray);

                    if($check_user_exists->sm_image){
                        $check_user_exists->sm_image = base_url().$check_user_exists->sm_image;
                    }else{
                        $check_user_exists->sm_image = base_url().'app_assets/images/user/avatar-2.jpg';
                    }
                    
                    
                    $this->chk = 1;
                    $this->msg =  "Logged in successfully";
                    $this->return_data = $check_user_exists;
                } else {
                    $this->msg =  "Invalid email or password";
                }
            }
        }



    }

    public function rudra_user_forgotPassword()
    {
        if ($_POST && !empty($_POST)) {

            $input = $this->input->post();
            $lang = (isset($input['language']) && $input['language'] != "") ? $input['language'] : "1";

            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            } else {

                $to_email = (isset($input['email']) && $input['email'] != "") ? $input['email'] : "";
                $code = substr(str_shuffle("0123456789"), 0, 4);
                $user = $this->user_model->check_SMuser_exists($email = $to_email);

                if (!empty($user)) {
                    $this->db->where(['id' => $user->id]);
                    $update = $this->db->update("rudra_shift_manager", ['forgot_code' => $code, 'forgot_time' => date('Y-m-d H:i:s')]);
                    if ($update) {
                        $message = "Your reset code is: " . $code;
                        $this->email_model->mail_utf8($to = $to_email, $from_user = "Anyshyft", $from_email = "anyshyft@team.com", $subject = 'Forgot Password Request - Anyshyft', $message);

                        $this->chk = 1;
                        $this->msg = "Please check your email we have sent a verification code to reset your password";
                        $this->return_data = ['user_id' => $user->id, 'email' => $user->sm_email];
                    } else {
                        $this->msg = "Failed to change password, Please try again later";
                    }
                } else {
                    $this->msg = 'User not found';
                }
            }
        }
    }

    public function rudra_user_checkotp(){

        if ($_POST && !empty($_POST)) {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('otp', 'otp', 'required');
            $input = $this->input->post();

            if ($this->form_validation->run() == FALSE) {
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            } else {
                $email = (isset($input['email']) && $input['email'] != "") ? $input['email'] : "";
                $otp = (isset($input['otp']) && $input['otp'] != "") ? $input['otp'] : "";

                $where = "WHERE `status` = 'Active' AND `sm_email` = '" . $email . "' AND `forgot_code` = '" . $otp . "' ";

                $sql = "SELECT * FROM `rudra_shift_manager` " . $where . " ";
                $check_user_exists = $this->db->query($sql)->row();
                
                if (isset($check_user_exists) && !empty($check_user_exists)) {

                    $this->chk = 1;
                    $this->msg =  "OTP matched";
                    $this->return_data = ['user_id' => $check_user_exists->id, 'email' => $check_user_exists->sm_email];
                } else {
                    $this->msg =  "Invalid otp";
                }
            }
        }

    }

    public function rudra_user_resetPassword()
    {
        if ($_POST && !empty($_POST)) {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirm_password', 'confirm password', 'required');

            $input = $this->input->post();
            $lang = (isset($input['language']) && $input['language'] != "") ? $input['language'] : "1";

            if ($this->form_validation->run() == FALSE) {
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            } else {
                $email = (isset($input['email']) && $input['email'] != "") ? $input['email'] : "";
                $password = (isset($input['password']) && $input['password'] != "") ? $input['password'] : "";
                $confirm_password = (isset($input['confirm_password']) && $input['confirm_password'] != "") ? $input['confirm_password'] : "";

                if ($password == $confirm_password) {
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number    = preg_match('@[0-9]@', $password);
                    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                        $this->msg = "Please enter a strong password, Password must be at least 8 characters long with digit, upper and lower case characters";
                    } else {
                        $user = $this->user_model->check_SMuser_exists($email);
                        if (!empty($user)) {
                            $this->db->where(['id' => $user->id]);
                            $update = $this->db->update("rudra_shift_manager", ['sm_password' => $password, 'forgot_code' => NULL, 'forgot_time' => NULL]);
                            if ($update) {
                                $this->chk = 1;
                                $this->msg = "Password changed successfully";
                                $this->return_data = [];
                            } else {
                                $this->msg = 'Failed to change password, Please try again later';
                            }
                        } else {
                            $this->msg = "User not found";
                        }
                    }
                } else {
                    $this->msg = 'Password and confirm password does not match';
                }
            }
        }
    }
    
    public function rudra_save_data()
    {     
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
			$this->form_validation->set_rules('fo_fname', 'fo_fname', 'required');
			$this->form_validation->set_rules('fo_lname', 'fo_lname', 'required');
			$this->form_validation->set_rules('fo_email', 'fo_email', 'required');
			$this->form_validation->set_rules('fo_mobile', 'fo_mobile', 'required');
			$this->form_validation->set_rules('fo_password', 'fo_password', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $std = date('Y-m-d H:i:s');
                //Insert Codes goes here 
                $updateArray = 
					array(
					 'fo_fname' => $this->input->post('fo_fname',true),
					 'fo_lname' => $this->input->post('fo_lname',true),
					 'fo_email' => $this->input->post('fo_email',true),
					 'fo_mobile' => $this->input->post('fo_mobile',true),
					 'fo_password' => $this->input->post('fo_password',true),
					 'status' => $this->input->post('status',true),
					);

                $this->db->insert("$this->table",$updateArray);
                $new_id = $this->db->insert_id();
                
                $res = $this->db->get_where("$this->table",array('id' => $new_id ))->row();
                //Format Data if required
                /*********
                 $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                 $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                 $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                 $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                 ************/
                $this->chk = 1;
                $this->msg = 'Data Stored Successfully';
                $this->return_data = $res;
            }
        }
       
    }
    
    public function rudra_update_data()
    {
       if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('id', 'id', 'required');
			$this->form_validation->set_rules('fo_fname', 'fo_fname', 'required');
			$this->form_validation->set_rules('fo_lname', 'fo_lname', 'required');
			$this->form_validation->set_rules('fo_email', 'fo_email', 'required');
			$this->form_validation->set_rules('fo_mobile', 'fo_mobile', 'required');
			$this->form_validation->set_rules('fo_password', 'fo_password', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('id');
                $chk_data = $this->db->get_where("$this->table",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'fo_fname' => $this->input->post('fo_fname',true),
					 'fo_lname' => $this->input->post('fo_lname',true),
					 'fo_email' => $this->input->post('fo_email',true),
					 'fo_mobile' => $this->input->post('fo_mobile',true),
					 'fo_password' => $this->input->post('fo_password',true),
					 'status' => $this->input->post('status',true),
					);

                    $this->db->where('id',$pk_id);
                    $this->db->update("$this->table",$updateArray);
                    
                    $this->chk = 1;
                    $this->msg = 'Information Updated';
                    $this->return_data = $this->db->get_where("$this->table",array('id' => $pk_id))->row();
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Record Not Found';   
                }
            }
        }
        
    }


    public function rudra_update_sm_data(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('sm_id', 'sm_id', 'required');
			$this->form_validation->set_rules('sm_fname', 'sm_fname', 'required');
			$this->form_validation->set_rules('sm_lname', 'sm_lname', 'required');
			$this->form_validation->set_rules('sm_email', 'sm_email', 'required');
			$this->form_validation->set_rules('sm_mobile', 'sm_mobile', 'required');
			$this->form_validation->set_rules('sm_password', 'sm_password', 'required');
			// $this->form_validation->set_rules('status', 'status', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('sm_id');
                $chk_data = $this->db->get_where("rudra_shift_manager",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'sm_fname' => $this->input->post('sm_fname',true),
					 'sm_lname' => $this->input->post('sm_lname',true),
					 'sm_email' => $this->input->post('sm_email',true),
					 'sm_mobile' => $this->input->post('sm_mobile',true),
					 'sm_password' => $this->input->post('sm_password',true),
					//  'status' => $this->input->post('status',true),
					);

                    $this->db->where('id',$pk_id);
                    $this->db->update("rudra_shift_manager",$updateArray);

                    if(isset($_FILES['sm_image']) && $_FILES['sm_image']['name'] != '') 
                    {
                        $bannerpath = 'app_assets/uploads/shiftManager';
                        $thumbpath = 'app_assets/uploads/shiftManager';
                        $config['upload_path'] = $bannerpath;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('sm_image'))
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
                                            'sm_image' => $bannerpath . '/' . $uploadedImage['file_name']
                                        );
                        $this->db->where('id', $pk_id);
                        $this->db->update("rudra_shift_manager", $up_array);
                    }
                    
                    $this->chk = 1;
                    $this->msg = 'Profile updated successfully';
                    $this->return_data = $this->db->get_where("rudra_shift_manager",array('id' => $pk_id))->row();
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'User Not Found';   
                }
            }
        }


    }

    public function rudra_update_profile_pic(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('sm_id', 'sm_id', 'required');
            // $this->form_validation->set_rules('sm_image', 'sm_image', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('sm_id');
                $chk_data = $this->db->get_where("rudra_shift_manager",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    
                    if(isset($_FILES['sm_image']) && $_FILES['sm_image']['name'] != '') 
                    {

                        if($chk_data->sm_image){
                            $path = $_SERVER['DOCUMENT_ROOT'].'/anyshyft1/app_assets/uploads/shiftManager/'.$chk_data->sm_image;
                            unlink($path);
                        }

                        $bannerpath = 'app_assets/uploads/shiftManager';
                        $thumbpath = 'app_assets/uploads/shiftManager';
                        $config['upload_path'] = $bannerpath;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('sm_image'))
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
                                            'sm_image' => $bannerpath . '/' . $uploadedImage['file_name']
                                        );
                        $this->db->where('id', $pk_id);
                        $this->db->update("rudra_shift_manager", $up_array);
                    }
                    

                    $this->chk = 1;
                    $this->msg = 'Profile picture updated successfully';

                    $res = $this->db->get_where("rudra_shift_manager",array('id' => $pk_id))->row();
                     if(!empty($res))
                    {


                        if($res->sm_image){
                            $res->sm_image = base_url().$res->sm_image;
                        }else{
                            $res->sm_image = base_url().'app_assets/images/user/avatar-2.jpg';
                        }

                    $this->return_data = $res;
                    }
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'User Not Found';   
                }
            }
        }


    }

    public function rudra_setting_list_data()
    {
       if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
            
                   
                    $this->chk = 1;
                    $this->msg = 'Small Lists';
                    $this->return_data = $list_array;
               
            }
        }
        
    }
    
    public function rudra_delete_data()
    {
       if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('fo_fname', 'fo_fname', 'required');
			$this->form_validation->set_rules('fo_lname', 'fo_lname', 'required');
			$this->form_validation->set_rules('fo_email', 'fo_email', 'required');
			$this->form_validation->set_rules('fo_mobile', 'fo_mobile', 'required');
			$this->form_validation->set_rules('fo_password', 'fo_password', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $pk_id = $this->input->post('id');
                $chk_data = $this->db->get_where("$this->table",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                   
                   // $this->db->where('id',$pk_id);
                   // $this->db->delete("$this->table");
                    $this->chk = 1;
                    $this->msg = 'Information deleted';
                    
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Record Not Found';   
                }
            }
        }
        
    }

    
    public function rudra_get_data()
    {     
       if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('id', 'ID', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $pk_id = $this->input->post('id');
                $res = $this->db->get_where("$this->table",array('id' => $pk_id))->row();
                if(!empty($res))
                {
                    //Format Data if required
                    /*********
                    $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                    $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                    $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                    $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                    ************/
                    $this->chk = 1;
                    $this->msg = 'Data';
                    $this->return_data = $res;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Error: ID not found';
                }
            }
        }
        
    }
    public function rudra_paged_data()
    {     
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            //$this->form_validation->set_rules('page_number', 'Page Number: default 1', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;
                $query = "SELECT * FROM $this->table ORDER BY id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {
                        $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                        $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                        $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                        $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Paged Data';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No recond exist';
                }
               
            }
        }
       
    }
      

    public function rudra_get_sm_data(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'ID', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id');
                $res = $this->db->get_where("rudra_shift_manager",array('id' => $sm_id))->row();
                if(!empty($res))
                {


                    if($res->sm_image){
                        $res->sm_image = base_url().$res->sm_image;
                    }else{
                        $res->sm_image = base_url().'app_assets/images/user/avatar-2.jpg';
                    }

                    $this->db->where(['sm_id' => $res->id]);
                    $jobs = $this->db->get('rudra_jobs');

                    $res->posted_jobs = $jobs->num_rows();

                    $hired = $dnr = 0;

                    foreach($jobs->result() as $row){

                        $this->db->where(['job_id' => $row->id, 'status' => 'Accept']);
                        $hiredData = $this->db->get('rudra_job_actions');

                        $hired = $hired + $hiredData->num_rows();

                        $this->db->where(['job_id' => $row->id, 'status' => 'Accept']);
                        $dnrData = $this->db->get('rudra_jobs_nurse');

                        $dnr = $dnr + $dnrData->num_rows();



                    }


                    

                    $res->hired = $hired;
                    $res->dnr = $dnr;


                    //Format Data if required
                    /*********
                    $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                    $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                    $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                    $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                    ************/
                    $this->chk = 1;
                    $this->msg = 'Data';
                    $this->return_data = $res;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Error: ID not found';
                }
            }
        }
        


    }


    public function rudra_get_notifications($type=''){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('user_id', 'User ID', 'required');
            $this->form_validation->set_rules('user_type', 'user type', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 

                $user_id = $this->input->post('user_id');
                $user_type = $this->input->post('user_type');
                if($type){
                    $result = $this->db->order_by('id', 'desc')->get_where("rudra_notifications",array('user_id' => $user_id, 'user_type' => $user_type,'status'=>$type))->result();
                }else{
                    $result = $this->db->order_by('id', 'desc')->get_where("rudra_notifications",array('user_id' => $user_id, 'user_type' => $user_type))->result();
                }
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {


                        $res->added_on = date('l d M,h:i A',strtotime($res->added_on));

                        $list[] = $res;
                    }


                    $this->chk = 1;
                    $this->msg = 'Data found';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Data not found';
                }

            }
        }
    }


    public function rudra_get_notificationsGeneralApp($type=''){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'sm_id', 'required');
            // $this->form_validation->set_rules('user_type', 'user type', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 

                $sm_id = $this->input->post('sm_id');


                $query = "SELECT * FROM rudra_notifications  where sm_id=$sm_id AND user_type='cg' AND type='".$type."' ";
                $result = $this->db->query($query)->result();


                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {


                        $res->added_on = date('l d M,h:i A',strtotime($res->added_on));

                        $where = " where id=$res->job_id";

                        $res->job = $this->jobData($where);

                        $list[] = $res;
                    }


                    $this->chk = 1;
                    $this->msg = 'Data found';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Data not found';
                }

            }
        }



    }


    public function rudra_read_notification(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('id', 'id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('id',true);

                $chk_data = $this->db->get_where("rudra_notifications",array('id' => $id))->row();

                if(!empty($chk_data))
                {


                    $updateArray = array(
                            'status' => 'read',
                            'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$id);
                    $this->db->update("rudra_notifications",$updateArray);

                    $this->chk = 1;
                    $this->msg = 'Data updated';
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }


    }
    

    public function rudra_home_screen(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'sm_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $sm_id = $this->input->post('sm_id');
                
                $query = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id ORDER BY average_rating desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $return_data = array();
                $list = array();
                if(!empty($result))
                {
                    
                    foreach($result as $res)
                    {

                        $nurse = $this->nurseDetails($res->id, $sm_id);
                        
                        $list[] = $nurse;
                    }
                }
                $return_data['top_nurses'] = $list;

                $where = " where `status` = 'Active' AND filter = 'speciality' ";
                
                $query = "SELECT * FROM rudra_keywords $where ";
                $result = $this->db->query($query)->result();
                $speciality = array();
                if(!empty($result))
                {
                    
                    foreach($result as $res)
                    {
                        $this->db->where(['speciality' => $res->id]);
                        $nurses = $this->db->get('rudra_care_giver');

                        $res->nurses = $nurses->num_rows();
                        $speciality[] = $res;
                    }
                }

                $return_data['specialities'] = $speciality;

                $where = ' where rudra_jobs.sm_id='.$sm_id.' AND  rudra_jobs.status="Published" ';
                $return_data['upcoming_jobs'] = $this->jobData($where, $start_index, $per_page, $join);


                $this->chk = 1;
                    $this->msg = 'Data found';
                    $this->return_data = $return_data;
            }
        }

    }


    public function nurseDetails($nurse_id, $sm_id){


        $where = " where rudra_care_giver.id=$nurse_id ";

        $query = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id $where ";
        $res = $this->db->query($query)->row();

        if(!empty($res))
        {
            if($sm_id){
                $smquery = "SELECT * FROM rudra_shift_manager where id=$sm_id";
                $smdata = $this->db->query($smquery)->row();
                $res->sm_fcm_token = $smdata->sm_fcm_token;
            }
                
            // if($res->premium == 1){
            //     $res->premium = 'yes';
            // }else{
            //     $res->premium = 'no';
            // }

            $this->db->where(['id' => $res->cat_id]);
            $cat = $this->db->get('rudra_nurse_category');

            $res->category_name = $cat->row()->nc_name;

            // $res->cg_profile_pic = base_url().$res->cg_profile_pic;
            if($res->cg_profile_pic){
                $res->cg_profile_pic = base_url().$res->cg_profile_pic;
            }else{
                $res->cg_profile_pic = base_url().'app_assets/images/user/avatar-2.jpg';
            }
            $res->country = getCountry($res->cg_country);
            $res->state = getState($res->cg_state);

            $res->license_state_definition = (isset($res->license_state) && $res->license_state != "") ? getKeyword($res->license_state) : "";
            $res->speciality_definition = (isset($res->speciality) && $res->speciality != "") ? getKeyword($res->speciality) : "";
            $res->license_type_definition = (isset($res->license_type) && $res->license_type != "") ? getKeyword($res->license_type) : "";
            $res->availability_definition = (isset($res->availability) && $res->availability != "") ? getKeyword($res->availability) : "";
            $res->shift_duration_definition = (isset($res->shift_duration) && $res->shift_duration != "") ? getKeyword($res->shift_duration) : "";
            $res->assignment_duration_definition = (isset($res->assignment_duration) && $res->assignment_duration != "") ? getKeyword($res->assignment_duration) : "";
            $res->preferred_shift_definition = (isset($res->preferred_shift) && $res->preferred_shift != "") ? getKeyword($res->preferred_shift) : "";
            $res->preferred_geography_definition = (isset($res->preferred_geography) && $res->preferred_geography != "") ? getKeyword($res->preferred_geography) : "";
            $res->nurse_degree_definition = (isset($res->nurse_degree) && $res->nurse_degree != "") ? getKeyword($res->nurse_degree) : "";
            $res->slot_definition = (isset($res->slot) && $res->slot != "") ? getKeyword($res->slot) : "";
            $res->job_title_definition = (isset($res->job_title) && $res->job_title != "") ? getKeyword($res->job_title) : "";
            $res->search_cred_definition = (isset($res->search_cred) && $res->search_cred != "") ? getKeyword($res->search_cred) : "";
            $res->total_experience_definition = (isset($res->total_experience) && $res->total_experience != "") ? getKeyword($res->total_experience) : "";


            $res->is_shortlist = 0;
            if($sm_id){
                $this->db->where(['cg_id' => $res->id, 'sm_id' => $sm_id, 'status' => 'Active']);
                $shortlist = $this->db->get('rudra_nurse_shortlist')->result();

                if(!empty($shortlist)){
                    $res->is_shortlist = 1;
                }
            }

            if($res->resume_path){
              $res->resume_path = base_url().'app_assets/uploads/careGiver/'.$res->resume_path;   
            }

            $this->db->where(['cg_id' => $res->id,'type'=>'1', 'status' => 'Active']);
            $uploads = $this->db->get('rudra_nurse_docs')->result();

            $res->experience = array();
            foreach($uploads as $row){
                $res->experience[] = array(
                    'id' => $row->id,
                    'cg_id' => $row->cg_id,
                    'filename' => $row->file_name,
                    'filepath' => base_url().'app_assets/uploads/careGiver/'.$row->filepath,
                );
            }

            $this->db->where(['cg_id' => $res->id,'type'=>'2', 'status' => 'Active']);
            $uploads = $this->db->get('rudra_nurse_docs')->result();

            $res->certificate = array();
            foreach($uploads as $row){
                $res->certificate[] = array(
                    'id' => $row->id,
                    'cg_id' => $row->cg_id,
                    'filename' => $row->file_name,
                    'filepath' => base_url().'app_assets/uploads/careGiver/'.$row->filepath,
                );
            }

            $this->db->where(['cg_id' => $res->id, 'status' => 'Completed']);
            $res->jobs_completed = $this->db->get('rudra_jobs_nurse')->num_rows();


            $this->db->where(['cg_id' => $res->id, 'status' => 'DNR']);
            $dnr = $this->db->get('rudra_jobs_nurse')->num_rows();

            if($dnr > 0){
                $res->is_dnr = 1;
            }else{
                $res->is_dnr = 0;
            }
        }   


        return $res;


    }
              

    public function timeAgo($time = NULL)
	{
		// Calculate difference between current
		// time and given timestamp in seconds
		$diff     = time() - $time;
		// Time difference in seconds
		$sec     = $diff;
		// Convert time difference in minutes
		$min     = round($diff / 60);
		// Convert time difference in hours
		$hrs     = round($diff / 3600);
		// Convert time difference in days
		$days     = round($diff / 86400);
		// Convert time difference in weeks
		$weeks     = round($diff / 604800);
		// Convert time difference in months
		$mnths     = round($diff / 2600640);
		// Convert time difference in years
		$yrs     = round($diff / 31207680);
		// Check for seconds
		if ($sec <= 60) {
			$string = "$sec seconds ago";
		}
		// Check for minutes
		else if ($min <= 60) {
			if ($min == 1) {
				$string = "one minute ago";
			} else {
				$string = "$min minutes ago";
			}
		}
		// Check for hours
		else if ($hrs <= 24) {
			if ($hrs == 1) {
				$string = "an hour ago";
			} else {
				$string = "$hrs hours ago";
			}
		}
		// Check for days
		else if ($days <= 7) {
			if ($days == 1) {
				$string = "Yesterday";
			} else {
				$string = "$days days ago";
			}
		}
		// Check for weeks
		else if ($weeks <= 4.3) {
			if ($weeks == 1) {
				$string = "a week ago";
			} else {
				$string = "$weeks weeks ago";
			}
		}
		// Check for months
		else if ($mnths <= 12) {
			if ($mnths == 1) {
				$string = "a month ago";
			} else {
				$string = "$mnths months ago";
			}
		}
		// Check for years
		else {
			if ($yrs == 1) {
				$string = "one year ago";
			} else {
				$string = "$yrs years ago";
			}
		}
		return $string;
	}
    
    public function jobData($where, $start_index = 0, $per_page = 10, $join=''){

        

        $query = "SELECT * FROM rudra_jobs $where ORDER BY rudra_jobs.id DESC LIMIT $start_index , $per_page";
        $result = $this->db->query($query)->result();
        $list = array();
        if(!empty($result))
        {
                    
            foreach($result as $res)
            {
                $smquery = "SELECT * FROM rudra_shift_manager where id=$res->sm_id";
                $smdata = $this->db->query($smquery)->row();
                $res->sm_fcm_token = $smdata->sm_fcm_token;
 

                $res->posted_at = $this->timeAgo($time = strtotime($res->added_on));

                $this->db->where(['id' => $res->cg_cat_id]);
                $cat = $this->db->get('rudra_nurse_category');

                $res->nurse_category = $cat->row()->nc_name;

                $this->db->where(['id' => $res->fc_cat_id]);
                $cat = $this->db->get('rudra_facility_category');

                $res->facility_category = $cat->row()->fc_name;

                $res->shift_duration_definition = (isset($res->shift_duration) && $res->shift_duration != "") ? getKeyword($res->shift_duration) : "";
                
                if($res->job_hours >= 8){
                    $res->job_type = 'Full Time';
                }else{
                    $res->job_type = 'Part Time';
                }
                
                $this->db->where(['fo_id' => $res->fo_id]);
                $facilty = $this->db->get('rudra_facility');

                $res->facility = $facilty->row();
                if($res->facility->fc_image){
                    $res->facility->fc_image = base_url().$res->facility->fc_image;
                }else{
                    $res->facility->fc_image = base_url().'app_assets/images/favicon.png';
                }
                 
                $this->db->where(['id' => $res->fo_id]);
                $facility_owner = $this->db->get('rudra_facility_owner');

                $res->facility_owner = $facility_owner->row();

                // $res->facility_owner->fo_image = base_url().'app_assets/uploads/facility/'.$res->facility_owner->fo_image;
                if($res->facility_owner->fo_image){
                    $res->facility_owner->fo_image = base_url().'app_assets/uploads/facility/'.$res->facility_owner->fo_image;
                }else{
                    $res->facility_owner->fo_image = base_url().'app_assets/images/user/avatar-2.jpg';
                }
                
                if($join){                    
                    $res->nurse = $this->nurseDetails($res->cg_id, $res->sm_id);
                }
                $list[] = $res;
            }


        }


        return $list;
    }


    public function rudra_about_app()
    {
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
              
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 

                
                $res = $this->db->get_where("rudra_settings",array('title' => 'about_app' ))->row();
                
                $this->chk = 1;
                $this->msg = 'Data found';
                $this->return_data = $res;
            }
        }
    }

    
    public function rudra_privacy_policy()
    {
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
              
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 

                
                $res = $this->db->get_where("rudra_settings",array('title' => 'privacy_policy' ))->row();
                
                $this->chk = 1;
                $this->msg = 'Data found';
                $this->return_data = $res;
            }
        }
    }


    public function rudra_help(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'sm_id', 'required');
            $this->form_validation->set_rules('subject', 'subject', 'required');
            $this->form_validation->set_rules('help_text', 'help_text', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $subject = $this->input->post('subject',true);
                $help_text = $this->input->post('help_text',true);
                


                    $updateArray = array(
                            'subject' => $subject,
                            'sm_id' => $sm_id,
                            'help_text' => $help_text
                    );

                    $this->db->insert("rudra_help",$updateArray);
                    $new_id = $this->db->insert_id();

                    $res = $this->db->get_where("rudra_help",array('id' => $new_id ))->row();
                
                    $this->chk = 1;
                    $this->msg = 'Data Stored Successfully';
                    $this->return_data = $res;
                

            }
        }

    }

    
}