<?php

class Newsletter_model extends CI_Model {	
		
	function __construct() {
       
    }

    function add_newsletter() {
        $data = array('title' => $this->input->post('title'),
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
        $data = array('title' => $this->input->post('title'),
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

    function send_newsletter() {
        $headers = "From: " . $this->input->post('sender') . "\r\n" .
                    "Reply-To: " . $this->input->post('sender') . "\r\n" .
                    'X-Mailer: PHP/' . phpversion() . "\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/html; charset=utf-8\r\n" .
                    "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $subject = $this->input->post('title');
        $emailbody = $this->input->post('content');

        if ($this->input->post('for') == 'selected') {

            @mail($this->input->post('receiver'), $subject, $emailbody, $headers);
        } else {
            foreach ($this->newsletter_subscriber_list($this->input->post('for')) as $subscriber_list) {

                //echo $subscriber_list['email']; exit;
                @mail($subscriber_list['email'], $subject, $emailbody, $headers);
            }
        }
    }
}
