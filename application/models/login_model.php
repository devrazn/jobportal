<?php

class Login_model extends CI_Model {

	public function can_log_in() {
		$this->db->where('email', $this->input->post('email'));

		$query = $this->db->get('tbl_admin');
		
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


	public function add_user($key) {
		$this->db->where('key', $key);
		$temp_user = $this->db->get('temp_users');

		if($temp_user){
			$row = $temp_user->row();
			$data = array(
				'email' => $row->email,
				'password' => $row->password
				);

			$did_add_user = $this->db->insert('users', $data);
		}

		if($did_add_user){
			$this->db->where('key', $key);
			$this->db->delete('temp_users');
			return $data['email'];
		}
		return false;
	}


	public function is_valid_admin_email() {
		$this->db->where('email', $this->input->post('email'));

		$query = $this->db->get('tbl_admin');
		
		if($query->num_rows() == 1){
			 return true;
		} else {
			return false;
		}
	}


	public function is_admin_key_valid($data) {

		$this->db->where('pw_reset_key', $data['admin_key']);

		$query = $this->db->get('tbl_admin');

		if ($query->num_rows() > 0) {
			//echo "got the key"; exit;
			foreach ($query->result_array() as $row) {
		   		if($data['admin_hash_email'] === sha1(md5($row['email']))) {
		   			//echo 'got both the key & email'; exit;
		   			return $row['email'];
		   			break;
		   		}
			}
			return false;
			//echo 'got the key but not the email.'; exit;
		} else {
			//secho "can't find either the key or the email."; exit;
			return false;
		}
	}


	public function update_pw_reset_key($key){
		$data = array(
			'pw_reset_key' => $key
			);

		$this->db->where('email', $this->input->post('email'));
		if($this->db->update('tbl_admin', $data)){
			return true;
		} else {
			return false;
		}
	}


	public function update_pw($email, $password){

		$data = array(
			'pw_reset_key' => $this->helper_model->genRandomString("42"),
			'password' => $password
			);

		$this->db->where('email', $this->session->userdata('admin_email'));

		if($this->db->update('tbl_admin', $data)){
			return true;
		} else {
			return false;
		}

	}
}