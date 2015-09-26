<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_session {

    public function validate_session() {
        //echo base_url(); exit;
        if(!($this->session->userdata('is_logged_in'))){
            //$this->load->view('members');
            redirect('login/login');
        }
    }

}
