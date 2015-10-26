<?php

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/user_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        $this->cms_user();
    }

    function cms_user() {
        $config['base_url'] = site_url(ADMIN_PATH . '/user/page');
        $data['main'] = 'admin/user/list';
        $query = $this->db->get('tbl_users');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['user_list'] = $this->user_model->user_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'user';

        $this->load->view('admin/admin', $data);
    }

    function edit($id) {
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
        $this->form_validation->set_rules('f_name', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rules('l_name', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        $this->form_validation->set_rules('dob_estd', 'Establised', 'required|xss_clean');
        $this->form_validation->set_rules('company_type', 'Company Type', 'required|xss_clean');
        $this->form_validation->set_rules('profile', 'Profile', 'required|xss_clean');
        $this->form_validation->set_rules('benefits', 'Benefits', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->user_model->get_user($id);
            $data['main'] = 'admin/user/edit';
            $data['title'] = 'Edit user';
            $this->load->view('admin/admin', $data);
        } else {
            $this->user_model->update_user($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'User Updated Successfully');
            redirect(ADMIN_PATH . '/user', 'refresh');
        }
    }

    function change_status($status = '', $id = '') {
        $this->user_model->change_status($status, $id);
        redirect(ADMIN_PATH . '/user', 'refresh');
    }

}
