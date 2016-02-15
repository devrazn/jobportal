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

	public function forgot_pass(){
		if($this->session->userdata('is_Login')){
			$this->load->view('home/landing');	
		} else {
			$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
			$data["sidebar_categories"] = $this->home_model->get_job_categories();
			$data["page"] = "forgot_password";
			$this->template->__set('title', 'Forgot Password');
			$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
			$this->template->publish('default_layout');
		}
	}

	public function forgot_pass_validation(){
		$this->form_validation->set_rules('email', "Email",'required|xss_clean|trim|valid_email|callback_email_exists');

		if($this->form_validation->run()){
			$this->login_user_model->pass_confirmation_email();
			redirect('home/landing');
			
		}else{
			$this->forgot_pass();
		}
	}

	public function email_exists() {
		if($this->login_user_model->check_email($this->input->post('email'))==FALSE) {
			$this->form_validation->set_message('email_exists', 'Email Id Doesnot Exist In Our System, Plese Register First.');
			return false;
		} else {
			return true;
		}	
	}

	public function validate_pw_reset_credentials($key='', $hash_email='') {
		$data = array(
					'key' => $key,
					'email' => $hash_email
					);
		$email = $this->login_user_model->is_key_valid($data);
		if($email){
			$data = array(
				'email' => $email,
				'is_logged_in' => 1
				);
			$this->session->set_userdata($data);

			$this->session->key = $key;
			$this->session->hash_email = $hash_email;

			$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
			$data["sidebar_categories"] = $this->home_model->get_job_categories();
			$data["page"] = "reset_password";
			$this->template->__set('title', 'Reset Password');
			$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
			$this->template->publish('default_layout');

		} else {
			return false;
			echo "Invalid password reset credentials."; exit;
		}
	}

	public function validate_reset_pw(){
		$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('c_password','Confirm Password','required|xss_clean|matches[password]');

	if($this->form_validation->run()) {
			//generate random key
			$data['key'] = md5(uniqid());
			$data['password'] = $this->helper_model->encrypt_me($this->input->post('password'));
			if($this->login_user_model->update_pw($data)){
				$this->session->set_userdata( 'flash_msg_type', "success" );
				$this->session->set_flashdata( 'flash_msg', "Password successfully reset" );
				redirect('home/landing');
			} else {
				$this->session->set_userdata( 'flash_msg_type', "danger" );
				$this->session->set_flashdata( 'flash_msg', "Sorry, We cannot reset your password currently." );
				$this->validate_pw_reset_credentials($this->session->key, $this->session->hash_email);
			}

		} else {
			$this->session->pass_error = form_error('password');
			$this->session->cpass_error = form_error('cpassword');
			$this->validate_pw_reset_credentials($this->session->key, $this->session->hash_email);
		}
	}

	


}
