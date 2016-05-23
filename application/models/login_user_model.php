<?php

class Login_User_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/settings_model');
    }

    public function can_log_in() {
		$this->db->where('email', $this->input->post('email'));
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


	public function pass_reset_email(){
		$mail_setting = $this->settings_model->get_email_settings();
		$user_details = $this->get_user_details($this->input->post('email'));
        $message = $this->settings_model->get_email_template('FORGOT_PWD');
        $subject = $message['subject'];
        $emailbody = $message['content'];

		$key = genRandomString('32');
		$email = sha1(md5($this->input->post('email')));
			
        $confirm = "<a target='_blank' href='".base_url()."login_user/validate_pw_reset_credentials/$key/$email'>here</a>";        
        $parseElement = array(
        	"USERNAME" => $user_details['f_name'],
            "SITENAME" => 'JobPortal',
            "LINK" => $confirm,
            "SITELINK" => base_url()
        );
        $subject = $this->parse_email($parseElement, $subject);
	    $message = $this->parse_email($parseElement, $emailbody);
	    //echo $message; die;
	    //$sendTo = $this->input->post('email');
        $data = array(
					'subject' => $subject,
					'message' => $message,
					'to' => $this->input->post('email')
					);
        $this->update_activation_reset_key($key);
        send_email($mail_setting,$data);
	}


	public function update_pw($email){
		$user_details = $this->get_user_details($email);
		if($user_details['verification_status']==0){
			$this->db->set('verification_status', 1);
		}
		$this->db->set('activation_reset_key', genRandomString(42));
		$this->db->set('password', $this->helper_model->encrypt_me($this->input->post('password')));
		/*$data1 = array(
			'activation_reset_key' => $update_data['key'],
			'password' => $this->helper_model->encrypt_me($this->input->post('password')),
			'verification_status' => 1
			);*/

		$this->db->where('email', $email);

		if($this->db->update('tbl_users')){
			return true;
		} else {
			return false;
		}
	}


    public function update_activation_reset_key($key){
    	$data = array('activation_reset_key' => $key );
    	$this->db->where("email", $this->input->post("email"));
    	$this->db->update("tbl_users", $data);
    }


    public function is_key_valid($key, $hash_email) {
    	$options = array(
    				'BINARY(activation_reset_key)' => $key,
    				'BINARY(SHA1(MD5(email)))' => $hash_email
    			);
    	$this->db->where($options);
    	$this->db->select('email');
    	$query = $this->db->get_where('tbl_users', $options);
    	//echo $this->db->get_where('tbl_users', $options)->num_rows(); exit;
    	if($query->num_rows()==1) {
    		$data = $query->row_array();
    		// $this->db->flush_cache();
    		// $this->db->reset_query();
    		return $data['email'];
    	} else {
    		// $this->db->reset_query();
    		// $this->db->flush_cache();
    		return false;
    	}


		/*$this->db->where('activation_reset_key', $data['user_key']);
		$query = $this->db->get('tbl_users')->row_array();
		print_r($query); exit;

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
		   		if($data['user_hash_email'] === sha1(md5($row['email']))) {
		   			return $row['email'];
		   		}
			}
			// got the key but not email
			return false;
		} else {
			//can't find either the key or the email.
			return false;
		}*/
	}

   	public function update_password($email) {
		$this->db->where('email',$email);
		$data = array(
					'password' => $this->helper_model->encrypt_me($this->input->post('password')),
					'activation_reset_key' => genRandomString('42')	
				);
		$this->db->update('tbl_users', $data);
		if($this->db->affected_rows()){
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


    public function get_user_details($email) {
    	return $this->db->get_where('tbl_users', array('email' => $email))->row_array();
	}


	function update_verification_status($email) {
		$this->db->set('verification_status', '1');
		$this->db->where('email', $email);
		$this->db->update('tbl_users');
	}




}

?>