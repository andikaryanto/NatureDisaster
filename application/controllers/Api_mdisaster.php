
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Api_mdisaster extends REST_Controller{
    
    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); 
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); 
        
        //$this->load->database('naturedisaster', TRUE);
        // header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        $this->load->model('Mdisaster_model');
        $this->load->library('paging');
        $this->load->library('session');
        $this->load->helper('form');
    }
    public function get_disaster_get()
    {
        // $curl = $this->apicurl_mdisaster->get_curl();
        // echo json_encode($curl);
        $response = array(
            'content' =>  $datapages = $this->Mdisaster_model->get_alldata()
            //'totalPages' => ceil($this->Mahasiswa->getCountMahasiswa() / $size)
        );
      
          $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
            exit;
    }

    public function save_disaster_post()
    {
       
        // $request = $this->request->body;
        // $date = date("Y-m-d H:i:s");

        // $data = array('id' => null,
        //    'name' => $request['name'],
        //    'description' => $request['description'],
        //    'ion' => $date,
        //    'iby' => 'android',
        //    'uon' => null,
        //    'uby' => null
        //    );
        // $this->Mdisaster_model->save_data($data);

        // $response = array(
        //     'success' => 'succesfully inserted'  
        //     //'totalPages' => ceil($this->Mahasiswa->getCountMahasiswa() / $size)
        // );
        // $this->output
        //     ->set_status_header(200)
        //     ->set_content_type('application/json', 'utf-8')
        //     ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        //     ->_display();
        //     exit;
    }
}