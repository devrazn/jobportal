<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
	var $data;

    function __construct() {
		parent::__construct();
		$this->load->model('home_model');

		$config["parser"]   = FALSE;
		$config["template"] = "template";
		$config["ttl"]      = 0;
		$this->template->initialize($config);
		$this->data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
		$this->data["sidebar_categories"] = $this->home_model->get_job_categories();
	}
	
	
	public function landing() {
		$this->data["content_jobs"] = $this->home_model->get_jobs();
		//echo '<pre>',print_r($data2,1),'</pre>'; exit;
		$this->data["sliders"] = $this->home_model->get_slider();
		$this->template->__set('title', 'Home');
		$this->template->partial->view("home_layout", $this->data, $overwrite=FALSE);
		$this->template->publish('home_layout');	
    }


    public function search(){
        $this->form_validation->set_rules('search', 'Search', 'required|xss_clean')

    }

    
    public function footer_contents($title){
		$data["cms_contents"] = $this->home_model->get_footer_contents($title);
		$this->template->partial->view("cms", $data, $overwrite=FALSE);
		$this->template->publish('cms');
    }


    public function contact_us(){
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean|trim');
        if(!$this->helper_model->validate_user_session()) {
            $this->form_validation->set_rules('captcha', 'Captcha', 'required|xss_clean|trim|callback_validate_captcha');
            $this->form_validation->set_rules('name', 'Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
        }

		if($this->form_validation->run() == FALSE){
	    	$data["captcha"] = $this->helper_model->generate_captcha();
			$data["contact_details"] = $this->home_model->get_contact_details();
			$data["page"] = 'contact_us';
			
			$this->template->partial->view("contact_us", $data, $overwrite=FALSE);
			$this->template->publish('contact_us');
		} else {
			if($this->home_model->insert_contact_message()){
				$this->session->set_userdata( 'flash_msg_type_public_user', "success" );
	            $this->session->set_flashdata('flash_msg_public_user', "Thanks for contacting JobPortal. We will get back to you as soon as we can.");
	            redirect(base_url() . 'contact_us', 'refresh');
			} else {
				$this->session->set_userdata( 'flash_msg_type_public_user', "failure" );
	            $this->session->set_flashdata('flash_msg_public_user', 'User Updated Successfully');
	            redirect(base_url() . 'contact_us', 'refresh');
			}
		}
    }


    public function refresh_captcha(){
    	$data = $this->helper_model->generate_captcha(true);
    	echo json_encode(array(
                'status' => true,
                'src' => $data["filename"]
            ));
    }


    public function validate_captcha($captcha){
    	if(strcmp($this->session->userdata('captchaWord'), $captcha) != 0){
    		$this->form_validation->set_message('validate_captcha', 'Please type the characters shown in the image correctly.');
    		return false;
    	} else {
    		return true;
    	}
    }


    public function job_details($id){
        $this->session->set_userdata('referred_from', current_url());
    	$this->data["job_details"] = $this->home_model->get_job_details($id);
    	$this->data["page"] = 'job_details';
    	//echo '<pre>',print_r($data,1),'</pre>'; exit;
		$this->template->partial->view("default_layout", $this->data, $overwrite=FALSE);
		$this->template->publish('default_layout');
    	
    }


    public function employer_details($id){
        $this->data["employer_details"] = $this->home_model->get_employer_details($id);
        $this->data["employer_jobs"] = $this->home_model->get_employer_jobs($id);
        $this->data["page"] = 'employer_details';
        //echo '<pre>',print_r($this->data2,1),'</pre>'; exit;
        $this->template->partial->view("default_layout", $this->data, $overwrite=FALSE);
        $this->template->publish('default_layout');
        
    }


    public function job_apply(){
    	if($this->session->userdata('is_Login')) {
    		$this->home_model->apply_job();
			echo "success";
    	} else {
    		echo 'failure';
    	}
    }


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
