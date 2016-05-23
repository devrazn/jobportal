<?php

class Tags_model extends CI_Model {	
		
	function __construct() {
       
    }

    function add_tags() {
        $data = array('name' => $this->input->post('name'),
                      'status' => $this->input->post('status')
        );
        $this->db->insert('tbl_tags', $data);
    }

    function tags_list($per_page='', $offset = '1') {
        $this->db->where('del_flag', 0);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get('tbl_tags');
        return $query->result_array();
    }

    function get_tags($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_tags', $options, 1);
        return $query->row_array();
    }

    function update_tags($id) {
        $data = array('name' => $this->input->post('name'),
                      'category_id' => $this->input->post('category_id'),
                      'status' => $this->input->post('status')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_tags', $data);
    }

    function delete_tags($id) {
        $sql ="Update tbl_tags set del_flag=1 where id='$id'";
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
        $this->db->update('tbl_tags', $data);
    }


    function find_matching_tag($tag_name, $id) {
        $options = array(
                    'name' => $tag_name,
                    'id !='=> $id
                );
        if($this->db->get_where('tbl_tags', $options)->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
}
