<?php

class Newsletter extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/newsletter_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        $this->cms_newsletter();
    }


    function cms_newsletter() {
        $config['base_url'] = site_url(ADMIN_PATH . '/newsletter/page');
        $data['main'] = 'admin/newsletter/list';
        $query = $this->db->get('tbl_newsletter');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['newsletter_list'] = $this->newsletter_model->newsletter_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'Newsletter';

        $this->load->view('admin/admin', $data);
    }

    function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->helper_model->editor();

        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'admin/newsletter/add';
            $data['title'] = 'Add newsletter';
            $this->load->view('admin/admin', $data);
        } else {
            $this->newsletter_model->add_newsletter();
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Newsletter Added Successfully');
            redirect(ADMIN_PATH . '/newsletter', 'refresh');
        }
    }

    function edit($id) {
        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->helper_model->editor();

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->newsletter_model->get_newsletter($id);
            $data['main'] = 'admin/newsletter/edit';
            $data['title'] = 'Edit newsletter';
            $this->load->view('admin/admin', $data);
        } else {
            $this->newsletter_model->update_newsletter($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Newsletter Updated Successfully');
            redirect(ADMIN_PATH . '/newsletter', 'refresh');
        }
    }

    function delete_newsletter($id) {
        $this->newsletter_model->delete_newsletter($id);
        $this->session->set_userdata( 'flash_msg_type', "success" );
        $this->session->set_flashdata('flash_msg', 'Newsletter Deleted Successfully.');
        redirect(ADMIN_PATH . '/newsletter', 'refresh');
    }

    public function change_status($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_newsletter', $options, 1);
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
        $this->db->update('tbl_newsletter', $data);
        echo $txt;
    }

    function use_newsletter($id) {
        $this->helper_model->editor();
        $data['info'] = $this->newsletter_model->get_newsletter($id);
        $data['title'] = 'Send Newsletter';
        $data['main'] = 'admin/newsletter/use_newsletter';
        $this->load->view('admin/admin', $data);
    }

    function send_newsletter($id) {

        $this->form_validation->set_rules('title', 'Heading', 'required');
        $this->form_validation->set_rules('for', 'for', 'required');
        $this->form_validation->set_rules('sender', 'Sender', 'required');
        if ($this->form_validation->run() == FALSE) {

            $data['main'] = 'admin/newsletter/use_newsletter/' . $id;
            $this->load->view('admin/admin', $data);
        } else {
            $this->Newsletter_model->send_newsletter();
            $this->session->set_flashdata('message', 'Sent');
            redirect(ADMIN_PATH . '/newsletter', 'refresh');
        }
    }

}
