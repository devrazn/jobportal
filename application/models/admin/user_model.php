<?php

class User_model extends CI_Model {	
		
	function __construct() {
       
    }

    function user_list($per_page, $offset = '1') {
        $this->db->where('del_flag', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('tbl_users');
        return $query->result_array();
    }

    function update_user($id) {
        $data = array('email' => $this->input->post('email'),
                      'f_name' => $this->input->post('f_name'),
                      'l_name' => $this->input->post('l_name'),
                      'address' => $this->input->post('address'),
                      'dob_estd' => $this->input->post('dob_estd'),
                      'company_type' => $this->input->post('company_type'),
                      'profile' => $this->input->post('profile'),
                      'benefits' => $this->input->post('benefits'),
                      'status' => $this->input->post('status')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_users', $data);
    }

    function get_user($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_users', $options, 1);
        return $query->row_array();
    }

    function change_status($status, $id) {
        $sql ="Update tbl_users SET status='$status' where id='$id'";
        $this->db->query($sql);
        

        // if ($status === '1')
        //     $status = '0';
        // else if ($status === '0')
        //     $status = '1';

        // $data = array(
        //     'status' => $status
        // );
        // $this->db->where('id', $id);
        // $this->db->update('tbl_users', $data);
    }
}
