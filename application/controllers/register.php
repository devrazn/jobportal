<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
		parent::__construct();		
		$this->load->model('registration_model');
	}

    public function index() {
		$this->template->set_template('register');
		$data['menu_active']='register';
		$this->template->__set('title', 'Register');

		$this->template->publish('register/register_jobseeker',$data);
	}

	public function register_employeer() {
		$this->template->set_template('register');
		$data['menu_active']='register';
        $this->template->__set('title', 'Register');
		$this->template->publish('register/register_employeer',$data);
   	}

	function add_user($user){
		if($user==1){
			$dob_estd = "Date of Birth";
			$f_name = "First Name";
			$this->form_validation->set_rules('l_name', "Last Name",'required|xss_clean');
			$this->form_validation->set_rules('email', "Email",'required|xss_clean|valid_email|callback_check_email_check');
			$this->form_validation->set_rules('gender', "Gender",'required|xss_clean');
			$this->form_validation->set_rules('marital_status', "Marital Status",'required|xss_clean');
		}else {
			$dob_estd = "Date of Establishment";
			$f_name = "Company Name";
			$this->form_validation->set_rules('company_type', "Company Type",'required|xss_clean|trim');
			$this->form_validation->set_rules('profile', "Profile",'xss_clean|trim');
			$this->form_validation->set_rules('benefits', "Benefits",'xss_clean|trim');
			$this->form_validation->set_rules('website', "Website","xss_clean|callback_valid_url|trim");
		}
			$this->form_validation->set_rules('f_name', $f_name,'required|xss_clean|trim');
			$this->form_validation->set_rules('email', "Email",'required|xss_clean|trim|valid_email|is_unique[tbl_users.email]');
			$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[50]');
			$this->form_validation->set_rules('cpassword','Confirm Password','required|xss_clean|matches[password]');
			$this->form_validation->set_rules('dob_estd', $dob_estd,'trim|required|xss_clean');
			$this->form_validation->set_rules('address', "Address",'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', "Phone",'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
			if (empty($_FILES['image']['name'])) {
				$this->form_validation->set_rules('required|image', "Image",'xss_clean');
			}
		
		if($this->form_validation->run()==FALSE) {
				$this->template->set_template('register');
			 	$data['menu_active']='register';
	         	$this->template->__set('title', 'Register');
         	if($user==1){
		    	$this->template->publish('register/register_jobseeker',$data);
         	}else{
         		$this->template->publish('register/register_employeer',$data);
         	}
		} else {
			if ($_FILES['image']['name'] != '') {
                $uploaded_details = $this->upload_image('image');
                if (!$uploaded_details) {
                  
                }
				else {
					$this->load->library("image_lib");
					$config['image_library'] = 'gd2';
	                $config['source_image'] = './uploads/user/'.$uploaded_details['file_name'];
	                $config['create_thumb'] = TRUE;
	                $config['thumb_marker'] = false;
	                $config['maintain_ratio'] = TRUE;
	                $config['width'] = $this->config->item('width');
	                $config['height'] = $this->config->item('height');
	                $config['new_image'] = './uploads/user/';
	                $this->image_lib->initialize($config);
             	}
            }

            $activation_code=$this->registration_model->register($uploaded_details['file_name']);
   			if($activation_code!='system_error') {
			     $this->registration_model->reg_confirmation_email($activation_code);
			}

			// $this->registration_model->register($uploaded_details['file_name']);
			// $this->template->set_template('home');
			// $data['menu_active']='register';
	  //       $this->template->__set('title', 'Home');
		 // 	$this->template->publish('home',$data);

		}
	}	
		
	function success() {
			$cms=$this->Cms_model->get_cms(35);
		
			$data['menu_active']=$id;
			
			$data['headtext']=$cms['headtext'];
			$data['content']=$cms['content'];

			
			$this->template->set_template('two');
			
	        $this->template->write('title', $cms['page_title']);
			$this->template->write('meta_description', $cms['meta_description']);
			$this->template->write('meta_key_word', $cms['meta_key_word']);
		
			
			$this->template->write_view('content_left', 'cms/left',$data);
			$this->template->write_view('content_right', 'cms/cms',$data);
			
			$this->template->render();
	}
		
	function failed() {
		echo 'failed';exit;
		$cms=$this->Cms_model->get_cms(37);
		
		$data['menu_active']=$id;
		
		$data['headtext']=$cms['headtext'];
		$data['content']=$cms['content'];

		
		$this->template->set_template('two');
		
        $this->template->write('title', $cms['page_title']);
		$this->template->write('meta_description', $cms['meta_description']);
		$this->template->write('meta_key_word', $cms['meta_key_word']);
	
		
		$this->template->write_view('content_left', 'cms/left',$data);
		$this->template->write_view('content_right', 'cms/cms',$data);
		
		$this->template->render();
	}
		
	function successed() {
		echo "sucess";die;
		$cms=$this->settings_model->get_cms_content(36);
		$data['menu_active']=$id;
		
		$data['headtext']=$cms['headtext'];
		$data['content']=$cms['content'];

		$this->template->set_template('two');
		
        $this->template->write('title', $cms['page_title']);
		$this->template->write('meta_description', $cms['meta_description']);
		$this->template->write('meta_key_word', $cms['meta_key_word']);
	
		
		$this->template->write_view('content_left', 'cms/left',$data);
		$this->template->write_view('content_right', 'cms/cms',$data);
		
		$this->template->render();
	}

	function activation_process($activation_code,$key) {
        if($this->registration_model->activated($key,$activation_code)==true) {
			redirect('register/successed/');					
		} else {
			redirect('register/failed/');
		}
 	}
		
	function check_email_check() {
		if($this->registration_model->get_aleady_registered_email()==TRUE) {
			$this->form_validation->set_message('check_email_check', 'This Email is Already Registered,Please Choose Another One.');
			return false;
		}
			return true;
	}			
		
	function username_check() {
        if(strlen($this->input->post('username'))<6 || strlen($this->input->post('username'))>16) {
			$this->form_validation->set_message('username_check', 'Username should be within 6-16');
			return false;     	
		}
		else if($this->registration_model->get_aleady_registered_email()==TRUE) {
			$this->form_validation->set_message('username_check', 'This username is Already Registered,Please Choose Another One.');
			return false;
		}
			return true;
	}
	
	function password_check(){
        if($this->input->post('cpassword')!=$this->input->post('password')) {
			$this->form_validation->set_message('password_check', 'Confirm Password And Password Doesnot Match');
			return false;
			}
		else if(strlen($this->input->post('password'))<6 || strlen($this->input->post('password'))>16){
			$this->form_validation->set_message('password_check', 'Password should be within 6-16');
			return false;     	
		}
		else if($this->input->post('password')==$this->input->post('f_name')) {
			$this->form_validation->set_message('password_check', 'Username And password Can Not Be Same.');
			return false;  
		}
			return true;        
	}
		
	function upload_image($file) {
        $config['upload_path'] = './uploads/user/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '9999999999999999999999999999999999999999';
        $config['max_width'] = '9999999999999999999999999999999999999999';
        $config['max_height'] = '9999999999999999999999999999999999999999';
        $config['remove_spaces'] = 'true';

        $this->load->library('upload', $config);
        $this->upload->do_upload($file);

        if ($this->upload->display_errors()) {
            $this->error = $this->upload->display_errors();
            return false;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }

    function valid_url($url){
    	$pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	    if (!preg_match($pattern, $url)){
	        return FALSE;
	    }
			return TRUE;
	}

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
