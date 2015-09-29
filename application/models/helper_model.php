<?php

class Helper_model extends CI_Model {

    public function __construct() {
        
    }

    public function validate_session() {
        if(!($this->session->userdata('is_logged_in'))){
            redirect('login/login');
        }
    }

    function humanize_admin($string) {
        $my_val = array('(', ')', '&', '', '&pound;', ' ', ',', '/', '_', '"', "'", '&quot;', 'quot;', '&amp;', 'amp;', '£', '+', '=', '?', '%', '@', '!', '#', '$', '^', '&', '*', "'", '!', ':', '[', ']', '{', '}', '|');
        
        $string= strtolower(str_replace($my_val, " ", trim($string)));
        $string = preg_replace('/-+/', ' ', $string);
        $string = trim($string," ");
        return ucwords($string);
    }
}

?>