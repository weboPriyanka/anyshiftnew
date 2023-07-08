
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rudra_jobs_apis extends CI_Controller
{                   
    
    private $api_status = false;
	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->bdp = $this->db->dbprefix;
        $this->table = 'rudra_jobs';
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
     
     //rudra_jobs API Routes
	$t_name = 'auto_scripts/Rudra_jobs_apis/';    
	$route[$api_ver.'jobs/(:any)'] = $t_name.'rudra_rudra_jobs/$1';

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

    public function rudra_rudra_jobs($param1)
    {
        $call_type = $param1;
        $res = array();
        if($call_type == 'create')
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
        elseif($call_type == 'list')
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
        elseif($call_type == 'active')
        {
			$res = $this->rudra_job_type_data($job_type = 'Active', $_POST);
        }
        elseif($call_type == 'expired')
        {
			$res = $this->rudra_job_type_data($job_type = 'Expired', $_POST);
        }
        elseif($call_type == 'posted')
        {
			$res = $this->rudra_job_type_data($job_type = 'Posted', $_POST);
        }
        elseif($call_type == 'my_total_jobs')
        {
            $res = $this->rudra_total_jobs_data($_POST);        
        }
        elseif($call_type == 'accept')
        {
            $res = $this->rudra_accept_job($_POST);        
        }
        elseif($call_type == 'reject')
        {
            $res = $this->rudra_reject_job($_POST);        
        }
        elseif($call_type == 'cancel')
        {
            $res = $this->rudra_cancel_job($_POST);        
        }
        elseif($call_type == 'feedback')
        {
            $res = $this->rudra_job_feedback($_POST);        
        }
        elseif($call_type == 'send-offer')
        {
            $res = $this->rudra_job_sendoffer($_POST);        
        }
        elseif($call_type == 'hire')
        {
            $res = $this->rudra_job_hire($_POST);        
        }
        elseif($call_type == 'end-contract')
        {
            $res = $this->rudra_job_end_contract($_POST);        
        }
        elseif($call_type == 'apply')
        {
            $res = $this->rudra_job_apply($_POST);        
        }
        elseif($call_type == 'make-active')
        {
            $res = $this->rudra_job_make_active($_POST);        
        }
        elseif($call_type == 'end-job')
        {
            $res = $this->rudra_job_end($_POST);        
        }

        $this->json_output(200,array('status' => 200,'message' => $this->msg,'data'=>$this->return_data,'chk' => $this->chk));

    }
    
    public function rudra_save_data()
    {     
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('fo_id', 'Facility owner id', 'required');
            $this->form_validation->set_rules('sm_id', 'Shift manager id', 'required');
            $this->form_validation->set_rules('fc_cat_id', 'Facility Category id', 'required');
            $this->form_validation->set_rules('cg_cat_id', 'Nurse Category id', 'required');
            $this->form_validation->set_rules('job_title', 'Job title', 'required');
            $this->form_validation->set_rules('job_description', 'Job descripion', 'required');
            $this->form_validation->set_rules('shift_type', 'Shift type', 'required');
            // $this->form_validation->set_rules('job_hours', 'Job hours', 'required');
            $this->form_validation->set_rules('is_premium', 'Is premium', 'required');
            $this->form_validation->set_rules('job_rate', 'Job rate', 'required');
            $this->form_validation->set_rules('positions', 'Avaialble positions', 'required');
            $this->form_validation->set_rules('location', 'Job location', 'required');
               
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                if(strtotime($this->input->post('end_date')) > strtotime($this->input->post('start_date'))){
                    $std = date('Y-m-d H:i:s');
                    //Insert Codes goes here 
                    
                    $insertArray = array(
                        'fo_id' => $this->input->post('fo_id'),
                        'sm_id' => $this->input->post('sm_id'),
                        'fc_cat_id' => $this->input->post('fc_cat_id'),
                        'job_title' => $this->input->post('job_title'),
                        'cg_cat_id' => $this->input->post('cg_cat_id'),
                        'job_description' => $this->input->post('job_description'),
                        'shift_type' => $this->input->post('shift_type'),
                        // 'job_hours' => $this->input->post('job_hours'),
                        'is_premium' => $this->input->post('is_premium'),
                        'job_rate' => $this->input->post('job_rate'),
                        'job_prem_rate' => $this->input->post('job_prem_rate'),
                        'start_date' => $this->input->post('start_date'),
                        'end_date' => $this->input->post('end_date'),
                        'service' => $this->input->post('service'),
                        'shift_duration' => $this->input->post('shift_duration'),
                        'collection_fee' => $this->input->post('collection_fee'),
                        'positions' => $this->input->post('positions'),
                        'location' => $this->input->post('location'),
                    );

                    $this->db->insert("$this->table",$insertArray);
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
                }else{
                    $this->chk = 0;
                    $this->msg = 'End date can not be less than Start date';
                }
            }
        }
       
    }
    
    public function rudra_update_data()
    {
       if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'Job id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $new_id = $pk_id = $this->input->post('job_id');
                $chk_data = $this->db->get_where("$this->table",array('id' => $pk_id))->row();
                if(!empty($chk_data))
                {
                    $std = date('Y-m-d H:i:s');
                    //Update Codes goes here 
                    $updateArray = array(
                        'fo_id' => $this->input->post('fo_id'),
                        'sm_id' => $this->input->post('sm_id'),
                        'fc_cat_id' => $this->input->post('fc_cat_id'),
                        'job_title' => $this->input->post('job_title'),
                        'cg_cat_id' => $this->input->post('cg_cat_id'),
                        'job_description' => $this->input->post('job_description'),
                        'shift_type' => $this->input->post('shift_type'),
                        // 'job_hours' => $this->input->post('job_hours'),
                        'is_premium' => $this->input->post('is_premium'),
                        'job_rate' => $this->input->post('job_rate'),
                        'job_prem_rate' => $this->input->post('job_prem_rate'),
                        'start_date' => $this->input->post('start_date'),
                        'end_date' => $this->input->post('end_date'),
                        // 'service' => $this->input->post('service'),
                        'shift_duration' => $this->input->post('shift_duration'),
                        'collection_fee' => $this->input->post('collection_fee'),
                        'positions' => $this->input->post('positions'),
                        'location' => $this->input->post('location'),
                    );
                    
                    $this->db->where('id',$pk_id);
                    $this->db->update("$this->table",$updateArray);

                    $where = " where id=$pk_id";

                    $res = $this->jobData($where);

                    $this->chk = 1;
                    $this->msg = 'Information Updated';
                    $this->return_data = $res;
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
            $this->form_validation->set_rules('job_id', 'job_id', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $job_id = $this->input->post('job_id');
                // $res = $this->db->get_where("$this->table",array('id' => $pk_id))->row();

                $where = " where id=$job_id";


                $res = $this->jobData($where);



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
                $query = "SELECT * FROM $this->table where status='ACtive' or status='Published' ORDER BY id DESC LIMIT $start_index , $per_page";
                $result = $this->db->query($query)->result();
                $return_data = array();

                if(!empty($result))
                {
                    $list = array();
                    foreach($result as $res)
                    {
                        // $where = " where id=$res->id";


                        // $res = $this->jobData($where);
                        // $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                        // $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                        // $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                        // $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                        // $list[] = $res;

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
                        $query = "SELECT * FROM rudra_job_actions where job_id=$res->id AND act_type='applied' ";
                        $res->apllied_nurses = $this->db->query($query)->num_rows();

                        $list[] = $res;
                    }
                    $this->chk = 1;
                    $this->msg = 'Paged Data';
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
                    $this->msg = 'No recond exist';
                }
               
            }
        }
       
    }


    public function rudra_job_type_data($job_type = null){


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
                $page_number = (($page_number == 1 || $page_number == '') ? 0 : ($page_number-1));
                $start_index = $page_number*$per_page;

                $sm_id = $this->input->post('sm_id');


                $where = ' where 1=1 ';
                $join = '';

                if ($job_type == "Active"){
                    $where .= ' AND rudra_jobs.status="Active"  ';

                    // $where .= ' AND (rudra_jobs.status="Active" OR rudra_jobs.status="Published") AND start_date <= "'.date('Y-m-d').'" AND  end_date >= "'.date('Y-m-d').'" ';
                    // $join = ' inner join rudra_jobs_nurse on rudra_jobs_nurse.job_id=rudra_jobs.id ';
                }

                if ($job_type == "Posted"){
                    $where .= ' AND  rudra_jobs.status="Published" ';

                    // $where .= ' AND (rudra_jobs.status="Active" OR rudra_jobs.status="Published") AND start_date > "'.date('Y-m-d').'" ';
                }

                if ($job_type == "Expired"){
                    $where .= ' AND rudra_jobs.status="Completed"  ';

                    // $where .= ' AND (rudra_jobs.status="Active" OR rudra_jobs.status="Published") AND end_date < "'.date('Y-m-d').'" ';
                    // $join = ' inner join rudra_jobs_nurse on rudra_jobs_nurse.job_id=rudra_jobs.id ';
                }

                if($sm_id){
                    $where .= ' AND rudra_jobs.sm_id='.$sm_id.' ';
                }




                // $query = "SELECT * FROM $this->table $where ORDER BY id DESC LIMIT $start_index , $per_page";
                // $result = $this->db->query($query)->result();


                $list = $this->jobData($where, $start_index, $per_page, $join);
                if(!empty($list))
                {
                    // $list = array(); 
                    // foreach($result as $res)
                    // {
                    //     $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                    //     $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                    //     $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                    //     $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                    //     $list[] = $res;
                    // }
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


    public function rudra_job_sendoffer(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');
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
                $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $sm_id = $this->input->post('sm_id',true);

                $chk_data = $this->db->get_where("rudra_jobs",array('id' => $job_id))->row();

                if(!empty($chk_data))
                {

                    $chk_data2 = $this->db->get_where("rudra_job_actions",array('job_id' => $job_id, 'cg_id' => $cg_id, 'sm_id' => $sm_id, 'status'=>'Pending'))->row();

                    if(empty($chk_data2)){

                        // $chk_data3 = $this->db->get_where("rudra_jobs_nurse",array('job_id' => $job_id, 'cg_id' => $cg_id))->row();

                        // if(empty($chk_data3)){

                            $insertArray = array(
                                'cg_id' => $cg_id,
                                'job_id' => $job_id,
                                'sm_id' => $sm_id
                            );

                            $this->db->insert("rudra_job_actions",$insertArray);
                            $job_offer_id = $this->db->insert_id();


                            if($chk_data->is_premium == 'yes'){
                                $premium = 'premium';
                                $job_rate = $chk_data->job_prem_rate;
                            }else{
                                $premium = 'normal';
                                $job_rate = $chk_data->job_rate;
                            }

                            $insertArray = array(
                                'cg_id' => $cg_id,
                                'job_id' => $job_id,
                                'hiring_type' => $premium,
                                'hiring_rate' => $job_rate,
                                'job_offer_id' => $job_offer_id
                            );

                            $this->db->insert("rudra_jobs_nurse",$insertArray);

                            $insertArray = array(
                                'user_id' => $sm_id,
                                'user_type' => 'sm',
                                'not_type' => 'job',
                                'not_title' => 'Job offered',
                                'not_text' => 'You have received a job offer for '.$chk_data->job_title.'.',
                                'job_id' => $chk_data->id,
                                'type' => 'application',
                                'cg_id' => $cg_id,
                                'sm_id' => $sm_id
                            );

                            $this->db->insert("rudra_notifications",$insertArray);


                            $this->chk = 1;
                            $this->msg = 'Job offer sent';
                            $where = " where id=$job_id";

                            $res = $this->jobData($where);
                            $this->return_data = $res;
                        // }else{

                        //     $this->chk = 0;
                        //     $this->msg = 'Job offer already exist';
                        // }
                    }else{

                        $this->chk = 0;
                        $this->msg = 'Job offer already exist';
                    }

                
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }
    }


    public function rudra_job_apply(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');
            $this->form_validation->set_rules('cg_id', 'cg_id', 'required');
            // $this->form_validation->set_rules('sm_id', 'sm_id', 'required');

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
                // $sm_id = $this->input->post('sm_id',true);

                $chk_data = $this->db->get_where("rudra_jobs",array('id' => $job_id))->row();

                if(!empty($chk_data))
                {

                    $sm_id = $chk_data->sm_id;

                    $chk_data2 = $this->db->get_where("rudra_job_actions",array('job_id' => $job_id, 'cg_id' => $cg_id, 'sm_id' => $chk_data->sm_id, 'status'=>'Pending'))->row();

                    if(empty($chk_data2)){

                        // $chk_data3 = $this->db->get_where("rudra_jobs_nurse",array('job_id' => $job_id, 'cg_id' => $cg_id))->row();

                        // if(empty($chk_data3)){

                            $insertArray = array(
                                'cg_id' => $cg_id,
                                'job_id' => $job_id,
                                'sm_id' => $sm_id,
                                'act_type' => 'applied'
                            );

                            $this->db->insert("rudra_job_actions",$insertArray);
                            $job_offer_id = $this->db->insert_id();

                            if($chk_data->is_premium == 'yes'){
                                $premium = 'premium';
                                $job_rate = $chk_data->job_prem_rate;
                            }else{
                                $premium = 'normal';
                                $job_rate = $chk_data->job_rate;
                            }

                            $insertArray = array(
                                'cg_id' => $cg_id,
                                'job_id' => $job_id,
                                'hiring_type' => $premium,
                                'hiring_rate' => $job_rate,
                                'job_offer_id' => $job_offer_id
                            );

                            $this->db->insert("rudra_jobs_nurse",$insertArray);

                            $cgdata = $this->db->get_where("rudra_care_giver",array('id' => $cg_id))->row();

                            $insertArray = array(
                                'user_id' => $cg_id,
                                'user_type' => 'cg',
                                'not_type' => 'job',
                                'not_title' => 'Job applied',
                                'not_text' => $cgdata->cg_fname.' '.$cgdata->cg_lname.' have applied for a job - '.$chk_data->job_title.'.',
                                'job_id' => $chk_data->id,
                                'type' => 'application',
                                'cg_id' => $cg_id,
                                'sm_id' => $sm_id
                            );

                            $this->db->insert("rudra_notifications",$insertArray);

                            $this->chk = 1;
                            $this->msg = 'Job applied';

                            $where = " where id=$job_id";

                            $res = $this->jobData($where);
                            $this->return_data = $res;


                        // }else{

                        //     $this->chk = 0;
                        //     $this->msg = 'Job offer already exist';
                        // }
                    }else{

                        $this->chk = 0;
                        $this->msg = 'Job offer already exist';
                    }

                
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }



    }

    public function rudra_job_hire(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_job_actions",array('id' => $id))->row();

                if(!empty($chk_data))
                {

                    $sm_id = $chk_data->sm_id;
                    $updateArray = array(
                            'status' => 'Approved',
                            'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$id);
                    $this->db->update("rudra_job_actions",$updateArray);

                    // $updateArray = array(
                    //     'status' => 'Active',
                    //     'updated_on' => date('Y-m-d H:i:s')
                    // );

                    // $this->db->where('job_id',$chk_data->job_id);
                    // $this->db->where('cg_id',$chk_data->cg_id);
                    // $this->db->update("rudra_jobs_nurse",$updateArray);


                    $job_data = $this->db->get_where("rudra_jobs",array('id' => $chk_data->job_id))->row();


                    $insertArray = array(
                        'user_id' => $chk_data->sm_id,
                        'user_type' => 'sm',
                        'not_type' => 'job',
                        'not_title' => 'Job offer approved',
                        'not_text' => 'You got hired for the job - '.$job_data->job_title.' ',
                        'job_id' => $chk_data->job_id,
                        'type' => 'general',
                        'cg_id' => $chk_data->cg_id,
                        'sm_id' => $sm_id
                    );

                    $this->db->insert("rudra_notifications",$insertArray);

                    $this->chk = 1;
                    $this->msg = 'Job offer approved';
                    
                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }



    }


    public function rudra_job_make_active(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_jobs_nurse",array('id' => $id, 'status !=' => 'Active'))->row();

                if(!empty($chk_data))
                {

                    // $sm_id = $chk_data->sm_id;
                    // $updateArray = array(
                    //         'status' => 'Approved',
                    //         'updated_on' => date('Y-m-d H:i:s')
                    // );

                    // $this->db->where('id',$id);
                    // $this->db->update("rudra_job_actions",$updateArray);

                    $updateArray = array(
                        'status' => 'Active',
                        'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$chk_data->id);
                    $this->db->update("rudra_jobs_nurse",$updateArray);


                    $updateArray = array(
                        'rudra_jobs_nurse.status' => 'Active',
                        'rudra_jobs_nurse.updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->join('rudra_job_actions', 'rudra_jobs_nurse.job_offer_id = rudra_job_actions.id');
                    $this->db->set($updateArray);
                    $this->db->where('rudra_jobs_nurse.job_id',$chk_data->job_id);
                    $where = '(rudra_job_actions.status="Accept" or rudra_job_actions.status = "Approved")';
                    $this->db->where($where);
                    $this->db->update('rudra_jobs_nurse');


                    $job_data = $this->db->get_where("rudra_jobs",array('id' => $chk_data->job_id))->row();

                    $updateArray = array(
                        'status' => 'Active',
                        'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$job_data->id);
                    $this->db->update("rudra_jobs",$updateArray);


                    $insertArray = array(
                        'user_id' => $job_data->sm_id,
                        'user_type' => 'sm',
                        'not_type' => 'job',
                        'not_title' => 'Job offer approved',
                        'not_text' => 'Job you got hired '.$job_data->job_title.' is been made active.',
                        'job_id' => $chk_data->job_id,
                        'type' => 'general',
                        'cg_id' => $chk_data->cg_id,
                        'sm_id' => $sm_id
                    );

                    $this->db->insert("rudra_notifications",$insertArray);

                    $this->chk = 1;
                    $this->msg = 'Hired job is been made active successfully';
                    
                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }

    }


    public function rudra_job_end_contract(){

            

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_jobs_nurse",array('id' => $id))->row();

                if(!empty($chk_data))
                {

                    $chk_data2 = $this->db->get_where("rudra_job_actions",array('id' => $chk_data->job_offer_id))->row();

                    // $updateArray = array(
                    //         'status' => 'Approved',
                    //         'updated_on' => date('Y-m-d H:i:s')
                    // );

                    // $this->db->where('id',$id);
                    // $this->db->update("rudra_job_actions",$updateArray);

                    $updateArray = array(
                        'status' => 'Completed',
                        'updated_on' => date('Y-m-d H:i:s')
                    );

                    // $this->db->where('job_id',$chk_data->job_id);
                    $this->db->where('id',$chk_data->id);
                    $this->db->update("rudra_jobs_nurse",$updateArray);


                    $job_data = $this->db->get_where("rudra_jobs",array('id' => $chk_data->job_id))->row();


                    $insertArray = array(
                        'user_id' => $chk_data2->sm_id,
                        'user_type' => 'sm',
                        'not_type' => 'job',
                        'not_title' => 'Job contract ended',
                        'not_text' => 'Job contract has been ended for '.$job_data->job_title,
                        'job_id' => $chk_data->job_id,
                        'cg_id' => $chk_data->cg_id,
                        'sm_id' => $chk_data2->sm_id
                    );

                    $this->db->insert("rudra_notifications",$insertArray);

                    $this->chk = 1;
                    $this->msg = 'Job offer ended';

                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }

    }


    public function rudra_accept_job(){

        
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_job_actions",array('id' => $id))->row();

                if(!empty($chk_data))
                {


                    $updateArray = array(
                            'status' => 'Accept',
                            'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$id);
                    $this->db->update("rudra_job_actions",$updateArray);


                    $updateArray = array(
                        'status' => 'Active',
                        'updated_on' => date('Y-m-d H:i:s')
                    );

                    // $this->db->where('job_id',$chk_data->job_id);
                    $this->db->where('job_offer_id',$chk_data->job_offer_id);
                    $this->db->update("rudra_jobs_nurse",$updateArray);


                    $job_data = $this->db->get_where("rudra_jobs",array('id' => $chk_data->job_id))->row();


                    $insertArray = array(
                        'user_id' => $chk_data->cg_id,
                        'user_type' => 'cg',
                        'not_type' => 'job',
                        'not_title' => 'Job accepted',
                        'not_text' => 'Job you offered - '.$job_data->job_title.' is been accepted',
                        'job_id' => $chk_data->job_id,
                        'cg_id' => $chk_data->cg_id,
                        'sm_id' => $chk_data->sm_id
                    );

                    $this->db->insert("rudra_notifications",$insertArray);

                    $this->chk = 1;
                    $this->msg = 'Job offer accepted successfully';
                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'Job offer not found';
                }

            }
        }
    }


    public function rudra_reject_job(){

        
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_job_actions",array('id' => $id))->row();

                if(!empty($chk_data))
                {


                    $updateArray = array(
                            'status' => 'Decline',
                            'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$id);
                    $this->db->update("rudra_job_actions",$updateArray);

                    $job_data = $this->db->get_where("rudra_jobs",array('id' => $chk_data->job_id))->row();


                    $insertArray = array(
                        'user_id' => $chk_data->cg_id,
                        'user_type' => 'cg',
                        'not_type' => 'job',
                        'not_title' => 'Job rejected',
                        'not_text' => 'Job you offered - '.$job_data->job_title.' is been rejected',
                        'job_id' => $chk_data->job_id,
                        'cg_id' => $chk_data->cg_id,
                        'sm_id' => $chk_data->sm_id
                    );

                    $this->db->insert("rudra_notifications",$insertArray);

                    $this->chk = 1;
                    $this->msg = 'Job offer rejected';
                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'Job offer not found';
                }

            }
        }
    }

    public function rudra_cancel_job(){
                
        
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_jobs",array('id' => $id))->row();

                if(!empty($chk_data))
                {


                    $updateArray = array(
                            'status' => 'Draft',
                            'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$id);
                    $this->db->update("rudra_job_actions",$updateArray);

                    $this->chk = 1;
                    $this->msg = 'Job offer rejected';
                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }
    }
      

    public function rudra_job_end(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            $this->form_validation->set_rules('job_id', 'job_id', 'required');
            $this->form_validation->set_rules('sm_id', 'sm_id', 'required');

            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $id = $this->input->post('job_id',true);

                $chk_data = $this->db->get_where("rudra_jobs",array('id' => $id, 'sm_id' => $sm_id))->row();

                if(!empty($chk_data))
                {


                    $updateArray = array(
                            'status' => 'Completed',
                            'updated_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id',$id);
                    $this->db->update("rudra_jobs",$updateArray);

                    $this->chk = 1;
                    $this->msg = 'Job ended';
                    $where = " where id=$id";

                    $res = $this->jobData($where);
                    $this->return_data = $res;
                }else{

                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }

            }
        }


    }

    public function jobData($where, $start_index = 0, $per_page = 10, $join=''){

        $select = '';
        if($join){
            $select = ' ,rudra_jobs_nurse.cg_id';
        }

        if($per_page != 0){
            $limit = "LIMIT $start_index , $per_page ";
        }else{
            $limit = '';
        }

        $query = "SELECT rudra_jobs.* $select FROM $this->table $join $where ORDER BY rudra_jobs.id DESC ";
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

                // if(strtotime($res->start_date) <= strtotime(date('Y-m-d')) && strtotime($res->end_date) >= strtotime(date('Y-m-d'))){
                //     $res->status = 'Active';
                // }else if(strtotime($res->start_date) > strtotime(date('Y-m-d')) ){
                //     $res->status = 'Posted';
                // }else if(strtotime($res->end_date) < strtotime(date('Y-m-d'))){
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
                $query = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs_nurse on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id where rudra_job_actions.job_id=$res->id AND rudra_job_actions.act_type='applied' AND rudra_job_actions.status='Pending' order by rudra_job_actions.id desc";
                $res->applied_nurses = $this->db->query($query)->num_rows();

                $query1 = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs_nurse on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id where rudra_job_actions.job_id=$res->id AND (rudra_job_actions.status='Approved' OR rudra_job_actions.status='Accept') AND rudra_jobs_nurse.status='Pending' order by rudra_job_actions.id desc";
                $res->hired_nurses = $this->db->query($query1)->num_rows();

                
                $applied = $this->db->query($query)->result();

                $applist = array();
                foreach($applied as $row){
                    $row->applied_date = date('d/m/Y', strtotime($row->added_on));

                    $row->nurse = $this->nurseDetails($row->cg_id);

                    $applist[] = $row;

                }
                $res->applied = $applist;

                $hired = $this->db->query($query1)->result();

                $hiredlist = array();
                foreach($hired as $row){
                    $row->hired_date = date('d/m/Y', strtotime($row->updated_on));

                    if($res->status == 'Accept'){
                        $res->status = 'Accepted';
                    }elseif ($res->status == 'Decline') {
                        $res->status = 'Rejected';
                    }
                    $row->nurse = $this->nurseDetails($row->cg_id);

                    $hiredlist[] = $row;

                }
                $res->hired = $hiredlist;



                $query2 = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs_nurse on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id inner join rudra_jobs on rudra_jobs.id=rudra_job_actions.job_id where rudra_job_actions.job_id=$res->id AND rudra_jobs_nurse.status='Active'  order by rudra_job_actions.id desc";
                $res->active_nurses = $this->db->query($query2)->num_rows();

                $active_nurses = $this->db->query($query2)->result();

                $active_nurseslist = array();
                foreach($active_nurses as $row){

                    $row->start_date = date('d/m/Y', strtotime($row->updated_on));

                    $row->nurse = $this->nurseDetails($row->cg_id);

                    $active_nurseslist[] = $row;

                }
                $res->active = $active_nurseslist;

                $query3 = "SELECT rudra_job_actions.* FROM rudra_job_actions inner join rudra_jobs_nurse on rudra_job_actions.id=rudra_jobs_nurse.job_offer_id inner join rudra_jobs on rudra_jobs.id=rudra_job_actions.job_id where rudra_job_actions.job_id=$res->id AND  rudra_jobs_nurse.status='Completed'  AND (rudra_job_actions.status='Accept' or rudra_job_actions.status='Approved')  order by rudra_job_actions.id desc";
                $res->past_nurses = $this->db->query($query3)->num_rows();

                $past_nurses = $this->db->query($query3)->result();

                $past_nurseslist = array();
                foreach($past_nurses as $row){

                    $row->start_date = date('d/m/Y', strtotime($row->updated_on));

                    $row->nurse = $this->nurseDetails($row->cg_id);

                    $past_nurseslist[] = $row;

                }
                $res->past = $past_nurseslist;




                $list[] = $res;
            }


        }


        return $list;
    }
            


    public function nurseDetails($nurse_id, $sm_id=''){

        $where = " where rudra_care_giver.id=$nurse_id ";

        $query = "SELECT rudra_care_giver.*, rudra_cg_category.cat_id FROM `rudra_care_giver` inner join rudra_cg_category on rudra_cg_category.cg_id = rudra_care_giver.id $where ";
        $res = $this->db->query($query)->row();

        if(!empty($res))
        {
            $this->db->where(['id' => $res->cat_id]);
            $cat = $this->db->get('rudra_nurse_category');

            $res->category_name = $cat->row()->nc_name;

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

            // if($res->premium == 1){
            //     $res->premium = 'yes';
            // }else{
            //     $res->premium = 'no';
            // }

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


            $this->db->where(['cg_id' => $res->id, 'sm_id' => $sm_id]);
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


    public function rudra_total_jobs_data(){


        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            //$this->form_validation->set_rules('page_number', 'Page Number: default 1', 'required');
            $this->form_validation->set_rules('sm_id', 'shift manager', 'required');
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                
                $sm_id = $this->input->post('sm_id');


                $where = ' where 1=1 ';


                if($sm_id){
                    $where .= ' AND sm_id='.$sm_id.' ';
                }



                $list = $this->jobData($where, $start_index=0, $per_page=0);
                if(!empty($list))
                {
                    // $list = array();
                    // foreach($result as $res)
                    // {
                    //     $res->added_on_custom_date = date('d-M-Y',strtotime($res->added_at));
                    //     $res->added_on_custom_time = date('H:i:s A',strtotime($res->added_at));
                    //     $res->updated_on_custom_date = date('d-M-Y',strtotime($res->updated_at));
                    //     $res->updated_on_custom_time = date('H:i:s A',strtotime($res->updated_at));
                    //     $list[] = $res;
                    // }
                    $this->chk = 1;
                    $this->msg = 'Data listed';
                    $this->return_data = array( "total_jobs" => count($list) );
                }
                else
                {
                    $this->chk = 0;
                    $this->msg = 'No record exist';
                }
               
            }
        }

    }


    public function rudra_job_feedback(){

        if(!empty($_POST))
        {
            $this->form_validation->set_rules('api_key', 'API KEY', 'required');
            
			$this->form_validation->set_rules('job_id', 'job_id', 'required');
			$this->form_validation->set_rules('sm_id', 'sm_id', 'required'); 
            // $this->form_validation->set_rules('cg_id', 'cg_id', 'required'); 
            // $this->form_validation->set_rules('feedback', 'feedback', 'required');   
            if($this->form_validation->run() == FALSE) 
			{ 
                $this->chk = 0;
                $this->msg = 'Input Error, Please check Params';
                $this->return_data = $this->form_validation->error_array();
            }
            else
            { 
                $sm_id = $this->input->post('sm_id',true);
                $job_id = $this->input->post('job_id',true);
                $cg_id = $this->input->post('cg_id',true);
                $feedback = $this->input->post('feedback',true);


               
                    //Insert Codes goes here 
                    $updateArray = 
                        array(
                        'job_id' => $this->input->post('job_id'),
                        'sm_id' => $this->input->post('sm_id'),
                        'cg_id' => $this->input->post('cg_id'),
                        // 'feedback' => $this->input->post('feedback'),
                        // 'rating' => $this->input->post('rating')
                        );

                    $this->db->insert("rudra_job_feedback",$updateArray);
                    $new_id = $this->db->insert_id();

                
                
                $res = $this->db->get_where("rudra_job_feedback",array('id' => $new_id ))->row();
                
                $this->chk = 1;
                $this->msg = 'Data Stored Successfully';
                $this->return_data = $res;
            }
        }
    }
}