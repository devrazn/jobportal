<?php

class Error_log extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/category_model');
        //$this->load->library('form_validation');
        $this->helper_model->validate_session();
        //$this->load->library('datatables');
    }


   	function index () {
   		$data['title'] = 'Error Log';
   		$data['main'] = 'admin/log';
   		$this->load->view('admin/admin', $data);
   	}


}