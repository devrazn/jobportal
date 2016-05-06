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
        $data["page"] = "jobseeker_details";
        $this->template->__set('title', 'Details');
        $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
        $this->template->publish('default_layout');
    }

    public function edit_profile($id){
        $data['sidebar_jobs'] = $this->home_model->get_latest_jobs();
        $data["sidebar_categories"] = $this->home_model->get_job_categories();
        $data["user_detail"] = $this->user_profile_model->get_user_detail($id);
        // echo "<pre>"; print_r($data['user_detail']);die;
        $data['user_detail']['user_type']== 0?$data["page"] = "update_jobseeker_details": $data["page"] = "update_employeer_details";
        $this->template->__set('title', 'Update Profile');
        $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
        $this->template->publish('default_layout');
    }

    public function update_info($id){
        $user_type = $this->input->post('user_type');

        if($user_type==0){
            $dob_estd = "Date of Birth";
            $f_name = "First Name";
            $this->form_validation->set_rules('l_name', "Last Name",'required|xss_clean');
            $this->form_validation->set_rules('gender', "Gender",'required|xss_clean');
            $this->form_validation->set_rules('marital_status', "Marital Status",'required|xss_clean');
        }else {
            $dob_estd = "Date of Establishment";
            $f_name = "Company Name";
            $this->form_validation->set_rules('website', "Website","xss_clean|callback_valid_url|trim");
        }
            $this->form_validation->set_rules('f_name', $f_name,'required|xss_clean|trim');
            $this->form_validation->set_rules('dob_estd', $dob_estd,'trim|required|xss_clean');
            $this->form_validation->set_rules('address', "Address",'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', "Phone",'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('prev_image', 'Preview Image', 'xss_clean');
            $this->form_validation->set_rules('image', 'Image', 'xss_clean|callback_handle_upload');
        
        if($this->form_validation->run()==FALSE) {
            if(isset($_POST['image'])){
                if (file_exists("./uploads/user/" . $_POST['image'])){
                    @unlink("./uploads/user/" . $_POST['image']);
                    echo "delete file". $_POST['image']; exit;
                }
            }
            $this->edit_profile($id);
        } else {
            if (isset($_POST['image'])) {
                $image = $_POST['image'];
                if (file_exists("./uploads/user" . $this->input->post('prev_image'))){
                    @unlink("./uploads/user/" . $this->input->post('prev_image'));
                }
            } else {
                $image = $this->input->post('prev_image');
            }
            if($this->user_profile_model->update_user_detail($image,$id)) {
                $this->session->set_userdata( 'user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Profile Updated Successfully');
                redirect(base_url());
            } else {
                $this->session->set_userdata( 'user_flash_msg_type', "danger" );
                $this->session->set_flashdata('user_flash_msg', 'Sorry, Unable to Update Profile');
                $this->index();
            }
        }
    }

    function handle_upload() {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $config['upload_path']          = './uploads/user';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 1000000;
            $config['max_width']            = 1000000;
            $config['max_height']           = 1000000;
            $config['min_width']            = 480;
            $config['min_height']           = 360;
            $config['remove_spaces']        = true;
            $config['file_ext_tolower']     = true;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                // set a $_POST value for 'image' that we can use later
                $upload_data    = $this->upload->data();
                $_POST['image'] = $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', "<div style='color:red'>" . $this->upload->display_errors() . "</div>");
                return false;
            }
        } else {
            return true;
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
