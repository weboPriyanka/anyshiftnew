<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TV extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->return_data = array('status' => false, 'msg' => 'Error', 'login' => false, 'data' => array());
		
	}
	public function index()
	{
		if ($this->session->userdata('rudra_tv_logged_in')) {
			// $data['pageTitle'] = "TV Owner Dashboard";
			// $data['page_template'] = "empty";
			$data['pageTitle'] = ' Videos';                        
        	$data['page_template'] = '_rudra_videos';
			$tv_id = $this->session->userdata('rudra_tv_id');
			
			$this->load->view('tv/template', $data);
		} else {
		    redirect(site_url('tv-login'), 'refresh');
		}
	}
	public function login()
	{
		$data['page_title'] = " TV Owner Login";
		$this->load->view('tv/login', $data);
	}
	
	public function check_login_tv()
	{
		// if (!$this->input->is_ajax_request()) {
		// 	exit('No direct script access allowed');
		// } else {
			$username = $this->input->post('username', true);
			$password = SHA1($this->input->post('password', true));
			$check = $this->db->get_where($this->bdp . 'video_admin', array('user_name' => $username, 'password' => $password))->row();
			if(!empty($check))
			{
				$adminlogin = array(
						'rudra_tv_status'            => 1,
						'rudra_tv_id'            => $check->id,
						'rudra_tv_name'          => $check->display_name,
						'rudra_tv_username'          => $check->user_name,
						'rudra_tv_logged_in'         => TRUE,
						'rudra_tv_utype'         => 1,
					);
					$return = 'tv-owner/dashboard';
					$post = ($_POST['req_uri'] != '' ? ($_POST['req_uri'] == 'tv' ? $return : $_POST['req_uri']) : $return);
					$return_url = $post;
					$this->session->set_userdata($adminlogin);
					$this->return_data['msg'] = "Login Successfull, redirecting...";
					$this->return_data['login'] = true;
					$this->return_data['status'] = 'success';
					$this->return_data['data'] = array('url' => base_url("$return_url"));
				
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
		redirect(base_url('tv-login'), 'refresh');
	}


	
}
