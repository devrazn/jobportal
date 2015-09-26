<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_settings');
        $this->load->library('form_validation');
        $this->helper_model->validate_session();

    }

    public function index() {
        
        $this->site_settings();
    }


    public function site_settings() {

        $this->load->view('admin/site_settings');
    }

}
