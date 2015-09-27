<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        
        $this->category();
    }


    public function category() {

        $this->load->view('admin/category/list');
    }

}
