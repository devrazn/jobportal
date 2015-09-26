<?php

class Helper_model extends CI_Model {

    public function __construct() {
        
    }

    public function validate_session() {
        if(!($this->session->userdata('is_logged_in'))){
            redirect('login/login');
        }
    }
}

?>