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


    public function index() {
        $this->landing();
    }
	
	
	public function landing() {
        $this->session->set_userdata('referred_from', current_url());
		$this->data["content_jobs"] = $this->home_model->get_jobs();
		//echo '<pre>',print_r($this->data["content_jobs"],1),'</pre>'; exit;
		$this->data["sliders"] = $this->home_model->get_slider();
        //echo '<pre>',print_r($this->data["sliders"],1),'</pre>'; exit;
		$this->template->__set('title', 'Home');
		$this->template->partial->view("home_layout", $this->data, $overwrite=FALSE);
		$this->template->publish('home_layout');	
    }


    public function search() {
        $data = array(
            'search' => $this->input->get('search')
        );
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('search', 'Search', 'required|xss_clean');
        if($this->form_validation->run() == false) {
            if($this->session->userdata('referred_from')) {
                redirect($this->session->userdata('referred_from'));
            } else {
                redirect(base_url());
            }
            
        } else {
            //echo 3; exit;
            $this->data["search_results"] = $this->home_model->get_search_result();
            $data2 = $this->data["search_results"];
            //echo '<pre>',print_r($data2,1),'</pre>'; exit;
            $this->data["page"] = 'search';
            $this->template->__set('title', $this->input->get('search'));
            $this->template->partial->view("default_layout", $this->data, $overwrite=FALSE);
            $this->template->publish('default_layout');

        }

    }

    
    public function footer_contents($title){
        $this->session->set_userdata('referred_from', current_url());
		$data["cms_contents"] = $this->home_model->get_footer_contents($title);
		$this->template->partial->view("cms", $data, $overwrite=FALSE);
		$this->template->publish('cms');
    }


    public function contact_us(){
        $this->session->set_userdata('referred_from', current_url());
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean|trim');
        if(!$this->helper_model->validate_user_session()) {
            $this->form_validation->set_rules('captcha', 'Captcha', 'required|xss_clean|trim|callback_validate_captcha');
            $this->form_validation->set_rules('name', 'Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
        }

		if($this->form_validation->run() == FALSE){
	    	$data["captcha"] = generate_captcha();
			$data["contact_details"] = $this->home_model->get_contact_details();
			$data["page"] = 'contact_us';
			
			$this->template->partial->view("contact_us", $data, $overwrite=FALSE);
			$this->template->publish('contact_us');
		} else {
			if($this->home_model->insert_contact_message()){
				$this->session->set_userdata( 'user_flash_msg_type', "success" );
	            $this->session->set_flashdata('user_flash_msg', "Thanks for contacting JobPortal. We will get back to you as soon as we can.");
	            redirect(base_url() . 'contact_us', 'refresh');
			} else {
				$this->session->set_userdata( 'user_flash_msg_type', "failure" );
	            $this->session->set_flashdata('user_flash_msg', "Your message can't be sent now. Please try again later.");
	            redirect(base_url() . 'contact_us', 'refresh');
			}
		}
    }


    public function refresh_captcha(){
    	$data = generate_captcha(true);
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
        $this->session->set_userdata('referred_from', current_url());
        $this->data["employer_details"] = $this->home_model->get_employer_details($id);
        $this->data["employer_jobs"] = $this->home_model->get_employer_jobs($id);
        $this->data["page"] = 'employer_details';
        $this->template->partial->view("default_layout", $this->data, $overwrite=FALSE);
        $this->template->publish('default_layout');
        
    }


    public function job_apply(){
    	if($this->helper_model->validate_user_session()) {
    		$this->home_model->apply_job();
			echo "success";
    	} else {
    		echo 'failure';
    	}
    }

    public function job_share($id=NULL) {
        if(empty($id)) $this->redirect(base_url());
        $data['job_details'] = $this->home_model->get_jobs($id);
        $this->job_details($id);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
