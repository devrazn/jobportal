<?php

class Newsletter extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/newsletter_model');
        if(!$this->helper_model->validate_admin_session()){
          redirect(base_url() . 'admin');
        }

    }

    public function index() {
        $this->cms_newsletter();
    }


    function cms_newsletter() {
        $config['base_url'] = site_url(ADMIN_PATH . '/newsletter/page');
        $data['main'] = 'admin/newsletter/list';
        $query = $this->db->get('tbl_newsletter');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['newsletter_list'] = $this->newsletter_model->newsletter_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'Newsletter';

        $this->load->view('admin/admin', $data);
    }

    function add() {
        $this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');
         $this->form_validation->set_rules('content', 'Content', 'required|xss_clean');
        $this->helper_model->editor();

        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'admin/newsletter/add';
            $data['title'] = 'Add newsletter';
            $this->load->view('admin/admin', $data);
        } else {
            $this->newsletter_model->add_newsletter();
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Newsletter Added Successfully');
            redirect(ADMIN_PATH . '/newsletter', 'refresh');
        }
    }

    function edit($id) {
        $this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');
        $this->helper_model->editor();

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->newsletter_model->get_newsletter($id);
            $data['main'] = 'admin/newsletter/edit';
            $data['title'] = 'Edit newsletter';
            $this->load->view('admin/admin', $data);
        } else {
            $this->newsletter_model->update_newsletter($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Newsletter Updated Successfully');
            redirect(ADMIN_PATH . '/newsletter', 'refresh');
        }
    }

    function delete_newsletter($id) {
        $this->newsletter_model->delete_newsletter($id);
        $this->session->set_userdata( 'flash_msg_type', "success" );
        $this->session->set_flashdata('flash_msg', 'Newsletter Deleted Successfully.');
        redirect(ADMIN_PATH . '/newsletter', 'refresh');
    }

    public function change_status($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_newsletter', $options, 1);
        $det=$query->row_array();
                
        if ($det['status'] === '1') {
            $status = '0';
            $txt="Inactive";
        } elseif ($det['status'] === '0') {
            $status = '1';
            $txt="Active";
        }

        $data = array('status' => $status);
        $this->db->where('id', $id);
        $this->db->update('tbl_newsletter', $data);
        echo $txt;
    }

    function send_newsletter($id) {
        $this->load->model('admin/settings_model');
        //$data['mail_settings']=$this->settings_model->get_email_settings();
        $mail_settings = $this->settings_model->get_email_settings();
        $this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean|trim');
        $this->form_validation->set_rules('receiver_options', 'Receiver', 'required|xss_clean|trim');

        if($this->input->post('receiver_options')=='1') {
            $this->form_validation->set_rules('receiver', 'Receiver Email', 'required|xss_clean|trim|valid_email|callback_validate_receiver');
        }

        $this->form_validation->set_rules('content', 'Content', 'required|xss_clean');

        $this->helper_model->editor();

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->newsletter_model->get_newsletter($id);
            $data['title'] = 'Send Newsletter';
            $data['main'] = 'admin/newsletter/send_newsletter';
            $this->load->view('admin/admin', $data);
        } else {
            if($this->input->post('receiver_options')=='1') {
                $to = $this->input->post('receiver');
            } else  {
                $receivers = $this->newsletter_model->get_receivers();
                //echo '<pre>',print_r($receivers,1),'</pre>';
                foreach($receivers as $receiver) {
                    $emails[] = $receiver["email"];
                }
                // echo '<pre>',print_r($emails,1),'</pre>'; exit;
            }
            $mail_params = array(
                                "subject" => $this->input->post('subject'),
                                "message" => $this->input->post('content'),
                                "to" => $emails
                            );
            if($this->helper_model->send_email($mail_settings, $mail_params)){
                $this->session->set_userdata( 'flash_msg_type', "success" );
                $this->session->set_flashdata('flash_msg', 'Newsletter Sent Successfully.');
                redirect(ADMIN_PATH . '/newsletter/send_newsletter' . '/' .$id, 'refresh');
            } else {
                $this->session->set_userdata( 'flash_msg_type', "danger" );
                $this->session->set_flashdata('flash_msg', "Newsletter Can't be sent. Please try again later. Click <a target='_blank' href='" . base_url('admin/error_log') . "'>here</a> to view the error log.");
                redirect(ADMIN_PATH . '/newsletter/send_newsletter' . '/' .$id, 'refresh');
            }
        }
    }


    function validate_receiver() {
        if($this->newsletter_model->verify_receiver()){
            return true;
        } else {
            $this->form_validation->set_message('validate_receiver', 'Incorrect Receiver Email');
            return false;
        }
    }



}
