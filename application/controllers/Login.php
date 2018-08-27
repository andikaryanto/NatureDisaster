<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model('Login_model');
        $this->load->model('Muser_model');
        $this->load->library('session');

    }

    public function index()
    {
        if(isset($_SESSION['userdata'])){
            redirect('home');
        }
        else{
            $this->load->view('login/login');
        }
    }

    // public function login($isloggedin = false)
    // {
    //     if($this->session->userdata('username')){
    //         redirect('home');
    //     }else{
    //         $this->index();
    //     }
    // }

    public function dologin()
    {
        //echo "<script>alert('sini njing');</script>";
        $username = $this->input->post('loginUsername');
        $password = $this->input->post('loginPassword');
        //$loggedin = $this->Login_model->do_logged_in($username, $password);
        
        $query = $this->Muser_model->get_sigle_data_user($username, $password);
        if ($query)
        {
            $userdata = $this->Muser_model->create_object($query->Id, $query->GroupId, $query->GroupName, $query->UserName, null, null, null, null, null);
            $this->session->set_userdata('userdata',$userdata);

            $language = array(
                'language' => 'english'
            );
            $this->session->set_userdata('language',$language);
            redirect('home');
        }
        else{
           $this->index();
        }
    }

    public function dologout()
    {
        unset(
            $_SESSION['userdata']
        );
        redirect('login');
    }

    private function loadview($viewName)
	{
		$this->load->view('template/header');
		$this->load->view($viewName);
		$this->load->view('template/footer');
    }
    
}