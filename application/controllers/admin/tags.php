<?php

class Tags extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/tags_model');
        $this->load->model('admin/category_model');
        $this->load->library('form_validation');
        if(!$this->helper_model->validate_admin_session()){
          redirect(base_url() . 'admin');
        }

    }

    public function index() {
        $this->cms_tags();
    }


    function cms_tags() {
        $config['base_url'] = site_url(ADMIN_PATH . '/tags/page');
        $data['main'] = 'admin/tags/list';
        $query = $this->db->get('tbl_tags');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['tags_list'] = $this->tags_model->tags_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'Tags';

        $this->load->view('admin/admin', $data);
    }

    function add() {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['category_info'] = $this->category_model->category_list_all();
            $data['main'] = 'admin/tags/add';
            $data['title'] = 'Add Tags';
            $this->load->view('admin/admin', $data);
        } else {
            $this->tags_model->add_tags();
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Tags Added Successfully');
            redirect(ADMIN_PATH . '/tags', 'refresh');
        }
    }

    function edit($id) {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

        $data['category_info'] = $this->category_model->category_list_all();

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->tags_model->get_tags($id);
            $data['main'] = 'admin/tags/edit';
            $data['title'] = 'Edit Tags';
            $this->load->view('admin/admin', $data);
        } else {
            $this->tags_model->update_tags($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Tags Updated Successfully');
            redirect(ADMIN_PATH . '/tags', 'refresh');
        }
    }

    function delete_tags($id) {
        $this->tags_model->delete_tags($id);
        $this->session->set_userdata( 'flash_msg_type', "success" );
        $this->session->set_flashdata('flash_msg', 'Tags Deleted Successfully.');
        redirect(ADMIN_PATH . '/tags', 'refresh');
    }

    // function change_status($status = '', $id = '') {
    //     $this->tags_model->change_status($status, $id);
    //     redirect(ADMIN_PATH . '/tags', 'refresh');
    // }

    public function change_status($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_tags', $options, 1);
        $det=$query->row_array();
                
        if ($det['status'] === '1') {
            $status = '0';
            $txt="Inactive";
        } elseif ($det['status'] === '0') {
            $status = '1';
            $txt="Active";
        }

        $data = array('status' => $status);
        $this->db->where('id', $id);
        $this->db->update('tbl_tags', $data);
        echo $txt;
    }

}
