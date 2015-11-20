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
        return $this->encryption->decrypt($data);
    }


    function editor($width='',$height='') {
        //Loading Library For Ckeditor
        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url().'assets/ckeditor/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        if($width!=''){
          $this->ckeditor->config['width'] = $width;
        }
        if($height!=''){
          $this->ckeditor->config['height'] = $height;
        }
        //configure ckfinder with ckeditor config 
        $path = base_url().'assets/ckeditor/ckfinder';
        $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
    }


    public function send_email($mail_settings='', $receiver='') {
        $this->load->library('email',array('mailtype' => $mail_settings['mailtype'],
                                                'protocol' => $mail_settings['protocol'],
                                                //'smtp_host' => 'smtp.wlink.com.np',
                                                'smtp_host' => $mail_settings['smtp_host'],
                                                'smtp_port' => $mail_settings['smtp_port'],
                                                'smtp_user' => $this->input->post('sender'),
                                                'smtp_pass' => $this->input->post('password'),
                                                'charset' => $mail_settings['charset'],
                                                'newline' => "\r\n"));

        $this->email->from($mail_settings['receive_email'], 'The JobPortal');
        $this->email->to($this->input->post('receiver_email'));
        $this->email->subject($this->input->post('subject'));
        $this->email->message($this->input->post('content'));

        if($this->email->send()) {
            return true;
        } else {
            $this->session->set_userdata('error_log_title', "Error while sending email");
            $this->session->set_userdata('error_log', $this->email->print_debugger());
            return false;
        }
    }


    function humanize_date($date) {
        $temp_date = date_create_from_format('Y-m-d', $date);
        return(date_format($temp_date,  'jS M Y'));
    }


    function calculate_age_year_from_y_m_d($date) {
        return(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->y);
    }


    function calculate_age_day($date) {
        return(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->d);
    }
    

    function calculate_age_day_signed($date) {
        $date1 = date_create($date);
        $date2 = new DateTime("now");
        if($date2 > $date1) {
            return (0-(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->d));
        } else {
            return (DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->d);
        }
    }

    function get_local_time($time = "none") {
        $time_zone = $this->get_time_zone_setting();

        $hour_delay = $time_zone[0];
        $minute_delay = $time_zone[1];

        if ($time != 'none')
        {
             return date("Y-m-d H:i:s");
             
            if ($time_zone[2] == '+') {
                return date("Y-m-d H:i:s", mktime(gmdate("H") + $hour_delay, gmdate("i") + $minute_delay, gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
            } else {
                return date("Y-m-d H:i:s", mktime(gmdate("H") - $hour_delay, gmdate("i") - $minute_delay, gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
            }
        }else
        {
             return date("Y-m-d");
             
        if ($time_zone[2] == '+') {
            return date("Y-m-d", mktime(gmdate("H") + $hour_delay, gmdate("i") + $minute_delay, gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        } else {
            return date("Y-m-d", mktime(gmdate("H") - $hour_delay, gmdate("i") - $minute_delay, gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        }
        }
    }

     function get_time_zone_setting() {

        $sql = "SELECT delay,sign FROM tbl_timezone WHERE status='1'";
        $query = $this->db->query($sql);
        $record = $query->row_array();
        $data = $record['delay'] . ":" . $record['sign'];
        $split = explode(":", $data);

        return $split;
    }

}

?>