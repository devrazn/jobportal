<?php

class category extends CI_Controller {

    function __construct()
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
        $data['main'] = 'admin/category/list';
        $this->load->view('admin/admin', $data);
    }

    function add() {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data['main'] = 'admin/category/add';
            $this->load->view('admin/admin', $data);
        } 
        else {
            $this->category_model->add_category();
            $this->session->set_flashdata('message', 'Added');
            redirect(ADMIN_PATH . '/category', 'refresh');
        }
    }

}
