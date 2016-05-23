<?php

class Helper_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'driver' => 'openssl',
                    'mode' => 'ctr'
                )
            );
    }


    public function encrypt_me($data) {
        return $this->encryption->encrypt($data);
    }


    public function decrypt_me($data) {
        return $this->encryption->decrypt($data);
    }

     function get_time_zone_setting() {

        $sql = "SELECT delay,sign FROM tbl_timezone WHERE status='1'";
        $query = $this->db->query($sql);
        $record = $query->row_array();
        $data = $record['delay'] . ":" . $record['sign'];
        $split = explode(":", $data);

        return $split;
    }


    function get_category() {
        $this->db->order_by('parent_id', 'DESC');
        $this->db->select('id, name, parent_id');
        return $this->db->get('tbl_job_category')->result_array();
    }

    function get_category_for_menu() {
        $this->db->select('id, name, parent_id, url');
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tbl_job_category')->result_array();
        
    }


    public function count_admin_new_messages(){
        $options = array('del_flag' => '0',
                            'read_flag' => '0');
        $this->db->where($options);
        return ($this->db->count_all_results('tbl_user_messages'));
    }


    public function validate_user_session(){
        if(($this->session->userdata('user_email') && $this->session->userdata('user_pw')) || isset($_SESSION['tw_status']) || isset($_SESSION['fb_access_token'])) {
            $options = array(
                            'email' => $this->session->userdata('user_email'),
                            );
            $this->db->where($options);
            $this->db->select("password");
            $db_pw = $this->db->get('tbl_users')->row_array();
            if($this->decrypt_me($this->session->userdata('user_pw')) === $this->decrypt_me($db_pw["password"])){
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
    }


    public function check_job_app_status($job_id){
        $options = array(
                    'user_id' => $this->session->userdata('user_id'), 
                    'job_id' => $job_id
                    );
        $this->db->where($options);
        $this->db->from('tbl_user_map_jobs');
        if($this->db->count_all_results() > 0){
            return true;
        } else{
            return false;
        }

    }

    public function is_user_registered($email){
        $options = array(
                    'email' => $email
                    );
        $this->db->where($options);
        $this->db->from('tbl_users');
        if($this->db->count_all_results() > 0){
            return true;
        } else{
            return false;
        }
    }


    public function set_user_login_session($email){
        $user_details = $this->db->get_where('tbl_users', array('email' => $email))->row_array();
        $name = $user_details["f_name"];
        if($user_details["user_type"]==1){
            $name .= " " . $user_details["l_name"];
        }
        //echo '<pre>',print_r($user_details,1),'</pre>'; exit;
        $data = array(
                    'user_email' => $email,
                    'user_pw' => $user_details['password'],
                    'name' => $name,
                    'is_Login' => 1,
                    'user_id' => $user_details["id"],
                    'user_type' => $user_details["user_type"],
                );
        $this->session->set_userdata($data);
        //echo $this->session->userdata('user_id'); exit;
    }


    public function set_admin_login_session($email){
        $admin_details = $this->db->get_where('tbl_admin', array('email' => $email))->row_array();
        //echo '<pre>',print_r($user_details,1),'</pre>'; exit;
        $data = array(
                    'admin_email' => $email,
                    'admin_pw' => $admin_details['password'],
                    'name' => $admin_details['admin_details'],
                    'is_logged_in' => 1,
                    'admin_id' => $admin_details["id"],
                );
        $this->session->set_userdata($data);
    }


    public function validate_admin_session(){
        if($this->session->userdata('admin_email') && $this->session->userdata('admin_pw')) {
            $options = array(
                            'email' => $this->session->userdata('admin_email'),
                            );
            $this->db->where($options);
            $this->db->select("password");
            $db_pw = $this->db->get('tbl_admin')->row_array();
            if($this->decrypt_me($this->session->userdata('admin_pw')) === $this->decrypt_me($db_pw["password"])){
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
    }


    function get_all_categories_except_current($id) {
        $this->db->where('id !=', $id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('tbl_job_category');
        return $query->result_array();
    }


}

?>