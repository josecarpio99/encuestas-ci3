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
	var $column_order = ['encuestas.titulo', 'clientes.razonSocial', 'clientes.cuit', 'encuestas_clientes.fechaRespuesta'];
	var $column_search = ['encuestas_clientes.fechaRespuesta','encuestas.titulo', 'clientes.razonSocial', 'clientes.cuit'];

  function __construct()
  {
    parent::__construct();    
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true);
    $this->load->model('encuestaCliente_model', 'encuestaCliente', true);
    
  }

  public function saveEncuestaCliente($idEncuesta, $idCliente)
  {
    
    $encuesta = $this->encuesta->getById($idEncuesta);
    
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		} 

    $cliente = $this->db->get_where('clientes', ['idCliente' => $idCliente])->row();

    if(!$cliente){
			$this->session->set_flashdata('warning','Cliente no encontrado!');
      redirect(base_url('index.php/encuestas/index'));
		} 

    $encuestaCliente = $this->encuestaCliente->getByClientId($idCliente);
    $isCreating = $encuestaCliente ? false : true;
    
    if(!$_POST){
			$input = $encuestaCliente ?
      (object) [
        'mensaje' => $encuestaCliente->mensaje,
        'idEncuestaClienteEstado' => $encuestaCliente->idEncuestaClienteEstado,
      ]
      : (object) $this->encuestaCliente->getDefaultValues();
		}else{
			$input = (object) $this->input->post(null, true);
		} 
    
		$this->form_validation->set_rules('idEncuestaClienteEstado','Estado','required|integer', [      
      'estado' => 'El campo estado no es válido'
    ]);			

		if($this->form_validation->run() == false){     

			$data['form_action'] = base_url("index.php/encuestas/$idEncuesta/cliente/$idCliente/guardar/");			
			$data['input'] = $input;
			$data['encuesta'] = $encuesta;
			$data['cliente'] = $cliente;
			$data['idEncuesta'] = $idEncuesta;
      $data['estados'] = $this->db->get('encuesta_cliente_estado')->result();

			$this->load->view('_header',$data);
      $this->load->view('encuestas/encuesta_cliente_form',$data);
		}else{ 
			$data = [
				'idEstado' => $this->input->post('idEncuestaClienteEstado', true),					
				'mensaje'  => $this->input->post('mensaje', true),					
			];
      
      if($isCreating) {
        $data['idCliente'] = $idCliente;
        $data['idEncuesta'] = $idEncuesta;
        $this->db->insert($this->table, $data);
      }else {
        $this->db->update($this->table, $data, ['idEncuestaCliente' => $encuestaCliente->idEncuestaCliente]);
      }
			
			$this->session->set_flashdata('success', 'Registro guardado con éxito.');

			redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
		}
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
			$row[] = $li->razonSocial;
			$row[] = $li->cuit;
			$row[] =  date('m/d/Y H:i', strtotime($li->fechaRespuesta));	
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