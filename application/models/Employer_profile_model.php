<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_profile_model extends CI_Model {

    public function verify_current_pw() {
		$this->db->where('email', $this->session->userdata('user_email'));
		$query = $this->db->get_where('tbl_users', array('email = ' => $this->session->userdata('user_email')));

		if($query->num_rows() == 1){
			$row = $query->row_array(); 
			$pass = $this->helper_model->decrypt_me($row['password']);
			if($this->input->post('cur_password') == $pass){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	function get_employer_by_id($id) {
		return $this->db->get_where('tbl_users', array('id' => $id))->row_array();
	}


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


    function get_all_jobs_by_employer_id($employer_id) {
    	$options = array(
    				'user_id' => $employer_id,
    				'del_flag' => 0
    			);
    	return $this->db->get_where('tbl_jobs', $options)->result_array();
    }


    function get_job_by_id($job_id){
    	return $this->db->get_where('tbl_jobs', array('id' => $job_id))->row_array();
    }

    function get_all_applied_jobs($id) {
    	$this->db->select('t1.*,t2.*,t3.*');
    	$this->db->select('t1.id as user_map_job_id');
    	$this->db->select('t3.id as jobseeker_id');
		$this->db->from('tbl_user_map_jobs t1');
		$this->db->join('tbl_jobs t2', 't1.job_id = t2.id','left');
		$this->db->join('tbl_users t3', 't1.user_id = t3.id','left');
		$options =  array(
    					't1.del_flag' => '0',
    					't1.status' => '1',
    					't2.user_id'=>$id,
    				);
		$this->db->where($options);
		return $this->db->get()->result_array();
    }

    function update_read_flag_status($id){
      $data = array('read_flag' => '1');
      $this->db->where('id',$id);
      $this->db->update('tbl_user_map_jobs', $data);
    }

    function get_map_job_details($id){
      return $this->db->get_where('tbl_user_map_jobs', array('id' => $id))->row_array();
    }


    public function get_search_result($page='', $per_page='', $count=false){
        $keyword = $this->input->get('search');

        $where_options = array(
                            'u.del_flag' => '0',
                            'q.del_flag' => '0',
                            'e.del_flag' => '0',
                            'u.user_type' => '1',
                            'ut.user_id' => 'u.id',
                            'ut.tag_id' => 't.id',
                            'uc.user_id' => 'u.id',
                            'uc.category_id' => 'c.id'
                        );
        $like_options = array(
                            'u.profile' => $keyword,
                            'e.title' => $keyword,
                            'q.degree' => $keyword,
                            'q.remarks' => $keyword,
                            't.name' => $keyword,
                            'c.name' => $keyword,
                        );
        $this->db->select('u.id, u.f_name, u.l_name, u.gender, u.profile, u.image, u.resume');
        $this->db->from("tbl_users u");
        $this->db->join("tbl_user_map_tag ut", 'u.id = ut.user_id');
        $this->db->join("tbl_tags t", 't.id = ut.tag_id');
        $this->db->join("tbl_user_map_category uc", 'u.id = uc.user_id');
        $this->db->join("tbl_job_category c", 'c.id = uc.category_id');
        $this->db->join("tbl_experience e", 'e.user_id = u.id');
        $this->db->join("tbl_qualification q", 'q.user_id = u.id');
        $this->db->or_like($like_options);
        $this->db->where($where_options);
        $this->db->group_by('u.id');
        $query = $this->db->get();
        if($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }


    function get_jobseeker_tags($jobseeker_id) {
        $this->db->select('t.name');
        $this->db->from('tbl_tags t');
        $this->db->join("tbl_user_map_tag ut", 't.id = ut.tag_id');
        $this->db->where('ut.user_id', $jobseeker_id);
        // $this->db->group_by('t.name');
        return $this->db->get()->result_array();
    }


    function verify_receiver() {
        $options = array(
                    'email' => $this->input->post('receiver_email'),
                    'user_type' => '1'
                );
        if($this->db->get_where('tbl_users', $options)->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
}
