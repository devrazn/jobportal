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
        //$this->cms_category();
    }


    function datatable() {
        //$this->datatables->where('id', '5');
        $this->datatables->select('id,name,status')
            ->from('tbl_job_category')
            ->where('del_flag', '0');
        $this->datatables->add_column('edit', '<a href="category/edit/$1/" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success" data-original-title="Edit"><i class="fa fa-pencil"></i></a>', 'id');
        $this->datatables->add_column('delete', '<div class=""><a onClick="return doConfirm()" class="delete btn btn-effect-ripple btn-xs btn-warning" href="category/delete_category/$1" data-original-title="Delete"><i class="fa fa-times"></i></a></div>', 'id');
        //if()
        $this->datatables->edit_column('status', '$1 :: <a href="category/change_status/$2/$3">$4</a>', 'ucfirst(status), status, id, Change Status');
        $this->datatables->unset_column('id');
        
        echo $this->datatables->generate();
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
        //$category = $this->helper_model->get_category();
        //echo json_encode($category); exit;
        //$data['category_list'] = $this->category_model->category_list();
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('parent_id', 'Parent Category', 'trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('parent', 'Parent Category', 'required')

       /* $refs = array();
        $list = array();

        $sql = "SELECT id, parent_id, name FROM items ORDER BY name";
        $result = mysqli_query($sql);
        while($data = @mysql_fetch_assoc($result)) {
            $thisref = &$refs[ $data['id'] ];

            $thisref['parent_id'] = $data['parent_id'];
            $thisref['name'] = $data['name'];

            if ($data['parent_id'] == 0) {
                $list[ $data['id'] ] = &$thisref;
            } else {
                $refs[ $data['parent_id'] ]['children'][ $data['id'] ] = &$thisref;
            }
        }*/

        //echo $list; exit;

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
        $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

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

        $data['is_childable'] = $this->category_model->is_childable($category_id);
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean|callback__matches_existing_category['.$category_id.']');
        $this->form_validation->set_rules('parent_id', 'Parent Category', 'xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['info'] = $this->category_model->get_category($category_id);
            $data['main'] = 'admin/category/edit';
            $data['title'] = 'Edit Category';
            $this->load->view('admin/admin', $data);
        } else {
            if($data['is_childable']) {
                $parent_id = $this->input->post('parent_id');
            } else {
                $parent_id=0;
            }
            $this->category_model->update_category($category_id, $parent_id);
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
                    'msg' => 'Category successfully deleted'
                ));
        } else {
            echo json_encode(array(
                    'response' => FALSE,
                    'title' => "failure",
                    'msg' => 'You cannot delete this category until there are jobs & sub-categories under it.'
                ));
        }
    }


    function change_status($status = '', $id = '') {
        $this->category_model->change_status(strtolower($status), $id);
        redirect(ADMIN_PATH . '/category', 'refresh');
    }


    function change_status_ajax($status = '', $id = '') {
        //($status)? $status = 0 : $status = 1;
        if($status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $this->category_model->change_status($status, $id);
        echo $status;
    }

}
