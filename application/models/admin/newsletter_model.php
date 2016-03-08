<?php

class Newsletter_model extends CI_Model {	
		
	function __construct() {
       
    }

    function add_newsletter() {
        $data = array('subject' => $this->input->post('subject'),
                      'content' => $this->input->post('content'),
                      'status' => $this->input->post('status')
        );
        $this->db->insert('tbl_newsletter', $data);
    }

    function newsletter_list($per_page, $offset = '1') {
        $this->db->where('del_flag', 0);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get('tbl_newsletter');
        return $query->result_array();
    }

    function get_newsletter($id) {
        $options = array('id' => $id);
        $query = $this->db->get_where('tbl_newsletter', $options, 1);
        return $query->row_array();
    }

    function update_newsletter($id) {
        $data = array('subject' => $this->input->post('subject'),
                      'content' => $this->input->post('content'),
                      'status' => $this->input->post('status')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_newsletter', $data);
    }

    function delete_newsletter($id) {
        $sql ="Update tbl_newsletter set del_flag=1 where id='$id'";
        $this->db->query($sql);
    }

    function change_status($status, $id) {
        if ($status === '1')
            $status = '0';
        else if ($status === '0')
            $status = '1';

        $data = array(
            'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_newsletter', $data);
    }


    function get_receivers() {
        $options = array('newsletter_subscription' => '1',
                            'del_flag' => '0');
        if($this->input->post('receiver_options')=='3') {
            $options += ['user_type' => '0'];
        } else if($this->input->post('receiver_options')=='4') {
            $options += ['user_type' => '1'];
        } else if($this->input->post('receiver_options')=='5') {
            $options += ['status' => '1'];
        } else if($this->input->post('receiver_options')=='6') {
            $options += ['status' => '0'];
        } 
        $this->db->select('email');
        return $this->db->get_where('tbl_users', $options)->result_array();
    }


    function verify_receiver(){
        $options = array('email' => $this->input->post('receiver'),
                        'newsletter_subscription' => '1',
                        'del_flag' => '0');
        $query = $this->db->get_where('tbl_users', $options, 1);
        if($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
