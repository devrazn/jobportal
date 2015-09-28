<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/category_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        
        $this->category();
    }


    public function category() {
        $data['main'] = 'admin/category/list';
        $this->load->view('admin/admin', $data);

       // $this->load->view('admin/category/list');
    }

}
