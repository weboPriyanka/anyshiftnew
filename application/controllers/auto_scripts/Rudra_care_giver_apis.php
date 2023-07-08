
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_care_giver_apis extends CI_Controller
{                   
    
    private $api_status = false;
	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->bdp = $this->db->dbprefix;
        $this->table = 'rudra_care_giver';
		$this->msg = 'input error';
		$this->return_data = array();
        $this->chk = 0;
		//$this->load->model('global_model', 'gm');
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
     
     //rudra_care_giver API Routes
	$t_name = 'auto_scripts/Rudra_care_giver_apis/';    
	$route[$api_ver.'care_giver/(:any)'] = $t_name.'rudra_rudra_care_giver/$1';

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

    public function rudra_rudra_care_giver($param1)
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

        $this->json_output(200,array('status' => 200,'message' => $this->msg,'data'=>$this->return_data,'chk' => $this->chk));

    }
    
    public function rudra_save_data()
    {     
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('cg_fname', 'cg_fname', 'required');
			$this->form_validation->set_rules('cg_lname', 'cg_lname', 'required');
			$this->form_validation->set_rules('cg_mobile', 'cg_mobile', 'required');
			$this->form_validation->set_rules('cg_fcm_token', 'cg_fcm_token', 'required');
			$this->form_validation->set_rules('cg_device_token', 'cg_device_token', 'required');
			$this->form_validation->set_rules('cg_profile_pic', 'cg_profile_pic', 'required');
			$this->form_validation->set_rules('cg_lat', 'cg_lat', 'required');
			$this->form_validation->set_rules('cg_long', 'cg_long', 'required');
			$this->form_validation->set_rules('cg_address', 'cg_address', 'required');
			$this->form_validation->set_rules('cg_zipcode', 'cg_zipcode', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('hours_completed', 'hours_completed', 'required');
			$this->form_validation->set_rules('total_earned', 'total_earned', 'required');
			$this->form_validation->set_rules('average_rating', 'average_rating', 'required');   
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
					 'cg_fname' => $this->input->post('cg_fname',true),
					 'cg_lname' => $this->input->post('cg_lname',true),
					 'cg_mobile' => $this->input->post('cg_mobile',true),
					 'cg_fcm_token' => $this->input->post('cg_fcm_token',true),
					 'cg_device_token' => $this->input->post('cg_device_token',true),
					 'cg_profile_pic' => $this->input->post('cg_profile_pic',true),
					 'cg_lat' => $this->input->post('cg_lat',true),
					 'cg_long' => $this->input->post('cg_long',true),
					 'cg_address' => $this->input->post('cg_address',true),
					 'cg_zipcode' => $this->input->post('cg_zipcode',true),
					 'status' => $this->input->post('status',true),
					 'hours_completed' => $this->input->post('hours_completed',true),
					 'total_earned' => $this->input->post('total_earned',true),
					 'average_rating' => $this->input->post('average_rating',true),
					);

                $this->db->insert("$this->table",$updateArray);
                $new_id = $this->db->insert_id();
                
					if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
                    {
                        $bannerpath = 'uploads/intro_banner';
                        $thumbpath = 'uploads/intro_banner';
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
                        $this->db->update($this->full_table, $up_array);
                    }
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
			$this->form_validation->set_rules('cg_fname', 'cg_fname', 'required');
			$this->form_validation->set_rules('cg_lname', 'cg_lname', 'required');
			$this->form_validation->set_rules('cg_mobile', 'cg_mobile', 'required');
			$this->form_validation->set_rules('cg_fcm_token', 'cg_fcm_token', 'required');
			$this->form_validation->set_rules('cg_device_token', 'cg_device_token', 'required');
			$this->form_validation->set_rules('cg_profile_pic', 'cg_profile_pic', 'required');
			$this->form_validation->set_rules('cg_lat', 'cg_lat', 'required');
			$this->form_validation->set_rules('cg_long', 'cg_long', 'required');
			$this->form_validation->set_rules('cg_address', 'cg_address', 'required');
			$this->form_validation->set_rules('cg_zipcode', 'cg_zipcode', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('hours_completed', 'hours_completed', 'required');
			$this->form_validation->set_rules('total_earned', 'total_earned', 'required');
			$this->form_validation->set_rules('average_rating', 'average_rating', 'required');
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
					 'cg_fname' => $this->input->post('cg_fname',true),
					 'cg_lname' => $this->input->post('cg_lname',true),
					 'cg_mobile' => $this->input->post('cg_mobile',true),
					 'cg_fcm_token' => $this->input->post('cg_fcm_token',true),
					 'cg_device_token' => $this->input->post('cg_device_token',true),
					 'cg_profile_pic' => $this->input->post('cg_profile_pic',true),
					 'cg_lat' => $this->input->post('cg_lat',true),
					 'cg_long' => $this->input->post('cg_long',true),
					 'cg_address' => $this->input->post('cg_address',true),
					 'cg_zipcode' => $this->input->post('cg_zipcode',true),
					 'status' => $this->input->post('status',true),
					 'hours_completed' => $this->input->post('hours_completed',true),
					 'total_earned' => $this->input->post('total_earned',true),
					 'average_rating' => $this->input->post('average_rating',true),
					);

                    $this->db->where('id',$pk_id);
                    $this->db->update("$this->table",$updateArray);
                    
					if(isset($_FILES['cg_profile_pic']) && $_FILES['cg_profile_pic']['name'] != '') 
                    {
                        $bannerpath = 'uploads/intro_banner';
                        $thumbpath = 'uploads/intro_banner';
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
                        $this->db->update($this->full_table, $up_array);
                    }
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
            
			$this->form_validation->set_rules('cg_fname', 'cg_fname', 'required');
			$this->form_validation->set_rules('cg_lname', 'cg_lname', 'required');
			$this->form_validation->set_rules('cg_mobile', 'cg_mobile', 'required');
			$this->form_validation->set_rules('cg_fcm_token', 'cg_fcm_token', 'required');
			$this->form_validation->set_rules('cg_device_token', 'cg_device_token', 'required');
			$this->form_validation->set_rules('cg_profile_pic', 'cg_profile_pic', 'required');
			$this->form_validation->set_rules('cg_lat', 'cg_lat', 'required');
			$this->form_validation->set_rules('cg_long', 'cg_long', 'required');
			$this->form_validation->set_rules('cg_address', 'cg_address', 'required');
			$this->form_validation->set_rules('cg_zipcode', 'cg_zipcode', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('hours_completed', 'hours_completed', 'required');
			$this->form_validation->set_rules('total_earned', 'total_earned', 'required');
			$this->form_validation->set_rules('average_rating', 'average_rating', 'required');
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
                $per_page = 50; // No. of records per page
                $page_number = $this->input->post('page_number',true);
                $page_number = ($page_number == 1 ? 0 : $page_number);
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
      
                    
}