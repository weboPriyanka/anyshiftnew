
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_facility_owner_apis extends CI_Controller
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

    public function rudra_rudra_facility_owner($param1)
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
        elseif($call_type == 'category-list')
        {
            $res = $this->rudra_category_list($_POST);        
        }

        $this->json_output(200,array('status' => 200,'message' => $this->msg,'data'=>$this->return_data,'chk' => $this->chk));

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
            $this->form_validation->set_rules('fo_id', 'Fo ID', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $fo_id = $this->input->post('fo_id');
                $res = $this->db->get_where("$this->table",array('id' => $fo_id))->row();
                if(!empty($res))
                {


                    $this->db->where(['fo_id' => $res->id]);
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

                    $res->fo_image = base_url().'app_assets/uploads/facility/'.$res->fo_image;

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
      

    public function rudra_category_list(){

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
                
                $query = "SELECT * FROM `rudra_facility_category` where status='Active' order by fc_name asc ";
                $result = $this->db->query($query)->result();
                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {


                        // $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                        // $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                        // $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                        // $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Facility categories listed';
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
                    
}