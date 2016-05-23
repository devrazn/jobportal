<?php

class Job_model extends CI_Model {

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

    public function post_job($data) {
    	$user_id = $this->session->userdata('user_id');
    	$data = array(
            'title' => $this->input->post('title'),
            'position' => $this->input->post('position'),
            'openings' => $this->input->post('openings'),
            'location' => $this->input->post('location'),
            'qualification' => $this->input->post('qualification'),
            'experience' => $this->input->post('experience'),
            'salary' => $this->input->post('salary'),
            'category_id' => $this->input->post('category_id'),
            'job_description' => $this->input->post('job_description'),
            'requirements' => $this->input->post('requirements'),
            'facilities' => $this->input->post('facilities'),
            'additional_info' => $this->input->post('additional_info'),
            'published_date' => get_local_time('published_date'),
            'deadline_date' => $this->input->post('deadline_date'),
            'application_procedure' => $data,
            'user_id' => $user_id,
            'status' => 1,
        );
        if($this->db->insert('tbl_jobs', $data)){
        	return true;
        } else {
			return false;
        }
    }

}