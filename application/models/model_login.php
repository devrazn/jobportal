<?php

class Model_Login extends CI_Model {

	public function can_log_in() {
		$this->db->where('email', $this->input->post('email'));

		$query = $this->db->get('tbl_admin');
		
		if($query->num_rows() == 1){
			 $row = $query->row_array(); 
			  $pass = $this->decrypt_me($row['password']);
			  //echo $pass; exit;
			  if($this->input->post('password') == $pass){
			  	//echo $pass; exit;
			  	return true;
			  } else {
			  	return false;
			  }
		} else {
			return false;
		}
	}



	public function is_key_valid($key) {
		$this->db->where('key', $key);
		$query = $this->db->get('temp_users');

		if($query->num_rows() == 1){
			return true;
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
	

	public function decrypt_me($data){
		$this->load->library('encryption');
		$this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'driver' => 'openssl',
                'mode' => 'ctr'
        )
        );

        //echo $this->encryption->encrypt($data); exit;
        return $this->encryption->decrypt($data);
	}

}