<?php

class User_model extends CI_Model {	
		
	function __construct() {
       
    }

    function user_list($per_page, $offset = '1') {
        $this->db->where('del_flag', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('tbl_users');
        return $query->result_array();
    }

    function get_user($id) {
        $options = array('id' => $id,
                          'del_flag' => '0');
        $query = $this->db->get_where('tbl_users', $options, 1);
        return $query->row_array();
    }

    function update_jobseeker_status() {
        $data = array('verification_status' => $this->input->post('verification_status'),
                    'account_status' => $this->input->post('account_status')
                  );
      $this->db->where('id', $this->input->post('id'));
      return $this->db->update('tbl_users', $data);
    }

    function update_employer_status() {
      $data = array('verification_status' => $this->input->post('verification_status'),
                    'account_status' => $this->input->post('account_status'),
                    'feature_in_slider' => $this->input->post('feature_in_slider')
        );
      $this->db->where('id', $this->input->post('id'));
      $this->db->update('tbl_users', $data);
      return $this->db->affected_rows();
    }


    public function get_user_type($id) {
      $options = array('id' => $id,
                      'del_flag' => '0');
      $this->db->select('user_type');
      return $this->db->get_where('tbl_users', $options)->row_array();
    }


    public function get_qualification($id) {
      $options = array('user_id' => $id,
                      'del_flag' => '0');
      $this->db->order_by('completion_date ASC');
      return $this->db->get_where('tbl_qualification', $options)->result_array();
    }


    public function get_experience($id) {
      $options = array('user_id' => $id,
                      'del_flag' => '0');
      $this->db->order_by('start_year ASC');
      return $this->db->get_where('tbl_experience', $options)->result_array();
    }


    function verify_receiver(){
        $options = array('email' => $this->input->post('receiver_email'),
                        'del_flag' => '0');
        $query = $this->db->get_where('tbl_users', $options, 1);
        if($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    function update_qualification_status() {
      $data = array('status' => $this->input->post('status')
        );
      $this->db->where('id', $this->input->post('id'));
      return($this->db->update('tbl_qualification', $data));
    }


    function update_experience_status() {
      $data = array('status' => $this->input->post('status')
        );
      $this->db->where('id', $this->input->post('id'));
      return($this->db->update('tbl_experience', $data));
    }


    public function get_jobs($id) {
      $options = array('user_id' => $id,
                      'del_flag' => '0');
      $this->db->order_by('published_date ASC');
      return $this->db->get_where('tbl_jobs', $options)->result_array();
    }


    function update_job_status_and_procedure() {
      //$checkboxData = implode(",", $_POST['various']);
      $application_procedure = implode(",", $this->input->post('application_procedure'));
      //echo $application_procedure; exit;
      $data = array('status' => $this->input->post('status'),
          'application_procedure' => $application_procedure
        );
      $this->db->where('id', $this->input->post('id'));
      return($this->db->update('tbl_jobs', $data));
    }


    function get_image($id='') {
      $this->db->select('image');
      $options = array('id' => $id);
      return $this->db->get_where('tbl_users', $options)->row_array();
    }
    
}
