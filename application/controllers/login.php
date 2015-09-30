<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	var $hash_email; var $hash_key;

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->library('form_validation');
	  	$this->load->helper('cookie');
	  	$this->load->model('model_login');
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
			$this->load->view('admin/common/blank_body');	
		} else {
			redirect('login/login');
		}
		
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

			redirect('login/dashboard');

		} else {
			$this->load->view('admin/login');
		}

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

	public function admin_forgot_pass() {
		if($this->session->userdata('is_logged_in')){
			$this->load->view('admin/blank_body');	
		} else {
			$this->load->view('admin/forgot_pass');
		}
	}
	

	public function admin_forgot_pass_validation() {
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|callback_validate_admin_email');

		if($this->form_validation->run()){
			//send the password reset link to the email address.

			//generate random key
			$data['key'] = md5(uniqid());
			$key = $data['key'];
			$this->hash_key = $data['key'];
			$email = sha1(md5($this->input->post('email')));
			$this->hash_email = $email;
			//echo $this->hash_key.' & '.$this->hash_email; exit;


			$this->load->library('email',array('mailtype' => 'html',
												'protocol' => 'smtp',
												'smtp_host' => 'smtp.wlink.com.np',
												//'smtp_host' => 'ssl://smtp.gmail.com',
												//'smtp_port' => '465',
												//'smtp_user' => 'rajanacharyapkr@gmail.com',
												//'smtp_pass' => '**********',
												'charset' => 'iso-8859-1',
												'newline' => "\r\n"));

			$this->load->model('model_login');

			// $config['protocol'] = "smtp";
			// $config['smtp_host'] = "ssl://smtp.gmail.com";
			// $config['smtp_port'] = "465";
			// $config['smtp_user'] = "blablabla@gmail.com"; 
			// $config['smtp_pass'] = "yourpassword";
			// $config['charset'] = "utf-8";
			// $config['mailtype'] = "html";
			// $config['newline'] = "\r\n";

			// $ci->email->initialize($config);

			$this->email->from('acharya.rajanpkr@gmail.com', 'Rajan Me');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Reset Password');

			$message = "<p>Reset your JobPortal Password.</p>";
			$message .= "<p><a href='".base_url()."login/validate_admin_pw_reset_credentials/$key/$email'>Click Here</a> to reset your password.</p>";
			$this->email->message($message);

			if($this->model_login->set_admin_pw_reset_key($key)){
				echo $message;
				/*if($this->email->send()) {
					echo "The email has been sent.";
					//echo $this->email->print_debugger();
				} else {
					echo "The email couldn't be sent.";
					echo $this->email->print_debugger();
				}*/
			} else {
				echo 'Problem updating password reset key to the admin table.';
			}

			//send an email to the user
			/*if($this->email->send()) {
				echo "The email has been sent.";
			} else {
				echo "The email couldn't be sent.";
				echo $this->email->print_debugger();
			}*/

			//add them to the temp_users table
			/*} else {
				echo 'fail';
				$this->load->view('sign_up');
			}*/

		} else {
			$this->load->view('admin/forgot_pass');
		}

	}


	public function validate_admin_email() {

		if($this->model_login->is_valid_admin_email()){
			return true;
		} else {
			$this->form_validation->set_message('validate_admin_email','Incorrect Email');
			return false;
		}
	}


	public function validate_admin_pw_reset_credentials($key='', $hash_email='') {

		//echo 'key = '.$key.' and email = '.$email; exit;
		if($this->uri->segment(3)=='' || $this->uri->segment(4)==''){
			echo "The page doesn't exist."; exit;
		}
		//echo 'key = ' . $key . ' & email = ' . $email; exit;
		$data = array(
					'key' => $key,
					'email' => $hash_email
					);
		$email = $this->model_login->is_admin_key_valid($data);
		if($email){
			$data = array(
				'email' => $email,
				'is_logged_in' => 1
				);
			$this->session->set_userdata($data);

			$this->session->key = $key;
			$this->session->hash_email = $hash_email;

			$this->load->view('admin/reset_pw');
		} else {
			echo "Invalid password reset credentials."; exit;
		}
	}
	

	public function reset_pw_validation() {

		$this->form_validation->set_rules('password','Password','required|trim|alpha_numeric|min_length[6]|max_length[64]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');

		$this->form_validation->set_message('alpha_numeric','The password must be alphanumeric');

		if($this->form_validation->run()) {
			//generate random key
			$data['key'] = md5(uniqid());
			$data['password'] = $this->encrypt_me($this->input->post('password'));
			if($this->model_login->update_pw($data)){
				$this->session->set_userdata( 'flash_msg_type', "success" );
				$this->session->set_flashdata( 'flash_msg', "Password successfully reset" );
				return redirect(base_url()."login/dashboard");
				//echo 'password successfully reset'; exit;
			} else {
				$this->session->set_userdata( 'flash_msg_type', "danger" );
				$this->session->set_flashdata( 'flash_msg', "Sorry, Password can't be updated in the db." );
				return redirect(base_url().'login/validate_admin_pw_reset_credentials/'.$this->session->key .'/'.$this->session->hash_email);
			}

		} else {

			$this->session->pass_error = form_error('password');
			$this->session->cpass_error = form_error('cpassword');
			
			redirect('login/validate_admin_pw_reset_credentials/'.$this->session->key .'/'.$this->session->hash_email);
		}
	}
}
