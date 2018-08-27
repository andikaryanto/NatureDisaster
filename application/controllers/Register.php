<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->library('session');
        $this->load->model('Muser_model');

    }

    public function index()
    {

        $this->loadview('register/register');
    }

    public function addsave()
    {
        $username = $this->input->post('registerUsername');
        $password = $this->input->post('registerPassword');
        $date = date("Y-m-d H:i:s");
        $data = $this->Muser_model->create_object(null, $username, $password, $date, 'andik', null, null);
        $this->Muser_model->save_data($data);

        $this->session->set_flashdata('success_msg', 'Register Successful');
        redirect('register');
        //$this->index();
    }

    private function loadview($viewName)
	{
		$this->load->view('template/header');
		$this->load->view($viewName);
		$this->load->view('template/footer');
    }
    
}