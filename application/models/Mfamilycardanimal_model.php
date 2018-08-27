<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mfamilycardanimal_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
    }

    public function get_alldata()
    {
        $this->db->select('f.Id,
                            f.FamilyCardId,
                            f.AnimalId,
                            f.Qty,
                            f.IOn,
                            f.IBy,
                            f.UOn,
                            f.UBy,
                            a.CardNo, 
                            a.Address, 
                            a.RT, 
                            a.RW, 
                            a.PostCode, 
                            b.Name as VillageName, 
                            c.Name As SubcityName, 
                            d.Name as CityName,
                            e.Name as ProvinceName');
        $this->db->from('m_familycardanimal f');
        $this->db->join('m_familycard a', 'a.Id = f.FamilyCardId');
        $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        $this->db->join('m_Animal g', 'g.Id = f.AnimalId', 'left');
        $this->db->order_by('f.IOn', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    
    public function get_data_by_id($id)
    {
        
        $this->db->select('
                    f.Id,
                    f.FamilyCardId,
                    f.AnimalId,
                    g.Name as AnimalName,
                    f.Qty,
                    f.IOn,
                    f.IBy,
                    f.UOn,
                    f.UBy,
                    a.CardNo, 
                    a.Address, 
                    a.RT, 
                    a.RW, 
                    a.PostCode');
        $this->db->from('m_familycardanimal f');
        $this->db->join('m_familycard a', 'a.Id = f.FamilyCardId');
        // $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        // $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        // $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        // $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        $this->db->join('m_Animal g', 'g.Id = f.AnimalId', 'left');
        $this->db->where('f.Id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    

    
    public function get_data_by_familycardid($id)
    {
        
        $this->db->select(' f.Id,
                        f.FamilyCardId,
                        f.AnimalId,
                        g.name as AnimalName,
                        f.Qty,
                        f.IOn,
                        f.IBy,
                        f.UOn,
                        f.UBy,
                        a.CardNo, 
                        a.Address, 
                        a.RT, 
                        a.RW, 
                        a.PostCode'
                    );
        $this->db->from('m_familycardanimal f');
        $this->db->join('m_familycard a', 'a.Id = f.FamilyCardId');
        // $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        // $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        // $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        // $this->db->join('m_Province e', 'e.Id = d.ProvinceId', 'left');
        $this->db->join('m_Animal g', 'g.Id = f.AnimalId', 'left');
        $this->db->where('a.Id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_datapages($page, $pagesize, $search = null, $familycardid = null)
    {
        $this->db->select(' f.Id,
                            f.FamilyCardId,
                            f.AnimalId,
                            g.name as AnimalName,
                            f.Qty,
                            f.IOn,
                            f.IBy,
                            f.UOn,
                            f.UBy,
                            a.CardNo, 
                            a.Address, 
                            a.RT, 
                            a.RW, 
                            a.PostCode');
        $this->db->from('m_familycardanimal f');
        $this->db->join('m_familycard a', 'a.Id = f.FamilyCardId');
        // $this->db->join('m_village b', 'b.Id = a.VillageId', 'left');
        // $this->db->join('m_subcity c', 'c.Id = b.SubcityId', 'left');
        // $this->db->join('m_city d', 'd.Id = c.CityId', 'left');
        // $this->db->join('m_province e', 'e.Id = d.ProvinceId', 'left');
        $this->db->join('m_Animal g', 'g.Id = f.AnimalId', 'left');
        if(!empty($search))
        {
            $this->db->like('a.CardNo', $search);
            $this->db->or_like('a.HeadFamilyName', $search);
        }
        $this->db->where('f.FamilyCardId', $familycardid);
        $this->db->order_by('f.IOn','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

    }

    public function save_data($data)
    {
        $this->db->insert('m_familycardanimal', $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('m_familycardanimal', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        $this->db->delete('m_familycardanimal');
    }

    public function create_object($id, $familycardid, $animalid, $animal, $qty, 
                                        $cardno, $address, $rt, $rw, $postcode,
                                        $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'familycardid' => $familycardid,
            'animalid' => $animalid,
            'animal' => $animal,
            'qty' => $qty,
            'cardno' => $cardno,
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

    public function create_object_tabel($id, $familycardid, $animalid, $qty, 
                                        $ion = null, $iby = null, $uon = null, $uby = null)
    { 
        $data = array(
            'id' => $id,
            'familycardid' => $familycardid,
            'animalid' => $animalid,
            'qty' => $qty,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function is_data_exist($name = null, $familycardid = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_familycard a');
        $this->db->join('m_familycardanimal b', 'b.Id = b.FamilyCardId');
        $this->db->where('a.Id', $familycardid);
        $this->db->where('b.Name', $name);
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
            if($model['name'] != $oldmodel['name'])
            {
                $nameexist = $this->is_data_exist($model['name'], $model['familycardid']);
            }
        }
        else{
            if(!empty($model['name']))
            {
                $nameexist = $this->is_data_exist($model['name'], $model['familycardid']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_name_can_not_null']));
            }
        }

        if($nameexist === true)
        {
            $warning = array_merge($warning, array(0=>$resource['res_err_name_exist']));
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
        $resource['res_edit_data'] = $this->lang->line('ui_edit_data');

        $resource['res_err_name_exist'] = $this->lang->line('err_msg_name_exist');
        $resource['res_msg_name_can_not_null'] = $this->lang->line('err_msg_name_can_not_null');

        return $resource;
    }
    
}
