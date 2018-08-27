<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ggroupuser_model extends CI_Model {
    public $id;
    public $groupname;
    public $description;
    public $ion;
    public $iby;
    public $uon;
    public $uby;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('paging');
        $this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
    }
    
    public function get_alldata()
    {
        $query = $this->db->get('g_groupuser');
        return $query->result();
    }

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('g_groupuser');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }

    public function get_datapages($page, $pagesize, $search = null)
    {
        
        $this->db->select('*');
        $this->db->from('g_groupuser');
        if(!empty($search))
        {
            $this->db->like('GroupName', $search);
        }
        $this->db->order_by('IOn','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

    }

    public function get_role($groupid)
    {
        $this->db->select('*');
        $this->db->from('view_m_accessrole');
        $this->db->where('GroupId', $groupid);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function save_data($data)
    {
        $this->db->insert('g_groupuser', $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('g_groupuser', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        $this->db->delete('g_groupuser');
    }

    public function save_role($data)
    {
        $this->db->select('*');
        $this->db->from('m_accessrole');
        $this->db->where('GroupId', $data['groupid']);
        $this->db->where('FormId', $data['formid']);
        $query = $this->db->get()->row();
        if($query)
        {
            $this->db->where('GroupId', $data['groupid']);
            $this->db->where('FormId', $data['formid']);
            $this->db->update('m_accessrole', $data);
        }
        else
        {
            $this->db->insert('m_accessrole', $data);
        }
    }

    public function create_object($id, $groupname, $description, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'groupname' => $groupname,
            'description' => $description,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function create_object_role_tabel($groupid, $formid, $read, $write, $delete, $print)
    {
        $data = array(
            'groupid' => $groupid,
            'formid' => $formid,
            'read' => $read,
            'write' => $write,
            'delete' => $delete,
            'print' => $print
        );

        return $data;
    }

    public function create_object_role($groupid, $formid, $formname, $aliasname, $read, $write, $delete, $print)
    {
        $data = array(
            'groupid' => $groupid,
            'formid' => $formid,
            'formname' => $formname,
            'aliasname' => $aliasname,
            'read' => $read,
            'write' => $write,
            'delete' => $delete,
            'print' => $print
        );

        return $data;
    }

    public function is_data_exist($groupname = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('g_groupuser');
        $this->db->where('GroupName', $groupname);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null)
    {
        $nameexist = false;
        $warning = array();
        $resource = $this->set_resources();
        if(!empty($oldmodel))
        {
            if($model['groupname'] != $oldmodel['groupname'])
            {
                $nameexist = $this->is_data_exist($model['groupname']);
            }
        }
        else{
            if(!empty($model['groupname']))
            {
                $nameexist = $this->is_data_exist($model['groupname']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_group_name_can_not_null']));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>$resource['res_err_name_exist']));
        }
        
        return $warning;
    }

    
    public function has_role($groupid, $formid, $role)
    {
        $permitted = false;
        $this->db->select('*');
        $this->db->from('m_accessrole');
        $this->db->where('GroupId', $groupid);
        $this->db->where('FormId', $formid);
        $this->db->where($role, 1);
        $query = $this->db->get();
        $result = $query->row();
        if($result)
        {
            $permitted = true;
        }

        return $permitted;
    }

    public function is_permitted($groupid, $formid, $role)
    {
        $permitted = false;
        if($this->paging->is_superadmin($_SESSION['userdata']['username'])
            ||  $this->has_role($groupid,$formid,$role)
        )
        {
            $permitted = true;
        }
        return $permitted;
    }


    public function set_resources()
    {
        $resource['res_master_groupuser'] = $this->lang->line('ui_master_groupuser');
        $resource['res_groupuser'] = $this->lang->line('ui_groupuser');
        $resource['res_data'] =  $this->lang->line('ui_data');
        $resource['res_add'] =  $this->lang->line('ui_add');
        $resource['res_name'] =$this->lang->line('ui_name');
        $resource['res_description'] = $this->lang->line('ui_description');
        $resource['res_edit'] = $this->lang->line('ui_edit');
        $resource['res_delete'] =$this->lang->line('ui_delete');
        $resource['res_search'] = $this->lang->line('ui_search');
        $resource['res_save'] = $this->lang->line('ui_save');
        $resource['res_add_data'] = $this->lang->line('ui_add_data');
        $resource['res_edit_data'] = $this->lang->line('ui_edit_data');
        $resource['res_role'] = $this->lang->line('ui_role');
        $resource['res_read'] = $this->lang->line('ui_read');
        $resource['res_write'] = $this->lang->line('ui_write');
        $resource['res_print'] = $this->lang->line('ui_print');
        $resource['res_module'] = $this->lang->line('ui_module');

        $resource['res_err_name_exist'] = $this->lang->line('err_msg_name_exist');
        $resource['res_msg_group_name_can_not_null'] = $this->lang->line('err_msg_groupname_can_not_null');

        return $resource;
    }
    
}