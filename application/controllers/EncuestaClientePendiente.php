<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaClientePendiente extends CI_Controller {
  var $table = 'encuestas_clientes';
	var $tableJoin = [
    'encuestas' => [
      'id' => 'idEncuesta',
      'selfId' => 'idEncuesta',      
    ],
    'adm_usuarios' => [
      'id' => 'idUsuario',
      'selfId' => 'idUsuario',
      'tableJoin' => [            
        'sucursales' => [
          'id' => 'idSucursal',
          'selfId' => 'idSucursal',
        ],
      ], 
    ], 
    'clientes' => [
      'id' => 'idCliente',
      'selfId' => 'idCliente',
    ], 
  ];
	var $id = 'idEncuestaCliente';
	var $select = ['encuestas_clientes.*','encuestas.titulo as titulo','encuestas.mensaje as encuestaMensaje','encuestas.idEncuesta as idEncuesta', 'clientes.razonSocial as razonSocial', 'clientes.cuit as cuit', 'clientes.idCliente as idCliente', 'clientes.celular as celular','adm_usuarios.razonSocial as vendedor', 'sucursales.nombreSucursal as sucursal'];
  var $where = [];
	var $column_order = ['encuestas.titulo', 'encuestas_clientes.fechaEnvio','adm_usuarios.razonSocial', 'sucursales.nombreSucursal', 'clientes.razonSocial', 'clientes.cuit'];
	var $column_search = ['encuestas.titulo', 'encuestas_clientes.fechaEnvio', 'adm_usuarios.razonSocial', 'sucursales.nombreSucursal', 'clientes.razonSocial', 'clientes.cuit'];

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

  public function getClientesDeEncuesta($estadoEncuesta = 2, $idEncuesta = null)
  {

    if($idEncuesta) {
      $this->where[] =  ['encuestas_clientes.idEncuesta', $idEncuesta];   
      $this->column_order = array_slice($this->column_order, 1); 
      $this->column_search = array_slice($this->column_search, 1); 
    }

    if($estadoEncuesta != 2) {
      $this->where[] = [
        'encuestas.estado', 
        $estadoEncuesta == 0 ? 'abierto' : 'cerrado'
      ];
    }

    $this->where[] = ['encuestas_clientes.idEstado', 1];

    if(!isAdmin()) {
      $this->where[] = ['encuestas_responsable.idUsuario', $this->session->userdata('logged_user_admin')->idUsuario];
    }    

    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
      $encuesta = $this->encuesta->getById($li->idEncuesta);
      $fechaEnvio = date('m-d-Y', strtotime($li->fechaEnvio. ' ' . $encuesta->cantidad_dias . 'days'));
      $menorAFechaEnvio = date('Y-m-d') < date('Y-m-d', strtotime($li->fechaEnvio. ' ' . $encuesta->cantidad_dias . 'days'));
    
      $encrypted = $this->encryption->encrypt($encuesta->idEncuesta.'/'.$li->idCliente);
      $encrypted = urlencode($encrypted);

      $whatsappText = $li->encuestaMensaje.'%0a%0a'.$li->mensaje.'%0a%0a'.base_url("index.php/survey/?q=$encrypted");
      
			$row = [];
      if(!$idEncuesta) {
        $row[] = $li->titulo;          
      }
      $row[] = $fechaEnvio;
			$row[] = $li->vendedor;
			$row[] = $li->sucursal;
			$row[] = $li->razonSocial;
			$row[] = $li->cuit;

      $lockIcon = ($li->pausada == 0) ? 'lock-open' : 'lock';
      $row[] = '<a class="btn btn-sm btn-secondary"
      href="'.base_url("index.php/encuestas/$li->idEncuesta/cliente/$li->idCliente/pausar").'">
        <i class="fa fa-'. $lockIcon .' mr-1"></i></a>';

      $row[] = ' <a class="btn btn-sm btn-info text-white" type="button"  onclick="contactos(\''. $li->idEncuestaCliente. '\', \'pendientes\')"
						  title="Contactos">  <i class="fa fa-link mr-1"></i></a>';

      $acciones = '';
      if ($li->pausada == 0) {
        $acciones .= '<a target="_blank" href="https://wa.me/'.$li->celular.'/?text='.$whatsappText.'"
        '.($menorAFechaEnvio ? 'onclick="return confirm('."'Estas enviando la encuesta antes de la fecha pautada, confirmar?');".'"' : '').'
        >
        <button type="button" style="border-radius: 50% 50% 50% 0%;display: inline-block;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
        </button>
        </a>
        <a  target="_blank" href="whatsapp://send?text='.$whatsappText.'&phone='.$li->celular.'&abid='.$li->celular.'"
        '.($menorAFechaEnvio ? 'onclick="return confirm('."'Estas enviando la encuesta antes de la fecha pautada, confirmar?');".'"' : '').'
        > 
              <button type="button" style="display: inline-block;border-color:#661cc8;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
              </button>
        </a>
        <a class="btn btn-sm btn-secondary" title="Encuesta enviada"
          href="'.base_url("index.php/encuestas/$li->idEncuesta/cliente/$li->idCliente/enviado").'"
          '.($menorAFechaEnvio ? 'onclick="return confirm('."'Estas enviando la encuesta antes de la fecha pautada, confirmar?');".'"' : '').'
          >
			      <i class="fa fa-paper-plane mr-1"></i></a>
        ';
      }

      $acciones .=  '          
        <a class="btn btn-sm btn-primary" target="_blank"
        href="'.base_url("index.php/survey/?q=$encrypted").'">
          <i class="fa fa-eye mr-1"></i></a>          
          <a class="btn btn-sm btn-warning text-white" href="'.base_url("index.php/encuestas/$idEncuesta/encuestaCliente/$li->idEncuestaCliente/guardar").'" title="'.$li->mensaje.'" >
        <i class="fa fa-comment-alt mr-1"></i></a>';

      $row[] = $acciones;

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
  
  
}