<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/settings_model');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        //echo 1; exit;
        $this->site_settings();
    }


    public function site_settings() {
        $data['main'] = 'admin/site_settings';
        $data['title'] = 'Site Settings';

        $this->load->view('admin/admin', $data);
    }


    public function change_password() {
        $this->form_validation->set_rules('cPassword', 'Current Password', 'required|xss_clean|callback_verify_current_pass');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[6]|max_length[64]');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|xss_clean|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'admin/change_password';
            $data['title'] = 'Change Password';
            $this->load->view('admin/admin', $data);
        } else {
            $password = $this->helper_model->encrypt_me($this->input->post('password'));
            if($this->settings_model->update_password($password)) {
                $this->session->set_userdata( 'flash_msg_type', "success" );
                $this->session->set_flashdata('flash_msg', 'Password Changed Successfully');
                redirect(ADMIN_PATH . '/settings/change_password', 'refresh');
            } else {
                $this->session->set_userdata( 'flash_msg_type', "danger" );
                $this->session->set_flashdata('flash_msg', 'Sorry, Unable to Change the Password');
                redirect(ADMIN_PATH . '/settings/change_password', 'refresh');
            }
        }
    }


    public function verify_current_pass() {
        if($this->settings_model->verify_current_pw()) {
            return true;
        } else {
            $this->form_validation->set_message('verify_current_pass','Current Password Incorrect');
            return false;
        }
    }


}
