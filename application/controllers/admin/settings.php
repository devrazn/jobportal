<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/settings_model');
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->helper_model->validate_session();
    }

    public function index() {
        //echo 1; exit;
        $this->site_settings();
    }


    public function site_settings() {
        $this->form_validation->set_rules('site_name', 'Site Name', 'required|xss_clean|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('site_title', 'Site Title', 'xss_clean');
        $this->form_validation->set_rules('site_slogan', 'Site Title', 'xss_clean');
        $this->form_validation->set_rules('site_email', 'Site Title', 'required|xss_clean');
        $this->form_validation->set_rules('facebook', 'Facebook Link', 'xss_clean');
        $this->form_validation->set_rules('twitter', 'Twitter Link', 'xss_clean');
        $this->form_validation->set_rules('youtube', 'Youtube', 'xss_clean');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'xss_clean');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'xss_clean');
        $this->form_validation->set_rules('site_authors', 'Site Authors', 'xss_clean');
        $this->form_validation->set_rules('site_status', 'Site Status', 'xss_clean');
        $this->form_validation->set_rules('prev_image', 'Previous Image', 'xss_clean');
        $this->form_validation->set_rules('site_offline_msg', 'Site Offline Message', 'required|xss_clean');

        $this->helper_model->editor();
        

        if ($this->form_validation->run() == FALSE) {        
            $data['info'] = $this->settings_model->get_site_settings();
            $data['main'] = 'admin/site_settings';
            $data['title'] = 'Site Settings';

            $this->load->view('admin/admin', $data);
        } else {
            $uploaded_details = $this->upload_image('logo');
            if ($uploaded_details['file_name'] != '') {
                $image = $uploaded_details['file_name'];
                //echo ("./uploads/admin/images/" . $this->input->post('prev_image')); exit;
                if (file_exists("./uploads/admin/images/" . $this->input->post('prev_image'))){
                    //echo (base_url()."uploads/admin/images/" . $this->input->post('prev_image')); exit;
                    @unlink("./uploads/admin/images/" . $this->input->post('prev_image'));
                }
            } else {
                $image = $this->input->post('prev_image');
            }

            if($this->settings_model->update_site_settings($image)) {
                $this->session->set_userdata( 'flash_msg_type', "success" );
                $this->session->set_flashdata('flash_msg', 'Site Settings Updated Successfully');
                redirect(ADMIN_PATH . '/settings/site_settings', 'refresh');
            } else {
                $this->session->set_userdata( 'flash_msg_type', "danger" );
                $this->session->set_flashdata('flash_msg', 'Sorry, Unable to Update Settings');
                redirect(ADMIN_PATH . '/settings/change_password', 'refresh');
            }
        }
    }


    function upload_image($file) {

        $config['upload_path'] = './uploads/admin/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000000';
        $config['max_width'] = '1000';
        $config['max_height'] = '768';
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        //var_dump($file); exit;
        $this->upload->do_upload($file);
        if ($this->upload->display_errors()) {
            $this->error = $this->upload->display_errors();
            //echo $this->error; exit;
            return true;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }


    public function change_password() {
        $this->form_validation->set_rules('cPassword', 'Current Password', 'required|xss_clean|callback_verify_current_pass');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[6]|max_length[64]');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|xss_clean|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'admin/change_password';
            $data['title'] = 'Change Password';
            $this->load->view('admin/admin', $data);
        } else {
            $password = $this->helper_model->encrypt_me($this->input->post('password'));
            if($this->settings_model->update_password($password)) {
                $this->session->set_userdata( 'flash_msg_type', "success" );
                $this->session->set_flashdata('flash_msg', 'Password Changed Successfully');
                redirect(ADMIN_PATH . '/settings/change_password', 'refresh');
            } else {
                $this->session->set_userdata( 'flash_msg_type', "danger" );
                $this->session->set_flashdata('flash_msg', 'Sorry, Unable to Change the Password');
                redirect(ADMIN_PATH . '/settings/change_password', 'refresh');
            }
        }
    }


    public function verify_current_pass() {
        if($this->settings_model->verify_current_pw()) {
            return true;
        } else {
            $this->form_validation->set_message('verify_current_pass','Current Password Incorrect');
            return false;
        }
    }



    public function index2() {
    // $path = base_url().'js/ckfinder';
    $path = '../js/ckfinder';
    $width = '850px';
    $this->editor($path, $width);
    $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('welcome_message');
    }
    else {
      // do your stuff with post data.
      echo $this->input->post('description');
    }
  }
  function editor($width='') {
    $path = base_url().'assets/ckeditor/ckfinder';
    //Loading Library For Ckeditor
    $this->load->library('ckeditor');
    $this->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $this->ckeditor->basePath = base_url().'js/ckeditor/';
    $this->ckeditor-> config['toolbar'] = 'Full';
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }


}
