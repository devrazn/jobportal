<?php

class Home_model extends CI_Model {

	public function get_latest_jobs() {
		$query = "SELECT t1.* FROM tbl_jobs t1
			LEFT JOIN tbl_jobs t2
			ON t1.id = t2.id AND t1.published_date < t2.published_date
			WHERE t1.deadline_date >= CURDATE() AND t1.status=1 AND t1.del_flag=0
			ORDER BY t1.published_date DESC
			LIMIT 10";
		$result = $this->db->query($query);
		return $result->result_array();
	}


	public function get_job_categories(){
		$query = "SELECT * FROM tbl_job_category
			WHERE (status=1 OR status = 'active') 
			LIMIT 10";
		$result = $this->db->query($query);
		return $result->result_array();
	}


	public function get_jobs() {
		$query = "SELECT t1.*, t2.name AS category_name, t3.image
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
		$result = $this->db->query($query);
		return $result->result_array();
	}


	public function get_slider(){
		$query = "SELECT * FROM tbl_users
			WHERE status=1
				AND user_type=1
				AND del_flag=0
				AND feature_in_slider=1
			LIMIT 10";
		$result = $this->db->query($query);
		return $result->result_array();
	}


	public function get_footer_contents($title){
		$query = "SELECT * FROM tbl_cms
			WHERE title = '$title'";
		$result = $this->db->query($query);
		return $result->row_array();
	}


	public function get_contact_details(){
        $query = $this->db->limit(1)->get('tbl_contact_us');
        return $query->row_array();
	}


	public function insert_contact_message(){
		$date = new DateTime('now');
		$date_to_insert = $date->format('Y-m-d H:i:s');
		$data_to_db = array(
                    'name'  => $this->input->post('name'),
                    'email'  => $this->input->post('email'),
                    'subject'  => $this->input->post('subject'),
                    'message'  => $this->input->post('message'),
                    'received_date_time'  => $date_to_insert,
                );
            $query = $this->db->insert_string('tbl_user_messages', $data_to_db);
            return $this->db->query($query);
	}


	public function get_job_details($id) {
		$this->db->select('t1.*, t1.id AS job_id');
		$this->db->select('t2.name AS category_name');
		$this->db->select('t3.*');
		$this->db->from('tbl_jobs t1');
		$this->db->join('tbl_job_category t2', 't1.category_id = t2.id');
		$this->db->join('tbl_users t3', 't1.user_id = t3.id');
		$this->db->where('t1.id', $id);
		//$query = ->get_compiled_select();
		//$query = $this->db->get()->result_array();
		//echo $query; exit; 
		return  $this->db->get()->row_array();
    }


    function apply_job(){
    	$date = new DateTime('now');
    	$date_to_insert = $date->format('Y-m-d');
    	$data = array(
                    'user_id'  => $this->session->userdata('user_id'),
                    'job_id'  => $this->input->post('job_id'),
                    'applied_date'  => $date_to_insert
                );
    	$this->db->insert('tbl_user_map_jobs', $data);
             //$this->db->query($query);
    }

}