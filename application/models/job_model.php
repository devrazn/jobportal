<?php

class Home_model extends CI_Model {

	public function get_job_details($id) {
		$this->db->select('*');
		$this->db->from('tbl_jobs t1');
		$this->db->join('tbl_job_category.name t2', 't1.category_id = t2.id');
		$this->db->join('tbl_users t3', 't1.user_id = t3.id');
		$this->db->where('t1.id', $id);
		return  $this->db->get()->row_array();
		

		/*$this->db->select('*');
		$this->db->from('blogs');
		$this->db->join('comments', 'comments.id = blogs.id');
		$query = $this->db->get();*/

		/*$query = "SELECT t1.*, t2.name AS category_name, t3.image
			FROM tbl_jobs t1
			INNER JOIN tbl_job_category t2
			ON t1.category_id = t2.id
			INNER JOIN tbl_users t3
			ON t1.user_id = t3.id
			WHERE t1.deadline_date >= CURDATE() 
				AND t1.status=1
				AND t1.del_flag=0
				AND t3.del_flag=0 
				AND t3.status=1 
			ORDER BY t1.published_date ASC
			LIMIT 10";
		$result = $this->db->query($query);*/


      /*$options = array('id' => $id,
                      'del_flag' => '0',
                      'status' => '1');
      $this->db->order_by('start_year ASC');
      return $this->db->get_where('tbl_experience', $options)->result_array();*/
    }


}