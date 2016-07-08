<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends CI_Controller {

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->model('user_profile_model');
	  	$this->load->model('home_model');
        if(!$this->helper_model->validate_user_session()){
          redirect(base_url());
        }
	}

	public function index() {
		$this->edit_profile();
	}

	public function change_password() {
		$this->form_validation->set_rules('cur_password', 'Current Password', 'required|xss_clean|callback_verify_current_pass');
        $this->form_validation->set_rules('new_password', 'Password', 'required|xss_clean|min_length[6]|max_length[64]');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|xss_clean|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $data["page"] = "member/change_password";
            $this->template->__set('title', 'Change Password');
            $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
            $this->template->publish('user_layout');
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

    public function jobseeker_details(){
        $id = $this->session->userdata('user_id');
        $data["jobseeker_details"] = $this->user_profile_model->get_jobseeker_details($id);
        $data["qualification"] = $this->user_profile_model->get_jobseeker_qualification($id);
        $data["experience"] = $this->user_profile_model->get_jobseeker_experience($id);
        $data["page"] = "member/jobseeker/jobseeker_details";
        $this->template->__set('title', 'Details');
        $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
        $this->template->publish('user_layout');
    }

    public function edit_profile(){
        $data["user_detail"] = $this->user_profile_model->get_user_detail($this->session->userdata('user_id'));
        $data["user_categories"] = $this->user_profile_model->get_user_categories($this->session->userdata('user_id'));
        $data["user_tags"] = $this->user_profile_model->get_user_tags($this->session->userdata('user_id'));
        $data["page"] = "member/jobseeker/update_jobseeker_details";
        $this->template->__set('title', 'Update Profile');
        $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
        $this->template->publish('user_layout');
    }

    public function update_info($id=''){
        if($this->session->userdata('user_type')==1){
            $dob_estd = "Date of Birth";
            $f_name = "First Name";
            $this->form_validation->set_rules('l_name', "Last Name",'required|xss_clean');
            $this->form_validation->set_rules('gender', "Gender",'required|xss_clean');
            $this->form_validation->set_rules('marital_status', "Marital Status",'required|xss_clean');
        } else {
            $dob_estd = "Date of Establishment";
            $f_name = "Company Name";
            $this->form_validation->set_rules('website', "Website","xss_clean|trim|valid_url");
        }
            $this->form_validation->set_rules('f_name', $f_name,'required|xss_clean|trim');
            $this->form_validation->set_rules('dob_estd', $dob_estd,'trim|required|xss_clean');
            $this->form_validation->set_rules('address', "Address",'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', "Phone",'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('prev_image', 'Preview Image', 'xss_clean');
            $this->form_validation->set_rules('image', 'Image', 'xss_clean|callback__validate_image['.true.']');
            $this->form_validation->set_rules('job_category[]', 'Job Category', 'xss_clean|callback__validate_job_category');
            $this->form_validation->set_rules('tag[]', 'Tag', 'xss_clean|callback__validate_tag');
        
        if($this->form_validation->run()==FALSE) {
            if(isset($_POST['post_image'])){
                if (file_exists("./uploads/user/images/" . $_POST['post_image'])){
                    @unlink("./uploads/user/images/" . $_POST['post_image']);
                }
            }
            $this->edit_profile($this->session->userdata('user_id'));
        } else {
            if (isset($_POST['post_image'])) {
                $image = $_POST['post_image'];
                if (file_exists("./uploads/user/images/" . $this->input->post('prev_image'))){
                    @unlink("./uploads/user/images/" . $this->input->post('prev_image'));
                }
            } else {
                $image = $this->input->post('prev_image');
            }
            if($this->user_profile_model->update_user_detail($image, $this->session->userdata('user_id'))) {
                $this->session->set_userdata('user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Profile Updated Successfully');
                $this->index();
            } else {
                $this->session->set_userdata( 'user_flash_msg_type', "danger" );
                $this->session->set_flashdata('user_flash_msg', 'Sorry, Unable to Update Profile');
                $this->index();
            }
        }
    }


    function _validate_job_category() {
        if(!set_value('job_category[0]')){
            //die('not set');
            return true;
        } else {
            //echo 'set'; exit;
            $category_ids = $this->user_profile_model->get_all_category_id();
            //echo '<pre>',print_r($this->input->post('job_category[]'),1),'</pre>'; exit;
            //print_r($category_ids); exit;
            $i=1;
            while (true) {
                if($i>=6){
                    $this->form_validation->set_message('_validate_job_category', 'You cannot select more than 5 categories.');
                    return false;
                }
                if(set_value('job_category['.$i.']')) {
                    if(!in_array(set_value('job_category['.$i.']'), $category_ids)){
                        $this->form_validation->set_message('_validate_job_category', 'Please select the job categories properly.');
                        return false;
                    }
                } else {
                    return true;
                }
                $i++;
            }
        }
    }


    function _validate_tag() {
        if(!set_value('tag[0]')){
            return true;
        } else {
            $tag_ids = $this->user_profile_model->get_all_tag_id();
            $i=1;
            while (true) {
                if($i>=11){
                    $this->form_validation->set_message('_validate_tag', 'You cannot select more than 5 tag words.');
                    return false;
                }
                if(set_value('tag['.$i.']')) {
                    if(!in_array(set_value('tag['.$i.']'), $tag_ids)) {
                        $this->form_validation->set_message('_validate_job_category', 'Please select the tags properly.');
                        return false;
                    }
                } else {
                    return true;
                }
                $i++;
            }
        }
    }


    function _validate_image($image='', $edit=false) {
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {     //check if the field is empty or not
            $image = array(
                        'location' => './uploads/user/images/',
                        'temp_location' => './uploads/user/images/temp/',
                        'width' => USER_W,
                        'height' => USER_H,
                        'image' => 'image'      //field name of the file in the form
                    );
            $this->load->helper('image_helper');
            $response = validate_image($image);
            if($response['status']) {
                return true;
            } else {
                $this->form_validation->set_message('_validate_image', $response['msg']);
                return false;
            }
        } elseif(!$edit) {
            $this->form_validation->set_message('_validate_image', 'Please select an image for logo.');
            return false;
        } else {
            return true;
        }
    }

    function _valid_url($url){
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $url)){
            return FALSE;
        }
            return TRUE;
    }


    function experience(){
        $data['experiences'] = $this->user_profile_model->get_all_user_experience($this->session->userdata('user_id'));
        $data["page"] = "member/jobseeker/experience/list";
        $data["title"] = 'Your Experiences';
        $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
        $this->template->publish('user_layout');
    }


    public function add_experience(){
        $date = date('Y');
        $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('position', 'Position', 'required|trim|xss_clean');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|xss_clean');
        $this->form_validation->set_rules('start_year', 'Start Year', 'required|trim|xss_clean|integer|greater_than_equal_to[1970]|less_than[' . $date . ']');
        $this->form_validation->set_rules('duration', 'Duration', 'required|xss_clean|integer|greater_than[0]');
        $this->form_validation->set_rules('duration_unit', 'Duration Unit', 'required|xss_clean|integer|greater_than_equal_to[1]|less_than_equal_to[2]');
        $this->form_validation->set_rules('description', 'Description', 'xss_clean');
        if(!$this->form_validation->run()) {
            $data["page"] = "member/jobseeker/experience/add";
            $this->template->__set('title', 'Add Your Experiences');
            $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
            $this->template->publish('user_layout');
        } else {
            $this->user_profile_model->add_experience($this->session->userdata('user_id'));
            $this->session->set_userdata( 'user_flash_msg_type', "success" );
            $this->session->set_flashdata('user_flash_msg', 'Experience addded successfully');
            redirect(base_url().'User_profile/experience', 'refresh');
        }
    }

    public function edit_experience($experience_id){
        $data['experience'] = $this->user_profile_model->get_experience($experience_id);
        if($data['experience']['user_id'] != $this->session->userdata('user_id') && $data['experience']['del_flag'] == 1) { //$this->session->userdata('user_id')
            show_404();
            exit;
        }
        $date = date('Y');
        $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('position', 'Position', 'required|trim|xss_clean');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|xss_clean');
        $this->form_validation->set_rules('start_year', 'Start Year', 'required|trim|xss_clean|integer|greater_than_equal_to[1900]|less_than[' . $date . ']');
        $this->form_validation->set_rules('duration', 'Duration', 'required|xss_clean|integer|greater_than[0]');
        $this->form_validation->set_rules('duration_unit', 'Duration Unit', 'required|xss_clean|integer|greater_than_equal_to[1]|less_than_equal_to[2]');
        $this->form_validation->set_rules('description', 'Description', 'xss_clean');
        if(!$this->form_validation->run()) {
            $data["page"] = "member/jobseeker/experience/edit";
            $this->template->__set('title', 'Edit Your Experience');
            $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
            $this->template->publish('user_layout');
        } else {
            $this->user_profile_model->update_experience($experience_id, $this->session->userdata('user_id'));
            $this->session->set_userdata( 'user_flash_msg_type', "success" );
            $this->session->set_flashdata('user_flash_msg', 'Experience updated successfully');
            redirect(base_url().'user_profile/experience', 'refresh');
        }
    }

    function delete_experience($experience_id) {
        $data['experience'] = $this->user_profile_model->get_experience($experience_id);
        if($data['experience']['user_id'] != $this->session->userdata('user_id')) { //$this->session->userdata('user_id')
            echo json_encode(array(
                    'response' => FALSE,
                    'message' => "The experience can't be deleted. Please try again later."
                ));
        } else {
            $table = 'tbl_experience';
            $this->helper_model->delete_from_table($experience_id, $table);
            echo json_encode(array(
                    'response' => TRUE,
                ));
        }
    }

    function qualification(){
        $data['qualification'] = $this->user_profile_model->get_jobseeker_qualification($this->session->userdata('user_id'));
        $data["title"] = "Your Qualifications";
        $data["page"] = "member/jobseeker/qualification/list";
        $this->template->partial->view("user_layout", $data, $overwrite=FALSE);
        $this->template->publish('user_layout');
    }

    function add_qualification() {
        $this->form_validation->set_rules('degree', "Degree",'required|xss_clean');
        $this->form_validation->set_rules('institution', "institution",'required|xss_clean');
        $this->form_validation->set_rules('completion_date', "Completion Date",'required|xss_clean');
        $this->form_validation->set_rules('gpa_pct', "GPA/Percentage",'required|xss_clean');
        if($this->form_validation->run()==FALSE) {
           $data["page"] = "member/jobseeker/qualification/add";
           $data["title"] = "Add Your Qualifications";
           $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
           $this->template->publish('user_layout');

        } else {
            if($this->user_profile_model->add_qualification()) {
                $this->session->set_userdata( 'user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Qualification Added Successfully');
                redirect('user_profile/qualification');
            } else {
                $this->session->set_userdata( 'user_flash_msg_type', "danger" );
                $this->session->set_flashdata('user_flash_msg', 'Sorry, Unable to Added Qualification');
                $data["page"] = "member/jobseeker/qualification/add";
                $data["title"] = "Add Your Qualifications";
                $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
                $this->template->publish('user_layout');
            }
        }
    }

    function edit_qualification($id) {
        $data["row"] = $this->user_profile_model->get_qualification_by_id($id);
        if($data['row']['user_id'] != $this->session->userdata('user_id')) { //$this->session->userdata('user_id')
            show_404();
            exit;
        }
        $this->form_validation->set_rules('degree', "Degree",'required|xss_clean');
        $this->form_validation->set_rules('institution', "institution",'required|xss_clean');
        $this->form_validation->set_rules('completion_date', "Completion Date",'required|xss_clean');
        $this->form_validation->set_rules('gpa_pct', "GPA/Percentage",'required|xss_clean');
        if($this->form_validation->run()==FALSE) {
            $user_id = $this->session->userdata('user_id');
            $data["page"] = "member/jobseeker/qualification/edit";
            $data["title"] = "Edit Qualification";
            $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
            $this->template->publish('user_layout');

        } else {
            if($this->user_profile_model->update_qualification($id,$this->session->userdata('user_id'))) {
                $this->session->set_userdata( 'user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Qualification Edited Successfully');
                redirect('user_profile/qualification');
            } else {
                $this->session->set_userdata( 'user_flash_msg_type', "danger" );
                $this->session->set_flashdata('user_flash_msg', 'Sorry, Unable to Edited Qualification');
                $data["page"] = "member/jobseeker/qualification/edit";
                $data["title"] = "Edit Qualification";
                $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
                $this->template->publish('user_layout');
            }
        }
    }

    function delete_qualification($qualification_id) {
        $data['qualification'] = $this->user_profile_model->get_qualification_by_id($qualification_id);
        if($data['qualification']['user_id'] != $this->session->userdata('user_id')) { //$this->session->userdata('user_id')
            echo json_encode(array(
                    'response' => FALSE,
                    'message' => "The qualification can't be deleted. Please try again later."
                ));
        } else {
            $table = 'tbl_qualification';
            $this->helper_model->delete_from_table($qualification_id, $table);
            echo json_encode(array(
                    'response' => TRUE,
                ));
        }
    }

    function upload_resume() {
        $this->form_validation->set_rules('title','Title','xss_clean');
        $this->form_validation->set_rules('resume','Resume','xss_clean|callback_validate_resume');
        $id = $this->session->userdata('user_id');

        if($this->form_validation->run()==FALSE) {
            if(isset($_POST['resume']) && file_exists("./uploads/user/resume/".$id.'/'.$_POST['resume'])) {
                @unlink("./uploads/user/resume/".$id.'/'.$_POST['resume']);
            }
            $data["page"] = "member/jobseeker/upload_resume";
            $data["title"] = "Upload Resume";
            $this->template->partial->view("default_layout", $data, $overwrite=FALSE);
            $this->template->publish('user_layout');
        } else {
            $user_data = $this->user_profile_model->get_jobseeker_details($id);
            if(!empty($user_data['resume']) || $user_data['resume']!="") {
                @unlink("./uploads/user/resume/".$id.'/'.$user_data['resume']);
            }
            $this->user_profile_model->upload_resume($id);
            $this->session->set_userdata( 'user_flash_msg_type', "success" );
            $this->session->set_flashdata('user_flash_msg', 'Resume addded successfully');
            redirect(base_url().'User_profile/jobseeker_details', 'refresh');
        }
         
    }

    function validate_resume() {
        if(isset($_FILES['resume']) && !empty($_FILES['resume']['name'])) {
            $id = $this->session->userdata('user_id');
            $dir= 'uploads/user/resume/'.$id.'/';

            if(!is_dir($dir)){
                mkdir($dir,0777,true);
            }

            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'txt|pdf|docx';
            $config['max_size'] = '100000';

            $this->load->library('upload', $config);
            $this->upload->display_errors();

            if ($this->upload->do_upload('resume')) {
                $upload_data = $this->upload->data();
                $_POST['resume'] = $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('validate_resume', "<div style='color:red'>" . $this->upload->display_errors() . "</div>");
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
            $this->form_validation->set_message('validate_resume', "You must select a file to upload.");
            return false;

        }
    }

}