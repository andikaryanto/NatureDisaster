<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paging {

    public function get_config()
    {
        $data["perpage"] = 10;
        $data["perpagemodal"] = 5;
        $data["pagelen"] = 5;
        return $data;
    }

    public function get_form_name_id()
    {
        $data["m_disaster"] = 1;
        $data["m_user"] = 2;
        $data["g_groupuser"] = 3;
        $data["m_province"] = 4;
        $data["m_city"] = 5;
        $data["m_village"] = 6;
        $data["m_subcity"] = 7;
        $data["m_familycard"] = 8;
        $data["m_animal"] = 9;
        return $data;
    }

    public function get_enum_name()
    {
        $data["gender"] = 1;
        $data["religion"] = 2;
        $data["education"] = 3;
        $data["marriagestatus"] = 4;
        $data["familystatus"] = 5;
        $data["citizenship"] = 6;
        return $data;
    }

    public function load_header()
    {

        $CI =& get_instance();
        $resource = $this->set_resources_header_page();

        $data['resource'] = $resource;

        $CI->load->view('template/header', $data); 
    }

    public function load_footer()
    {
        $CI =& get_instance();
        $CI->load->view('template/footer');
    }

    public function set_resources_forbidden_page()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        $resource['res_page_forbidden'] = $CI->lang->line('ui_page_forbidden');
        $resource['res_contact_your_admin'] = $CI->lang->line('ui_contact_your_admin');
        return $resource;
    }

    private function set_resources_header_page()
    {
        
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        $resource['res_disaster'] = $CI->lang->line('ui_disaster');
        $resource['res_groupuser'] = $CI->lang->line('ui_groupuser');
        $resource['res_user'] = $CI->lang->line('ui_user');
        $resource['res_logout'] = $CI->lang->line('ui_logout');
        $resource['res_province'] = $CI->lang->line('ui_province');
        $resource['res_city'] = $CI->lang->line('ui_city');
        $resource['res_village'] = $CI->lang->line('ui_village');
        $resource['res_subcity'] = $CI->lang->line('ui_subcity');
        $resource['res_familycard'] = $CI->lang->line('ui_familycard');
        $resource['res_animal'] = $CI->lang->line('ui_animal');

        $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/US.png');
        if($_SESSION['language']['language'] === 'indonesia'){
            $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/ID.png');;
        }

        return $resource;
    }

    public function is_session_set()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->model('Login_model');
        if(isset($_SESSION['userdata']))
        {
            
        }
        else
        {
            redirect('login');
        }
    }

    public function set_data_page_add($resource, $model = null)
    {
        $data['resource'] = $resource;
        $data['model'] = $model;
        return $data;
    }

    public function set_data_page_edit($resource, $model = null, $enums = null)
    {
        $data['resource'] = $resource;
        $data['model'] = $model;
        $data['enums'] = $enums;
        return $data;
    }

    public function is_superadmin($user)
    {
        $permited = false;
        if($user === "superadmin")
        {
            $permited = true;
        }
        return $permited;
    }

    public function set_data_page_index($resource, $modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $pagesize = null)
    {
        $config = $this->get_config();
        $pagesz = $config['perpage'];
        if(!empty($pagesize))
        {
            $pagesz = $pagesize;
        }
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        if($totalrow)
        {
            $totalpage = ceil($totalrow / $pagesz);
            if($totalpage > $config["pagelen"])
            {
                //$firstpage = $page - 2;
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    //$lastpage = $config['pagelen'];
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                //$firstpage = 1;
                //echo '<script>alert('$totalpage')</script>';
                $lastpage = $totalpage;
            }
        }

        $data['modelheader'] = $modelheader;
        $data['modeldetail'] = $modeldetail;
        $data['totalrow'] = $totalrow;
        $data['totalpage'] = $totalpage;
        $data['currentpage'] = (int)$currentpage;
        $data['firstpage'] = $firstpage;
        $data['lastpage'] = $lastpage;
        $data['search'] = $search;
        $data['resource'] = $resource;
        return $data;
    }

    public function set_data_page_modal($resource, $modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $tabelname = null)
    {
        $config = $this->get_config();
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        if($totalrow)
        {
            $totalpage = ceil($totalrow / $config['perpagemodal']);
            if($totalpage > $config["pagelen"])
            {
                //$firstpage = $page - 2;
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    //$lastpage = $config['pagelen'];
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        }

        $data[$tabelname]['modelheadermodal'] = $modelheader;
        $data[$tabelname]['modeldetailmodal'] = $modeldetail;
        $data[$tabelname]['totalrowmodal'] = $totalrow;
        $data[$tabelname]['totalpagemodal'] = $totalpage;
        $data[$tabelname]['currentpagemodal'] = (int)$currentpage;
        $data[$tabelname]['firstpagemodal'] = $firstpage;
        $data[$tabelname]['lastpagemodal'] = $lastpage;
        $data[$tabelname]['searchmodal'] = $search;
        $data[$tabelname]['resourcemodal'] = $resource;
        return $data;
    }

}