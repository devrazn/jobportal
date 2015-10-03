<?php

class Category_model extends CI_Model {	
		
	function __construct() {
       
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


        // $options = array('del_flag' => 0);
        // $this->db->where('tbl_job_category', $options);
        //$orderby = " ORDER BY id ASC";

        // $sql = "SELECT * FROM tbl_job_category WHERE del_flag = '0'".$orderby ;
        // $query = $this->db->query($sql);
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
        $sql ="Update tbl_job_category set del_flag=1 where id='$id'";
        $this->db->query($sql);
    }

    function change_status($status, $id) {
        if ($status === '1')
            $status = '0';
        else if ($status === '0')
            $status = '1';

        $data = array(
            'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_job_category', $data);
    }

	
	
}
