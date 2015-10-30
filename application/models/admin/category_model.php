<?php

class Category_model extends CI_Model {	
		
	function __construct()
    {
       
    }


    function add_category() {
        $data = array('name' => $this->input->post('name'),
                      'status' => $this->input->post('status')
        );
        $this->db->insert('tbl_job_category', $data);
    }


    function category_list($per_page, $offset = '1') {
        $this->db->where('del_flag', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('tbl_job_category');
        return $query->result_array();
    }


    function get_category($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_job_category', $options, 1);
        return $query->row_array();
    }


    function update_category($id) {
        $data = array('name' => $this->input->post('name'),
                      'status' => $this->input->post('status')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_job_category', $data);
    }


    function delete_category($id) {
        $data = array('del_flag' => '1');
        $this->db->where('id', $id);
        return $this->db->update('tbl_job_category', $data);
    }


    function change_status($status, $id) {
        if ($status == 'active')
            $status = 'inactive';
        else if ($status == 'inactive')
            $status = 'active';

        $data = array(
            'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_job_category', $data);
    }

	
	function category_name_by_id($id) {
        $query = $this->db->get_where('tbl_job_category', array("id" => $id));
        $data = $query->row_array();
        if($data['name'])
            return $data['name'];
        else
            return "NONE";  
    }


    function category_list_all() {
        $sql = "SELECT * FROM tbl_job_category";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
