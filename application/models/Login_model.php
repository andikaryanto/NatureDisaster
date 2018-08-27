<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function do_logged_in($username, $password)
    {
        $data = $this->get_sigle_data_user($username, $password);
        $row = $data->row();
        if (isset($row)){
            return true;
        } else{
            return false;
        }
    }

    public function get_sigle_data_user($username, $password)
    {
        $query = $this->db->get_where('m_user', array('UserName' => $username, "Password" => $password));
        return $query;
    }

    public function is_logged_in()
    {
        $isloggedin = false;
        if(!empty($_SESSION['userdata']))
        {
            $isloggedin = true;
        }

        return $isloggedin;
    }
}