<?php

class Login_User_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/settings_model');
    }

    public function can_log_in() {
		$this->db->where(array('email' => $this->input->post('email'),'status' => 1));
		$query = $this->db->get('tbl_users');
		//print_r($this->db->last_query()); exit;

		if($query->num_rows() == 1){
			$row = $query->row_array(); 
			$pass = $this->helper_model->decrypt_me($row['password']);
			if($this->input->post('password') == $pass){
			  	return true;
			} else {
			  	return false;
			}
		} else {
			return false;
		}
	}

	public function check_email($email){
		$this->db->where(array('email' => $email));
		$query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    
	}

	public function update_pw($update_data){
		$data1 = array(
			'activation_code' => $update_data['key'],
			'password' => $update_data['password']
			);

		$this->db->where('email', $this->session->userdata('email'));

		if($this->db->update('tbl_users', $data1)){
			return true;
		} else {
			return false;
		}
	}

	public function pass_confirmation_email(){
		$mail_setting = $this->settings_model->get_email_settings();
        $message = $this->settings_model->get_email_template('FORGOT_PWD');
        $subject = $message['subject'];
        $emailbody = $message['content'];

		$code = $this->get_activation_code($this->input->post('email'));
		$email = sha1(md5($this->input->post('email')));
		$this->hash_email = $email;
			
        $confirm = "<p><a href='".site_url()."login_user/validate_pw_reset_credentials/$code/$email'>Click Here</a></p>";
        $parseElement = array(
            "SITENAME" => $this->config->item('site_name'),
            "SITENAME" => 'Job Portal',
            "LINK" => $confirm,
            "EMAIL" => $this->input->post('email')
        );
        $subject = $this->parse_email($parseElement, $subject);
	    $message = $this->parse_email($parseElement, $emailbody);
	    echo $message;die;
	    $sendTo = $this->input->post('email');
        $data = array(
					'subject' => $subject,
					'message' => $message,
					'to' => $sendTo
					);
        $this->helper_model->send_email($mail_setting,$data);
	}

    public function get_activation_code($email){
    	$this->db->where('email', $email);
		$query = $this->db->get('tbl_users');

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
		   			return $row['activation_code'];
			}
			
		} else {
			return false;
		}
    }

    public function is_key_valid($data) {
		$this->db->where('activation_code', $data['key']);
		$query = $this->db->get('tbl_users');

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
		   		if($data['email'] == sha1(md5($row['email']))) {
		   			return $row['email'];
		   			break;
		   		}
			}
			return false;
		} else {
			//echo "can't find either the key or the email."; exit;
			return false;
		}
	}

   	public function update_password($email,$password) {
		$this->db->where('email',$email);
		if($this->db->update('tbl_users', $password)){
			return true;
		} else {
			return false;
		}
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


    public function get_user_id() {
    	$this->db->select('id');
		$this->db->where('email', $this->input->post('email');
		return $this->db->get('tbl_users')->row_array();
	}

}

?>