<?php
class Category_model extends CI_Model {	
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function insert($data) {
        $this->db->insert('tbl_job_category', $data);
    }

    function select_category() {
        $query = $this->db->get('tbl_job_category');
        return $query;
    }

    function count_record($Id) {
        $this->db->select('*');
        $this->db->from('tbl_job_category');
        $this->db->where('id', $Id);
      
        $query = $this->db->count_all_results();
        return $query;
    }

    function get_data($Id,$num, $offset) {
        $this->db->select('*');
        $this->db->from('tbl_job_category');
        $this->db->limit($num, $offset);
        $this->db->where('id', $Id);
    
        $query = $this->db->get();
        return $query;
    }

    function select($id) {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function delete($Id) {
        $this->db->where('id', $Id);
        $this->db->delete('tbl_job_category');
    }

    function edit($data, $Id) {
        $this->db->where('id', $Id);
        $this->db->update('tbl_job_category', $data);
    }

    // function select_inserted_category($menuId) {
    //     $this->db->select('id ');
    //     $this->db->from('tblmenuitem');
    //     $this->db->where('fldid', $menuId);
    //     $query = $this->db->get();
    //     return $query->row();
    // }

	
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */