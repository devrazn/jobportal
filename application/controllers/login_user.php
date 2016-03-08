<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_User extends CI_Controller {

	//var $hash_email; var $hash_key;

	public function __construct()
	{
	  	parent::__construct();

	  	$this->load->helper('cookie');
	  	$this->load->model('login_user_model');
	  	$this->load->model('home_model');
	  	
	}

	public function index() {
		if($this->helper_model->validate_user_session()){
			redirect(base_url());
		} else {
			$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
			$data["sidebar_categories"] = $this->home_model->get_job_categories();
			$data["page"] = "login";
			$this->template->__set('title', 'Login');
			$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
			$this->template->publish('default_layout');
		}
	}

	public function login_process(){
		$this->form_validation->set_rules('email', "Email",'required|xss_clean|valid_email|callback_validate_credentials|callback_check_user_status');
		$this->form_validation->set_rules('password', "Password",'required|xss_clean');
		if($this->form_validation->run()) {
			//$id = $this->login_user_model->get_user_id();
			$user_details = $this->login_user_model->get_user_details($this->input->post('email'));
			//echo $user_details['id']; exit;
			if($user_details['user_type'] == 0){
				$name = $user_details["f_name"] . " " . $user_details["l_name"];
			} else {
				$name = $user_details["f_name"];
			}
			$data = array(
				'user_email' => $this->input->post('email'),
				'user_pw' => $this->helper_model->encrypt_me($this->input->post('password')),
				'name' => $name,
				'is_Login' => 1,
				'user_id' => $user_details["id"],
				'user_type' => $user_details["user_type"]
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

			/*if($this->session->userdata('referred_from')) {
				$url=$this->session->userdata('referred_from');
				$this->session->set_userdata('referred_from', NULL);
				//echo $this->session->userdata('referred_from'); exit;
				redirect($url);
			} else {*/
				redirect(base_url());
			//}
		} else {
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
		$data = array('user_email', 'user_pw', 'is_Login', 'user_id');
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
			redirect(base_url() . 'login_user');
		
	}

	public function forgot_pass(){
		if($this->helper_model->validate_user_session()){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('email', "Email",'required|trim|xss_clean|valid_email|callback_email_exists');
			if($this->form_validation->run()){
				$this->login_user_model->pass_reset_email();
				$this->session->set_userdata( 'user_flash_msg_type', "success" );
	        	$this->session->set_flashdata('user_flash_msg', "A message has been sent to your email with password reset link. Please check your inbox.");
				redirect('home/landing');
			}else{
				$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
				$data["sidebar_categories"] = $this->home_model->get_job_categories();
				$data["page"] = "forgot_password";
				$this->template->__set('title', 'Forgot Password');
				$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
				$this->template->publish('default_layout');
			}
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
			$this->form_validation->set_message('email_exists', "Email Does not exist in our system. Please <a href='" . base_url() . "register'>Register </a>First.");
			return false;
		} else {
			return true;
		}	
	}


	public function validate_pw_reset_credentials($key='', $hash_email='') {
		$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('c_password','Confirm Password','required|xss_clean|matches[password]');
		if($this->form_validation->run() == FALSE) {
			if($this->session->userdata('user_key') && $this->session->userdata('user_hash_email')) {
				$credential_data = array(
									'user_key' => $this->session->userdata('user_key'),
									'user_hash_email' => $this->session->userdata('user_hash_email')
									);
			} else { 
				$credential_data = array(
							'user_key' => $key,
							'user_hash_email' => $hash_email
							);
			}
			$email = $this->login_user_model->is_key_valid($credential_data);
			if($email){
				$this->login_user_model->update_pw($email);
				$this->session->set_userdata('user_email', $email);
				$this->session->set_userdata($credential_data);
				$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
				$data["sidebar_categories"] = $this->home_model->get_job_categories();
				$data["page"] = "reset_password";
				$this->template->__set('title', 'Reset Password');
				$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
				$this->template->publish('default_layout');
			} else {
				echo "Invalid password reset credentials.";
				exit;
			}
		} else {
			$this->session->unset_userdata('user_key');
			//$this->session->unset_userdata('user_email');
			$password = $this->helper_model->encrypt_me($this->input->post('password'));
			$this->login_user_model->update_pw($this->session->userdata('user_email'), $password);

			$this->helper_model->set_user_login_session($this->session->userdata('user_email'));
			$this->session->set_userdata( 'user_flash_msg_type', "success" );
	        $this->session->set_flashdata('user_flash_msg', "Your JobPortal Password has been successfully reset.");
			redirect(base_url());
		}
	}


	public function check_user_status(){
		$user_details = $this->login_user_model->get_user_details($this->input->post('email'));
		if($user_details['verification_status']==0){
			$this->form_validation->set_message('check_user_status', 'Your account is not verified. Please check your email inbox and click on the verification link there to verify your account.');
			return false;
		} elseif($user_details['account_status']==3) {
			$this->form_validation->set_message('check_user_status', "Your account has been blocked. Please contact Admin from the <a href='" . base_url() . "contact_us'> Contact Us</a> page to access your account.");
			return false;
		} else {
			return true;
		}
	}


}
