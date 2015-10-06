<?php

class Category extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/category_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        $this->cms_category();
    }

    // public function category() {
    //     $data['main'] = 'admin/category/list';
    //     $this->load->view('admin/admin', $data);
    // }

    function cms_category() {
        $config['base_url'] = site_url(ADMIN_PATH . '/category/page');
        $data['main'] = 'admin/category/list';
        $query = $this->db->get('tbl_job_category');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['category_list'] = $this->category_model->category_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'Categories';

        $this->load->view('admin/admin', $data);
    }

    // function page() {

    //     $config['base_url'] = site_url(ADMIN_PATH . '/category/page');
    //     $data['main'] = 'admin/category/category';
    //     $query = $this->db->get('tbl_city');
    //     $config['total_rows'] = $query->num_rows();

    //     $config['per_page'] = '300';
    //     $offset = $this->uri->segment(4, 0);
    //     $config['uri_segment'] = '4';
    //     $this->pagination->initialize($config);

    //     $data['city_list'] = $this->city_model->city_list($config['per_page'], $offset);

    //     $this->load->view('admin/admin', $data);
    // }

    function add() {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $data['main'] = 'admin/category/add';
            $data['title'] = 'Add Category';
            $this->load->view('admin/admin', $data);
        } else {
            $this->category_model->add_category();
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Category Added Successfully');
            redirect(ADMIN_PATH . '/category', 'refresh');
        }
    }

    function edit($id) {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
         $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->category_model->get_category($id);
            $data['main'] = 'admin/category/edit';
            $data['title'] = 'Edit Category';
            $this->load->view('admin/admin', $data);
        } 
        else {
            //echo $id; exit;
            $this->category_model->update_category($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Category Updated Successfully');
            redirect(ADMIN_PATH . '/category', 'refresh');
        }
    }

    function delete_category($id) {
        //$this->Helper_model->validate_session();
        $this->category_model->delete_category($id);
        /*$this->session->set_userdata( 'flash_msg_type', "danger" );
        $this->session->set_flashdata( 'flash_msg', "Sorry, Password can't be updated in the db." );*/
        $this->session->set_userdata( 'flash_msg_type', "success" );
        $this->session->set_flashdata('flash_msg', 'Category Deleted Successfully.');
        redirect(ADMIN_PATH . '/category', 'refresh');
    }

    function change_status($status = '', $id = '') {
        $this->category_model->change_status($status, $id);
        redirect(ADMIN_PATH . '/category', 'refresh');
    }

}
