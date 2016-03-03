<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Profile extends CI_Controller {

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->model('user_profile_model');
	  	$this->load->model('home_model');
	}

	public function index() {
		$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
		$data["sidebar_categories"] = $this->home_model->get_job_categories();
		$data["page"] = "change_password";
		$this->template->__set('title', 'Change Password');
		$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
		$this->template->publish('default_layout');
	}

	public function change_password() {
		$this->form_validation->set_rules('cur_password', 'Current Password', 'required|xss_clean|callback_verify_current_pass');
        $this->form_validation->set_rules('new_password', 'Password', 'required|xss_clean|min_length[6]|max_length[64]');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|xss_clean|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
           $this->index();
        } else {
            $password = $this->helper_model->encrypt_me($this->input->post('new_password'));
            if($this->user_profile_model->update_password($password)) {
                $this->session->set_userdata( 'flash_msg_type_public_user', "success" );
                $this->session->set_flashdata('flash_msg_public_user', 'Password Changed Successfully');
                redirect(base_url());
            } else {
                $this->session->set_userdata( 'flash_msg_type_public_user', "danger" );
                $this->session->set_flashdata('flash_msg_public_user', 'Sorry, Unable to Change the Password');
                $this->index();
            }
        }
	}

	public function verify_current_pass() {
        if($this->user_profile_model->verify_current_pw()) {
            return true;
        } else {
            $this->form_validation->set_message('verify_current_pass','Current Password Incorrect');
            return false;
        }
    }

    public function jobseeker_details($id){
        $data["sidebar_jobs"] = $this->home_model->get_latest_jobs();
        $data["sidebar_categories"] = $this->home_model->get_job_categories();
        $data["jobseeker_details"] = $this->user_profile_model->get_jobseeker_details($id);
        $data["qualification"] = $this->user_profile_model->get_jobseeker_qualification($id);
        $data["experience"] = $this->user_profile_model->get_jobseeker_experience($id);
        //echo "<pre>";print_r($data["qualification"]);die;
        $data["page"] = "jobseeker_details";
        $this->template->__set('title', 'Details');
        $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
        $this->template->publish('default_layout');
    }
}
