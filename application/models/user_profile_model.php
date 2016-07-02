<?php

class User_profile_model extends CI_Model {

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


	function count_user_by_id_type($id, $user_type) {
		$options = array(
					'id' => $id,
					'user_type' => $user_type
				);
		return $this->db->get_where('tbl_users', $options)->num_rows();
	}


	function get_all_user_experience($user_id) {
		$options = array('user_id' => $user_id);
		return $this->db->get_where('tbl_experience', $options)->result_array();
	}


	function add_experience($user_id) {
      $data = array(
      		'title' => $this->input->post('title'),
            'position' => $this->input->post('position'),
            'company_name' => $this->input->post('company_name'),
            'start_year' => $this->input->post('start_year'),
            'duration' => $this->input->post('duration'),
            'duration_unit' => $this->input->post('duration_unit'),
            'description' => $this->input->post('description'),
            'user_id' => $user_id,
          );
      $this->db->insert('tbl_experience', $data);
    }


    function update_experience($experience_id, $user_id) {
		$data = array(
				'title' => $this->input->post('title'),
				'position' => $this->input->post('position'),
				'company_name' => $this->input->post('company_name'),
				'start_year' => $this->input->post('start_year'),
				'duration' => $this->input->post('duration'),
				'duration_unit' => $this->input->post('duration_unit'),
				'description' => $this->input->post('description')
			);
		$options = array(
					'id' => $experience_id,
					'user_id' => $user_id
				);

		$this->db->where($options);
		$this->db->update('tbl_experience', $data);
    }


    function get_experience($experience_id) {
    	return $this->db->get_where('tbl_experience', array('id' => $experience_id))->row_array();
    }
}
