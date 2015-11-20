<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
		parent::__construct();
			// if($this->config->item('site_status')=='offline')
			// {
			// 	redirect('/site_offline/');
			// 	exit;
			// }
			
			//  if($this->session->userdata(SESSION.'user_id'))
   //                      {
   //                            redirect(site_url(''));      
   //                      }
		
		$this->load->model('Registration_model');
		$this->load->model('Helper_model');
		$this->load->library('form_validation');
		//$this->form_validation->set_error_delimiters('<p class="error_class_register">', '</p>');
	}

    public function index()
		{
			//$this->load->view('register');
	
		 $this->template->set_template('register');
		 //echo 1;exit;
		 $data['menu_active']='register';
         $this->template->__set('title', 'Register');
		
		 $this->template->publish('register',$data);
      	 //$this->template->render();
	}
	function add_user()
	{
		$this->form_validation->set_rules('f_name', "First Name",'required');
		$this->form_validation->set_rules('l_name', "Last Name",'required');
		$this->form_validation->set_rules('email', "Email",'required|valid_email');
		$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|xss_clean|matches[password]');
		$this->form_validation->set_rules('gender', "Gender",'required');
		$this->form_validation->set_rules('dob_estd', "DOB",'required');
		$this->form_validation->set_rules('company_type', "Company Type",'required');
		$this->form_validation->set_rules('profile', "Profile",'required');
		$this->form_validation->set_rules('benefits', "Benefits",'required');
		$this->form_validation->set_rules('website', "Website",'required');
		$this->form_validation->set_rules('address', "Address",'required');
		$this->form_validation->set_rules('marital_status', "Marital Status",'required');
		$this->form_validation->set_rules('phone', "Phone",'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('user_type', "User Type",'required');
		//$this->form_validation->set_rules('image', "Image",'required');
		$this->form_validation->set_rules('status', "Status",'required');
		
		if($this->form_validation->run()==FALSE) {
			$this->template->set_template('register');
		 	$data['menu_active']='register';
         	$this->template->__set('title', 'Register');
		    $this->template->publish('register',$data);
		} else {
			$this->Registration_model->register();
			$this->template->set_template('home');
			$data['menu_active']='register';
	        $this->template->__set('title', 'Home');
		 	$this->template->publish('home',$data);

			
				// if ($_FILES['picture']['name'] != '') {
				//                 $uploaded_details = $this->upload_image('picture');
				//                 if (!$uploaded_details) {
				                  
				//                 }
				// 				else
				// 				{
					
				// $this->load->library(array('Image_lib'));
				// $config['image_library'] = 'gd2';
    //             $config['source_image'] = './user_upload/images/'.$uploaded_details['file_name'];
    //             $config['create_thumb'] = TRUE;
    //             $config['thumb_marker'] = false;
    //             $config['maintain_ratio'] = TRUE;
    //             $config['width'] = $this->config->item('width');
    //             $config['height'] = $this->config->item('height');
               
    //             $config['new_image'] = './user_upload/images/';
    //             $this->image_lib->initialize($config);
    //             $this->image_lib->resize();
				
				// }
    //         }
			 //  $activation_code=$this->Registration_model->register($uploaded_details['file_name']);
			 //  if($activation_code!='system_error')
			 //  	{
			 //     $this->Registration_model->reg_confirmation_email($activation_code);
				// }
            // redirect('register/success/');
		
		}
	}	
	
	   
	
	function success()
		{
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
		
			function failed()
		{$cms=$this->Cms_model->get_cms(37);
		
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
		
		
			function successed()
		{
		$cms=$this->Cms_model->get_cms(36);
		
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
	
	

	
	function activation_process($activation_code)
        {
             if($this->Registration_model->activated($activation_code)==true)
			 	{
					 redirect('register/successed/');					
				}
			else
				{
					redirect('register/failed/');
				}
  }
	   
	   
			
			
	   function check_email_check()
	   		{
				if($this->Registration_model->get_aleady_registered_email()==TRUE)
					{
						$this->form_validation->set_message('check_email_check', 'This Email is Already Registered,Please Choose Another One.');
						return false;
					}
				  return true;
			}			
		
	function username_check()
	{
          if(strlen($this->input->post('username'))<6 || strlen($this->input->post('username'))>16)
					{
						$this->form_validation->set_message('username_check', 'Username should be within 6-16');
						return false;     	
					}
			else if($this->Registration_model->get_aleady_registered_email()==TRUE)
					{
						$this->form_validation->set_message('username_check', 'This username is Already Registered,Please Choose Another One.');
						return false;
					}
				  return true;
	       

	}
	
		function password_check()
	{
          if($this->input->post('confirm_password')!=$this->input->post('password')) 
				{
				$this->form_validation->set_message('password_check', 'Confirm Password And Password Doesnot Match');
				return false;
				}
			
			 else if(strlen($this->input->post('password'))<6 || strlen($this->input->post('password'))>16)
					{
						$this->form_validation->set_message('password_check', 'Password should be within 6-16');
						return false;     	
					}
			else if($this->input->post('password')==$this->input->post('user_name'))
					{
						$this->form_validation->set_message('password_check', 'Username And password Can Not Be Same.');
						return false;  
					}
	  return true;        

	}
	
		function security_code_exist()
	{
	
          if($this->input->post('security_code')!=$_SESSION['security_code']) 
				{
				$this->form_validation->set_message('security_code_exist', 'Security Code Doesnot Match');
				return false;
				}
			
	  return true;        

	}
	
	 function upload_image($file) {

        $config['upload_path'] = './user_upload/images/';
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
