<?php

class Experience_model extends CI_Model {	
		
	function __construct() {
       
  }

  function experience_list($per_page, $offset = '1') {
        $this->db->where('del_flag', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('tbl_experience');
        return $query->result_array();
  }

  function get_experience($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_experience', $options, 1);
        return $query->row_array();
  }

    function update_experience($id) {
        $data = array('status' => $this->input->post('status')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_experience', $data);
    }
    
  
}
