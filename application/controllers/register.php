<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
		parent::__construct();
		if($this->helper_model->validate_user_session()){
			redirect(base_url());
		}
		$this->load->model('registration_model');
	}

    public function index() {
		$this->template->set_template('register');
		$data['menu_active']='register';
		$this->template->__set('title', 'Register');

		$this->template->publish('register/register_jobseeker',$data);
	}

	public function register_employer() {
		$this->template->set_template('register');
		$data['menu_active']='register';
        $this->template->__set('title', 'Register');
		$this->template->publish('register/register_employer',$data);
   	}

	function add_user($user){
		if($user==1){
			//echo $user; exit;
			$f_name = "First Name";
			$this->form_validation->set_rules('l_name', "Last Name",'required|xss_clean');
			$this->form_validation->set_rules('gender', "Gender",'required|xss_clean');
			$this->form_validation->set_rules('marital_status', "Marital Status",'required|xss_clean');
			$this->form_validation->set_rules('phone', "Phone",'xss_clean|trim');
			$this->form_validation->set_rules('dob_estd', "Date of Birth",'xss_clean|trim|callback_validate_date');
		} else if($user==2){
			//echo $user; exit;
			$dob_estd = "Date of Establishment";
			$f_name = "Company Name";
			$this->form_validation->set_rules('phone', "Phone",'required|xss_clean|trim|is_natural_no_zero|min_length[7]|max_length[15]');
			// $this->form_validation->set_rules('company_type', "Company Type",'required|xss_clean|trim');
			// $this->form_validation->set_rules('profile', "Profile",'xss_clean|trim');
			// $this->form_validation->set_rules('benefits', "Benefits",'xss_clean|trim');
			$this->form_validation->set_rules('website', "Website","xss_clean|trim|valid_url");
			$this->form_validation->set_rules('address', "Address",'required|trim|xss_clean');
			$this->form_validation->set_rules('image', "Image",'xss_clean|callback__validate_image');
			$this->form_validation->set_rules('dob_estd', "Established Year",'xss_clean|trim|greater_than[1900]|callback_validate_date_year');
		} else {
			echo show_404(); exit;
		}
		$this->form_validation->set_rules('f_name', $f_name,'required|xss_clean|trim');
		$this->form_validation->set_rules('email', "Email",'required|xss_clean|trim|valid_email|is_unique[tbl_users.email]');
		$this->form_validation->set_message('is_unique', 'This %s has already been registered with JobPortal.');
		$this->form_validation->set_rules('password','Password','required|xss_clean|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|xss_clean|matches[password]');
		//$this->form_validation->set_rules('dob_estd', $dob_estd,'trim|required|xss_clean');
		
		$this->form_validation->set_rules('newsletter_subscription', "Newsletter Subscription", 'xss_clean');
		
		
		if($this->form_validation->run()==FALSE) {
			if(isset($_POST['post_image']) && file_exists("./uploads/user/images/" . $_POST['post_image'])) {
				@unlink("./uploads/user/images/" . $_POST['post_image']);
			}
				$this->template->set_template('register');
			 	$data['menu_active']='register';
	         	$this->template->__set('title', 'Register');
         	if($user==1){
		    	$this->template->publish('register/register_jobseeker',$data);
         	} else {
         		$this->template->publish('register/register_employer',$data);
         	}
		} else {
			if(!isset($_POST['post_image'])){
				$_POST['post_image']='';
			}
			$activation_code = genRandomString(32);
            $inserted_id = $this->registration_model->register($user, $_POST['post_image'], $activation_code);
   			if($activation_code!='system_error') {
			    if($this->registration_model->reg_confirmation_email($activation_code)) {
				    $this->session->set_userdata( 'user_flash_msg_type', "success" );
		        	$this->session->set_flashdata('user_flash_msg', "You've successfully created your JobPortal Account. A verification link has been sent to your email. Please check your inbox");
		        	redirect(base_url());
		        } else {
		        	$this->registration_model->hard_delete_user($inserted_id);
		        	if(isset($_POST['post_image']) && file_exists("./uploads/user/images/" . $_POST['post_image'])) {
						@unlink("./uploads/user/images/" . $_POST['post_image']);
					}
					$this->session->set_userdata( 'user_flash_msg_type', "danger" );
		        	$this->session->set_flashdata('user_flash_msg', "Sorry, we cannot complete your registration at the moment. Please try again later.");
					$this->template->set_template('register');
			 		$data['menu_active']='register';
	         		$this->template->__set('title', 'Register');
         			if($user==1){
		    			$this->template->publish('register/register_jobseeker',$data);
         			} else {
         				$this->template->publish('register/register_employer',$data);
         			}
		        }
			}

		}
	}


	function _validate_image($received_image='', $edit=false){
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        	$this->load->helper('image_helper');
            $image = array(
                        'location' => './uploads/user/images/',
                        'temp_location' => './uploads/user/images/temp/',
                        'width' => USER_W,
                        'height' => USER_H,
                        'image' => 'image'
                    );
            $response = validate_image($image);
            if($response['status']) {
                return true;
            } else {
                $this->form_validation->set_message('_validate_image', $response['msg']);
                return false;
            }
        } elseif(!$edit) {
            $this->form_validation->set_message('_validate_image', 'You must provide an image.');
            return false;
        } else {
            return true;
        }
    }


	function activation_process($key='', $hash_email='') {
		$email = $this->registration_model->activated($key, $hash_email);
        if($email) {
        	$this->session->set_userdata( 'user_flash_msg_type', "success" );
	        $this->session->set_flashdata('user_flash_msg', "Congratulations, you've successfully activated your JobPortal account.");
	        $this->helper_model->set_user_login_session($email);
			redirect(base_url());					
		} else {
			echo "Invalid Credentials"; exit;
		}
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


    function handle_upload() {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $config['upload_path']          = './uploads/user';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 10000;
            $config['max_width']            = 3840;
            $config['max_height']           = 2160;
            $config['min_width']            = 480;
            $config['min_height']           = 360;
            $config['remove_spaces']        = true;
            $config['file_ext_tolower']     = true;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                // set a $_POST value for 'image' that we can use later
                $upload_data = $this->upload->data();
                $_POST['image'] = $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', "<div style='color:red'>" . $this->upload->display_errors() . "</div>");
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
            $this->form_validation->set_message('handle_upload', "You must select an image to upload.");
            return false;
        }
    }

    /*function valid_url($url){
    	$pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	    if (!preg_match($pattern, $url)){
	        return FALSE;
	    }
			return TRUE;
	}*/


	public function validate_date($date){
		$parts = explode("-", $date);
	    if (count($parts) == 3) { 
			if (checkdate($parts[1], $parts[2], $parts[0])){
				$datetime1 = new DateTime($date);
		        $datetime2 = new DateTime('now');
		        $interval = $datetime2->diff($datetime1);
		        $diff = $interval->format('%R%a');
		        if($diff >= 0){
		        	$this->form_validation->set_message('validate_date', 'The %s must be yyyy-mm-dd format with date between 1900-01-01 & current date');
		        	return false;
		        } else {
		        	return TRUE;
		        }
	      	} else {
	      		$this->form_validation->set_message('validate_date', 'The %s must be yyyy-mm-dd format & between current date & 1900-01-01');
		        return false;
	      	}
	    } else {
		    $this->form_validation->set_message('validate_date', 'The %s must be yyyy-mm-dd format & between current date & 1900-01-01');
		    return false;
		}
	}


	public function validate_date_year($year){
		if($year - date("Y") > 0){
			$this->form_validation->set_message('validate_date_year', 'The %s field must be between current 1900 & current year');
			return false;
		} else {
			return true;
		}
	}

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
