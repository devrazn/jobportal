<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This library installs/loads/updates config items from/to database.
 * Application based configurations can be stored and retrieved in bulk.
 * 
 */

/**
 * Description of appconfig
 *
 * @author mrigess
 * @copyright mrigess
 * @name mrigess
 */
class Appconfig {

    private $CI;

    public function __construct() {
        $this->CI = get_instance();
        $this->read_site_settings();
         
    }

    public function __destruct() {
        unset($this->CI);
    }

   

    private function read_site_settings() {
        $query = $this->CI->db->get('tbl_site_settings');
        if ($query->num_rows() > 0) {
            $load = $query->row();
            if(sizeof($load)>0){
                foreach ($load as $item => $value) {
                    $this->CI->config->set_item($item, stripslashes($value));
                }
            }
        }
        
    }
}
?>
