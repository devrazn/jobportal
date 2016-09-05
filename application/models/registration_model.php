<?php
class Registration_Model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/settings_model');
        $this->load->helper('email_helper');
    }
   
    function get_aleady_registered_email() {
        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('tbl_users');
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return NULL;
    }

    function register($user_type, $image='', $activation_code) {
        $data = array(
            'f_name' => $this->input->post('f_name'),
            'l_name' => $this->input->post('l_name'),
            'password' => $this->helper_model->encrypt_me($this->input->post('password')),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'dob_estd' => $this->input->post('dob_estd'),
            //'company_type' => $this->input->post('company_type'),
            //'profile' => $this->input->post('profile'),
            //'benefits' => $this->input->post('benefits'),
            //'website' => $this->input->post('website'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'marital_status' => $this->input->post('marital_status'),
            'phone' => $this->input->post('phone'),
            'user_type' => $user_type,
            'newsletter_subscription' => $this->input->post('newsletter_subscription'),
            'verification_status' => 0,
            'image'=> $image,
            'reg_date' => get_local_time('time'),
            'activation_reset_key' => $activation_code
        );
        $this->db->insert('tbl_users', $data);
        return $this->db->insert_id();
    }
    

    function reg_confirmation_email($activation_code) {
        $mail_setting = $this->settings_model->get_email_settings();
        $message = $this->settings_model->get_email_template('REGISTRATION');
        $subject = $message['subject'];
        $emailbody = $message['content'];
        $hash_email = sha1(md5($this->input->post('email')));
        $confirm = "Click <a href='".site_url()."register/activation_process/$activation_code/$hash_email'> here</a> to activate your JobPortal account";
        $parseElement = array(
            "USERNAME" => $this->input->post("f_name"),
            "SITENAME" => 'JobPortal',
            "CONFIRM" => $confirm,
            "LINK" => base_url()
        );
        $subject = parse_email($parseElement, $subject);
        $emailbody = parse_email($parseElement, $emailbody);
        //echo $emailbody;exit;
        $mail_params = array(
                        'to' => $this->input->post('email'),
                        'subject' => $subject,
                        'message' => $emailbody,
                );
        if(send_email($mail_setting, $mail_params)){
            return true;
        } else {
            return false;
        }
    }

    function activated($key, $hash_email) {
        $this->db->where("BINARY(activation_reset_key)", $key);
        //"BINARY column_name = '$var'"
        //$sql = "'BINARY user = '.$username.'";
        /*$query = $this->db->get_compiled_select("tbl_users");
        echo $query; exit;*/
        $query = $this->db->get("tbl_users");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if($hash_email === sha1(md5($row['email']))) {
                    $this->db->set('activation_reset_key', genRandomString('42'));
                    $this->db->set('verification_status', 1);
                    $this->db->where('email',$row['email']);
                    if($this->db->update('tbl_users')) {
                        return $row['email'];
                    } else {
                        return false;
                    }
                }
            }
            return false;
        } else {
            //echo "can't find either the key or the email."; exit;
            return false;
        }
    }
    

    function check_email_forget($str) {
        $sql = "SELECT * FROM tbl_users WHERE email='$str' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function hard_delete_user($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_users');
    }
}
?>