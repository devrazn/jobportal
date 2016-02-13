<?php

class Login_User_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
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

	public function update_pw($update_data){
		$data1 = array(
			'pw_reset_key' => $update_data['key'],
			'password' => $update_data['password']
			);

		$this->db->where('email', $this->session->userdata('email'));

		if($this->db->update('tbl_admin', $data1)){
			return true;
		} else {
			return false;
		}
	}
}

?>