<?php

class Api_Login_Model extends CI_Model {

	public function insert_api_info($userProfile,$id){
		$unique_id = $this->get_user_details($id);

		if($unique_id != $userProfile['api_id']){
			$this->db->insert('tbl_users', $userProfile);
		} else {
			echo "user already saved in db";
		}
	}

	public function get_user_details($id){
		$options =  array(
			'api_id' => $id, 
			);
		$this->db->where($options);
		$data = $this->db->get("tbl_users")->row_array();
		return $data['api_id'];
	}

}
?>