<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->model('job_model');
	  	$this->load->model('home_model');
	}

	public function index($procedure="") {
		$data['temp_procedure'] = $procedure;
		$data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
		$data["sidebar_categories"] = $this->home_model->get_job_categories();
		$data["page"] = "post_job";
		$data["title"] = "post_job";
		$this->template->__set('title', 'Post Job');
		$this->template->partial->view("default_layout", $data, $overwrite=FALSE);
		$this->template->publish('default_layout');
	}

	public function post_job() {
		$temp_procedure = $this->input->post('application_procedure');
		$procedure_data = isset($temp_procedure)?implode(",", $temp_procedure):'';

		$this->form_validation->set_rules('title', "Title",'required|xss_clean');
		$this->form_validation->set_rules('position', "Position",'required|xss_clean');
		$this->form_validation->set_rules('openings', "Openings",'required|xss_clean');
		$this->form_validation->set_rules('location', "Location",'required|xss_clean');
		$this->form_validation->set_rules('qualification', "Qualification",'required|xss_clean');
		$this->form_validation->set_rules('experience', "Experience",'required|xss_clean');
		$this->form_validation->set_rules('salary', "Salary",'required|xss_clean');
		$this->form_validation->set_rules('category_id', "Category",'required|xss_clean');
		$this->form_validation->set_rules('job_description', "Job Description",'required|xss_clean');
		$this->form_validation->set_rules('requirements', "Requirement",'required|xss_clean');
		$this->form_validation->set_rules('facilities', "Facilities",'required|xss_clean');
		$this->form_validation->set_rules('deadline_date', "Deadline Date",'required');
		$this->form_validation->set_rules('application_procedure', "Application Procedure",'callback__validate_checkbox|xss_clean');
		
		if($this->form_validation->run()==FALSE) {
			if($temp_procedure) {
				$this->index($procedure_data);
			} else {
				$this->index();
			}
		} else {
			if($this->job_model->post_job($procedure_data)) {
                $this->session->set_userdata( 'user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Job Posted Sucessfully');
                redirect('home/landing');
            } else {
                $this->session->set_userdata( 'user_flash_msg_type', "danger" );
                $this->session->set_flashdata('user_flash_msg', 'Sorry, Unable to Post Job');
                $this->index();
            }
		}
	}

	function _validate_checkbox() {
		if(count($this->input->post('application_procedure'))==0){
			$this->form_validation->set_message('_validate_checkbox','Application Procedure is required');
			return false;
		} else{
			return true;
		}

	}

}
