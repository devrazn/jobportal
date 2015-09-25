<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->library('form_validation');
	  	$this->load->helper('cookie');
	  	$this->load->library('session');
	}


	public function index() {
		if(!($this->session->userdata('is_logged_in'))) {
			//$this->load->view('members');
			$this->load->view('admin/login');
		} else {
			redirect('login/dashboard');
		}
	}


	public function sign_up() {
		if($this->session->userdata('is_logged_in')){
			redirect('login/dashboard');
		} else {
			$this->load->view('admin/sign_up');
		}
	}


	public function login() {
		//echo 1; exit;
		if($this->session->userdata('is_logged_in')){
			//$this->load->view('members');
			redirect('login/dashboard');
		} else {
			$this->load->view('admin/login');
		}
	}


	public function dashboard() {
		if($this->session->userdata('is_logged_in')){
			$this->load->view('admin/blank_body');	
		} else {
			redirect('login/login');
		}
		
	}


	public function restricted() {
		$this->load->view('restricted');
	}


	public function admin_login_validation() {
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|callback_validate_credentials');

		if($this->form_validation->run()){
			$data = array(
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
				);
			$this->session->set_userdata($data);

			if($this->input->post('remember') !== null) {

				$cookie = array(
					'name'   => 'admin_jp_un',
					'value'  => $this->input->post('email'),
					'expire' => time()+100 * 24 * 60 * 60
					);
				$this->input->set_cookie($cookie);

				$cookie = array(
					'name'   => 'admin_jp_pw',
					'value'  => $this->input->post('password'),
					'expire' => time()+100 * 24 * 60 * 60
					);
				$this->input->set_cookie($cookie);

			}else{

				delete_cookie('admin_jp_un');
				delete_cookie('admin_jp_pw');

			}

			redirect('login/dashboard');

		} else {
			//echo 1; exit;
			//$this->login();
			//redirect('main/login');
			$this->load->view('admin/login');
		}

		//echo $_POST['email'];
		//echo $this->input->post('email');
	}


	public function validate_credentials(){

		//$ciphertext = $this->encrypt_me($this->input->post('password'));
		$this->load->model('model_login');

		if($this->model_login->can_log_in()){

			return true;
		} else {
			$this->form_validation->set_message('validate_credentials','Incorrect Email/Password');
			return false;
		}
	}


	public function logout() {
		$this->session->sess_destroy();
		redirect('login/login');
	}

	public function registered_user($key) {
		$this->load->model('model_login');

		if($this->model_login->is_key_valid($key)){
			if($new_email = $this->model_login->add_user($key)){
				$data = array(
					'email' => $new_email,
					'is_logged_in' => 1
					);

				$this->session->set_userdata($data);
				redirect('login/members');
			} else {
				echo "failed to add user.";
			}
		} else {
			echo 'invalid key';
		}
	}


	public function encrypt_me($data) {
		$this->load->library('encryption');
		$this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'driver' => 'openssl',
                'mode' => 'ctr'
        )
        );
        //echo $this->encryption->encrypt($data); exit;
		return $this->encryption->encrypt($data);
	}
	
}
