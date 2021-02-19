<?php
//harizo
defined('BASEPATH') OR exit('No direct script access allowed');

// afaka fafana refa ts ilaina
require APPPATH . '/libraries/REST_Controller.php';

class Client extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('client_model', 'ClientManager');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    public function index_get() {
        $id = $this->get('id');
        $type_get = $this->get('type_get'); 
           
            if ($id) {
                $data = array();
                $client = $this->ClientManager->findById($id);
                $data['id'] = $client->id;
                $data['code'] = $client->code;
                $data['nom'] = $client->nom;
            }  /*
            else {
                $menu = $this->ClientManager->findAll();
                if ($menu) {
                    foreach ($menu as $key => $value) {
                        $pays = array();
                        $pays = $this->PaysManager->findById($value->id_pays);
                        $data[$key]['id'] = $value->id;
                        $data[$key]['code'] = $value->code;
                        $data[$key]['nom'] = $value->nom;
                        $data[$key]['pays'] = $pays;
                    }
                } else
                    $data = array();
            }
            */

           else {
               $data = $this->ClientManager->findAll();     
            }
          /*  if ($type_get=='findAll')
            {
                $data = $this->ClientManager->findAll();
            }*/
        if (count($data)>0) {
            $this->response([
                'status' => TRUE,
                'response' => $data,
                'message' => 'Get data success',
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => array(),
                'message' => 'No data were found'
            ], REST_Controller::HTTP_OK);
        }
    }
    public function index_post() {
        $id = $this->post('id') ;
        $supprimer = $this->post('supprimer') ;
        if ($supprimer == 0) {
            if ($id == 0) {
                $data = array(
                    'code'       =>  $this->post('code'),
                    'nom_client'        =>  $this->post('nom_client'),
                    'adresse'     =>  $this->post('adresse'),
                    'telephone'     =>  $this->post('telephone') ,
                    'email'     =>  $this->post('email') ,
                    'fax'     =>  $this->post('fax'),
                    'nif'     =>  $this->post('nif') ,
                    'stat'     =>  $this->post('stat'),
                    'cif'     =>  $this->post('cif') ,
                    'reg_comm'     =>  $this->post('reg_comm') ,
                    'groupe_app'     =>  $this->post('groupe_app') ,
                    'groupe'     =>  $this->post('groupe') ,
                    'capital'     =>  $this->post('capital') ,
                    'effectif'     =>  $this->post('effectif')
                );
                if (!$data) {
                    $this->response([
                        'status' => FALSE,
                        'response' => 0,
                        'message' => 'No request found'
                            ], REST_Controller::HTTP_BAD_REQUEST);
                }
                $dataId = $this->ClientManager->add($data);
                if (!is_null($dataId)) {
                    $this->response([
                        'status' => TRUE,
                        'response' => $dataId,
                        'message' => 'Data insert success'
                            ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => FALSE,
                        'response' => 0,
                        'message' => 'No request found'
                            ], REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $data = array(

                    'code'       =>  $this->post('code'),
                    'nom_client'        =>  $this->post('nom_client'),
                    'adresse'     =>  $this->post('adresse'),
                    'telephone'     =>  $this->post('telephone') ,
                    'email'     =>  $this->post('email') ,
                    'fax'     =>  $this->post('fax'),
                    'nif'     =>  $this->post('nif') ,
                    'stat'     =>  $this->post('stat'),
                    'cif'     =>  $this->post('cif') ,
                    'reg_comm'     =>  $this->post('reg_comm') ,
                    'groupe_app'     =>  $this->post('groupe_app') ,
                    'groupe'     =>  $this->post('groupe') ,
                    'capital'     =>  $this->post('capital') ,
                    'effectif'     =>  $this->post('effectif')
                );
                if (!$data || !$id) {
                    $this->response([
                        'status' => FALSE,
                        'response' => 0,
                        'message' => 'No request found'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
                $update = $this->ClientManager->update($id, $data);
                if(!is_null($update)) {
                    $this->response([
                        'status' => TRUE,
                        'response' => 1,
                        'message' => 'Update data success'
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No request found'
                    ], REST_Controller::HTTP_OK);
                }
            }
        } else {
            if (!$id) {
                $this->response([
                    'status' => FALSE,
                    'response' => 0,
                    'message' => 'No request found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }
            $delete = $this->ClientManager->delete($id);         
            if (!is_null($delete)) {
                $this->response([
                    'status' => TRUE,
                    'response' => 1,
                    'message' => "Delete data success"
                        ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'response' => 0,
                    'message' => 'No request found'
                        ], REST_Controller::HTTP_OK);
            }
        }        
    }
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
