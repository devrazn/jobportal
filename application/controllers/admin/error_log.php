<?php

class Error_log extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/category_model');
        //$this->load->library('form_validation');
        if(!$this->helper_model->validate_admin_session()){
          redirect(base_url() . 'admin');
        }
        //$this->load->library('datatables');
    }


   	function index () {
   		$data['title'] = 'Error Log';
   		$data['main'] = 'admin/log';
   		$this->load->view('admin/admin', $data);
   	}


}