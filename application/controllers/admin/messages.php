<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages extends CI_Controller {

    function __construct() {
		parent::__construct();
        if(!$this->helper_model->validate_admin_session()){
          redirect(base_url() . 'admin');
        }
		$this->load->model('admin/messages_model');
	}


	public function index(){
		$this->get_messages();
	}

	
	public function get_messages(){
		$data['messages'] = $this->messages_model->get_messages();
        $data['title'] = 'User Messages';
        $data['main'] = 'admin/user_messages/list';
        $this->load->view('admin/admin', $data);
	}

	public function delete_message($id){
		//$this->messages_model->delete_message($id);
		
		if($this->messages_model->delete_message($id)){
			$this->session->set_userdata( 'flash_msg_type', "success" );
        	$this->session->set_flashdata('flash_msg', 'Message Deleted Successfully.');
		} else {
			$this->session->set_userdata( 'flash_msg_type', "warning");
        	$this->session->set_flashdata('flash_msg', "Message can't be deleted.");
		}
		redirect(ADMIN_PATH . '/messages', 'refresh');
	}


	public function details($id){
		$this->messages_model->update_read_status($id);
		$data['message'] = $this->messages_model->get_message_details($id);
        //$data['title'] = 'Message - ' . $data['message']['subject'];
        $data['main'] = 'admin/user_messages/details';
        $this->load->view('admin/admin', $data);
	}


	public function reply(){
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
        $this->form_validation->set_rules('content', 'Message', 'required|xss_clean');
        if($this->form_validation->run()==FALSE){
        	echo json_encode(array(
                'status' => 'validation_error',
                'message' => 'Please enter the required fields correctly.',
                'subject' => form_error('subject'),
                'content' => form_error('content'),
			));
        } else {
        	$this->load->model('admin/settings_model');
            $mail_settings = $this->settings_model->get_email_settings();
            $mail_params = array(
                        'to' => $this->input->post('email'),
                        'subject' => $this->input->post('subject'),
                        'message' => $this->input->post('content'),
                );
        	if($this->helper_model->send_email($mail_settings, $mail_params)) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Email successfully sent.'
                ));
            } else {
                echo json_encode(array(
                	'status' => 'unknown_error',
                    'message' => 'Email sending failed. Please try again later.',
                    'error_log' => $this->session->userdata('error_log'),
                ));
            }
        }
	}


}