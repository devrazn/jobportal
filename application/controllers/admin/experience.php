<?php

class Experience extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/experience_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }
 
    public function list_experience($id) {
        $data['info'] = $this->experience_model->get_experience($id);
        $data['main'] = 'admin/user/user_experience';
        $data['title'] = 'User Experience';
        $this->load->view('admin/admin', $data);
    }

    function edit($id) {
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->experience_model->get_experience($id);

        } else {
            $this->experience_model->update_experience($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Status Updated Successfully');
            redirect(ADMIN_PATH . '/user', 'refresh');
        }
    }

}
