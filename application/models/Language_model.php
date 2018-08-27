<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Language_model extends CI_Model {

    public function get_alldata()
    {
        $query = $this->db->get('g_language');
        return $query->result();
    }
}