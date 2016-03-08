<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Admin extends CI_Controller {

	var $hash_email; var $hash_key;

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->library('form_validation');
	  	$this->load->helper('cookie');
	  	$this->load->model('login_model');
	}


	public function index() {
		if(!($this->helper_model->validate_admin_session())) {
			$this->load->view('admin/login');
		} else {
			$data['main'] = 'admin/dashboard';
			$this->load->view('admin/admin', $data);
		}
	}


	public function login() {
		if($this->helper_model->validate_admin_session()){
			redirect('admin/dashboard');
		} else {
			$this->load->view('admin/login');
		}
	}


	public function admin_login_validation() {
		$this->form_validation->set_rules('password','Password','required|xss_clean');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean|callback_validate_credentials');

		if($this->form_validation->run()){
			$this->helper_model->set_admin_login_session($this->input->post('email'));

			if($this->input->post('remember') !== null) {

				$cookie = array(
					'name'   => 'admin_jp_un',
					'value'  => $this->input->post('email'),
					'expire' => time()+30 * 24 * 60 * 60
					);
				$this->input->set_cookie($cookie);

				$cookie = array(
					'name'   => 'admin_jp_pw',
					'value'  => $this->input->post('password'),
					'expire' => time()+30 * 24 * 60 * 60
					);
				$this->input->set_cookie($cookie);

			}else{

				delete_cookie('admin_jp_un');
				delete_cookie('admin_jp_pw');

			}

			redirect('admin/dashboard');

		} else {
			$this->load->view('admin/login');
		}

	}


	public function validate_credentials(){
		if($this->login_model->can_log_in()){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials','Incorrect Email/Password');
			return false;
		}
	}


	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'login_admin');
	}


	public function admin_forgot_pass() {
		if($this->helper_model->validate_admin_session()){
			$this->load->view('admin/dashboard');	
		} else {
			$this->load->view('admin/forgot_pass');
		}
	}
	

	public function admin_forgot_pass_validation() {
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean|callback_validate_admin_email');

		if($this->form_validation->run()){
			$this->load->model('admin/settings_model');
			$mail_settings = $this->settings_model->get_email_settings();
			$key = $this->helper_model->genRandomString("16");
			$email = sha1(md5($this->input->post('email')));
			$message = "<p>Reset your JobPortal Admin Password.<br>";
			$message .= "Click <a href='".base_url()."login_admin/validate_admin_pw_reset_credentials/$key/$email'> Here</a> to reset your password.</p>";
			$data = array(
					'subject' => "Reset JobPortal Admin Password",
					'message' => $message,
					'to' => $this->input->post('email')
					);
			$this->login_model->update_pw_reset_key($key);
			if($this->helper_model->send_email($mail_settings, $data)) {
				echo "<p>Please check your email inbox. <br> A message has been sent with Password Reset link.</p>";
				exit;
				//echo $this->email->print_debugger();
			} else {
				echo "<p>Password reset request can't be completed at the moment. Please"
					.  "<a href='" . base_url() . "login_admin/admin_forgot_pass'> try again</a>"
					.  "later.</p>";
				exit;
			}
		} else {
			$this->load->view('admin/forgot_pass');
		}

	}


	public function validate_admin_email() {

		if($this->login_model->is_valid_admin_email()){
			return true;
		} else {
			$this->form_validation->set_message('validate_admin_email','Incorrect Email');
			return false;
		}
	}


	public function validate_admin_pw_reset_credentials($key='', $hash_email='') {
		$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|xss_clean|matches[password]');
		if($this->form_validation->run() == FALSE) {
			if($this->session->userdata('admin_key') && $this->session->userdata('admin_hash_email')) {
				$credential_data = array(
									'admin_key' => $this->session->userdata('admin_key'),
									'admin_hash_email' => $this->session->userdata('admin_hash_email')
									);
			} else { 
				$credential_data = array(
							'admin_key' => $key,
							'admin_hash_email' => $hash_email
							);
			}
			$email = $this->login_model->is_admin_key_valid($credential_data);
			if($email){
				$this->session->set_userdata('admin_email', $email);
				$this->session->set_userdata($credential_data);
				$this->load->view('admin/reset_pw');
			} else {
				echo "Invalid password reset credentials.";
				exit;
			}
		} else {
			$this->session->unset_userdata('admin_key');
			//$this->session->unset_userdata('user_email');
			$password = $this->helper_model->encrypt_me($this->input->post('password'));
			$this->login_model->update_pw($this->session->userdata('admin_email'), $password);

			$this->helper_model->set_admin_login_session($this->session->userdata('admin_email'));
			$this->session->set_userdata( 'flash_msg_type', "success" );
	        $this->session->set_flashdata('flash_msg', "Your JobPortal Admin Password has been successfully reset.");
			redirect(base_url() . "admin/dashboard");
		}
	}
	

	public function reset_pw_validation() {
		$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[64]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|xss_clean|matches[password]');

		if($this->form_validation->run()) {
			//generate random key
			$data['key'] = $this->helper_model->genRandomString('32');
			$data['password'] = $this->helper_model->encrypt_me($this->input->post('password'));
			if($this->login_model->update_pw($data)){
				$this->session->set_userdata( 'flash_msg_type', "success" );
				$this->session->set_flashdata( 'flash_msg', "Password successfully reset" );
				return redirect(base_url()."admin/dashboard");
			} else {
				$this->session->set_userdata( 'flash_msg_type', "danger" );
				$this->session->set_flashdata( 'flash_msg', "Sorry, We cannot reset your password currently." );
				$this->validate_admin_pw_reset_credentials($this->session->key, $this->session->hash_email);
				//return redirect(base_url().'login/validate_admin_pw_reset_credentials/'.$this->session->key .'/'.$this->session->hash_email);
			}

		} else {
			$this->session->pass_error = form_error('password');
			$this->session->cpass_error = form_error('cpassword');
			$this->validate_admin_pw_reset_credentials($this->session->key, $this->session->hash_email);
			//redirect('login/validate_admin_pw_reset_credentials/'.$this->session->key .'/'.$this->session->hash_email);
		}
	}
}
