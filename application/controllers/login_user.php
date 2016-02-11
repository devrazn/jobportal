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
		//echo '<pre>',print_r($data2,1),'</pre>'; exit;
		$this->template->__set('title', 'Login');
		$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
		$this->template->publish('default_layout');
	}


}
