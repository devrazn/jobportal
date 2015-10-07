<?php

class Helper_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'driver' => 'openssl',
                    'mode' => 'ctr'
            )
            );   
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


    public function encrypt_me($data) {
        return $this->encryption->encrypt($data);
    }


    public function decrypt_me($data) {
        /*$this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'driver' => 'openssl',
                    'mode' => 'ctr'
            )
            );*/
        //echo $data; exit;
        return $this->encryption->decrypt($data);
    }

}

?>