<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
		parent::__construct();
			// if($this->config->item('site_status')=='offline')
			// {
			// 	redirect('/site_offline/');
			// 	exit;
	// }
	
	}
	
	 // function menu($id) {

  //       $this->load->model('users/menu_model');
		// $data['categories'] = $this->menu_model->selectCategories($id);
		// $sql="SELECT tax_vat FROM tbl_members WHERE user_id='$id'";
		// $query=$this->db->query($sql);
		// $result=$query->row_array();
		// $data['tax_vat']=$result['tax_vat'];
		

		// $data['categories'] = $this->menu_model->selectCategories($id);
	
		// $this->load->view('menu/menu', $data);
    // }

  //   public function index()
		// {
		// $this->session->set_userdata(array('back_to_page' =>current_url()));  	
		// $data['menu_active']=5;	
		// $data['url']='business';	
		
		// $cms=$this->Helper_model->get_column_by_id('tbl_type','*','id',5);
		// $this->template->set_template('home');
		// $this->template->write('title', $this->config->item('site_title'));
		// $this->template->write('meta_description', $cms['meta_description']);
		// $this->template->write('meta_key_word', $cms['meta_key_word']);
		// $this->template->write_view('content_left', 'type/left',$data);
		// $this->template->write_view('content_right', 'home/right',$data);
		// $this->template->render();
		
    // }
	
	   public function landing()
		{
		$this->load->view('layout/index');
		
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
