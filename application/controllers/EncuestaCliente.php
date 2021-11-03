<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaCliente extends CI_Controller {
  var $table = 'encuestas_clientes';
	var $tableJoin = [
    'encuestas' => [
      'id' => 'idEncuesta',
      'selfId' => 'idEncuesta',
      'tableJoin' => [
        'encuestas_responsable' => [
          'id' => 'idEncuesta',
          'selfId' => 'idEncuesta',
        ],
      ]
    ],
    'clientes' => [
      'id' => 'idCliente',
      'selfId' => 'idCliente',
    ],
    'encuesta_cliente_estado' => [
      'id' => 'idEncuestaClienteEstado',
      'selfId' => 'idEstado',
    ],
  ];
	var $id = 'idEncuestaCliente';
	var $select = ['encuestas_clientes.*','encuestas.titulo as titulo', 'clientes.razonSocial as razonSocial', 'clientes.cuit as cuit','encuesta_cliente_estado.nombre as estado'];
  var $where = [];
	var $column_order = ['clientes.razonSocial', 'clientes.cuit', 'encuestas_clientes.fechaRespuesta', 'estado'];
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

  public function mostrarEncuestasClientes()
  {
    $this->load->view('_header');
    $this->load->view('encuestas/mostrar_encuestas_clientes',);
    $this->load->view('_footerTablasEncuestasClientes');
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

    $encuestaCliente = $this->encuestaCliente->getByClientAndEncuestaId($idEncuesta, $idCliente);
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

  public function getClientesDeEncuesta($idEncuesta = null)
  {

    $encuesta = $this->encuesta->getById($idEncuesta);

    // if(!$encuesta){
		// 	echo 'Encuesta mo encontrada';
    //   die;
		// }

    if($idEncuesta) {
      $this->where[] =  ['encuestas_clientes.idEncuesta', $idEncuesta];    
    }

    if(!isAdmin()) {
      $this->where[] = ['encuestas_responsable.idUsuario', $this->session->userdata('logged_user_admin')->idUsuario];
    }

    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
			$row = [];
      if(!$idEncuesta) {
        $row[] = $li->titulo;
      }
			$row[] = $li->razonSocial;
			$row[] = $li->cuit;
			$row[] =  $li->fechaRespuesta ? date('m/d/Y H:i', strtotime($li->fechaRespuesta)) : 'No ha respondido';	
			$row[] = $li->estado;
      $row[] = 
          '<a class="btn btn-sm btn-primary mr-1"
          href="'.base_url("index.php/encuestas/$li->idEncuesta/cliente/$li->idEncuestaCliente").'">
			      <i class="fa fa-eye"></i></a>'.
             (isAdmin() 
             ? '<a class="btn btn-sm btn-danger"
              href="'.base_url("index.php/encuestas/$li->idEncuesta/cliente/$li->idEncuestaCliente/eliminar").'" 
              title="Delete"
              onclick="return confirm('."'Seguro que quieres eliminar  este registro?');".'">
            <i class="fa fa-trash"></i></a>'
           : '')
           ;
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

  public function eliminar($idEncuesta, $idEncuestaCliente)
  {
    if(!isAdmin()) return redirect(base_url('index.php/encuestas/index'));;
    $this->db->delete($this->table, ['idEncuestaCliente' => $idEncuestaCliente]);
    $this->session->set_flashdata('success', 'Registro eliminado con éxito.');
		redirect(base_url('index.php/encuestas/mostrar/'.$idEncuesta));  
  }
  
}