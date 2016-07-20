<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('humanize_admin')) {
	function humanize_admin($string) {
        $my_val = array('(', ')', '&', '', '&pound;', ' ', ',', '/', '_', '"', "'", '&quot;', 'quot;', '&amp;', 'amp;', '£', '+', '=', '?', '%', '@', '!', '#', '$', '^', '&', '*', "'", '!', ':', '[', ']', '{', '}', '|');
        
        $string= strtolower(str_replace($my_val, " ", trim($string)));
        $string = preg_replace('/-+/', ' ', $string);
        $string = trim($string," ");
        return ucwords($string);
	}
}


if(!function_exists('editor')) {
	function editor($width='',$height='') {
		$CI =& get_instance();
        //Loading Library For Ckeditor
        $CI->load->library('ckeditor');
        $CI->load->library('ckfinder');
        //configure base path of ckeditor folder 
        $CI->ckeditor->basePath = base_url().'assets/ckeditor/ckeditor/';
        $CI->ckeditor->config['toolbar'] = 'Full';
        $CI->ckeditor->config['language'] = 'en';
        if($width!=''){
          $CI->ckeditor->config['width'] = $width;
        }
        if($height!=''){
          $CI->ckeditor->config['height'] = $height;
        }
        //configure ckfinder with ckeditor config 
        $path = base_url().'assets/ckeditor/ckfinder';
        $CI->ckfinder->SetupCKEditor($CI->ckeditor,$path); 
    }
}


if(!function_exists('send_email')) {
    function send_email($mail_settings='', $mail_params=array()) {
        $CI =& get_instance();
        $CI->load->library('email',array('mailtype' => $mail_settings['mailtype'],
                                                'protocol' => $mail_settings['protocol'],
                                                'mailpath' => '/usr/sbin/sendmail',
                                                //'smtp_host' => 'smtp.wlink.com.np',
                                                'smtp_host' => $mail_settings['smtp_host'],
                                                'smtp_port' => $mail_settings['smtp_port'],
                                                'smtp_user' => $mail_settings['smtp_user'],
                                                'smtp_pass' => $CI->helper_model->decrypt_me($mail_settings['smtp_pass']),
                                                'charset' => $mail_settings['charset'],
                                                'newline' => "\r\n"));
        if(isset($mail_params['from'])) {
            $CI->email->from($mail_params['from'], $mail_params['from_name']);    
        } else {
            $CI->email->from($mail_settings['receive_email'], 'The JobPortal');
        }
        //prePrint($mail_params);
        $CI->email->to($mail_params['to']);
        $CI->email->subject($mail_params['subject']);
        $CI->email->message($mail_params['message']);
        //echo $mail_params['message']; exit;

        if($CI->email->send()) {
            return true;
        } else {
            if($CI->helper_model->validate_admin_session()){
                $CI->session->set_userdata('error_log_title', "Error while sending email.");
                $CI->session->set_userdata('error_log', $CI->email->print_debugger());
            }
            return false;
        }
    }
}


if(!function_exists('humanize_date')) {
    function humanize_date($date) {
        $temp_date = date_create_from_format('Y-m-d', $date);
        return(date_format($temp_date,  'jS M Y'));
    }
}


if(!function_exists('print_humanize_date')) {
    function print_humanize_date($date) {
        $temp_date = date_create_from_format('Y-m-d', $date);
        echo date_format($temp_date,  'jS M Y');
    }
}

if(!function_exists('humanize_date_time')) {
    function humanize_date_time($date_time){
        $date = date_create($date_time);
        return date_format($date, 'g:ia \o\n l jS F Y');
    }
}


if(!function_exists('calculate_age_year_from_y_m_d')) {
    function calculate_age_year_from_y_m_d($date) {
        return(DateTime::createFromFormat('Y-m-d', $date)->diff(new DateTime('now'))->y);
    }
}


if(!function_exists('calculate_age_from_year')) {
    function calculate_age_from_year($year) {
        return date("Y")-$year;
    }
}


if(!function_exists('calculate_age_with_unit')) {
    function calculate_age_with_unit($date) {
        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime('now');
        $interval = $datetime2->diff($datetime1);
        $diff = $interval->format('%R%a');
        if($diff==0){
            return 'Today';
        } elseif ($diff==-1) {
            return 'Yesterday';
        } elseif ($diff==+1){
            return 'Tomorrow';
        } elseif ($diff<-1){
            return abs($diff).' Days Ago';
        } else {
            return 'After '. abs($diff) . 'Days';
        }
    }
}


