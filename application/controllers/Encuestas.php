<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas extends CI_Controller {
  var $table = 'encuestas';
	var $tableJoin = [
    'encuestas_responsable' => [
      'id' => 'idEncuesta',
      'tableJoin' => [
        'adm_usuarios' => [
          'id' => 'idUsuario'
        ]
      ]
    ]
  ];
	var $id = 'idEncuesta';
	var $select = ['encuestas.*', 'adm_usuarios.razonSocial AS razonSocial'];
	var $column_order = ['encuestas.nombre', 'encuestas.titulo', 'encuestas.estado', 'adm_usuarios.razonSocial'];
	var $column_search = ['encuestas.nombre', 'encuestas.titulo', 'encuestas.estado', 'adm_usuarios.razonSocial'];
  function __construct()
  {
    parent::__construct();
    setSessionData();
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
  }

  public function index()
  {    
    if(!@$this->session->userdata('logged_user_admin')->email) {
      echo 'No session'; 
      die;
    }
    $data = [];

    $data = [];
    $data['userM'] = $this->session->userdata('logged_user_admin')->razonSocial;
    $idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
    $data['perfilUsuario'] = $this->session->userdata('logged_user_admin')->perfil;
    $this->load->view('_header',$data);
    $this->load->view('encuestas/index',$data);
    $this->load->view('_footerTablasEncuestas',$data);

  }

  public function getEncuestas($perfil = 0)
  {
    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
			$row = [];
			$row[] = $li->nombre;
			$row[] = $li->titulo;
			$row[] = $li->razonSocial;
			$row[] = $li->estado;	
      $row[] = 
          '<a class="btn btn-sm btn-warning text-white" href="'.base_url("index.php/encuestas/editar/$li->idEncuesta").'" 
          title="Edit">
      <i class="fa fa-pencil-alt mr-1"></i></a>

			<a class="btn btn-sm btn-danger" href="#" 
			title="Delete" onclick="borrar_encuesta('."'".$li->idEncuesta."'".')">
			<i class="fa fa-trash mr-1"></i></a>';
      $data[] = $row;
    }

    $output = [
      'draw'            => $_POST['draw'],
      'recordsTotal'    => $this->my->count_all(),
      'recordsFiltered' => $this->my->count_filtered(),
      'data'            => $data
   ];

   echo json_encode($output);

  }

  public function agregar()
  {

  }

  public function editar($id)
  {
    dd($id);
  }

  public function eliminar($id)
  {

  }
}