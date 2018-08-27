<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_city extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureprovince', TRUE);
        $this->load->model('Mcity_model');
        $this->load->model('Ggroupuser_model');
        $this->load->library('paging');
        $this->load->library('session');
        $this->load->helper('form');
        
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_city'],'Read'))
        {
            $page = 1;
            $search = "";
            if(!empty($_GET["page"]))
            {
                $page = $_GET["page"];
            }
            if(!empty($_GET["search"]))
            {
                $search = $_GET["search"];
            }

            $pagesize = $this->paging->get_config();
            $resultdata = $this->Mcity_model->get_alldata();
            $datapages = $this->Mcity_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mcity_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_city/index', $data);
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function citymodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->Mcity_model->get_alldata();
        $datapages = $this->Mcity_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->Mcity_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_city');      
        
        echo json_encode($data);
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_city'],'Write'))
        {
            $resource = $this->Mcity_model->set_resources();
            $model = $this->Mcity_model->create_object(null, null, null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_city/add', $data);
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }   
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning = array();
        $err_exist = false;
        $resource = $this->Mcity_model->set_resources();
        $provinceid = $this->input->post('provinceid');
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        
        $model = $this->Mcity_model->create_object_tabel(null, $provinceid, $name, $description, null, null, null, null);

        $validate = $this->Mcity_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_city/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mcity_model->save_data($model);
            redirect('mcity');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_city'],'Read'))
        {
            $resource = $this->Mcity_model->set_resources();
            $edit = $this->Mcity_model->get_data_by_id($id);
            $model = $this->Mcity_model->create_object($edit->Id, $edit->ProvinceId, $edit->ProvinceName, $edit->Name, $edit->Description, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_city/edit', $data);   
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }   
    }

    public function editsave()
    {
        $resource = $this->Mcity_model->set_resources();

        $cityid = $this->input->post('idcity');
        $provinceid = $this->input->post('provinceid');
        $provincename = $this->input->post('provincename');
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        //echo $provincename;

        $edit = $this->Mcity_model->get_data_by_id($cityid);

        $oldmodel = $this->Mcity_model->create_object($edit->Id,$edit->ProvinceId,$edit->ProvinceName, $edit->Name, $edit->Description, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);
        $model = $this->Mcity_model->create_object($edit->Id,$provinceid, $provincename, $name, $description, $edit->IOn, $edit->IBy, null , null);
        $modeltabel = $this->Mcity_model->create_object_tabel($edit->Id, $provinceid, $name, $description, $edit->IOn, $edit->IBy, null , null);
        
        $validate = $this->Mcity_model->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_city/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['username'];

            $this->Mcity_model->edit_data($modeltabel);
            redirect('mcity');
        }
    }

    public function delete($id)
    {
        $this->Mcity_model->delete_data($id);
        redirect('mcity');
    }

    private function loadview($viewName, $data)
	{
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
    }

   
    
    
}