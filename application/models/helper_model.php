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

    public function send_email($mail_settings='',$mail_params=array()) {
        $this->load->library('email',array('mailtype' => $mail_settings['mailtype'],
                                                'protocol' => $mail_settings['protocol'],
                                                'mailpath' => '/usr/sbin/sendmail',
                                                //'smtp_host' => 'smtp.wlink.com.np',
                                                'smtp_host' => $mail_settings['smtp_host'],
                                                'smtp_port' => $mail_settings['smtp_port'],
                                                'smtp_user' => $mail_settings['smtp_user'],
                                                'smtp_pass' => $mail_settings['smtp_pass'],
                                                'charset' => $mail_settings['charset'],
                                                'newline' => "\r\n"));
        $this->email->from($mail_settings['receive_email'], 'The JobPortal');
        $this->email->to($mail_params['to']);
        $this->email->subject($mail_params['subject']);
        $this->email->message($mail_params['message']);

        if($this->email->send()) {
            return true;
        } else {
            if($this->session->userdata('is_logged_in')){
                $this->session->set_userdata('error_log_title', "Error while sending email");
                $this->session->set_userdata('error_log', $this->email->print_debugger());
            }
            return false;
        }
    }


    function humanize_date($date) {
        $temp_date = date_create_from_format('Y-m-d', $date);
        return(date_format($temp_date,  'jS M Y'));
    }

    function print_humanize_date($date) {
        $temp_date = date_create_from_format('Y-m-d', $date);
        echo date_format($temp_date,  'jS M Y');
    }

    function humanize_date_time($date_time){
        $date = date_create($date_time);
        return date_format($date, 'g:ia \o\n l jS F Y');
    }


    function calculate_age_year_from_y_m_d($date) {
        return(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->y);
    }


    function calculate_age_day($date) {
        return(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->d);
    }
    

    function calculate_age_day_signed($date) {
        /*$date1 = date_create($date);
        $date2 = new DateTime("now");
        if($date2 > $date1) {
            return (0-(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->d));
        } else {
            return (DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->d);
        }*/

        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime('now');
        $interval = $datetime2->diff($datetime1);
        return $interval->format('%R%a');
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


    function get_category() {
        $this->db->order_by('parent_id', 'DESC');
        $this->db->select('id, name, parent_id');
        return $this->db->get('tbl_job_category')->result_array();
    }


    function bootstrap_menu($array,$parent_id = 0,$parents = array()) {
        if($parent_id==0)
        {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }
        $menu_html = '';
        foreach($array as $element)
        {
            if($element['parent_id']==$parent_id)
            {
                if(in_array($element['id'], $parents))
                {
                    $menu_html .= '<li class="dropdown-submenu">';
                    $menu_html .= '<a href="' . base_url() . 'admin/category/' .$element['id'].'" class="dropdown-toggle" data-toggle="" role="button" aria-expanded="true">'.$element['name'].' <span class="caret"></span></a>';
                } else {
                    $menu_html .= '<li>';
                    $menu_html .= '<a href="' . base_url() . 'admin/category/' . $element['id'] . '">' . $element['name'] . '</a>';
                }
                if(in_array($element['id'],$parents))
                {
                    $menu_html .= '<ul class="dropdown-menu" role="menu">';
                    $menu_html .= $this->bootstrap_menu($array, $element['id'], $parents);
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;
    }

    function bootstrap_menu_user($array,$parent_id = 0,$parents = array()) {
        if($parent_id==0)
        {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }
        $menu_html = '';
        foreach($array as $element)
        {
            if($element['parent_id']==$parent_id)
            {
                if(in_array($element['id'], $parents))
                {
                    $menu_html .= '<li class="dropdown-submenu">';
                    $menu_html .= '<a href="' . base_url() . 'admin/category/' .$element['id'].'" class="dropdown-toggle" data-toggle="" role="button" aria-expanded="true">'.$element['name'].' <span class="caret"></span></a>';
                } else {
                    $menu_html .= '<li>';
                    $menu_html .= '<a href="' . base_url() . 'admin/category/' . $element['id'] . '">' . $element['name'] . '</a>';
                }
                if(in_array($element['id'],$parents))
                {
                    $menu_html .= '<ul class="dropdown-menu" role="menu">';
                    $menu_html .= $this->bootstrap_menu_user($array, $element['id'], $parents);
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;
    }


    function multilevel_select($array,$parent_id = 0,$parents = array(), $level=0) {
        static $i=0;
        if($parent_id==0)
        {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }

        $menu_html = '';
        foreach($array as $element){
            if($element['parent_id']==$parent_id && $level < 2){
                $menu_html .= '<option';
                if($level==0){
                    $menu_html .= ' style="font-weight:bold;"';
                } else {
                    $menu_html .= ' style="font-style:italic;"';
                }
                $menu_html .= ' value="' . $element['id'] .'">';
                for($j=0; $j<$i; $j++) {
                    $menu_html .= '&mdash;';
                }
                $menu_html .= $element['name'].'</option>';
                if(in_array($element['id'], $parents)){
                    $i++;
                    $menu_html .= $this->multilevel_select($array, $element['id'], $parents, $level+1);
                }
            }
        }
        $i--;
        return $menu_html;
    }


    function humanize_url($url) {
        return strtolower(str_replace(' ', '_', $url));
    }


    public function generate_captcha($refresh=false){
        $this->load->helper('captcha');
        $vals = array(
            'img_path'      => './captcha/',
            'img_url'       => base_url().'captcha',
            'font_path'     => './assets/user/fonts/timesbd.ttf',
            'img_width'     => 175,
            'img_height'    => 45,
            'expiration'    => 3600,
            'word_length'   => 5,
            'font_size'     => 24,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyz',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                )
            );

        $cap = create_captcha($vals);
        $this->session->set_userdata('captchaWord',$cap['word']);
        return $cap;
    }


    public function count_admin_new_messages(){
        $options = array('del_flag' => '0',
                            'read_flag' => '0');
        $this->db->where($options);
        return ($this->db->count_all_results('tbl_user_messages'));
    }

     function genRandomString($length = '') {
        if ($length == '') {
            $length = 20;
        }
        $characters = '12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ';
        $string = '';
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters))];
        }
        return $string;
    }

}

?>