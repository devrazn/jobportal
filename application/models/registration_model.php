<?php
class Registration_Model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/settings_model');
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
        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('tbl_users');
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return NULL;
    }

    function register($image) {
        $activation_code = $this->genRandomString('12');
        $pwd = $this->helper_model->encrypt_me($this->input->post('password'));
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
            'status' => 0,
            'image'=>$image,
            'reg_date' => $this->helper_model->get_local_time('time'),
            'activation_code' => $activation_code
        );
      // echo "<pre>";print_r($data);die;
        $this->db->insert('tbl_users', $data);
            return $activation_code;
    }
    function reg_confirmation_email($activation_code) {
        $mail_setting = $this->settings_model->get_email_settings();
        $message = $this->settings_model->get_email_template('REGISTRATION');
        $subject = $message['subject'];
        $emailbody = $message['content'];
        //generate random key
        $data['key'] = md5(uniqid());
        $key = $data['key'];
        $confirm = "<p><a href='".site_url()."register/activation_process/$key/$activation_code'>Click Here</a> to activate your account.</p>";
        $parseElement = array(
            "SITENAME" => $this->config->item('site_name'),
            "SITENAME" => 'Job Portal',
            "CONFIRM" => $confirm,
            "EMAIL" => $this->input->post('email')
        );
        $subject = $this->parse_email($parseElement, $subject);
        $emailbody = $this->parse_email($parseElement, $emailbody);
        echo $emailbody;exit;
        $this->helper_model->send_email($mail_setting,NULL,$subject,$emailbody);
    }
    function activated($activation_code,$key) {
        $this->db->where('activation_code',$activation_code);
        $query = $this->db->get('tbl_users');
        if ($query->num_rows() > 0) {
            $sql = "select email,id FROM tbl_users WHERE activation_code='$activation_code'";
            $query = $this->db->query($sql);
            $d = $query->row_array();
            $user_id = $d['id'];
            $data = array('status' => '1', 'activation_code' => $this->genRandomString('12'));
            $this->db->where('id', $user_id);
            $this->db->update('tbl_users', $data);
            return true;
        }
    }
    function check_email_forget($str) {
        $sql = "SELECT * FROM tbl_users WHERE email='$str' ";
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
        
        $sql = "SELECT email FROM tbl_users WHERE email='$email'  ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        $email = $result['email'];
        $confirm = "<a href='" . site_url('forgot_password/change_process/' . uencode(yencode($email, $this->config->item('encoder')))) . "'>" . site_url('forgot_password/change_process/' . uencode(yencode($email, $this->config->item('encoder')))) . "</a>";
        $parseElement = array(
        "SITEURL" => base_url(),            
            "SITENAME" => $this->config->item('site_name'),
            "SITEEMAIL" =>$this->config->item('site_email'),
            "LOGO" => base_url('user_upload/images/'.$this->config->item('logo')),
            "CURRENT_DATE" => $this->helper_model->get_local_time('time'),
            "EMAIL" => $this->input->post('reg_email'),
            "LINK" => $confirm,
            "CURRENT_DATE" => $this->helper_model->get_local_time('time'),
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
    }
    //to parse the the email which is available in the
    function parse_email($parseElement, $mail_body) {
        foreach ($parseElement as $name => $value) {
            $parserName = $name;
            $parseValue = $value;
            $mail_body = str_replace("[$parserName]", $parseValue, $mail_body);
        }
        return $mail_body;
    }
}
?>