<?php

class Api_Login_Model extends CI_Model {

	public function insert_gmail_user_info($userProfile){
		$data = array(
					'unique_id'  => $userProfile['id'],
                    'first_name' => $userProfile['given_name'],
                    'last_name'  => $userProfile['family_name'],
                    'image'  	 => $userProfile['picture'],
                    'gender'     => $userProfile['gender'],
                );
		$id = $userProfile['id'];
		$_SESSION['gmail_full_name'] = $userProfile['name'];
		$unique_id = $this->get_gmail_user_details($id);

		if($unique_id != $userProfile['id']){
			$this->db->insert('tbl_api_google', $data);
		} else {
			echo "user already saved in db";
		}
	}

	public function get_gmail_user_details($id){
		$options =  array(
			'unique_id' => $id, 
			);
		$this->db->where($options);
		$data = $this->db->get("tbl_api_google")->row_array();
		return $data['unique_id'];
	}

}
?>