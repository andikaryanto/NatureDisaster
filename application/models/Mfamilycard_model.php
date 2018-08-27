<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mfamilycard_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
    }

    public function get_alldata()
    {
        $this->db->select('a.*, b.Name as VillageName, c.Name As SubcityName, d.Name as CityName, e.Name as ProvinceName');
        $this->db->from('m_familycard a');
        $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    
    public function get_data_by_id($id)
    {
        
        $this->db->select('a.*, b.Name as VillageName, c.Name As SubcityName, d.Name as CityName, e.Name as ProvinceName');
        $this->db->from('m_familycard a');
        $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        $this->db->where('a.Id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    

    
    public function get_data_by_cardno($cardno)
    {
        
        $this->db->select('a.*, b.Name as VillageName, c.Name As SubcityName, d.Name as CityName, e.Name as ProvinceName');
        $this->db->from('m_familycard a');
        $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        $this->db->where('a.CardNo', $cardno);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_datapages($page, $pagesize, $search = null)
    {
        
        $this->db->select('a.*, b.Name as VillageName, c.Name As SubcityName, d.Name as CityName, e.Name as ProvinceName');
        $this->db->from('m_familycard a');
        $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        if(!empty($search))
        {
            $this->db->like('a.CardNo', $search);
            $this->db->or_like('a.HeadFamilyName', $search);
        }
        $this->db->order_by('a.IOn','a.ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

    }

    public function save_data($data)
    {
        $this->db->insert('m_familycard', $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('m_familycard', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        $this->db->delete('m_familycard');
    }

    public function create_object_tabel($id, $cardno, $headfamilyname, $villageid, $address, $rt, $rw, $postcode, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'cardno' => $cardno,
            'headfamilyname' => $headfamilyname,
            'villageid' => $villageid,
            'address' => $address,
            'rt' => $rt,
            'rw' => $rw,
            'postcode' => $postcode,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function create_object($id, $cardno, $headfamilyname, $villageid ,$villagename, $subcityname, $cityname, $provincename, $address, $rt, $rw, $postcode, $ion, $iby, $uon, $uby)
    { 
        $data = array(
            'id' => $id,
            'cardno' => $cardno,
            'headfamilyname' => $headfamilyname,
            'villageid' => $villageid,
            'villagename' => $villagename,
            'subcityname' => $subcityname,
            'cityname' => $cityname,
            'provincename' => $provincename,
            'address' => $address,
            'rt' => $rt,
            'rw' => $rw,
            'postcode' => $postcode,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function is_data_exist($cardno = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_familycard');
        $this->db->where('CardNo', $cardno);
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
            if($model['cardno'] != $oldmodel['cardno'])
            {
                $nameexist = $this->is_data_exist($model['cardno']);
            }
        }
        else{
            if(!empty($model['cardno']))
            {
                $nameexist = $this->is_data_exist($model['cardno']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_cardno_can_not_null']));
            }
        }

        if($nameexist === true)
        {
            $warning = array_merge($warning, array(0=>$resource['res_err_cardno_exist']));
        }
        
        return $warning;
    }

    public function set_resources()
    {
        $resource['res_master_familycard'] = $this->lang->line('ui_master_familycard');
        $resource['res_cardno'] = $this->lang->line('ui_cardno');
        $resource['res_address'] = $this->lang->line('ui_address');
        $resource['res_familycard'] = $this->lang->line('ui_familycard');
        $resource['res_postcode'] = $this->lang->line('ui_postcode');
        $resource['res_headfamilyname'] = $this->lang->line('ui_headfamilyname');
        $resource['res_village'] = $this->lang->line('ui_village');
        $resource['res_subcity'] = $this->lang->line('ui_subcity');
        $resource['res_city'] = $this->lang->line('ui_city');
        $resource['res_province'] = $this->lang->line('ui_province');
        $resource['res_data'] =  $this->lang->line('ui_data');
        $resource['res_add'] =  $this->lang->line('ui_add');
        $resource['res_name'] =$this->lang->line('ui_name');
        $resource['res_description'] = $this->lang->line('ui_description');
        $resource['res_edit'] = $this->lang->line('ui_edit');
        $resource['res_delete'] =$this->lang->line('ui_delete');
        $resource['res_search'] = $this->lang->line('ui_search');
        $resource['res_save'] = $this->lang->line('ui_save');
        $resource['res_add_data'] = $this->lang->line('ui_add_data');
        $resource['res_add_detail_data'] = $this->lang->line('ui_add_detail_data');
        $resource['res_edit_data'] = $this->lang->line('ui_edit_data');
        $resource['res_gender'] = $this->lang->line('ui_gender');
        $resource['res_dateofbirth'] = $this->lang->line('ui_dateofbirth');
        $resource['res_placeofbirth'] = $this->lang->line('ui_placeofbirth');
        $resource['res_religion'] = $this->lang->line('ui_religion');
        $resource['res_male'] = $this->lang->line('ui_male');
        $resource['res_female'] = $this->lang->line('ui_female');
        $resource['res_lasteducation'] = $this->lang->line('ui_lasteducation');
        $resource['res_job'] = $this->lang->line('ui_job');
        $resource['res_married'] = $this->lang->line('ui_married');
        $resource['res_divorced'] = $this->lang->line('ui_divorced');
        $resource['res_single'] = $this->lang->line('ui_single');
        $resource['res_father'] = $this->lang->line('ui_father');
        $resource['res_mother'] = $this->lang->line('ui_mother');
        $resource['res_child'] = $this->lang->line('ui_child');
        $resource['res_marriagestatus'] = $this->lang->line('ui_marriagestatus');
        $resource['res_familystatus'] = $this->lang->line('ui_familystatus');
        $resource['res_citizenship'] = $this->lang->line('ui_citizenship');
        $resource['res_fathersname'] = $this->lang->line('ui_fathersname');
        $resource['res_mothersname'] = $this->lang->line('ui_mothersname');
        $resource['res_isheadfamily'] = $this->lang->line('ui_isheadfamily');
        $resource['res_detail_data'] = $this->lang->line('ui_detail_data');
        $resource['res_animal'] = $this->lang->line('ui_animal');
        $resource['res_qty'] = $this->lang->line('ui_qty');

        $resource['res_err_name_exist'] = $this->lang->line('err_msg_name_exist');
        $resource['res_msg_name_can_not_null'] = $this->lang->line('err_msg_name_can_not_null');

        return $resource;
    }
    
}
