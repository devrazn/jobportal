<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('blank_body');
		$this->load->view('admin/login');
	}

	public function login_validation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email','Email','required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password','required|md5|trim');

		if($this->form_validation->run()){
			$data = array(
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
				);
			$this->session->set_userdata($data);

			redirect('main/members');
		} else {
			$this->load->view('login');
		}

		//echo $_POST['email'];
		//echo $this->input->post('email');
	}
}
