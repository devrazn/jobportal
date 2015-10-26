<?php

class Qualification extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/qualification_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }
 
    public function list_qualification($id) {
        $data['info'] = $this->qualification_model->get_qualification($id);
        $data['main'] = 'admin/user/user_qualification';
        $data['title'] = 'User qualification';
        $this->load->view('admin/admin', $data);
    }

    function edit($id) {
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->qualification_model->get_qualification($id);

        } else {
            $this->qualification_model->update_qualification($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Status Updated Successfully');
            redirect(ADMIN_PATH . '/user', 'refresh');
        }
    }

}
