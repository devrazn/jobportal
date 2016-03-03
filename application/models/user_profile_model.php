<?php

class User_Profile_Model extends CI_Model {

    public function verify_current_pw() {
    	//
		$this->db->where('email', $this->session->userdata('user_email'));
		$query = $this->db->get_where('tbl_users', array('email = ' => $this->session->userdata('user_email')));

		if($query->num_rows() == 1){
			$row = $query->row_array(); 
			$pass = $this->helper_model->decrypt_me($row['password']);
			if($this->input->post('cur_password') == $pass){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function update_password($password) {
		$data = array(
			'password' => $password
			);

		$this->db->where('email', $this->session->userdata('user_email'));

		if($this->db->update('tbl_users', $data)){
			return true;
		} else {
			return false;
		}

	}

   
}
?>