<?php

class User_Profile_Model extends CI_Model {

    public function verify_current_pw() {
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

	public function get_jobseeker_details($id){
		$options =  array(
    					'id' => $id, 
    					'user_type' => '0'
    				);
		$this->db->where($options);
		return  $this->db->get("tbl_users")->row_array();
	}

	public function get_jobseeker_qualification($id){
		$this->db->where('user_id',$id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('tbl_qualification');
        return $query->result_array();
	}

	public function get_jobseeker_experience($id){
		$this->db->where('user_id',$id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('tbl_experience');
        return $query->result_array();
	}

	public function get_user_detail($id) {
    	return $this->db->get_where('tbl_users', array('id' => $id))->row_array();
	}

	public function update_user_detail($image,$id) {
		if ($image == '')
            $image = $this->input->post('prev_image');
    	$data = array(
    					'f_name' => $this->input->post('f_name'),
			            'l_name' => $this->input->post('l_name'),
			            'gender' => $this->input->post('gender'),
			            'dob_estd' => $this->input->post('dob_estd'),
			            'address' => $this->input->post('address'),
			            'marital_status' => $this->input->post('marital_status'),
			            'phone' => $this->input->post('phone'),
			            'website' => $this->input->post('website'),
			            'newsletter_subscription' => $this->input->post('newsletter_subscription'),
			            'image'=> $image,
        );
        $this->db->where('id', $id);
        if($this->db->update('tbl_users', $data)){
			return true;
		} else {
			return false;
		}
	}
}
?>