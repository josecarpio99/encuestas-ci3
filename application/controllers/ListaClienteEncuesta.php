<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListaClienteEncuesta extends CI_Controller {
  var $table = 'clientes c';
	var $tableJoin = [];
  var $id = 'idCliente';
  var $select = ['c.idCliente','c.razonSocial', 'c.cuit'];
  var $where = [];
  var $column_order = ['razonSocial', 'cuit', 'respondido']; 
  var $column_search = ['razonSocial', 'cuit']; 


  function __construct()
  {
    parent::__construct();    
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true);
    $this->load->model('encuestaCliente_model', 'encuestaCliente', true);
    $this->load->library('encryption');     
  }

  public function getListaClientesParaEnviarEncuesta($idEncuesta)
  {
    $encuesta = $this->encuesta->getById($idEncuesta);

    if(!$encuesta){
			echo 'Encuesta no encontrada';
      die;
		}

    $this->select[] = "(SELECT ec.fechaRespuesta FROM encuestas_clientes ec WHERE idEncuesta = $idEncuesta && idCliente = c.idCliente) as respondido";

    $data = [];
    
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    // dd($list);
    foreach($list as $li){
      $encrypted = $this->encryption->encrypt($idEncuesta.'/'.$li->idCliente);
      $encrypted = urlencode($encrypted);
      $row = [];
			$row[] = $li->razonSocial;
			$row[] = $li->cuit;
			$row[] = $li->respondido ? date('m/d/Y H:i', strtotime($li->respondido)) : 'No ha respondido' ;
      $row[] = 
          '<a class="btn btn-sm btn-primary" target="_blank"
          href="'.base_url("index.php/survey/?q=$encrypted").'">
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