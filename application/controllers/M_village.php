<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_village extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mvillage_model');
        $this->load->model('Ggroupuser_model');
        $this->load->library('paging');
        $this->load->library('session');
        $this->load->helper('form');
        
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_village'],'Read'))
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
            $resultdata = $this->Mvillage_model->get_alldata();
            $datapages = $this->Mvillage_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mvillage_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_village/index', $data);
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function villagemodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->Mvillage_model->get_alldata();
        $datapages = $this->Mvillage_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->Mvillage_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_village');      
        
        echo json_encode($data);
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_village'],'Write'))
        {
            $resource = $this->Mvillage_model->set_resources();
            $model = $this->Mvillage_model->create_object(null, null, null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_village/add', $data);
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
        $resource = $this->Mvillage_model->set_resources();
        $subcityid = $this->input->post('subcityid');
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        
        $model = $this->Mvillage_model->create_object_tabel(null, $subcityid, $name, $description, null, null, null, null);

        $validate = $this->Mvillage_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_village/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mvillage_model->save_data($model);
            redirect('mvillage');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_village'],'Read'))
        {
            $resource = $this->Mvillage_model->set_resources();
            $edit = $this->Mvillage_model->get_data_by_id($id);
            $model = $this->Mvillage_model->create_object($edit->Id, $edit->SubcityId, $edit->SubcityName, $edit->Name, $edit->Description, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_village/edit', $data);   
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }   
    }

    public function editsave()
    {
        $resource = $this->Mvillage_model->set_resources();

        $villageid = $this->input->post('idvillage');
        $subcityid = $this->input->post('subcityid');
        $subcityname = $this->input->post('subcityname');
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        //echo $subcityname;

        $edit = $this->Mvillage_model->get_data_by_id($villageid);

        $oldmodel = $this->Mvillage_model->create_object($edit->Id,$edit->subcityId,$edit->subcityName, $edit->Name, $edit->Description, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);
        $model = $this->Mvillage_model->create_object($edit->Id,$subcityid, $subcityname, $name, $description, $edit->IOn, $edit->IBy, null , null);
        $modeltabel = $this->Mvillage_model->create_object_tabel($edit->Id, $subcityid, $name, $description, $edit->IOn, $edit->IBy, null , null);
        
        $validate = $this->Mvillage_model->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_village/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['username'];

            $this->Mvillage_model->edit_data($modeltabel);
            redirect('mvillage');
        }
    }

    public function delete($id)
    {
        $this->Mvillage_model->delete_data($id);
        redirect('mvillage');
    }

    private function loadview($viewName, $data)
	{
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
    }

   
    
    
}