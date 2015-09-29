<?php

class category_model extends CI_Model {	
		
	function __construct() {
       
    }

    function add_category() {
        $data = array('name' => $this->input->post('name'),
                      'status' => $this->input->post('status')
        );
        $this->db->insert('tbl_job_category', $data);
    }
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */