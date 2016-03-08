<?php
class Settings_model extends CI_Model {

	function verify_current_pw() {
		$this->db->where('email', $this->session->userdata('email'));
		$query = $this->db->get_where('tbl_admin', array('email = ' => $this->session->userdata('email')));
		
		if($query->num_rows() == 1){
			$row = $query->row_array(); 
			$pass = $this->helper_model->decrypt_me($row['password']);
			if($this->input->post('cPassword') == $pass){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}
	
	
	public function update_password($password) {
		$data = array(
			'password' => $password
			);

		$this->db->where('email', $this->session->userdata('email'));

		if($this->db->update('tbl_admin', $data)){
			return true;
		} else {
			return false;
		}

	}


	public function get_site_settings() {
		$query = $this->db->get('tbl_site_settings');
		if($query->num_rows() == 1){
			return $query->row_array();
		} else {
			return false;
		}
	}
	

	public function update_site_settings($image = '') {
		if ($image == '')
            $image = $this->input->post('prev_image');
        
		$data = array(
			'site_name' => $this->input->post('site_name'),
			'site_title' => $this->input->post('site_title'),
			'site_slogan' => $this->input->post('site_slogan'),
			'site_email' => $this->input->post('site_email'),
			'facebook' => $this->input->post('facebook'),
			'twitter' => $this->input->post('twitter'),
			'youtube' => $this->input->post('youtube'),
			'meta_description' => $this->input->post('meta_description'),
			'meta_keywords' => $this->input->post('meta_keywords'),
			'site_authors' => $this->input->post('site_authors'),
			'site_status' => $this->input->post('site_status'),
			'logo' => $image,
			'site_offline_msg' => $this->input->post('site_offline_msg')
			);

		$this->db->where('site_id', 1);
		if($this->db->update('tbl_site_settings', $data)){
			return true;
		} else {
			return false;
		}

	}


	public function get_email_template($template_code){
		$this->db->where('template_code', $template_code);
		$query = $this->db->get('tbl_email_templates');
		if($query->num_rows() == 1){
			return $query->row_array();
		} else {
			return false;
		}
	}


	public function update_email_template(){
		$data = array(
			'subject' => $this->input->post('subject'),
			'content' => $this->input->post('content')
			);

		$this->db->where('template_code', $this->input->post('temp_name'));
		if($this->db->update('tbl_email_templates',$data)){
			return true;
		} else {
			return false;
		}
	}


	public function get_cms($title=''){
		if($title!=''){
			$this->db->where(array(
				'title' => $title,
				'del_flag' => 0
				));
			$query = $this->db->get('tbl_cms');
			if($query->num_rows() == 1){
				return $query->row_array();
			} else {
				return false;
			}
		} else {
			$this->db->where('del_flag', 0);
	        $this->db->order_by('id', 'ASC');
	        $query = $this->db->get('tbl_cms');
	        return $query->result_array();
		}
	}


	public function update_cms(){
		$data = array(
			'page_title' => $this->input->post('page_title'),
			'head_text' => $this->input->post('head_text'),
			'meta_keywords' => $this->input->post('meta_keywords'),
			'meta_description' => $this->input->post('meta_description'),
			'status' => $this->input->post('status'),
			'content' => $this->input->post('content')
			);

		$this->db->where('title', $this->input->post('cms_page'));
		if($this->db->update('tbl_cms',$data)){
			return true;
		} else {
			return false;
		}
	}


	public function get_contact_info() {
		$query = $this->db->get('tbl_contact_us');
		return $query->row_array();
	}


	public function update_contact(){
		$data = array(
			'phone' => $this->input->post('phone'),
			'fax' => $this->input->post('fax'),
			'email' => $this->input->post('email'),
			'weekday_start_time' => $this->input->post('weekday_start_time'),
			'weekday_end_time' => $this->input->post('weekday_end_time'),
			'weekend_start_time' => $this->input->post('weekend_start_time'),
			'weekend_end_time' => $this->input->post('weekend_end_time'),
			'lat' => $this->input->post('lat'),
			'lon' => $this->input->post('lon'),
			'address' => $this->input->post('address'),
			);

		$this->db->where('id', '1');
		if($this->db->update('tbl_contact_us',$data)){
			return true;
		} else {
			return false;
		}
	}


	public function get_email_settings() {
		return $this->db->get_where('tbl_email_settings',array('del_flag' => '0'), 1)->row_array();
	}

	public function update_email_settings(){
		$data = array(
			'mailtype' => $this->input->post('mailtype'),
			'protocol' => $this->input->post('protocol'),
			'smtp_host' => $this->input->post('smtp_host'),
			'smtp_port' => $this->input->post('smtp_port'),
			'smtp_user' => $this->input->post('smtp_user'),
			'smtp_pass' => $this->helper_model->encrypt_me($this->input->post('smtp_pass')),
			'receive_email' => $this->input->post('receive_email')
			//'charset' => $this->input->post('charset'),
			//'newline' => $this->input->post('newline')			
			);

		$this->db->where('id', '1');
		if($this->db->update('tbl_email_settings',$data)){
			return true;
		} else {
			return false;
		}
	}
}