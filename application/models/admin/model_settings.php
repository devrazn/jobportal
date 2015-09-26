<?php
class Site_setting_model extends CI_Model {	
		
	function get_site_info($site_id)
	{
		$data=array();
		$options=array('site_id'=>$site_id);

		//$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);

		$query = $this->db->get('tbl_site_setting');
		
		return $query->row();
		
	}
	
	
	function update_site_settings($image='')
	{
		if($image=='')
			$image=$this->input->post('prev_image');
		
		$data=array('site_name'=>$this->input->post('site_name'),
                            'site_title'=>$this->input->post('site_title'),
							 'site_slogan'=>$this->input->post('site_slogan'),
							  'product_per_page'=>$this->input->post('product_per_page'),
							
						    'facebook'=>$this->input->post('facebook'),
					        'twitter'=>$this->input->post('twitter'),
                            'site_offline_msg'=>addslashes($this->input->post('site_offline_msg')),
                            'site_email'=>$this->input->post('site_email'),
                        	'site_meta_desc'=>addslashes($this->input->post('site_meta_desc')),
                            'site_meta_keywords'=>addslashes($this->input->post('site_meta_keywords')),
	                        'site_authors'=>addslashes($this->input->post('site_authors')),
							
							'logo'=>$image,
							
							'slider'=>$this->input->post('slider'),
							
                   			'site_status'=>$this->input->post('site_status'));
		$this->db->where('site_id','1');
		$this->db->update('tbl_site_setting',$data);
		
		//print_r($this->db->last_query());
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */