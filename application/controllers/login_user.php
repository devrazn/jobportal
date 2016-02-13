<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_User extends CI_Controller {

	var $hash_email; var $hash_key;

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->helper('cookie');
	  	$this->load->model('login_user_model');
	  	$this->load->model('home_model');
	}


	public function index() {
		$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
		$data["sidebar_categories"] = $this->home_model->get_job_categories();
		$data["page"] = "login";
		$this->template->__set('title', 'Login');
		$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
		$this->template->publish('default_layout');
	}

	public function login_process(){
		$this->form_validation->set_rules('email', "Email",'required|xss_clean|valid_email|callback_validate_credentials');
		$this->form_validation->set_rules('password', "Password",'required|xss_clean');
		if($this->form_validation->run()){
			$data = array(
				'email' => $this->input->post('email'),
				'is_Login' => 1
				);
			$this->session->set_userdata($data);

			if($this->input->post('remember_me') !== null) {

				$cookie = array(
					'name'   => 'user_email',
					'value'  => $this->input->post('email'),
					'expire' => time()+30 * 24 * 60 * 60
					);
				$this->input->set_cookie($cookie);

				$cookie = array(
					'name'   => 'user_pw',
					'value'  => $this->input->post('password'),
					'expire' => time()+30 * 24 * 60 * 60
					);
				$this->input->set_cookie($cookie);

			}else{

				delete_cookie('user_email');
				delete_cookie('user_pw');
			}
			redirect('home/landing');
		}else{
			$this->index();
		}
	}

	public function validate_credentials(){
		if($this->login_user_model->can_log_in()){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials','Incorrect Email/Password');
			return false;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}


}
