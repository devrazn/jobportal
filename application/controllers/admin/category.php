<?php

class Category extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/category_model');
        if(!$this->helper_model->validate_admin_session()) {
            redirect(base_url().'admin');
        }
    }

    public function index() {
        $data['categories'] = $this->category_model->get_all_categories();
        $data['main'] = 'admin/category/list';
        $data['title'] = 'Categories';
        $this->load->view('admin/admin', $data);
    }


    function cms_category() {
        $config['base_url'] = site_url(ADMIN_PATH . '/category/page');
        $data['main'] = 'admin/category/list';
        $query = $this->db->get('tbl_job_category');
        $config['total_rows'] = $query->num_rows();

        $config['per_page'] = '300';
        $offset = $this->uri->segment(4, 0);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['category_list'] = $this->category_model->category_list($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['title'] = 'Categories';

        $this->load->view('admin/admin', $data);


    }


    function add() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean|is_unique[tbl_job_category.name]');
        $this->form_validation->set_rules('parent_id', 'Parent Category', 'trim|xss_clean');
        $data['parentable_categories'] = $this->category_model->get_parentable_categories();
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'admin/category/add';
            $data['title'] = 'Add Category';
            $this->load->view('admin/admin', $data);
        } else {
            $this->category_model->add_category();
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Category Added Successfully');
            redirect(ADMIN_PATH . '/category', 'refresh');
        }
    }


    function edit($id) {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
        $data['is_childable'] = $this->category_model->is_childable($id);
        if($data['is_childable']) {
            $data['parentable_categories'] = $this->category_model->get_parentable_categories($id);
        }

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->category_model->get_category($id);
            $data['main'] = 'admin/category/edit';
            $data['title'] = 'Edit Category';
            $this->load->view('admin/admin', $data);
        } else {
            $this->category_model->update_category($id);
            $this->session->set_userdata( 'flash_msg_type', "success" );
            $this->session->set_flashdata('flash_msg', 'Category Updated Successfully');
            redirect(ADMIN_PATH . '/category', 'refresh');
        }
    }


    function delete_category_ajax($id) {
        if($this->category_model->delete_category($id)) {
            echo json_encode(array(
                    'response' => TRUE,
                    'title' => "success",
                    'message' => 'Category successfully deleted'
                ));
        } else {
            echo json_encode(array(
                    'response' => FALSE,
                    'title' => "failure",
                    'message' => 'You cannot delete this category until there are jobs & sub-categories under it.'
                ));
        }
    }

}