if(!function_exists('calculate_age_day_signed')) {
    function calculate_age_day_signed($date) {
        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime('now');
        $interval = $datetime2->diff($datetime1);
        return $interval->format('%R%a');
    }
}


if(!function_exists('get_local_time')) {
    function get_local_time($time = "none") {
        $CI =& get_instance();
        $time_zone = $CI->helper_model->get_time_zone_setting();

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
}


if(!function_exists('bootstrap_menu')) {
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
                    $menu_html .= '<a href="' . base_url() . 'category/' .$element['url'].'" class="dropdown-toggle" data-toggle="" role="button" aria-expanded="true">'.$element['name'].' </a>';
                } else {
                    $menu_html .= '<li>';
                    $menu_html .= '<a href="' . base_url() . 'category/' . $element['url'] . '">' . $element['name'] . '</a>';
                }
                if(in_array($element['id'],$parents))
                {
                    $menu_html .= '<ul class="dropdown-menu" role="menu">';
                    $menu_html .= bootstrap_menu($array, $element['id'], $parents);
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;
    }
}


if(!function_exists('genRandomString')) {
    function genRandomString($length = '') {
        if ($length == '') {
            $length = 20;
        }
        $characters = '12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKLMNOPQRSTUVWXYZ12345CARTN6789abcdefghijklmnopqrstuvwxyz12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ';
        $string = "";
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters))];
        }
        return $string;
    }
}


if(!function_exists('generate_captcha')) {
    function generate_captcha($refresh=false){
        $CI =& get_instance();
        $CI->load->helper('captcha');
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
        $CI->session->set_userdata('captchaWord',$cap['word']);
        return $cap;
    }
}


if(!function_exists('multilevel_category_select')) {
    function multilevel_category_select($array,$parent_id = 0,$parents = array(), $level=0) {
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
            if($element['parent_id']==$parent_id && $level < 1){
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
                    $menu_html .= multilevel_category_select($array, $element['id'], $parents, $level+1);
                }
            }
        }
        $i--;
        return $menu_html;
    }
}


if(!function_exists('convert_to_url')) {
    function convert_to_url($url) {
        $url = strtolower(str_replace(' ', '-', $url));
        $url = str_replace('&', 'and',$url);
        return str_replace('_', '-', $url);
    }
}


if(!function_exists('multilevel_select_category')) {
    function multilevel_select_category($categories, $parent_id = 0, $parents = array(), $level=0, $parent='') {
        /*static $i=0;
        static $k=0;
        if($k==0){
            $parent_cat = $parent;
            $k++;
        }*/
        
        if($parent_id==0) {
            foreach ($categories as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }

        $menu_html = '';
        foreach($categories as $element){
            if($element['parent_id']==$parent_id && $level < 1){
                $menu_html .= '<option';
                if($level==0){
                    $menu_html .= ' style="font-weight:bold;"';
                } else {
                    $menu_html .= ' style="font-style:italic;"';
                }
                $menu_html .= ' value="' . $element['id'] .'"';
                if($element['id'] == $parent){
                    $menu_html .= " selected";
                }
                $menu_html .= '>';
                $menu_html .= $element['name'].'</option>';
                if(in_array($element['id'], $parents)){
                    $i++;
                    $menu_html .= multilevel_select_category($categories, $element['id'], $parents, $level+1, $parent);
                }
            }
        }
        $i--;
        return $menu_html;
    }
}


if (!function_exists('prePrint')) {
    function prePrint($arrData, $exit = TRUE)
    {
        echo "<pre>";
        print_r($arrData);
        if ($exit === TRUE) {
            die();
        }
    }
}


if(!function_exists('multilevel_select_job_category')) {
    function multilevel_select_job_category($array,$parent_id = 0,$parents = array(), $level=0, $selected='') {
        static $k=0;
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
                if($element['id'] == $selected) {
                    $menu_html .= ' selected';
                }
                if($level==0){
                    $menu_html .= ' style="font-weight:bold;"';
                } else {
                    $menu_html .= ' style="font-style:italic;"';
                }
                $menu_html .= ' value="' . $element['id'] .'">';
                for($j=0; $j<$k; $j++) {
                    $menu_html .= '&mdash;';
                }
                $menu_html .= $element['name'].'</option>';
                if(in_array($element['id'], $parents)){
                    $k++;
                    $menu_html .= multilevel_select_job_category($array, $element['id'], $parents, $level+1, $selected);
                }
            }
        }
        $k--;
        return $menu_html;
    }
}