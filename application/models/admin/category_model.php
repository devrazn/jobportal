<?php

class Category_model extends CI_Model {	
		
	function __construct()
    {
       
    }


    function add_category() {
        //$url = $this->helper_model->humanize_url($this->input->post('name'));
        $data = array('name' => $this->input->post('name'),
                      'parent_id' => $this->input->post('parent_id'),
                      'url' => convert_to_url($this->input->post('name'))
        );
        $this->db->insert('tbl_job_category', $data);
    }


    function get_all_categories() {
        $options = array("del_flag" => "0");
        return $this->db->get_where('tbl_job_category', $options)->result_array();
    }


    function get_category($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_job_category', $options, 1);
        return $query->row_array();
    }


    function update_category($id) {
        $data = array('name' => $this->input->post('name'),
                      'parent_id' => $this->input->post('parent_id')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_job_category', $data);
    }


    function delete_category($id) {
       $options1 = array(
                        'category_id' => $id,
                        'del_flag' => 0
                    );
        $this->db->where($options1);
        $job_count = $this->db->get('tbl_jobs')->num_rows();

        $this->db->flush_cache();
        $options2 = array(
                        'del_flag' => 0,
                        'parent_id' => $id
                    );
        $this->db->where($options2);
        $child_category_count = $this->db->get('tbl_job_category')->num_rows();

        if($job_count==0 && $child_category_count==0) {
            $this->db->flush_cache();
            $this->db->where('category_id', $id);
            $this->db->delete('tbl_user_map_category');

            $this->db->flush_cache();
            $this->db->where('id', $id);
            $this->db->delete('tbl_job_category');
            return true;
        } else {
            return FALSE;
        }
    }


    function change_status($status, $id) {
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
        $sql = "SELECT * FROM tbl_job_category WHERE del_flag = '0'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function is_childable($id) {
        $options = array('parent_id' => $id);
        $count_child = $this->db->get_where('tbl_job_category', $options)->num_rows();
        if($count_child>0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    function get_parentable_categories($id='') {
        $this->db->where('id !=', $id);
        $this->db->where('parent_id', 0);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('tbl_job_category');
        return $query->result_array();
    }

}
