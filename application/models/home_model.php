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
				AND t3.verification_status=2 
				AND t3.account_status=1 
			ORDER BY t1.published_date ASC
			LIMIT 10";
		$result = $this->db->query($query);
		return $result->result_array();
	}


	public function get_slider(){
		$query = "SELECT * FROM tbl_users
			WHERE verification_status=2
				AND user_type=2
				AND account_status=1
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
		if($this->helper_model->validate_user_session()) {
			$name = $this->session->userdata("name");
			$email = $this->session->userdata("user_email");
			$user_id = $this->session->userdata("user_id");
		} elseif ($this->helper_model->is_user_registered($this->input->post('email'))) {
			$this->db->where('email', $this->input->post('email'));
			$user_details = $this->db->get('tbl_users')->row_array();
			$email = $this->input->post('email');
			$name = $user_details['f_name'];
			if($user_details['user_type']==2){
				$name .= " " . $user_details['l_name'];
			}
			$user_id = $user_details['id'];
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$user_id = NULL;
		}
		//echo $user_id; exit;
		$data_to_db = array(
                    'name'  => $name,
                    'email'  => $email,
                    'subject'  => $this->input->post('subject'),
                    'message'  => $this->input->post('message'),
                    'received_date_time'  => $date_to_insert,
                    'user_id'  => $user_id
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
    	$date_to_insert = $date->format('Y-m-d h:i:s');
    	$data = array(
                    'user_id'  => $this->session->userdata('user_id'),
                    'job_id'  => $this->input->post('job_id'),
                    'applied_date'  => $date_to_insert
                );
    	$this->db->insert('tbl_user_map_jobs', $data);
             //$this->db->query($query);
    }


    public function get_employer_details($id){
    	$options =  array(
    					'id' => $id, 
    					'user_type' => '2'
    				);
		$this->db->where($options);
		//$query = ->get_compiled_select();
		//$query = $this->db->get()->result_array();
		//echo $query; exit; 
		return  $this->db->get("tbl_users")->row_array();
    }


    public function get_employer_jobs($id){
    	$options =  array(
    					'user_id' => $id, 
    					'del_flag' => '0',
    					'status' => '1',
    				);
		$this->db->where($options);
		$this->db->order_by('deadline_date DESC');
		//$query = ->get_compiled_select();
		//$query = $this->db->get()->result_array();
		//echo $query; exit; 
		return  $this->db->get("tbl_jobs")->result_array();
    }


    public function get_search_result(){
    	$keyword = $this->input->get('search');
    	$where_options = array(
    						't1.del_flag' => '0',
    						't1.status' => '1',
    						't3.del_flag' => '0',
    						't3.status' => '1'
    						);
    	$like_options = array(
    						'title' => $keyword,
    						'position' => $keyword,
    						'qualification' => $keyword,
    						'job_description' => $keyword,
    						'requirements' => $keyword,
    						'facilities' => $keyword,
    						'additional_info' => $keyword,
    						't3.f_name' => $keyword,
    						't2.name' => $keyword,
    						't3.address' => $keyword,
    						't1.location' => $keyword,
    						't3.company_type' => $keyword
    						);

    	$this->db->select('t1.*, t1.id AS job_id');
    	$this->db->select('t2.*');
    	$this->db->select('t3.*, t3.id AS user_id');
    	$this->db->from("tbl_jobs t1");
    	$this->db->join('tbl_job_category t2', 't1.category_id = t2.id');
    	$this->db->join('tbl_users t3', 't1.user_id = t3.id');
    	$this->db->or_like($like_options);
    	$this->db->where($where_options);
    	return $this->db->get()->result_array();

    	/*$this->db->or_like($like_options);
    	$this->db->where($where_options);
    	return $this->db->get('tbl_jobs')->result_array();

    	$this->db->select('t1.*, t1.id AS job_id');
		$this->db->select('t2.name AS category_name');
		$this->db->select('t3.*');
		$this->db->from('tbl_jobs t1');
		$this->db->join('tbl_job_category t2', 't1.category_id = t2.id');
		$this->db->join('tbl_users t3', 't1.user_id = t3.id');
		$this->db->where('t1.id', $id);*/
    }

}