<?php
class Settings_model extends CI_Model {

	function verify_current_pw() {
		$this->db->where('email', $this->session->userdata('email'));
		$query = $this->db->get_where('tbl_admin', array('email = ' => $this->session->userdata('email')));
		
		if($query->num_rows() == 1){
			$row = $query->row_array(); 
			$pass = $this->helper_model->decrypt_me($row['password']);
			if($this->input->post('cPassword') == $pass){
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

		$this->db->where('email', $this->session->userdata('email'));

		if($this->db->update('tbl_admin', $data)){
			return true;
		} else {
			return false;
		}

	}
	
}