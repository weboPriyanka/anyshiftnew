
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_nurse_category_apis extends CI_Controller
{                   
    
    private $api_status = false;
	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->bdp = $this->db->dbprefix;
        $this->table = 'rudra_nurse_category';
		$this->msg = 'input error';
		$this->return_data = array();
        $this->chk = 0;
		//$this->load->model('global_model', 'gm');
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
     //rudra_nurse_category API Routes
	$t_name = 'auto_scripts/Rudra_nurse_category_apis/';    
	$route[$api_ver.'nurse_category/(:any)'] = $t_name.'rudra_rudra_nurse_category/$1';

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

    public function rudra_rudra_nurse_category($param1)
    {
        $call_type = $param1;
        $res = array();
        if($call_type == 'put')
        {            
            $res = $this->rudra_save_data($_POST);        
        }
        elseif($call_type == 'update')
        {           
            $res = $this->rudra_update_data($_POST);        
        }
        elseif($call_type == 'get')
        {
            $res = $this->rudra_get_data($_POST);        
        }
        elseif($call_type == 'category-list')
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
        elseif($call_type == 'nurses-by-category')
        {
            $res = $this->rudra_nurses_data($_POST);        
        }
        elseif($call_type == 'top-nurses')
        {
            $res = $this->rudra_top_nurses_data($_POST);        
        }
        elseif($call_type == 'get-nurse')
        {
            $res = $this->rudra_get_nurse_data($_POST);        
        }
        elseif($call_type == 'get-shortlisted')
        {
            $res = $this->rudra_get_nurse_shortlisted($_POST);        
        }
        elseif($call_type == 'shortlist')
        {
            $res = $this->rudra_get_nurse_shortlist($_POST);        
        }
        elseif($call_type == 'remove-shortlist')
        {
            $res = $this->rudra_get_nurse_removeshortlist($_POST);        
        }
        elseif($call_type == 'get-interested')
        {
            $res = $this->rudra_get_nurse_interested($_POST);        
        }
        elseif($call_type == 'get-offered')
        {
            $res = $this->rudra_get_nurse_offered($_POST);        
        }
        elseif($call_type == 'get-active')
        {
            $res = $this->rudra_get_nurse_active($_POST);        
        }
        elseif($call_type == 'get-hired')
        {
            $res = $this->rudra_get_nurse_hired($_POST);        
        }
        elseif($call_type == 'get-dnr')
        {
            $res = $this->rudra_get_nurse_dnr($_POST);        
        }
        elseif($call_type == 'get-past')
        {
            $res = $this->rudra_get_nurse_past($_POST);        
        }
        elseif($call_type == 'remove-dnr')
        {
            $res = $this->rudra_get_nurse_dnr_remove($_POST);        
        }
        elseif($call_type == 'search')
        {
            $res = $this->rudra_get_nurse_search($type=1, $_POST);        
        }
        elseif($call_type == 'most-recent')
        {
            $res = $this->rudra_get_nurse_search($type=2, $_POST);        
        }
        elseif($call_type == 'most-relevant')
        {
            $res = $this->rudra_get_nurse_search($type=1, $_POST);        
        }
        elseif($call_type == 'login')
        {
            $res = $this->rudra_nurse_login($_POST);        
        }
        elseif($call_type == 'register')
        {
            $res = $this->rudra_nurse_register($_POST);        
        }
        elseif ($call_type == 'forgot-password') 
        {
            $res = $this->rudra_nurse_forgotPassword($_POST);
        }
        elseif ($call_type == 'verify-otp') 
        {
            $res = $this->rudra_nurse_checkotp($_POST);
        }
        elseif ($call_type == 'reset-password') {
            $res = $this->rudra_nurse_resetPassword($_POST);
        }
        elseif($call_type == 'get-liceneStates')
        {
            $res = $this->rudra_nurse_keywords($filter="licenseState", $_POST);        
        }
        elseif($call_type == 'get-speciality')
        {
            $res = $this->rudra_nurse_keywords($filter="speciality", $_POST);        
        }
        elseif($call_type == 'get-preferredGeography')
        {
            $res = $this->rudra_nurse_keywords($filter="preferredGeography", $_POST);        
        }
        elseif($call_type == 'get-experiences')
        {
            $res = $this->rudra_nurse_keywords($filter="experiences", $_POST);        
        }
        elseif($call_type == 'get-radius')
        {
            $res = $this->rudra_nurse_keywords($filter="radius", $_POST);        
        }
        elseif($call_type == 'my-jobs-applied')
        {
            $res = $this->rudra_nurse_jobs($type="applied", $_POST);        
        }
        elseif($call_type == 'my-jobs-offered')
        {
            $res = $this->rudra_nurse_jobs($type="offered", $_POST);        
        }
        elseif($call_type == 'my-jobs-active')
        {
            $res = $this->rudra_nurse_jobs($type="active", $_POST);        
        }
        elseif($call_type == 'my-jobs-completed')
        {
            $res = $this->rudra_nurse_jobs($type="completed", $_POST);        
        }
        elseif($call_type == 'personal-details')
        {
            $res = $this->rudra_nurse_personalDetails($_POST);        
        }
        elseif($call_type == 'professional-details')
        {
            $res = $this->rudra_nurse_professionalDetails($_POST);        
        }
        elseif($call_type == 'preference-details')
        {
            $res = $this->rudra_nurse_prefDetails($_POST);        
        }
        elseif($call_type == 'get-licenseTypes')
        {
            $res = $this->rudra_nurse_keywords($filter="licenseTypes", $_POST);        
        }
        elseif($call_type == 'get-countries')
        {
            $res = $this->rudra_nurse_countries($_POST);        
        }
        elseif($call_type == 'get-states')
        {
            $res = $this->rudra_nurse_states($_POST);        
        }
        elseif($call_type == 'get-cities')
        {
            $res = $this->rudra_nurse_cities($_POST);        
        }
        elseif($call_type == 'get-nurseDegree')
        {
            $res = $this->rudra_nurse_keywords($filter="nurseDegree", $_POST);        
        }
        elseif($call_type == 'get-jobTitle')
        {
            $res = $this->rudra_nurse_keywords($filter="jobTitle", $_POST);        
        }
        elseif($call_type == 'get-slot')
        {
            $res = $this->rudra_nurse_keywords($filter="slot", $_POST);        
        }
        elseif($call_type == 'get-searchCredential')
        {
            $res = $this->rudra_nurse_keywords($filter="searchCredential", $_POST);        
        }
        elseif($call_type == 'get-availability')
        {
            $res = $this->rudra_nurse_keywords($filter="availability", $_POST);        
        }
        elseif($call_type == 'get-shiftDuration')
        {
            $res = $this->rudra_nurse_keywords($filter="shiftDuration", $_POST);        
        }
        elseif($call_type == 'get-assignmentDuration')
        {
            $res = $this->rudra_nurse_keywords($filter="assignmentDuration", $_POST);        
        }
        elseif($call_type == 'get-preferredShift')
        {
            $res = $this->rudra_nurse_keywords($filter="preferredShift", $_POST);        
        }
        elseif($call_type == 'job-favourite')
        {
            $res = $this->rudra_nurse_favouriteJobs($_POST);        
        }
        elseif($call_type == 'remove-job-favourite')
        {
            $res = $this->rudra_nurse_RemovefavouriteJobs($_POST);        
        }
        elseif($call_type == 'get-job-details')
        {
            $res = $this->rudra_nurse_JobData($_POST);        
        }
        elseif($call_type == 'clock-in')
        {
            $res = $this->rudra_nurse_clockin($_POST);        
        }
        elseif($call_type == 'clock-out')
        {
            $res = $this->rudra_nurse_clockOut($_POST);        
        }
        elseif($call_type == 'popular-jobs')
        {
            $res = $this->rudra_nurse_get_popular_jobs($_POST);        
        }
        elseif($call_type == 'remove-nurse-dnr')
        {
            $res = $this->rudra_get_nurse_dnr_remove_cgId($_POST);        
        }
        elseif($call_type == 'recommended-jobs')
        {
            $res = $this->rudra_nurse_get_recommended_jobs($_POST);        
        }
        elseif($call_type == 'feedback')
        {
            $res = $this->rudra_nurse_feedback($_POST);
        }
        elseif($call_type == 'home-screen')
        {
            $res = $this->rudra_nurse_home_screen($_POST);
        }
        elseif($call_type == 'search-jobs')
        {
            $res = $this->rudra_nurse_search_jobs($type="search", $_POST);
        }
        elseif($call_type == 'most-recent-jobs')
        {
            $res = $this->rudra_nurse_search_jobs($type="recent", $_POST);
        }
        elseif($call_type == 'most-relevant-jobs')
        {
            $res = $this->rudra_nurse_search_jobs($type="relevant", $_POST);
        }
        elseif($call_type == 'delete-document')
        {
            $res = $this->rudra_nurse_delete_files($_POST);
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
        elseif($call_type == 'delete-resume')
        {
            $res = $this->rudra_nurse_delete_resume($_POST);
        }
        elseif($call_type == 'update-profile-pic')
        {           
            $res = $this->rudra_update_profile_pic($_POST);        
        }
        elseif($call_type == 'download-invoice')
        {           
            $res = $this->rudra_download_invoice($_POST);        
        }
        elseif($call_type == 'add-dnr')
        {           
            $res = $this->rudra_add_dnr($_POST);        
        }

        $this->json_output(200,array('status' => 200,'message' => $this->msg,'data'=>$this->return_data,'chk' => $this->chk));

    }

    public function rudra_nurse_login(){

        if ($_POST && !empty($_POST)) {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
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

                $where = "WHERE `status` = 'Active' AND `cg_email` = '" . $email . "' AND `cg_password` = '" . $password . "' ";

                $sql = "SELECT * FROM `rudra_care_giver` " . $where . " ";
                $check_user_exists = $this->db->query($sql)->row();
                

                if (isset($check_user_exists) && !empty($check_user_exists)) {

                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					    'cg_last_login' => $std,
                        'cg_fcm_token' => $fcm_token,
					);

                    $this->db->where('id',$check_user_exists->id);
                    $this->db->update("rudra_care_giver",$updateArray);
                    
                    $nurse = $this->nurseDetails($check_user_exists->id);

                    $this->chk = 1;
                    $this->msg =  "Logged in successfully";
                    $this->return_data = $nurse;
                } else {
                    $this->msg =  "Invalid email or password";
                }
            }
        }

    }

    public function rudra_nurse_register(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_fname', 'First name', 'required');
			$this->form_validation->set_rules('cg_lname', 'Last name', 'required');   
			$this->form_validation->set_rules('cg_email', 'Email', 'required'); 
            $this->form_validation->set_rules('password', 'password', 'required');
            // $this->form_validation->set_rules('confirm_password', 'confirm password', 'required'); 
            $this->form_validation->set_rules('cat_id', 'Category', 'required'); 
            $this->form_validation->set_rules('cg_mobile', 'Phone number', 'required'); 
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $input = $this->input->post();

                $std = date('Y-m-d H:i:s');
                $email = (isset($input['cg_email']) && $input['cg_email'] != "") ? $input['cg_email'] : "";
                $password = (isset($input['password']) && $input['password'] != "") ? $input['password'] : "";
                // $confirm_password = (isset($input['confirm_password']) && $input['confirm_password'] != "") ? $input['confirm_password'] : "";

                if ($password) {
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number    = preg_match('@[0-9]@', $password);

                    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                        $this->msg = "Please enter a strong password, Password must be at least 8 characters long with digit, upper and lower case characters";
                    } else {

                        $user = $this->user_model->check_Nurseuser_exists($email);
                        if (empty($user)) {

                            // if(preg_match('/^[0-9]{10}+$/', $input['cg_mobile'])) {

                            //Insert Codes goes here 
                            $updateArray = 
                                array(
                                'cg_fname' => $this->input->post('cg_fname',true),
                                'cg_lname' => $this->input->post('cg_lname',true),
                                'cg_email' => $this->input->post('cg_email',true),
                                'cg_password' => $this->input->post('password',true),
                                'license_state' => $this->input->post('license_state'),
                                'speciality' => $this->input->post('speciality'),
                                'preferred_geography' => $this->input->post('preferred_geography'),
                                'cg_mobile' => $this->input->post('cg_mobile'),
                                'radius' => $this->input->post('radius'),
                                'cg_gender' => $this->input->post('cg_gender'),
                                'about' => $this->input->post('about'),
                                );

                            $this->db->insert("rudra_care_giver",$updateArray);
                            $new_id = $this->db->insert_id();
                            
                            $insertArray = 
                                array(
                                'cg_id' => $new_id,
                                'cat_id' => $this->input->post('cat_id',true),
                                );
                            $this->db->insert("rudra_cg_category",$insertArray);

                            if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
                            {
                                $bannerpath = 'app_assets/uploads/careGiver';
                                $thumbpath = 'app_assets/uploads/careGiver';
                                $config['upload_path'] = $bannerpath;
                                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                                $config['encrypt_name'] = TRUE;
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                if(!$this->upload->do_upload('cg_profile_pic'))
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
                                                    'cg_profile_pic' => $bannerpath . '/' . $uploadedImage['file_name']
                                                );
                                $this->db->where('id', $new_id);
                                $this->db->update("rudra_care_giver", $up_array);
                            }


                            $res = $this->db->get_where("rudra_care_giver",array('id' => $new_id ))->row();
                            //Format Data if required
                            /*********
                             $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                            $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                            $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                            $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                            ************/
                            $this->chk = 1;
                            $this->msg = 'Signed up Successfully';
                            $this->return_data = $res;

                            // }else{
                            //     $this->msg = "Invalid phone number";
                            // }

                        } else {
                            $this->msg = "Nurse already exist";
                        }
                    }

                }else {
                    $this->msg = 'Password and confirm password does not match';
                }
            }
        }




    }


    public function rudra_nurse_forgotPassword()
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
                $user = $this->user_model->check_Nurseuser_exists($email = $to_email);

                if (!empty($user)) {
                    $this->db->where(['id' => $user->id]);
                    $update = $this->db->update("rudra_care_giver", ['forgot_code' => $code, 'forgot_time' => date('Y-m-d H:i:s')]);
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

    public function rudra_nurse_checkotp(){

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

                $where = "WHERE `status` = 'Active' AND `cg_email` = '" . $email . "' AND `forgot_code` = '" . $otp . "' ";

                $sql = "SELECT * FROM `rudra_care_giver` " . $where . " ";
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

    public function rudra_nurse_resetPassword()
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
                        $user = $this->user_model->check_Nurseuser_exists($email);
                        if (!empty($user)) {
                            $this->db->where(['id' => $user->id]);
                            $update = $this->db->update("rudra_care_giver", ['cg_password' => $password, 'forgot_code' => NULL, 'forgot_time' => NULL]);
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
            
			$this->form_validation->set_rules('nc_name', 'nc_name', 'required');
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
					 'nc_name' => $this->input->post('nc_name',true),
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


    public function rudra_nurse_personalDetails(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			// $this->form_validation->set_rules('cg_fname', 'cg_fname', 'required');
			// $this->form_validation->set_rules('cg_lname', 'cg_lname', 'required');
            // $this->form_validation->set_rules('cg_email', 'cg_email', 'required');
			// $this->form_validation->set_rules('cg_mobile', 'cg_mobile', 'required');
			// $this->form_validation->set_rules('cg_fcm_token', 'cg_fcm_token', 'required');
			// $this->form_validation->set_rules('cg_device_token', 'cg_device_token', 'required');
			// $this->form_validation->set_rules('cg_profile_pic', 'cg_profile_pic', 'required');
			// $this->form_validation->set_rules('cg_lat', 'cg_lat', 'required');
			// $this->form_validation->set_rules('cg_long', 'cg_long', 'required');
			// $this->form_validation->set_rules('cg_address', 'cg_address', 'required');
			// $this->form_validation->set_rules('cg_zipcode', 'cg_zipcode', 'required');
			// $this->form_validation->set_rules('status', 'status', 'required');
			// $this->form_validation->set_rules('hours_completed', 'hours_completed', 'required');
			// $this->form_validation->set_rules('total_earned', 'total_earned', 'required');
			// $this->form_validation->set_rules('average_rating', 'average_rating', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('cg_id');

                // if($this->input->post('premium') == 'yes' ){
                //     $premium =1;
                // }else{
                //     $premium =0;
                // }

                $chk_data = $this->db->get_where("rudra_care_giver",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'cg_fname' => $this->input->post('cg_fname'),
					 'cg_lname' => $this->input->post('cg_lname'),
                     'cg_email' => $this->input->post('cg_email'),
					 'cg_mobile' => $this->input->post('cg_mobile'),
					 'cg_fcm_token' => $this->input->post('cg_fcm_token'),
					 'cg_device_token' => $this->input->post('cg_device_token'),
					//  'cg_profile_pic' => $this->input->post('cg_profile_pic'),
					 'cg_lat' => $this->input->post('cg_lat'),
					 'cg_long' => $this->input->post('cg_long'),
					 'cg_address' => $this->input->post('cg_address'),
					 'cg_zipcode' => $this->input->post('cg_zipcode'),
					//  'status' => $this->input->post('status'),
					//  'hours_completed' => $this->input->post('hours_completed'),
					//  'total_earned' => $this->input->post('total_earned'),
					//  'average_rating' => $this->input->post('average_rating'),
                     'cg_country' => $this->input->post('cg_country'),
                     'license_state' => $this->input->post('license_state'),
                     'license_number' => $this->input->post('license_number'),
                     'search_status' => $this->input->post('search_status'),
                     'license_type' => $this->input->post('license_type'),
                     'cg_state' => $this->input->post('cg_state'),
                     'cg_city' => $this->input->post('cg_city'),
                     'speciality' => $this->input->post('speciality'),
                     'cg_gender' => $this->input->post('cg_gender'),
                    //  'job_type' => $this->input->post('job_type'),
                    //  'premium' => $premium,
                    'preferred_geography' => $this->input->post('preferred_geography'),
                    'radius' => $this->input->post('radius'),
                    'about' => $this->input->post('about'),
					);

                    $updateArray=array_filter($updateArray);

                    $this->db->where('id',$pk_id);
                    $this->db->update("rudra_care_giver",$updateArray);

                    if($this->input->post('cat_id')){
                        $updateArray = 
                        array(
                        'cat_id' => $this->input->post('cat_id'),
                        );
                        $this->db->where('cg_id',$pk_id);
                        $this->db->update("rudra_cg_category",$updateArray);
                    }
                    
                    
					if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
                    {
                        $bannerpath = 'app_assets/uploads/careGiver';
                        $thumbpath = 'app_assets/uploads/careGiver';
                        $config['upload_path'] = $bannerpath;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('cg_profile_pic'))
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
                                            'cg_profile_pic' => $bannerpath . '/' . $uploadedImage['file_name']
                                        );
                        $this->db->where('id', $new_id);
                        $this->db->update("rudra_care_giver", $up_array);
                    }
                    $this->chk = 1;
                    $this->msg = 'Personal details updated successfully';
                    $this->return_data = $this->nurseDetails($new_id);
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'Record Not Found';   
                }
            }
        }
        

    }


    public function rudra_update_profile_pic(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			// $this->form_validation->set_rules('cg_profile_pic', 'cg_profile_pic', 'required');
			
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('cg_id');
                $chk_data = $this->db->get_where("rudra_care_giver",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    
                    
					if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
                    {
                        
                        if($chk_data->cg_profile_pic){
                            $path = $_SERVER['DOCUMENT_ROOT'].'/anyshyft1/app_assets/uploads/careGiver/'.$chk_data->cg_profile_pic;
                            unlink($path);
                        }
                        $bannerpath = 'app_assets/uploads/careGiver';
                        $thumbpath = 'app_assets/uploads/careGiver';
                        $config['upload_path'] = $bannerpath;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('cg_profile_pic'))
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
                                            'cg_profile_pic' => $bannerpath . '/' . $uploadedImage['file_name']
                                        );
                        $this->db->where('id', $new_id);
                        $this->db->update("rudra_care_giver", $up_array);
                    }
                    $this->chk = 1;
                    $this->msg = 'Profile picture updated successfully';
                    $this->return_data = $this->nurseDetails($new_id);
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'User Not Found';   
                }
            }
        }
        




    }


    public function rudra_nurse_professionalDetails(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			// $this->form_validation->set_rules('resume', 'resume', 'required');
			
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('cg_id');
                $chk_data = $this->db->get_where("rudra_care_giver",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'nurse_degree' => $this->input->post('nurse_degree'),
					 'university_name' => $this->input->post('university_name'),
					 'university_country' => $this->input->post('university_country'),
					//  'university_state' => $this->input->post('university_state'),
					//  'university_city' => $this->input->post('university_city'),
					//  'job_title' => $this->input->post('job_title'),
					//  'slot' => $this->input->post('slot'),
					//  'feedback' => $this->input->post('feedback'),
					 'search_cred' => $this->input->post('search_cred'),
					//  'effective_date' => $this->input->post('effective_date'),
					//  'expiration_date' => $this->input->post('expiration_date'),
                    'total_experience' => $this->input->post('total_experience'),
                );

                    $this->db->where('id',$pk_id);
                    $this->db->update("rudra_care_giver",$updateArray);
                    
					if(isset($_FILES['resume']) && $_FILES['resume']['name'] != '') 
                    {
                        $bannerpath = 'app_assets/uploads/careGiver';
                        $thumbpath = 'app_assets/uploads/careGiver';
                        $config['upload_path'] = $bannerpath;
                        $config['allowed_types'] = 'pdf';
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('resume'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            exit('Errors');
                        }
                        else
                        {
                            $imagedata = array('image_metadata' => $this->upload->data());
                            $uploadedImage = $this->upload->data();
                            // print_r($uploadedImage);
                        }
                        $up_array = array(
                                            'resume' => $uploadedImage['orig_name'],
                                            'resume_path' => $uploadedImage['file_name']
                                        );
                        $this->db->where('id', $new_id);
                        $this->db->update("rudra_care_giver", $up_array);
                    }

                    $files = $_FILES['certificate'];
                    $images = array();

                    foreach ($files['name'] as $key => $image) {
                    
                            $bannerpath = 'app_assets/uploads/careGiver';
                            $thumbpath = 'app_assets/uploads/careGiver';
                            $config['upload_path'] = $bannerpath;
                            $config['allowed_types'] = 'pdf';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                        
                            $_FILES['images']['name'] = $files['name'][$key];
                            $_FILES['images']['type'] = $files['type'][$key];
                            $_FILES['images']['tmp_name'] = $files['tmp_name'][$key];
                            $_FILES['images']['error'] = $files['error'][$key];
                            $_FILES['images']['size'] = $files['size'][$key];
    
                            // $fileName =  $pk_id . '_' . $_FILES['images']['name'];
                            $config['file_name'] = $fileName;
                            $this->upload->initialize($config);
    
                            if ($this->upload->do_upload('images')) {
                                $this->upload->data();
                                $uploadedImage = $this->upload->data();
                                $images[] = ['cg_id' => $pk_id, 'type' => '2', 'filepath' => $uploadedImage['file_name'], 'file_name' => $uploadedImage['orig_name']];
                            }

                       

                    }
                    if (!empty($images)) {
                        $update = $this->db->insert_batch('rudra_nurse_docs', $images);
                    }


                    $files = $_FILES['experience'];
                    $images = array();

                    foreach ($files['name'] as $key => $image) {
                    
                            $bannerpath = 'app_assets/uploads/careGiver';
                            $thumbpath = 'app_assets/uploads/careGiver';
                            $config['upload_path'] = $bannerpath;
                            $config['allowed_types'] = 'pdf';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                        
                            $_FILES['images']['name'] = $files['name'][$key];
                            $_FILES['images']['type'] = $files['type'][$key];
                            $_FILES['images']['tmp_name'] = $files['tmp_name'][$key];
                            $_FILES['images']['error'] = $files['error'][$key];
                            $_FILES['images']['size'] = $files['size'][$key];
    
                            // $fileName =  $pk_id . '_' . $_FILES['images']['name'];
                            $config['file_name'] = $fileName;
                            $this->upload->initialize($config);
    
                            if ($this->upload->do_upload('images')) {
                                $this->upload->data();
                                $uploadedImage = $this->upload->data();
                                $images[] = ['cg_id' => $pk_id, 'type' => '1', 'filepath' => $uploadedImage['file_name'], 'file_name' => $uploadedImage['orig_name']];
                            }

                       

                    }
                    if (!empty($images)) {
                        $update = $this->db->insert_batch('rudra_nurse_docs', $images);
                    }

                    $employment = $this->input->post('employment');

                    $this->db->where('cg_id',$new_id);
                    $this->db->delete("rudra_nurse_experience");
                    if($employment){

                        $employment = json_decode($employment);
                        foreach($employment as $row){

                            $insertArray = 
                                array(
                                'cg_id' => $new_id,
                                'employer_name' => $row->employer_name,
                                'start_date' => $row->start_date,
                                'end_date' => $row->end_date,
                                'is_current' => $row->is_current,
                                );
                            $this->db->insert("rudra_nurse_experience",$insertArray);


                        }
                    }

                    $this->chk = 1;
                    $this->msg = 'Professional details updated successfully';
                    $this->return_data = $this->nurseDetails($new_id);
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'User Not Found';   
                }
            }
        }
        


    }


    public function rudra_nurse_prefDetails(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			// $this->form_validation->set_rules('slots', 'slots', 'required');
			// $this->form_validation->set_rules('hourly_charges', 'hourly_charges', 'required');
			
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('cg_id');
                $chk_data = $this->db->get_where("rudra_care_giver",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'preferred_days' => $this->input->post('preferred_days'),
					 'hourly_charges' => $this->input->post('hourly_charges'),
					//  'availability' => $this->input->post('availability'),
					 'shift_duration' => $this->input->post('shift_duration'),
					//  'assignment_duration' => $this->input->post('assignment_duration'),
					 'preferred_shift' => $this->input->post('preferred_shift'),
					//  'preferred_geography' => $this->input->post('preferred_geography'),
					 'earliest_start_date' => $this->input->post('earliest_start_date'),
					//  'hourly_charges' => $this->input->post('hourly_charges'),
					);

                    $this->db->where('id',$pk_id);
                    $this->db->update("rudra_care_giver",$updateArray);
                    
                    
                    $this->chk = 1;
                    $this->msg = 'Preference details updated successfully';
                    $this->return_data = $this->nurseDetails($new_id);
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'User Not Found';   
                }
            }
        }
        



    }

    public function rudra_update_data()
    {
       if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
			$this->form_validation->set_rules('id', 'id', 'required');
			$this->form_validation->set_rules('nc_name', 'nc_name', 'required');
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
					 'nc_name' => $this->input->post('nc_name',true),
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
            
			$this->form_validation->set_rules('nc_name', 'nc_name', 'required');
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
                $search = $this->input->post('search');
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;
                $where = '';
                if($search){
                    $where = " where nc_name LIKE '%".$search."%' ";
                }
                $query = "SELECT * FROM $this->table $where LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {

                        $this->db->where(['cat_id' => $res->id]);
                        $nurses = $this->db->get('rudra_cg_category');

                        $res->nurses = $nurses->num_rows();

                        // $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                        // $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                        // $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                        // $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Nurse categories listed';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
               
            }
        }
       
    }


    public function rudra_nurses_data(){
        

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            //$this->form_validation->set_rules('page_number', 'Page Number: default 1', 'required');
            $this->form_validation->set_rules('category_id', 'Category id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $category_id = $this->input->post('category_id');
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;
                $sm_id = $this->input->post('sm_id');
                
                $where = " where cat_id=$category_id ";
                
                $query = "SELECT * FROM `rudra_cg_category`  $where  LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query = "SELECT * FROM `rudra_cg_category`  $where ";
                $total_result_count = $this->db->query($query)->num_rows();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 
                        $this->db->where(['id' => $res->cat_id]);
                        $cat = $this->db->get('rudra_nurse_category');

                        $res->category_name = $cat->row()->nc_name;

                        // $this->db->where(['id' => $res->cg_id]);
                        // $nurses = $this->db->get('rudra_care_giver');

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        // $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                        // $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                        // $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                        // $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Nurses listed';
                    // $this->return_data = $list;

                    $return_data = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;

                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
               
            }
        }




    }


    public function rudra_top_nurses_data(){

        
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
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;
                
                $sm_id = $this->input->post('sm_id');

                // $where = " where cat_id=$category_id ";
                
                $query = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id ORDER BY average_rating desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id ORDER BY average_rating desc";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 
                        // $this->db->where(['id' => $res->cat_id]);
                        // $cat = $this->db->get('rudra_nurse_category');

                        // $res->category_name = $cat->row()->nc_name;

                        $nurse = $this->nurseDetails($res->id, $sm_id);
                        
                        $list[] = $nurse;
                    }
                    $this->chk = 1;
                    $this->msg = 'Nurses listed';
                    // $this->return_data = $list;


                    $return_data = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;


                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }


        }


    }


    public function rudra_get_nurse_search($type){

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
                $cat_id = $this->input->post('cat_id');
                $fcat_id = $this->input->post('fcat_id');
                $job_type = $this->input->post('job_type');
                $hours = $this->input->post('hours');
                // $premium = $this->input->post('premium');
                $search_text = $this->input->post('search_text');
                $sm_id = $this->input->post('sm_id');

                $speciality = $this->input->post('speciality');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number');
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;

                $where = " where 1=1";

                if($cat_id){
                    $where .= " AND rudra_cg_category.cat_id=$cat_id ";
                }
                if($job_type){
                    $where .= " AND rudra_care_giver.preferred_shift='".$job_type."' ";
                }
                if($hours){
                    $where .= " AND rudra_care_giver.hours='".$hours."' ";
                }
                // if($premium){
                //     if($premium=='no'){
                //        $where .= " AND rudra_care_giver.premium=0 ";
                //     }else{
                //         $where .= " AND rudra_care_giver.premium=1 ";
                //     }
                // }
                if($speciality ){
                    $where .= " AND rudra_care_giver.speciality=$speciality ";
                }

                if($search_text){
                    $where .= " AND ( rudra_nurse_category.nc_name LIKE '%".$search_text."%' or rudra_care_giver.cg_fname LIKE '%".$search_text."%' or rudra_care_giver.cg_lname LIKE '%".$search_text."%' or rudra_keywords.title LIKE '%".$search_text."%' ) ";
                }

                if($type == 2){
                    $order = " average_rating desc";
                }else{
                    $order = " id desc";
                } 

                
                
                $query = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id inner join rudra_nurse_category on rudra_nurse_category.id = rudra_cg_category.cat_id  left join rudra_keywords on rudra_keywords.id = rudra_care_giver.speciality $where ORDER BY $order LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id inner join rudra_nurse_category on rudra_nurse_category.id = rudra_cg_category.cat_id left join rudra_keywords on rudra_keywords.id = rudra_care_giver.speciality $where ORDER BY $order";
                $total_result_count = $this->db->query($query2)->num_rows();

                $return_data = array();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 

                        $nurse = $this->nurseDetails($res->id, $sm_id);

                        $list[] = $nurse;

                    }

                    $this->chk = 1;
                    $this->msg = 'Nurses listed';
                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;

                    
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';

                }
            }

        }

    }

    public function rudra_get_nurse_data(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('nurse_id', 'Nurse id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $nurse_id = $this->input->post('nurse_id',true);
                $sm_id = $this->input->post('sm_id');
                
                $nurse = $this->nurseDetails($nurse_id, $sm_id);

                $where = ' where 1=1 ';

                // if ($type == "offered"){
                    $where .= ' AND rudra_job_actions.act_type="offer" AND rudra_job_actions.status="Pending"  AND rudra_jobs.status = "Published" ';
                // }

                // if ($job_type == "active"){
                //     $where .= ' AND (rudra_job_actions.status="Active" OR rudra_job_actions.status="Approved") AND  rudra_jobs.start_date <= "'.date('Y-m-d').'" AND  rudra_jobs.end_date >= "'.date('Y-m-d').'"';
                // }

                // if ($job_type == "completed"){
                //     $where .= ' AND (rudra_job_actions.status="Active" OR rudra_job_actions.status="Approved") AND rudra_jobs.end_date < "'.date('Y-m-d').'"  ';
                // }

                
                $where .= ' AND rudra_job_actions.cg_id='.$nurse_id.' ';
            
                $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id $where ORDER BY rudra_job_actions.id DESC";
                $result = $this->db->query($query)->result();
                $total_offered_jobs = 0;
                
                    $offered = array();
                    
                    foreach($result as $res)
                    {
                        $res->posted_on = date("d M Y", strtotime($res->added_on)); 

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $query = "SELECT * FROM rudra_job_actions where job_id=$res->job_id AND act_type='applied' ";
                        $res->job->total_nurses = $this->db->query($query)->num_rows();

                        $offered[] = $res;
                        $total_offered_jobs++;
                    }
                $nurse->total_offered_jobs = $total_offered_jobs;
                $nurse->offered_jobs = $offered;

                $where = ' where 1=1 ';
                $where .= ' AND (rudra_job_actions.status="Accept" OR rudra_job_actions.status="Approved") AND  rudra_jobs.status = "ACtive"  ';
                $where .= ' AND rudra_job_actions.cg_id='.$nurse_id.' ';
            
                $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id $where ORDER BY rudra_job_actions.id DESC ";
                $result = $this->db->query($query)->result();
                $total_active_jobs = 0;

                    $active = array();
                    foreach($result as $res)
                    {
                        $res->posted_on = date("d M Y", strtotime($res->added_on)); 

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $query = "SELECT * FROM rudra_job_actions where job_id=$res->job_id AND (status='Approved' OR status='Accept') ";
                        $res->job->total_nurses = $this->db->query($query)->num_rows();

                        $active[] = $res;
                        $total_active_jobs++;
                    }
                $nurse->total_active_jobs = $total_active_jobs;
                $nurse->active_jobs = $active;

                $where = ' where 1=1 ';
                $where .= ' AND (rudra_job_actions.status="Accept" OR rudra_job_actions.status="Approved") AND rudra_jobs.status = "Completed"  ';
                $where .= ' AND rudra_job_actions.cg_id='.$nurse_id.' ';
            
                $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id $where ORDER BY rudra_job_actions.id DESC ";
                $result = $this->db->query($query)->result();
                $total_past_jobs = 0;

                    $past = array();
                    foreach($result as $res)
                    {
                        $res->posted_on = date("d M Y", strtotime($res->added_on)); 

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $query = "SELECT * FROM rudra_job_actions where job_id=$res->job_id AND (status='Accept' OR status='Approved') ";
                        $res->job->total_nurses = $this->db->query($query)->num_rows();

                        $past[] = $res;
                        $total_past_jobs++;
                    }                
                
                $nurse->total_past_jobs = $total_past_jobs;
                $nurse->past_jobs = $past;


                if(!empty($nurse))
                {
                    
                    $this->chk = 1;
                    $this->msg = 'Nurse data found';
                    $this->return_data = $nurse;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }


        }


    }



    public function nurseDetails($nurse_id, $sm_id=''){

        $where = " where rudra_care_giver.id=$nurse_id ";

        $query = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id $where ";
        $res = $this->db->query($query)->row();

        if(!empty($res))
        {
            $progress_count = 0;

            if($res->cg_fname){
                $progress_count++;
            }
            if($res->cg_lname){
                $progress_count++;
            }
            if($res->cg_email){
                $progress_count++;
            }
            if($res->cg_gender){
                $progress_count++;
            }
            if($res->cg_mobile){
                $progress_count++;
            }
            if($res->cg_country){
                $progress_count++;
            }
            if($res->resume){
                $progress_count++;
            }
            if($res->preferred_days){
                $progress_count++;
            }
            if($res->hourly_charges){
                $progress_count++;
            }
            
            $res->progress = ceil(($progress_count/9) * 100);

            // if($res->premium == 1){
            //     $res->premium = 'yes';
            // }else{
            //     $res->premium = 'no';
            // }

            if($sm_id){
                $smquery = "SELECT * FROM rudra_shift_manager where id=$sm_id";
                $smdata = $this->db->query($smquery)->row();
                $res->sm_fcm_token = $smdata->sm_fcm_token;
            }
                

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


            $this->db->where(['cg_id' => $res->id, 'sm_id' => $sm_id ]);
            $dnr = $this->db->get('rudra_nurse_dnr')->num_rows();

            if($dnr > 0){
                $res->is_dnr = 1;
            }else{
                $res->is_dnr = 0;
            }


            $this->db->where(['cg_id' => $res->id]);
            $res->employment = $this->db->get('rudra_nurse_experience')->result();
          
        }   


        return $res;
    }


    public function rudra_get_nurse_shortlisted(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where rudra_nurse_shortlist.sm_id=$sm_id AND rudra_nurse_shortlist.status='Active' ";

                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                
                $query = "SELECT rudra_nurse_shortlist.* FROM `rudra_nurse_shortlist` inner join rudra_care_giver on rudra_care_giver.id=rudra_nurse_shortlist.cg_id $where ORDER BY rudra_nurse_shortlist.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT rudra_nurse_shortlist.* FROM `rudra_nurse_shortlist` inner join rudra_care_giver on rudra_care_giver.id=rudra_nurse_shortlist.cg_id $where ORDER BY rudra_nurse_shortlist.id desc ";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Shortlisted Nurses listed';
                    // $this->return_data = $list;

                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }
    }


    public function rudra_get_nurse_shortlist(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('sm_id', 'sm_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $cg_id = $this->input->post('cg_id',true);


                $chk_data = $this->db->get_where("rudra_nurse_shortlist",array('cg_id' => $cg_id, 'sm_id' => $sm_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'status' => 'Active',
					);

                    $this->db->where('id',$chk_data->id);
                    $this->db->update("rudra_nurse_shortlist",$updateArray);

                    $new_id = $chk_data->id;

                }else{
                    //Insert Codes goes here 
                    $updateArray = 
                        array(
                        'cg_id' => $this->input->post('cg_id'),
                        'sm_id' => $this->input->post('sm_id'),
                        );

                    $this->db->insert("rudra_nurse_shortlist",$updateArray);
                    $new_id = $this->db->insert_id();

                }
                
                $res = $this->db->get_where("rudra_nurse_shortlist",array('id' => $new_id ))->row();
                
                $this->chk = 1;
                $this->msg = 'Nurse shortlisted successfully';
                $this->return_data = $res;
            }
        }

    }

    public function rudra_get_nurse_removeshortlist(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('sm_id', 'sm_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $cg_id = $this->input->post('cg_id',true);


                $chk_data = $this->db->get_where("rudra_nurse_shortlist",array('cg_id' => $cg_id, 'sm_id' => $sm_id))->row();
                if(!empty($chk_data))
                {
                    

                    $this->db->where('id',$chk_data->id);
                    $this->db->delete("rudra_nurse_shortlist");


                    $this->chk = 1;
                    $this->msg = 'Nurse removed from shortlist Successfully';

                }
                
                
            }
        }



    }


    public function rudra_get_nurse_interested(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where rudra_job_actions.sm_id=$sm_id AND rudra_job_actions.act_type='applied' AND rudra_job_actions.status='Pending' ";

                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                
                $query = "SELECT rudra_job_actions.* FROM `rudra_job_actions` inner join rudra_care_giver on rudra_care_giver.id=rudra_job_actions.cg_id $where ORDER BY rudra_job_actions.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();
                
                $query2 = "SELECT rudra_job_actions.* FROM `rudra_job_actions` inner join rudra_care_giver on rudra_care_giver.id=rudra_job_actions.cg_id $where ORDER BY rudra_job_actions.id desc";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 
                        $res->applied_date = date('d/m/Y', strtotime($res->added_on));

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Interested Nurses listed';
                    // $this->return_data = $list;

                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }


    }


    public function rudra_get_nurse_offered(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where rudra_job_actions.sm_id=$sm_id AND rudra_job_actions.act_type='offer' AND rudra_job_actions.status='Pending' ";

                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                
                $query = "SELECT rudra_job_actions.* FROM `rudra_job_actions` inner join rudra_care_giver on rudra_care_giver.id=rudra_job_actions.cg_id $where ORDER BY rudra_job_actions.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();
                
                $query2 = "SELECT rudra_job_actions.* FROM `rudra_job_actions` inner join rudra_care_giver on rudra_care_giver.id=rudra_job_actions.cg_id $where ORDER BY rudra_job_actions.id desc";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 
                        
                        $res->offered_date = date('d/m/Y', strtotime($res->added_on));

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Offered Nurses listed';
                    // $this->return_data = $list;

                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }




    }


    public function rudra_get_nurse_active(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where rudra_jobs.sm_id=$sm_id AND rudra_jobs_nurse.status='Active' AND rudra_jobs.status='Active' ";
                
                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                $query = "SELECT rudra_jobs_nurse.*  FROM `rudra_jobs_nurse` inner join rudra_jobs on rudra_jobs.id=rudra_jobs_nurse.job_id inner join rudra_care_giver on rudra_care_giver.id=rudra_jobs_nurse.cg_id  $where ORDER BY rudra_jobs_nurse.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT rudra_jobs_nurse.*  FROM `rudra_jobs_nurse` inner join rudra_jobs on rudra_jobs.id=rudra_jobs_nurse.job_id inner join rudra_care_giver on rudra_care_giver.id=rudra_jobs_nurse.cg_id  $where ORDER BY rudra_jobs_nurse.id desc";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 
                        $res->start_date = date('d/m/Y', strtotime($res->updated_on));


                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Active Nurses listed';
                    // $this->return_data = $list;
                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }





    }


    public function rudra_get_nurse_hired(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where rudra_jobs.sm_id=$sm_id AND rudra_jobs_nurse.status='Pending' AND (rudra_job_actions.status='Approved' or rudra_job_actions.status='Accept')  ";
                
                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                $query = "SELECT rudra_jobs_nurse.*  FROM `rudra_jobs_nurse` inner join rudra_job_actions on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id inner join rudra_jobs on rudra_jobs.id=rudra_jobs_nurse.job_id inner join rudra_care_giver on rudra_care_giver.id=rudra_jobs_nurse.cg_id  $where ORDER BY rudra_jobs_nurse.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT rudra_jobs_nurse.*  FROM `rudra_jobs_nurse` inner join rudra_job_actions on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id inner join rudra_jobs on rudra_jobs.id=rudra_jobs_nurse.job_id inner join rudra_care_giver on rudra_care_giver.id=rudra_jobs_nurse.cg_id  $where ORDER BY rudra_jobs_nurse.id desc";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 
                        $res->hired_date = date('d/m/Y', strtotime($res->updated_on));

                        if($res->status == 'Accept'){
                            $res->status = 'Accepted';
                        }elseif ($res->status == 'Decline') {
                            $res->status = 'Rejected';
                        }

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Hired Nurses listed';
                    // $this->return_data = $list;
                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }




    }

    public function rudra_get_nurse_past(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where rudra_jobs.sm_id=$sm_id AND ( rudra_jobs.status='Completed' OR  rudra_jobs_nurse.status='Completed' ) AND (rudra_job_actions.status='Accept' or rudra_job_actions.status='Approved') ";
                
                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                $query = "SELECT rudra_jobs_nurse.*  FROM `rudra_jobs_nurse` inner join rudra_job_actions on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id inner join rudra_jobs on rudra_jobs.id=rudra_jobs_nurse.job_id inner join rudra_care_giver on rudra_care_giver.id=rudra_jobs_nurse.cg_id  $where ORDER BY rudra_jobs_nurse.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT rudra_jobs_nurse.*  FROM `rudra_jobs_nurse` inner join rudra_job_actions on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id inner join rudra_jobs on rudra_jobs.id=rudra_jobs_nurse.job_id inner join rudra_care_giver on rudra_care_giver.id=rudra_jobs_nurse.cg_id  $where ORDER BY rudra_jobs_nurse.id desc";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 

                        $res->start_date = date('d/m/Y', strtotime($res->updated_on));

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        $res->job = $this->jobData($res->job_id, $cg_id='');

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Past Nurses listed';
                    // $this->return_data = $list;
                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }




    }


    public function rudra_get_nurse_dnr(){

        
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $search = $this->input->post('search');

                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;


                $where = " where sm_id=$sm_id ";
                
                if($search){
                    $where .= " AND ( rudra_care_giver.cg_fname LIKE '%".$search."%' or rudra_care_giver.cg_lname LIKE '%".$search."%'  ) ";
                }
                $query = "SELECT rudra_nurse_dnr.*  FROM `rudra_nurse_dnr` inner join rudra_care_giver on rudra_care_giver.id=rudra_nurse_dnr.cg_id $where ORDER BY rudra_nurse_dnr.id desc LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    { 

                        $res->nurse = $this->nurseDetails($res->cg_id, $sm_id);

                        // $res->job = $this->jobData($res->job_id, $cg_id='');

                        $res->added_on = $this->timeAgo($time = strtotime($res->added_on));


                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'DNR Nurses listed';
                    // $this->return_data = $list;
                    $return_data['nurses'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
            }

        }

    }


    public function rudra_get_nurse_dnr_remove(){

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

                $chk_data = $this->db->get_where("rudra_nurse_dnr",array('id' => $id))->row();

                if(!empty($chk_data))
                {

                    $this->db->where('id',$chk_data->id);
                    $this->db->delete("rudra_nurse_dnr");

                    $this->chk = 1;
                    $this->msg = 'DNR removed';
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }

    }


    public function rudra_get_nurse_dnr_remove_cgId(){
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');
            $this->form_validation->set_rules('sm_id', 'sm_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $cg_id = $this->input->post('cg_id',true);
                $sm_id = $this->input->post('sm_id',true);

                $chk_data = $this->db->get_where("rudra_nurse_dnr",array('cg_id' => $cg_id,'sm_id'=> $sm_id))->row();

                if(!empty($chk_data))
                {

                    // $updateArray = array(
                    //         'status' => 'Completed',
                    //         'updated_on' => date('Y-m-d H:i:s')
                    // );

                    // $this->db->where('cg_id',$cg_id);
                    // $this->db->update("rudra_jobs_nurse",$updateArray);

                    $this->db->where('id',$chk_data->id);
                    $this->db->delete("rudra_nurse_dnr");

                    $this->chk = 1;
                    $this->msg = 'DNR removed';
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }
    }

    public function rudra_add_dnr(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');
            $this->form_validation->set_rules('sm_id', 'sm_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $cg_id = $this->input->post('cg_id',true);
                $sm_id = $this->input->post('sm_id',true);

                $chk_data = $this->db->get_where("rudra_nurse_dnr",array('cg_id' => $cg_id,'sm_id'=> $sm_id))->result();

                if(empty($chk_data))
                {

                    $updateArray = array(
                            'cg_id' => $cg_id,
                            'sm_id' => $sm_id
                    );

                    $this->db->insert("rudra_nurse_dnr",$updateArray);

                    
                    $this->chk = 1;
                    $this->msg = 'DNR added';
                }else{

                    $this->chk = 0;
                    $this->msg = 'Already exist';
                }

            }
        }
    }

    public function jobData($job_id, $cg_id = '', $from_date='', $to_date=''){

        
        $query = "SELECT * FROM `rudra_jobs` where id=$job_id ORDER BY id DESC";
        $result = $this->db->query($query)->result();
        $list = array();
        if(!empty($result))
        {
                    
            foreach($result as $res)
            {

                $smquery = "SELECT * FROM rudra_shift_manager where id=$res->sm_id";
                $smdata = $this->db->query($smquery)->row();
                $res->sm_fcm_token = $smdata->sm_fcm_token;

                $res->start_on = date('d M Y', strtotime($res->start_date));

                $res->posted_at = $this->timeAgo($time = strtotime($res->added_on));

                // if($res->start_date <= date('Y-m-d') && $res->end_date >= date('Y-m-d')){
                //     $res->status = 'Active';
                // }elseif($res->start_date > date('Y-m-d')){
                //     $res->status = 'Posted';
                // }elseif($res->end_date < date('Y-m-d')){
                //     $res->status = 'Completed';
                // }

                if($res->status = 'Published'){
                    $res->status = 'Posted';
                }
                $this->db->where(['id' => $res->cg_cat_id]);
                $cat = $this->db->get('rudra_nurse_category');

                $res->nurse_category = $cat->row()->nc_name;

                $this->db->where(['id' => $res->fc_cat_id]);
                $cat = $this->db->get('rudra_facility_category');

                $res->facility_category = $cat->row()->fc_name;

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
                $facilty = $this->db->get('rudra_facility_owner');

                $res->facility_owner = $facilty->row();
                if($res->facility_owner->fo_image){
                    $res->facility_owner->fo_image = base_url().'app_assets/uploads/facility/'.$res->facility_owner->fo_image;
                }else{
                    $res->facility_owner->fo_image = base_url().'app_assets/images/user/avatar-2.jpg';
                }

                $res->is_favourite = 0;

                if($cg_id){
                    $this->db->where(['cg_id' => $cg_id, 'job_id' => $job_id, 'status' => 'Active']);
                    $fav = $this->db->get('rudra_jobs_favourite')->row();

                    if(!empty($fav)){
                        $res->is_favourite = 1;
                    }   
                }
                $res->shift_duration_definition = (isset($res->shift_duration) && $res->shift_duration != "") ? getKeyword($res->shift_duration) : "";


                $query = "SELECT * FROM rudra_job_actions where job_id=$res->id AND act_type='applied' ";
                $res->apllied_nurses = $this->db->query($query)->num_rows();

                $res->is_applied = 0;
                $res->is_offered = 0;
                if($cg_id){

                    $is_appliedquery = "SELECT * FROM rudra_job_actions where job_id=$res->id aND cg_id=$cg_id AND act_type='applied' ";
                    $is_applied = $this->db->query($is_appliedquery)->num_rows();

                    $is_offeredquery = "SELECT * FROM rudra_job_actions where job_id=$res->id aND cg_id=$cg_id AND act_type='offer' ";
                    $is_offered = $this->db->query($is_offeredquery)->num_rows();

                    if($is_applied > 0){
                        $res->is_applied = 1;
                    }

                    if($is_offered > 0){
                        $res->is_offered = 1;
                    }

                    $res->clock_from_date = '';
                    $res->clock_to_date = '';

                    $wherec = 'where job_id='.$res->id.' AND cg_id='.$cg_id.' ';
                    if($from_date){
                        $wherec .= ' AND DATE(clock_in) >= "'.$from_date.'" ';
                        $res->clock_from_date = date('M d, Y',strtotime($from_date));
                    }

                    if($to_date){
                        $wherec .= ' AND DATE(clock_out) <= "'.$to_date.'" ';
                        $res->clock_to_date = date('M d, Y',strtotime($to_date));
                    }
                    $query = "SELECT * FROM rudra_nurse_hours $wherec order by id desc ";
                    $clocks = $this->db->query($query)->result();

                    $clockarr = array();
                    foreach($clocks as $row){
                        // $clock = [];
                        $clock_in = $row->clock_in;
                        $clock_out = $row->clock_out;

                        $row->clock_date = date('d M, Y', strtotime($clock_in)); 
                        $row->clock_in = date('H:i A', strtotime($clock_in)); 
                        $row->clock_out = date('H:i A', strtotime($clock_out)); 

                        // $time1 = new DateTime($clock_in);
                        // $time2 = new DateTime($clock_out);
                        // $time_diff = $time1->diff($time2);
                        // $row->hours = $time_diff->h.':'.$time_diff->i;
                        // $row->total_hours = str_pad($row->total_hours, 2, '0', STR_PAD_LEFT);
                        $clockarr[] = $row;

                    }
                    $res->clock_data = $clockarr;
                    // print_r($clocks);

                    $total_hoursquery = "SELECT sum(total_hours) as total_hours FROM rudra_nurse_hours $wherec order by id desc ";
                    $res->total_hours = $this->db->query($total_hoursquery)->row()->total_hours;


                    if($res->total_hours  == null){
                        $res->total_hours =0;
                    }
                    $ratequery = "SELECT * FROM rudra_jobs_nurse where job_id=$res->id AND cg_id=$cg_id";
                    $hiring_rate = $this->db->query($ratequery)->row()->hiring_rate;

                    $res->total_amount = $hiring_rate * $res->total_hours;


                    $queryci = "SELECT * FROM rudra_nurse_hours where job_id=$res->id AND cg_id=$cg_id AND clock_out is null order by id desc limit 1 ";
                    $is_clocked_in = $this->db->query($queryci)->row();
                    $res->is_clocked_in = 0;

                    $res->clocked_time = '00:00';
                    if(!empty($is_clocked_in)){
                        $res->is_clocked_in = 1;

                        // $res->clocked_time = date('H:i',strtotime( strtotime(date('Y-m-d H:i:s')) - strtotime($is_clocked_in->clock_in)));
                    
                        $time1 = new DateTime($is_clocked_in->clock_in);
                        $time2 = new DateTime(date('Y-m-d H:i:s'));
                        $time_diff = $time1->diff($time2);
                        $res->clocked_time = str_pad($time_diff->h, 2, '0', STR_PAD_LEFT).':'.str_pad($time_diff->i, 2, '0', STR_PAD_LEFT);
                        
                    }
                }



                $list = $res; 
            }


        }


        return $list;
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
      


    public function rudra_nurse_keywords($filter=''){


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
               
                $where = " where `status` = 'Active' AND filter = '".$filter."' ";
                
                $query = "SELECT * FROM rudra_keywords $where ";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {

                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Data listed';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
               
            }
        }


    }

    public function rudra_nurse_search_jobs($type=''){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');

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

                $cg_id = $this->input->post('cg_id');
                $search = $this->input->post('search');
                $department = $this->input->post('department');
                $category = $this->input->post('category');
                $shift_type = $this->input->post('job_type');
                $hours = $this->input->post('hours');

                $salary_range_from = $this->input->post('salary_range_from');
                $salary_range_to = $this->input->post('salary_range_to');

                $cgquery = "SELECT * FROM rudra_cg_category where cg_id=$cg_id";
                $cat_id = $this->db->query($cgquery)->row()->cat_id;

                $where = ' where (rudra_jobs.status="Active" or rudra_jobs.status="Published") ';
                

                if($search){
                    $where .= ' AND rudra_jobs.job_title LIKE "%'.$search.'%" ';
                }

                if($department){
                    $where .= ' AND rudra_jobs.fc_cat_id = '.$department;
                }
                if($category){
                    $where .= ' AND rudra_jobs.cg_cat_id = '.$category;
                }
                if($shift_type){
                    $where .= ' AND rudra_jobs.shift_type = "'.$shift_type.'" ';
                }

                if($hours){
                    $where .= ' AND rudra_jobs.shift_duration = '.$hours.' ';
                }

                if($salary_range_from && $salary_range_to){
                    $where .= ' AND ( (rudra_jobs.job_rate >= '.$salary_range_from.' AND rudra_jobs.job_rate <= '.$salary_range_to.') OR (rudra_jobs.job_prem_rate >= '.$salary_range_from.' AND rudra_jobs.job_prem_rate <= '.$salary_range_to.') ) ';
                }

                if($type=='relevant'){
                    $where .= ' AND cg_cat_id='.$cat_id;
                }

                $query = "SELECT * FROM rudra_jobs $where ORDER BY rudra_jobs.id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query2 = "SELECT * FROM rudra_jobs $where ORDER BY rudra_jobs.id DESC";
                $total_result_count = $this->db->query($query2)->num_rows();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {
                        // $res->posted_on = date("d M Y", strtotime($res->added_on)); 

                        $res = $this->jobData($res->id, $cg_id);


                        $list[] = $res;
                    }

                    $this->chk = 1;
                    $this->msg = 'Jobs listed';
                    // $this->return_data = $list;
                    $return_data['jobs'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }



            }
        }
    }

    public function rudra_nurse_jobs($type){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');

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

                $nurse_id = $this->input->post('cg_id');
                $search = $this->input->post('search');

                $where = ' where 1=1 ';

                if($nurse_id){
                    $where .= ' AND cg_id='.$nurse_id.' ';
                }

                if($search){
                    $where .= ' AND rudra_jobs.job_title LIKE "%'.$search.'%" ';
                }

                if ($type == "applied"){
                    $where .= ' AND rudra_job_actions.act_type="applied" AND rudra_job_actions.status="Pending"  ';
                    $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id $where ORDER BY rudra_job_actions.id DESC LIMIT $start_index , $per_page";
                }
                else if ($type == "offered"){
                    $where .= ' AND rudra_job_actions.act_type="offer" AND rudra_job_actions.status="Pending"  ';
                    $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id  $where ORDER BY rudra_job_actions.id DESC LIMIT $start_index , $per_page";

                }
                else if ($type == "active"){
                    $where .= ' AND (rudra_job_actions.status="Accept" OR rudra_job_actions.status="Approved") AND  rudra_jobs.status = "Active" ';
                    $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id $where ORDER BY rudra_job_actions.id DESC LIMIT $start_index , $per_page";
                }
                else if ($type == "completed"){
                    $where .= ' AND (rudra_jobs_nurse.status="Completed" OR rudra_jobs.status = "Completed" )  ';
                    $query = "SELECT rudra_jobs_nurse.* FROM rudra_jobs_nurse inner join rudra_jobs on rudra_jobs_nurse.job_id=rudra_jobs.id  $where ORDER BY rudra_jobs_nurse.id DESC LIMIT $start_index , $per_page";
                }

               

                


                // $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs on rudra_job_actions.job_id=rudra_jobs.id inner join rudra_jobs_nurse on rudra_jobs_nurse.job_id=rudra_jobs.id $where ORDER BY rudra_job_actions.id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {
                        $res->posted_on = date("d M Y", strtotime($res->added_on)); 

                        $res->job = $this->jobData($res->job_id, $nurse_id);


                        $list[] = $res;
                    }

                    $this->chk = 1;
                    $this->msg = 'Data listed';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }



            }
        }

    }

    public function rudra_nurse_countries(){


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

                // $where = " where `status` = 'Active' AND filter = '".$filter."' ";
                
                $query = "SELECT * FROM rudra_countries order by name asc";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {
                        $res->flag = base_url().'app_assets/images/flags/'.strtolower($res->iso2).'.svg';

                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Data listed';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }


            }
        }


    }


    public function rudra_nurse_states(){

        
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('country_id', 'country_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $country_id = $this->input->post('country_id',true);

                $where = " where `country_id` = $country_id  ";
                
                $query = "SELECT * FROM rudra_states $where order by name asc";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {

                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Data listed';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }


            }
        }



    }


    public function rudra_nurse_cities(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            // $this->form_validation->set_rules('country_id', 'country_id', 'required');
            $this->form_validation->set_rules('state_id', 'state_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $state_id = $this->input->post('state_id',true);

                $where = " where `state_id` = $state_id  ";
                
                $query = "SELECT * FROM rudra_cities $where order by name asc";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {

                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Data listed';
                    $this->return_data = $list;
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }


            }
        }


    }


    public function rudra_nurse_favouriteJobs(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('job_id', 'job_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);


                $chk_data = $this->db->get_where("rudra_jobs_favourite",array('cg_id' => $cg_id, 'job_id' => $job_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = 
					array(
					 'status' => 'Active',
					);

                    $this->db->where('id',$chk_data->id);
                    $this->db->update("rudra_jobs_favourite",$updateArray);

                    $new_id = $chk_data->id;

                }else{
                    //Insert Codes goes here 
                    $updateArray = 
                        array(
                        'cg_id' => $this->input->post('cg_id'),
                        'job_id' => $this->input->post('job_id'),
                        );

                    $this->db->insert("rudra_jobs_favourite",$updateArray);
                    $new_id = $this->db->insert_id();

                }
                
                $res = $this->db->get_where("rudra_jobs_favourite",array('id' => $new_id ))->row();
                
                $this->chk = 1;
                $this->msg = 'Job added to favourites Successfully';
                $this->return_data = $res;
            }
        }

    }



    public function rudra_nurse_RemovefavouriteJobs(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('job_id', 'job_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);


                $chk_data = $this->db->get_where("rudra_jobs_favourite",array('cg_id' => $cg_id, 'job_id' => $job_id))->row();
                if(!empty($chk_data))
                {
                    

                    $this->db->where('id',$chk_data->id);
                    $this->db->delete("rudra_jobs_favourite");


                    $this->chk = 1;
                    $this->msg = 'Job removed from favourites successfully';

                }
                
                
            }
        }

    }


    public function rudra_nurse_JobData(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('job_id', 'job_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $from_date = $this->input->post('clock_from_date',true);
                $to_date = $this->input->post('clock_to_date',true);


                $jobdata = $this->jobData($job_id, $cg_id, $from_date, $to_date);

                if(!empty($jobdata))
                {
                   

                    $this->chk = 1;
                    $this->msg = 'Job data found';
                    $this->return_data = $jobdata;


                }else{
                    $this->chk = 0;
                    $this->msg = 'No data found';

                }
                
                
            }
        }

    }

    public function rudra_nurse_clockin(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('job_id', 'job_id', 'required');   
			$this->form_validation->set_rules('clock_in', 'clock_in', 'required');   
			// $this->form_validation->set_rules('clock_out', 'clock_out', 'required');   
			// $this->form_validation->set_rules('total_hours', 'total_hours', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $cg_id = $this->input->post('cg_id');
                $job_id = $this->input->post('job_id');
                $clock_in = $this->input->post('clock_in');
                $current_date = date('Y-m-d',strtotime($clock_in));
                $query = "SELECT * FROM rudra_nurse_hours  where cg_id=$cg_id AND job_id=$job_id AND clock_out is null ORDER BY id DESC";
                $result = $this->db->query($query)->row();
                
                if(empty($result))
                {
                
                    //Insert Codes goes here 
                    $updateArray = 
                        array(
                        'cg_id' => $this->input->post('cg_id'),
                        'job_id' => $this->input->post('job_id'),
                        'clock_in' => $this->input->post('clock_in'),
                        // 'clock_out' => $this->input->post('clock_out'),
                        // 'total_hours' => $this->input->post('total_hours')
                        );

                    $this->db->insert("rudra_nurse_hours",$updateArray);
                    $new_id = $this->db->insert_id();

                
                
                    $res = $this->db->get_where("rudra_nurse_hours",array('id' => $new_id ))->row();
                    
                    $this->chk = 1;
                    $this->msg = 'Data Stored Successfully';
                    $this->return_data = $res;

                }else{
                    $this->chk = 0;
                    $this->msg = 'Already clocked In';
                }
            }
        }



    }


    public function rudra_nurse_clockOut(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('job_id', 'job_id', 'required');   
			// $this->form_validation->set_rules('clock_in', 'clock_in', 'required');   
			$this->form_validation->set_rules('clock_out', 'clock_out', 'required');   
			// $this->form_validation->set_rules('total_hours', 'total_hours', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $cg_id = $this->input->post('cg_id');
                $job_id = $this->input->post('job_id');
                $clock_out = $this->input->post('clock_out');
                $current_date = date('Y-m-d',strtotime($clock_out));

                $query = "SELECT * FROM rudra_nurse_hours  where cg_id=$cg_id AND job_id=$job_id AND clock_out is null ORDER BY id DESC  limit 1";
                $result = $this->db->query($query)->row();
                
                if(!empty($result))
                {

                    if($result->clock_out == ''){
                        $clock_in = $result->clock_in;

                        $time1 = new DateTime($clock_in);
                        $time2 = new DateTime($clock_out);
                        $time_diff = $time1->diff($time2);
                        $hours = str_pad($time_diff->h, 2, '0', STR_PAD_LEFT).':'.str_pad($time_diff->i, 2, '0', STR_PAD_LEFT);



                        //Insert Codes goes here 
                        $updateArray = 
                            array(
                            // 'cg_id' => $this->input->post('cg_id'),
                            // 'job_id' => $this->input->post('job_id'),
                            // 'clock_in' => $this->input->post('clock_in'),
                            'clock_out' => $this->input->post('clock_out'),
                            'total_hours' => $hours
                            );

                        $this->db->where('id',$result->id);
                        $this->db->update("rudra_nurse_hours",$updateArray);
                        
                    
                        $res = $this->db->get_where("rudra_nurse_hours",array('id' => $result->id ))->row();
                        
                        $this->chk = 1;
                        $this->msg = 'Data Stored Successfully';
                        $this->return_data = $res;
                    }else{
                        $this->chk = 0;
                        $this->msg = 'Already clocked out';
                    }

                }else{
                    $this->chk = 0;
                    $this->msg = 'No clocked In data exist';
                }
            }
        }


    }



    public function rudra_nurse_get_popular_jobs(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			// $this->form_validation->set_rules('job_id', 'job_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                // $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;

                $where = " where (status='Active' or status='Published') ";

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC  ";
                $total_result_count = $this->db->query($query)->num_rows();
                
                if(!empty($result)){
                    $list = array();
                    foreach($result as $res){

                        $list[] = $this->jobData($res->id, $cg_id);

                    }
                   

                    $this->chk = 1;
                    $this->msg = 'Jobs listed';
                    // $return_data = $list;
                    $return_data['jobs'] = $list;


                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;


                }else{
                    $this->chk = 0;
                    $this->msg = 'No data found';

                }
                
                
            }
        }

    }


    public function rudra_nurse_get_recommended_jobs(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			// $this->form_validation->set_rules('job_id', 'job_id', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                // $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;

                $nursequery = "SELECT rudra_cg_category.cat_id as cat_id FROM rudra_care_giver inner join rudra_cg_category on rudra_cg_category.cg_id=rudra_care_giver.id where rudra_care_giver.id='$cg_id' ";
                $nurse = $this->db->query($nursequery)->row();

                $cat_id = $nurse->cat_id;

                $where = " where cg_cat_id=$cat_id AND (status='Active' or status='Published')  ";

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC  ";
                $total_result_count = $this->db->query($query)->num_rows();
                
                if(!empty($result)){
                    $list = array();
                    foreach($result as $res){

                        $list[] = $this->jobData($res->id, $cg_id);

                    } 
                   

                    $this->chk = 1;
                    $this->msg = 'Jobs listed';
                    $return_data['jobs'] = $list;

                    $total_pages = ceil($total_result_count / $per_page);
                    $return_data['total_pages_available'] =  strval($total_pages);
                    $page_number = $this->input->post('page_number');
                    $page_number = ($page_number == '' ? 1 : $page_number);
                    $return_data['current_page'] = $page_number;
                    $return_data['results_per_page'] = $per_page;

                    $this->return_data = $return_data;


                }else{
                    $this->chk = 0;
                    $this->msg = 'No data found';

                }
                
                
            }
        }
    }


    public function rudra_nurse_home_screen(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $cg_id = $this->input->post('cg_id',true);
                $per_page = 10; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;

                $nursequery = "SELECT rudra_cg_category.cat_id as cat_id FROM rudra_care_giver inner join rudra_cg_category on rudra_cg_category.cg_id=rudra_care_giver.id where rudra_care_giver.id='$cg_id' ";
                $nurse = $this->db->query($nursequery)->row();

                $cat_id = $nurse->cat_id;

                $where = " where cg_cat_id=$cat_id AND (status='Active' or status='Published')  ";

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC  ";
                $total_result_count = $this->db->query($query)->num_rows();

                $recommended = array();

                if(!empty($result)){
                    foreach($result as $res){

                        $recommended[] = $this->jobData($res->id, $cg_id);

                    } 

                }

                $return_data['recommended'] = $recommended;


                $where = " where (status='Active' or status='Published') ";

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();

                $query = "SELECT * FROM rudra_jobs  $where ORDER BY id DESC  ";
                $total_result_count = $this->db->query($query)->num_rows();
                $popular = array();

                if(!empty($result)){
                    foreach($result as $res){

                        $popular[] = $this->jobData($res->id, $cg_id);

                    }
                }

                $return_data['popular'] = $popular;


                $this->chk = 1;
                $this->msg = 'Data found';
                $this->return_data = $return_data;
            }
    

        }
    }
                    

    public function rudra_nurse_feedback(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('sm_id', 'sm_id', 'required'); 
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required'); 
            $this->form_validation->set_rules('comment', 'comment', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $comment = $this->input->post('comment',true);


               
                    //Insert Codes goes here 
                    $updateArray = 
                        array(
                        'sm_id' => $this->input->post('sm_id'),
                        'cg_id' => $this->input->post('cg_id'),
                        'comment' => $this->input->post('comment'),
                        'rating' => $this->input->post('rating')
                        );

                    $this->db->insert("rudra_nurse_feedback",$updateArray);
                    $new_id = $this->db->insert_id();

                    $query = "SELECT AVG(rating) as rating FROM rudra_nurse_feedback  where cg_id=$cg_id";
                    $rating = $this->db->query($query)->row()->rating;

                    $updateArray = 
                        array(
                        'average_rating' => $rating
                        );
                    $this->db->where('id',$cg_id);
                    $this->db->update("rudra_care_giver",$updateArray);

                
                $res = $this->db->get_where("rudra_nurse_feedback",array('id' => $new_id ))->row();
                
                $this->chk = 1;
                $this->msg = 'Data Stored Successfully';
                $this->return_data = $res;
            }
        }
    }

    public function rudra_nurse_delete_files(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('id', 'id', 'required'); 
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required'); 
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('id',true);
                $cg_id = $this->input->post('cg_id',true);

                $query = "SELECT * FROM rudra_nurse_docs  where cg_id=$cg_id AND id=$id ";
                $result = $this->db->query($query)->row();
                
                if(!empty($result)){
                    
                    $path = $_SERVER['DOCUMENT_ROOT'].'/anyshyft1/app_assets/uploads/careGiver/'.$result->filepath;
                    unlink($path);

                    
                    $this->db->where('id',$id);
                    $this->db->delete("rudra_nurse_docs");

                    $this->chk = 1;
                    $this->msg = 'Data deleted Successfully';
                    $this->return_data = $this->nurseDetails($cg_id);;
                }else{


                    $this->chk = 0;
                    $this->msg = 'Data not found';
                    // $this->return_data = $res;
                }
            }
        }
    }


    public function rudra_nurse_delete_resume(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			// $this->form_validation->set_rules('id', 'id', 'required'); 
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required'); 
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                // $id = $this->input->post('id',true);
                $cg_id = $this->input->post('cg_id',true);

                $query = "SELECT * FROM rudra_care_giver  where  id=$cg_id ";
                $result = $this->db->query($query)->row();
                
                if(!empty($result)){
                    
                    $path = $_SERVER['DOCUMENT_ROOT'].'/anyshyft1/app_assets/uploads/careGiver/'.$result->resume_path;
                    unlink($path);

                    
                    
                        //Insert Codes goes here 
                        $updateArray = 
                            array(
                            'resume_path' => null,
                            'resume' => null
                            );

                        $this->db->where('id',$cg_id);
                        $this->db->update("rudra_care_giver",$updateArray);

                    $this->chk = 1;
                    $this->msg = 'Data deleted Successfully';
                    $this->return_data = $this->nurseDetails($cg_id);;
                }else{


                    $this->chk = 0;
                    $this->msg = 'Data not found';
                    // $this->return_data = $res;
                }
            }
        }


    }


    public function rudra_get_notificationsGeneralApp($type=''){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');
            // $this->form_validation->set_rules('user_type', 'user type', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 

                $cg_id = $this->input->post('cg_id');


                $query = "SELECT * FROM rudra_notifications  where cg_id=$cg_id AND user_type='sm' AND type='".$type."' ";
                $result = $this->db->query($query)->result();


                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {


                        $res->added_on = date('l d M,h:i A',strtotime($res->added_on));


                        $res->job = $this->jobData($res->job_id, $res->cg_id);

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


    public function rudra_help(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');
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
                $cg_id = $this->input->post('cg_id',true);
                $subject = $this->input->post('subject',true);
                $help_text = $this->input->post('help_text',true);
                


                    $updateArray = array(
                            'subject' => $subject,
                            'cg_id' => $cg_id,
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



    public function rudra_download_invoice(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_id', 'cg_id', 'required');
			$this->form_validation->set_rules('job_id', 'job_id', 'required');   
			$this->form_validation->set_rules('clock_from_date', 'clock_from_date', 'required');   
			$this->form_validation->set_rules('clock_to_date', 'clock_to_date', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $from_date = $this->input->post('clock_from_date',true);
                $to_date = $this->input->post('clock_to_date',true);


                $jobdata = $this->jobData($job_id, $cg_id, $from_date, $to_date);

                if(!empty($jobdata))
                {
                   

                    $jobdata->nurse = $this->nurseDetails($cg_id);
                    $this->load->library('pdf');


                    // $this->pdf->load_view('mypdf');
                    // $this->pdf->render();


                    // $this->pdf->stream("welcome.pdf");
                    // file_put_contents('app_assets/uploads/my.pdf', $this->pdf->output());


                    $id = $this->load->view('mypdf',$jobdata,true);
           
                    $this->pdf->loadHtml($id);
                    $options = $this->pdf->getOptions(); 
                    $options->set(array('isRemoteEnabled' => true));
                    $this->pdf->setOptions($options);                    $this->pdf->render();
                    $pdf = $this->pdf->output();
                    $file_location = $_SERVER['DOCUMENT_ROOT']."/anyshyft1/app_assets/docs/invoice_".$cg_id."_".$job_id.".pdf";
                    file_put_contents($file_location,$pdf, FILE_USE_INCLUDE_PATH ); 

                    $data['link'] = base_url()."app_assets/docs/invoice_".$cg_id."_".$job_id.".pdf";
                    $this->chk = 1;
                    $this->msg = 'Job data found';
                    $this->return_data = $data;


                }else{
                    $this->chk = 0;
                    $this->msg = 'No data found';

                }
                
                
            }
        }





    }

}