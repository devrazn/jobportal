<?php

class Registration_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->model('Email_model');
        //$this->load->helper('yurl');
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

    function get_aleady_registered_email() {
        $this->db->where('email', $this->input->post('reg_email'));
        $query = $this->db->get('tbl_members');

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return NULL;
    }



    function incrypt($pwd) {
        $temp = "uno";
        $a = md5(sha1($temp . $pwd));
        return $a;
    }

    function register($image) {
        $activation_code = $this->genRandomString('12');
        $pwd = $this->incrypt($this->input->post('password'));
        $data = array(
            'f_name' => $this->input->post('f_name'),
            'l_name' => $this->input->post('l_name'),
            'password' => $pwd,
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'dob_estd' => $this->input->post('dob_estd'),
            'company_type' => $this->input->post('company_type'),
            'profile' => $this->input->post('profile'),
            'benefits' => $this->input->post('benefits'),
            'website' => $this->input->post('website'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'marital_status' => $this->input->post('marital_status'),
            'phone' => $this->input->post('phone'),
            'user_type' => $this->input->post('user_type'),
            'newsletter_subscription' => $this->input->post('newsletter_subscription'),
            'status' => $this->input->post('status'),
            'image'=>$image,
            'reg_date' => $this->Helper_model->get_local_time('time'),
            'activation_code' => $activation_code
        );
         echo "<pre>";print_r($data);die;
       
        $this->db->insert('tbl_users', $data);
        //$user_id = $this->db->insert_id();

    //$this->session->set_userdata(array(SESSION . 'image' => $image));

//         $this->db->trans_complete();

//         if ($this->db->trans_status() === FALSE) {
//             return "system_error";
//         } else {

// if($this->input->post('uno_card')=='1')
// {
// $front_link="User Requested For Uno while registering.";
// $back_link=site_url(ADMIN_PATH.'/member_new/edit_member/'.$user_id);	
// $time=$this->Helper_model->get_local_time('time');
// $changed_by=site_url(ADMIN_PATH.'/member_new/edit_member/'.$user_id);		
// $this->Helper_model->notify("MEMBER REGISTERED",'upgrade',$front_link,$back_link,$time,$changed_by,"Uno upgrade Notification while registering");	
// }			
//             return $activation_code;
//         }
    }

    function reg_confirmation_email($activation_code) {

        $this->load->model('Email_model');
        $headers = "From: " . $this->config->item('site_email') . "\r\n" .
                "Reply-To: " . $this->config->item('site_email') . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=utf-8\r\n" .
                "Content-Transfer-Encoding: 8bit\r\n\r\n";

        $template = $this->Email_model->get_email_template("REGISTRATION");

        $subject = $template['TemplateSubject'];
        $emailbody = $template['TemplateDesign'];

        $confirm = "<a href='" . site_url('register/activation_process/' . uencode(yencode($activation_code, $this->config->item('encoder')))) . "'>" . site_url('register/activation_process/' . uencode(yencode($activation_code, $this->config->item('encoder')))) . "</a>";

        $parseElement = array(
		
			"SITEURL" => base_url(),			
           "SITEEMAIL" =>$this->config->item('site_email'),
			"LOGO" => base_url('user_upload/images/'.$this->config->item('logo')),		
		  "CURRENT_DATE" => $this->Helper_model->get_local_time('time'),
            "CONFIRM" => $confirm,
            "SITENAME" => $this->config->item('site_name'),
            "CURRENT_DATE" => $this->Helper_model->get_local_time('time'),
            "EMAIL" => $this->input->post('reg_email'),
            "FULLNAME" => $this->input->post('first_name').' '.$this->input->post('last_name'),
            "PASSWORD" => $this->input->post('reg_password'));

        $subject = $this->Email_model->parse_email($parseElement, $subject);
        $emailbody = $this->Email_model->parse_email($parseElement, $emailbody);
       //echo $emailbody; exit;
 $this->load->library('email');	
$this->email->from($this->config->item('site_email'), $this->config->item('site_title'));
$this->email->set_mailtype("html");
$this->email->to($this->input->post('reg_email')); 
$this->email->subject($subject);
$this->email->message($emailbody);	
$this->email->send();	   
      //  @mail($this->input->post('reg_email'), $subject, $emailbody, $headers);
    }

    function activated($activation_code) {


        $this->db->where('activation_code', ydecode(udecode($activation_code), $this->config->item('encoder')));
        $query = $this->db->get('tbl_members');

        if ($query->num_rows() > 0) {
            $activation_code = ydecode(udecode($activation_code), $this->config->item('encoder'));
            $sql = "select email,user_id FROM tbl_members WHERE activation_code='$activation_code'";
            $query = $this->db->query($sql);
            $d = $query->row_array();
            $user_id = $d['user_id'];

            $data = array('status' => '1', 'activation_code' => $this->genRandomString('12'));
            $this->db->where('user_id', $user_id);
            $this->db->update('tbl_members', $data);

            //print_r($this->db->last_query()); exit;

            return true;
        }
    }

    function check_email_forget($str) {

        $sql = "SELECT * FROM tbl_members WHERE email='$str' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function forget_password_reminder_email() {

        $information = $this->check_email_forget($this->input->post('email1'));
        $this->load->model('Email_model');
        $headers = "From: " . $this->config->item('site_email') . "\r\n" .
                "Reply-To: " . $this->config->item('site_email') . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=utf-8\r\n" .
                "Content-Transfer-Encoding: 8bit\r\n\r\n";

        $template = $this->Email_model->get_email_template("FORGOT_PWD");

        $subject = $template['TemplateSubject'];
        $emailbody = $template['TemplateDesign'];


        $email = $this->input->post('email1');
        $sql = "SELECT email FROM tbl_members WHERE email='$email'  ";

        $query = $this->db->query($sql);
        $result = $query->row_array();
        
        $email = $result['email'];

        $confirm = "<a href='" . site_url('forgot_password/change_process/' . uencode(yencode($email, $this->config->item('encoder')))) . "'>" . site_url('forgot_password/change_process/' . uencode(yencode($email, $this->config->item('encoder')))) . "</a>";

        $parseElement = array(
		"SITEURL" => base_url(),			
            "SITENAME" => $this->config->item('site_name'),
			"SITEEMAIL" =>$this->config->item('site_email'),
			"LOGO" => base_url('user_upload/images/'.$this->config->item('logo')),
            "CURRENT_DATE" => $this->Helper_model->get_local_time('time'),
            "EMAIL" => $this->input->post('reg_email'),
		
            "LINK" => $confirm,

            "CURRENT_DATE" => $this->Helper_model->get_local_time('time'),
            "EMAIL" => $email
            
        );

        $subject = $this->Email_model->parse_email($parseElement, $subject);
        $emailbody = $this->Email_model->parse_email($parseElement, $emailbody);
		
 $this->load->library('email');	
$this->email->from($this->config->item('site_email'), $this->config->item('site_title'));
$this->email->set_mailtype("html");
$this->email->to($email); 
$this->email->subject($subject);
$this->email->message($emailbody);	
$this->email->send();	
	
         // echo $emailbody; exit;
       // @mail($email, $subject, $emailbody, $headers);
    }

}

?>