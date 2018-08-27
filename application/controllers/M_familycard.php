<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_familycard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturefamilycard', TRUE);
        $this->load->model('Mfamilycard_model');
        $this->load->model('Mfamilycarddetail_model');
        $this->load->model('Mfamilycardanimal_model');
        $this->load->model('Ggroupuser_model');
        $this->load->model('Genum_model');      
        $this->load->library('paging');
        $this->load->library('session');
        $this->load->helper('form');
        
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_familycard'],'Read'))
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
            $resultdata = $this->Mfamilycard_model->get_alldata();
            $datapages = $this->Mfamilycard_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mfamilycard_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_familycard/index', $data);
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function familycardmodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->Mfamilycard_model->get_alldata();
        $datapages = $this->Mfamilycard_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->Mfamilycard_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_familycard');      
        
        echo json_encode($data);
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_familycard'],'Write'))
        {
            $resource = $this->Mfamilycard_model->set_resources();
            $model = $this->Mfamilycard_model->create_object(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_familycard/add', $data);
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
        $resource = $this->Mfamilycard_model->set_resources();

        echo json_encode($_POST);
        
        $model = $this->Mfamilycard_model->create_object_tabel(null, 
                                            $_POST['cardno'], 
                                            $_POST['headfamilyname'],
                                            $_POST['villageid'],
                                            $_POST['address'],
                                            $_POST['rt'],
                                            $_POST['rw'],
                                            $_POST['postcode'],
                                            null, null, null, null);


        $validate = $this->Mfamilycard_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_familycard/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mfamilycard_model->save_data($model);
            
            $edit = $this->Mfamilycard_model->get_data_by_cardno($_POST['cardno']);
            redirect('mfamilycard/edit/'.$edit->Id);
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Ggroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_familycard'],'Read'))
        {
            $resource = $this->Mfamilycard_model->set_resources();
            $edit = $this->Mfamilycard_model->get_data_by_id($id);
            //echo json_encode($edit);
            $model = $this->Mfamilycard_model->create_object($edit->Id, 
                                                            $edit->CardNo, 
                                                            $edit->HeadFamilyName, 
                                                            $edit->VillageId,
                                                            $edit->VillageName,
                                                            $edit->SubcityName,
                                                            $edit->CityName,
                                                            $edit->ProvinceName,
                                                            $edit->Address,
                                                            $edit->RT,
                                                            $edit->RW,
                                                            $edit->PostCode,
                                                            null, null, null, null);
            
            //detail family
            // $page = 1;
            // $search = "";
            // if(!empty($_GET["page"]))
            // {
            //     $page = $_GET["page"];
            // }
            // if(!empty($_GET["search"]))
            // {
            //     $search = $_GET["search"];
            // }
            // $pagesize = $this->paging->get_config();
            $enum =  $this->paging->get_enum_name();
            // $alldatabycardid = $this->Mfamilycarddetail_model->get_data_by_familycardid($model['id']);
            // $alldatabycardid = $this->Mfamilycardanimal_model->get_data_by_familycardid($model['id']);
            //$modeldetail['modeldetail']['detail'] = $this->Mfamilycarddetail_model->get_datapages($page, $pagesize['perpagemodal'], $search, $id);
            //$modeldetail['modeldetail'] = $this->Mfamilycardanimal_model->get_datapages($page, $pagesize['perpagemodal'], $search, $id);
            $enums['genderenum'] = $this->Genum_model->get_data_by_id($enum['gender']);
            $enums['religionenum'] = $this->Genum_model->get_data_by_id($enum['religion']);
            $enums['educationenum'] = $this->Genum_model->get_data_by_id($enum['education']);
            $enums['marriageenum'] = $this->Genum_model->get_data_by_id($enum['marriagestatus']);
            $enums['familyenum'] = $this->Genum_model->get_data_by_id($enum['familystatus']);
            $enums['citizenshipenum'] = $this->Genum_model->get_data_by_id($enum['citizenship']);


            // $rows = !empty($search) ? count($modeldetail['modeldetail']) : count($alldatabycardid);

            // $detail = $this->paging->set_data_page_index($resource, $modeldetail, $rows, $page, $search, null, $pagesize['perpagemodal']);
            $data =  $this->paging->set_data_page_edit($resource, $model, $enums);
            $this->loadview('m_familycard/edit', $data);   
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }   
    }

    //public function 

    public function editsave()
    {
        $resource = $this->Mfamilycard_model->set_resources();

        $edit = $this->Mfamilycard_model->get_data_by_id($_POST['familycardid']);

        $oldmodel = $this->Mfamilycard_model->create_object($edit->Id, 
                                                            $edit->CardNo, 
                                                            $edit->HeadFamilyName, 
                                                            $edit->VillageId,
                                                            $edit->VillageName,
                                                            $edit->SubcityName,
                                                            $edit->CityName,
                                                            $edit->ProvinceName,
                                                            $edit->Address,
                                                            $edit->RT,
                                                            $edit->RW,
                                                            $edit->PostCode,
                                                            $edit->IOn,
                                                            $edit->IBy, null, null);
                                                            
        $model = $this->Mfamilycard_model->create_object($_POST['familycardid'],
                                                            $_POST['cardno'], 
                                                            $_POST['headfamilyname'],
                                                            $_POST['villageid'],
                                                            $_POST['villagename'],
                                                            null,null,null,
                                                            $_POST['address'],
                                                            $_POST['rt'],
                                                            $_POST['rw'],
                                                            $_POST['postcode'],
                                                            $edit->IOn,
                                                            $edit->IBy, null, null);

        $modeltabel = $this->Mfamilycard_model->create_object_tabel($_POST['familycardid'],
                                                            $_POST['cardno'], 
                                                            $_POST['headfamilyname'],
                                                            $_POST['villageid'],
                                                            $_POST['address'],
                                                            $_POST['rt'],
                                                            $_POST['rw'],
                                                            $_POST['postcode'],
                                                            $edit->IOn,
                                                            $edit->IBy, null, null);

        $validate = $this->Mfamilycard_model->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_familycard/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['username'];

            $this->Mfamilycard_model->edit_data($modeltabel);
            redirect('mfamilycard');
        }
    }

    public function delete($id)
    {
        $this->Mfamilycard_model->delete_data($id);
        redirect('mfamilycard');
    }

    #region  detail
    public function getfamilycarddetail(){
            #detail family

            $id =  $this->input->post("idfamilycard");
            $page = $this->input->post("page");
            $pagesize = $this->paging->get_config();
            $alldatabycardid = $this->Mfamilycarddetail_model->get_data_by_familycardid($id);
            $modeldetail = $this->Mfamilycarddetail_model->get_datapages($page, $pagesize['perpagemodal'], "", $id);
            $rows = count($alldatabycardid);;//!empty($search) ? count($modeldetail) : count($alldatabycardid);
            $detail = $this->paging->set_data_page_index("", $modeldetail, $rows, $page, "", null, $pagesize['perpagemodal']);
            echo json_encode($detail);
    }

    public function editfamilycarddetail()
    {
        $detail = $this->Mfamilycarddetail_model->get_data_by_id($_POST['id']);
        echo json_encode($detail);
    }

    public function savefamilycarddetail()
    {
        $date = date("Y-m-d H:i:s");
        $familycarddetailmodel = $this->Mfamilycarddetail_model->create_object_tabel(
                                    $_POST['id'],
                                    $_POST['familycardid'],
                                    $_POST['name'],
                                    $_POST['nik'],
                                    $_POST['gender'],
                                    date("Y-m-d H:i:s", strtotime($_POST['dateofbirth'])),
                                    $_POST['placeofbirth'],
                                    $_POST['religion'],
                                    $_POST['education'],
                                    $_POST['job'],
                                    $_POST['marriagestatus'],
                                    $_POST['familystatus'],
                                    $_POST['citizenship'],
                                    $_POST['pasportno'],
                                    $_POST['kitano'],
                                    $_POST['fathersname'],
                                    $_POST['mothersname'],
                                    $_POST['isheadfamily'],
                                    null,
                                    null,
                                    null,
                                    null
                                );
                                
        if(!empty($_POST['id']))
        {
            $oldmodel = $this->Mfamilycarddetail_model->get_data_by_id($_POST['id']);
            $familycarddetailmodel['ion'] = $oldmodel->IOn;
            $familycarddetailmodel['iby'] = $oldmodel->IBy;
            $familycarddetailmodel['uon'] = $date;
            $familycarddetailmodel['uby'] = $_SESSION['userdata']['username'];
            $this->Mfamilycarddetail_model->edit_data($familycarddetailmodel);
        }
        else
        {
            
            $familycarddetailmodel['id'] = null;
            $familycarddetailmodel['ion'] = $date;
            $familycarddetailmodel['iby'] = $_SESSION['userdata']['username'];
            $this->Mfamilycarddetail_model->save_data($familycarddetailmodel);
            //echo json_encode($familycarddetailmodel);
        }
        
        //echo json_encode($familycarddetailmodel);

        redirect('mfamilycard/edit/' . $_POST['familycardid']);
    }

    public function deletefamilycarddetail($id, $idfamilycard)
    {
        $this->Mfamilycarddetail_model->delete_data($id);
        redirect('mfamilycard/edit/' . $idfamilycard);
    }

    ##region amimal
    public function getfamilycardanimal(){
        #detail family

        $id =  $this->input->post("idfamilycard");
        $page = $this->input->post("page");
        $pagesize = $this->paging->get_config();
        $alldatabycardid = $this->Mfamilycardanimal_model->get_data_by_familycardid($id);
        $modeldetail = $this->Mfamilycardanimal_model->get_datapages($page, $pagesize['perpagemodal'], "", $id);
        $rows = count($alldatabycardid);;//!empty($search) ? count($modeldetail) : count($alldatabycardid);
        $detail = $this->paging->set_data_page_index("", $modeldetail, $rows, $page, "", null, $pagesize['perpagemodal']);
        echo json_encode($detail);
    }

    public function savefamilycardanimal()
    {
        $date = date("Y-m-d H:i:s");
        $familycardanimalmodel = $this->Mfamilycardanimal_model->create_object_tabel(
                                    $_POST['id'],
                                    $_POST['familycardid'],
                                    $_POST['animalid'],
                                    $_POST['qty'],
                                    null,
                                    null,
                                    null,
                                    null
                                );
                                
        if(!empty($_POST['id']))
        {
            $oldmodel = $this->Mfamilycarddetail_model->get_data_by_id($_POST['id']);
            $familycardanimalmodel['ion'] = $oldmodel->IOn;
            $familycardanimalmodel['iby'] = $oldmodel->IBy;
            $familycardanimalmodel['uon'] = $date;
            $familycardanimalmodel['uby'] = $_SESSION['userdata']['username'];
            $this->Mfamilycardanimal_model->edit_data($familycardanimalmodel);
        }
        else
        {
            
            $familycardanimalmodel['id'] = null;
            $familycardanimalmodel['ion'] = $date;
            $familycardanimalmodel['iby'] = $_SESSION['userdata']['username'];
            $this->Mfamilycardanimal_model->save_data($familycardanimalmodel);
            //echo json_encode($familycarddetailmodel);
        }
        
        //echo json_encode($familycarddetailmodel);

        redirect('mfamilycard/edit/' . $_POST['familycardid']);
    }

    
    public function editfamilycardanimal()
    {
        $detail = $this->Mfamilycardanimal_model->get_data_by_id($_POST['id']);
        echo json_encode($detail);
    }

    private function loadview($viewName, $data)
	{
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
    }
}