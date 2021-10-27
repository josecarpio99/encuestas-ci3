<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaCliente extends CI_Controller {
  var $table = 'encuestas_clientes';
	var $tableJoin = [
    'encuestas' => [
      'id' => 'idEncuesta',
      'selfId' => 'idEncuesta',
    ],
    'clientes' => [
      'id' => 'idCliente',
      'selfId' => 'idCliente',
    ]
  ];
	var $id = 'idEncuestaCliente';
	var $select = ['encuestas_clientes.*','encuestas.titulo as titulo', 'clientes.razonSocial as razonSocial', 'clientes.cuit as cuit'];
  var $where = [];
	var $column_order = ['encuestas.titulo', 'clientes.razonSocial', 'clientes.cuit', 'encuestas_clientes.fechaEnviada'];
	var $column_search = ['encuestas_clientes.fechaEnviada','encuestas.titulo', 'clientes.razonSocial', 'clientes.cuit'];

  function __construct()
  {
    parent::__construct();    
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true);
    $this->load->model('encuestaCliente_model', 'encuestaCliente', true);
    
  }

  public function getClientesDeEncuesta($idEncuesta)
  {

    $encuesta = $this->encuesta->getById($idEncuesta);

    if(!$encuesta){
			echo 'Encuesta mo encontrada';
      die;
		}

    $this->where[] =  ['encuestas_clientes.idEncuesta', $idEncuesta];    

    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
			$row = [];
			$row[] = $li->titulo;
			$row[] = $li->razonSocial;
			$row[] = $li->cuit;
			$row[] = $li->fechaEnviada;	
      $row[] = 
          '<a class="btn btn-sm btn-primary"
          href="'.base_url("index.php/encuestas/$idEncuesta/cliente/$li->idEncuestaCliente").'">
			      <i class="fa fa-eye mr-1"></i></a>';
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

  public function mostrarRespuestasDeCliente($idEncuesta, $idEncuestaCliente)
  {
    $data = [];
    $encuestaCliente = $this->encuestaCliente->getById($idEncuestaCliente);
    if(!$encuestaCliente){
			$this->session->set_flashdata('warning','Encuesta cliente no encontrada!');
      redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
		}

    $respuestas = $this->encuestaCliente->getRespuestas($idEncuestaCliente);

    $data['encuestaCliente'] = $encuestaCliente;
    $data['respuestas'] = $respuestas;
    $data['idEncuesta'] = $idEncuesta;
    
    $this->load->view('_header',$data);
    $this->load->view('encuestas/cliente_respuestas',$data);
    $this->load->view('_footerTablasEncuestaCliente',$data);
  }
}