<?php

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/user_model');
        $this->load->library('form_validation');
        $this->load->model('admin/category_model');
        $this->helper_model->validate_session();

    }

    public function index() {
        $this->cms_user();
    }

    function cms_user() {
        $config['base_url'] = site_url(ADMIN_PATH . '/user/page');
        $data['main'] = 'admin/user/list';
        $query = $this->db->get('tbl_users');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['user_list'] = $this->user_model->user_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'Users';

        $this->load->view('admin/admin', $data);
    }

    function edit($id) {
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
        $this->form_validation->set_rules('f_name', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rules('l_name', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        $this->form_validation->set_rules('dob_estd', 'Establised', 'required|xss_clean');
        $this->form_validation->set_rules('company_type', 'Company Type', 'required|xss_clean');
        $this->form_validation->set_rules('profile', 'Profile', 'required|xss_clean');
        $this->form_validation->set_rules('benefits', 'Benefits', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
        //$this->form_validation->set_rules('feature_in_slider', 'Feature in slider', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->user_model->get_user($id);
            $data['main'] = 'admin/user/edit';
            $data['title'] = 'Edit user';
            $this->load->view('admin/admin', $data);
        } else {
            $this->user_model->update_user($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'User Updated Successfully');
            redirect(ADMIN_PATH . '/user', 'refresh');
        }
    }


    function change_status($status = '', $id = '') {
        if($this->user_model->change_status($status, $id)){
            echo 'success';
        } else {
            echo 'failure';
        }
    }


    function update_employer() {
        if($this->user_model->update_employer()){
            echo 'success';
        } else {
            echo 'failure';
        }
    }


    public function details($id) {
        $this->load->model('admin/settings_model');
        $data['mail_settings']=$this->settings_model->get_email_settings();
        $data['user_info'] = $this->user_model->get_user($id);
        //echo json_encode($data['user_type']); exit;

        //$this->helper_model->editor();

        if($data['user_info']['user_type']==0) {
            //echo json_encode($data['user_info']['user_type']); exit;
            //echo json_encode($data['user_info']['user_type']); exit;
            $data['title'] = 'User Details';
            $data['qualification'] = $this->user_model->get_qualification($id);
            $data['experience'] = $this->user_model->get_experience($id);
            $data['main'] = 'admin/user/user_details';
        } else if ($data['user_info']['user_type']==1) {
            //echo json_encode($data['user_info']['user_type']) . " else if"; exit;
            $data['title'] = 'Employer Details';
            $data['jobs'] = $this->user_model->get_jobs($id);
            $data['main'] = 'admin/user/employer_details';
        } else {
        }

        $this->load->view('admin/admin', $data);
    }


    public function check_user_type($id) {
        $options = array('id' => '1',
                        'del_flag' => '0');
        $this->db->select('user_type');
        return $this->db->get_where('tbl_users', $options)->row_array();
    }


    public function send_email() {
        $this->form_validation->set_rules('receiver_email', 'Receiver', 'required|xss_clean|valid_email|callback_validate_receiver');
        $this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');
        $this->form_validation->set_rules('content', 'Content', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'error_title' => 'validation_error',
                'error_description' => "<p style='color:red'>Please fill all the required fields correctly.</p>",
                'subject' => form_error('subject'),
                'content' => form_error('content'),
                'receiver_email' => form_error('receiver_email'),

            ));
        } else {
            $this->load->model('admin/settings_model');
            $mail_settings = $this->settings_model->get_email_settings();
            $mail_params = array(
                        'to' => $this->input->post('receiver_email'),
                        'subject' => $this->input->post('subject'),
                        'message' => $this->input->post('content'),
                );
            if($this->helper_model->send_email($mail_settings, $mail_params)) {
                echo json_encode(array(
                    'error_msg' => 'Email Sent Successfully.',
                    'error_title' => 'success'
                ));
            } else {
                echo json_encode(array(
                    'error_msg' => 'Email sending failed. Please try again later.',
                    'error_log' => $this->session->userdata('error_log'),
                    'error_title' => 'email_error'
                ));
            }
        }

    }


    function validate_receiver() {
        if($this->user_model->verify_receiver()){
            return true;
        } else {
            $this->form_validation->set_message('validate_receiver', 'Incorrect Receiver Email');
            return false;
        }
    }


    function update_qualification_status() {
        if($this->user_model->update_qualification_status()) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }


    function update_experience_status() {
        if($this->user_model->update_experience_status()) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }


    function update_job_status_and_procedure() {
        if($this->user_model->update_job_status_and_procedure()) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }


    function update_application_procedure() {
        if($this->user_model->update_application_procedure()) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }

}
