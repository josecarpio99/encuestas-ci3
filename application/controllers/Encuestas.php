<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas extends CI_Controller {
  var $table = 'encuestas';
	var $tableJoin = [
    'encuestas_tipos' => [
      'id' => 'idTipoEncuesta',
      'selfId' => 'idTipoEncuesta',
    ],
    'encuestas_estados' => [
      'id' => 'idEstadoEncuesta',
      'selfId' => 'idEstadoEncuesta',
    ],
    'encuestas_responsable' => [
      'id' => 'idEncuesta',
      'selfId' => 'idEncuesta',
    ],
  ];
	var $id = 'idEncuesta';
	var $select = ['encuestas.*', 'encuestas_tipos.nombreTipoEncuesta as tipo', 'encuestas_estados.valor as estado'];
  var $where = [];
	var $column_order = ['encuestas.nombre', 'encuestas.titulo', 'encuestas.estado', 'adm_usuarios.razonSocial'];
	var $column_search = ['encuestas.nombre', 'encuestas.titulo', 'encuestas.estado', 'adm_usuarios.razonSocial']; 
  function __construct()
  {
    parent::__construct();
    setSessionData();
    // redirectIsNoLoggedIn();
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true); 
    $this->load->library('encryption');  
  }

  public function index()
  {        
    $data = [];
    
    $data['userM'] = $this->session->userdata('logged_user_admin')->razonSocial;
    $idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
    $data['perfilUsuario'] = $this->session->userdata('logged_user_admin')->perfil;
    $this->load->view('_header',$data);
    $this->load->view('encuestas/index',$data);
    $this->load->view('_footerTablasEncuestas',$data);

  } 

  public function mostrar($id)
  {   
    $data = [];
    $encuesta = $this->encuesta->getById($id);

    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}

    $data['encuesta'] = $encuesta;
    
    $this->load->view('_header',$data);
    $this->load->view('encuestas/mostrar',$data);
    $this->load->view('_footerTablasEncuestaCliente',$data);

  }

  public function preguntas($id)
  {
    $data = [];
    $encuesta = $this->encuesta->getById($id);

    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}

    $data['encuesta'] = $encuesta;
    $data['preguntas'] = $this->pregunta->getPreguntasOfEncuesta($id);
    
    $this->load->view('_header',$data);
    $this->load->view('encuestas/encuesta_preguntas',$data);
    $this->load->view('_footerTablasEncuestas',$data);
  }

  public function reporteDetalle($id)
  {
    $data = [];
    $encuesta = $this->encuesta->getById($id);

    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}
    $clientesRespuestas = $this->db->query("
      SELECT c.razonSocial, GROUP_CONCAT(valor ORDER BY orden SEPARATOR '|') as respuestas
      FROM `encuestas_clientes_respuestas` ecr
      JOIN encuestas_clientes ec
      ON ec.idEncuestaCliente = ecr.idEncuestaCliente
      JOIN clientes c
      ON c.idcliente = ec.idCliente
      JOIN encuestas_preguntas ep
      ON ep.idEncuestaPregunta = ecr.idEncuestaPregunta
      WHERE ec.idEncuesta = $id
      GROUP BY c.razonSocial
      ORDER BY c.razonSocial, ep.orden;"
    )->result();
    // dd($clientesRespuestas);

    $data['clientesRespuestas'] = $clientesRespuestas;
    $data['encuesta'] = $encuesta;
    $data['preguntas'] = $this->pregunta->getPreguntasOfEncuesta($id);

    $this->load->view('_header',$data);
    $this->load->view('encuestas/reporte_detallado',$data);
    $this->load->view('_footerTablasReporteDetallado',$data);
  }

  public function getEncuestas()
  {
    if(!isAdmin()) {
      $this->where[] = ['idUsuario', $this->session->userdata('logged_user_admin')->idUsuario];
    }
    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
			$row = [];
			$row[] = $li->nombre;
			$row[] = $li->titulo;
			$row[] = $li->tipo;
			$row[] = $li->estado;	
      $row[] = 
          '<a class="btn btn-sm btn-primary"
          href="'.base_url("index.php/encuestas/mostrar/$li->idEncuesta").'">
			      <i class="fa fa-eye mr-1"></i></a>

          <a class="btn btn-sm btn-warning text-white" href="'.base_url("index.php/encuestas/editar/$li->idEncuesta").'" 
              title="Edit">
          <i class="fa fa-pencil-alt mr-1"></i></a>

			
        <a class="btn btn-sm btn-danger"
        href="'.base_url("index.php/encuestas/eliminar/$li->idEncuesta").'" 
        title="Delete"
        onclick="return confirm('."'Seguro que quieres eliminar  este registro?');".'">
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
    if(!$_POST){
			$input = (object) $this->encuesta->getDefaultValues();
		}else{
			$input = (object) $this->input->post(null, true);
		}

		$this->form_validation->set_rules('nombre','Nombre','required', [
      'required' => 'El campo nombre es requerido'
    ]);
		$this->form_validation->set_rules('titulo','Título','required', [
      'required' => 'El campo título es requerido'
    ]);
		

		if($this->form_validation->run() == false){
			$data['form_action'] = base_url("index.php/encuestas/agregar");			
			$data['input'] = $input;
      $data['encuestaTipos'] = $this->db->get('encuestas_tipos')->result();
      $data['encuestaEstados'] = $this->db->get('encuestas_estados')->result();

			$this->load->view('_header',$data);
      $this->load->view('encuestas/encuesta_form',$data);
      $this->load->view('_footerTablasEncuestas',$data);
		}else{
			
			$data = [
				'nombre'         => $this->input->post('nombre', true),	
				'titulo'         => $this->input->post('titulo', true),	
				'mensaje' => $this->input->post('mensaje', true),	
				'idTipoEncuesta' => $this->input->post('idTipoEncuesta', true),	
				'idEstadoEncuesta' => $this->input->post('idEstadoEncuesta', true),	
			];	
			
			$this->encuesta->save($data);
			$this->session->set_flashdata('success', 'Encuesta creada con éxito.');

			redirect(base_url('index.php/encuestas/index'));
		}
  }

  public function editar($id)
  {
		$encuesta = $this->encuesta->getById($id);
    
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}

    if(!$_POST){
			$input = $encuesta;
		}else{
			$input = (object) $this->input->post(null, true);
		}

		$this->form_validation->set_rules('nombre','Nombre','required', [
      'required' => 'El campo nombre es requerido'
    ]);
		$this->form_validation->set_rules('titulo','Título','required', [
      'required' => 'El campo título es requerido'
    ]);
		

		if($this->form_validation->run() == false){
			$data['form_action'] = base_url("index.php/encuestas/editar/$id");			
			$data['input'] = $input;
      $data['encuestaTipos'] = $this->db->get('encuestas_tipos')->result();
      $data['encuestaEstados'] = $this->db->get('encuestas_estados')->result();
			$this->load->view('_header',$data);
      $this->load->view('encuestas/encuesta_form',$data);
      $this->load->view('_footerTablasEncuestas',$data);
		}else{
			
			$data = [
				'nombre' => $this->input->post('nombre', true),	
				'titulo' => $this->input->post('titulo', true),	
				'mensaje' => $this->input->post('mensaje', true),	
				'idTipoEncuesta' => $this->input->post('idTipoEncuesta', true),	
				'idEstadoEncuesta' => $this->input->post('idEstadoEncuesta', true),	
			];	
			
			$this->encuesta->update(['idEncuesta' => $id], $data);
			$this->session->set_flashdata('success', 'Encuesta actualizada con éxito.');

			redirect(base_url('index.php/encuestas/index'));
		}
  }

  public function eliminar($id)
  {
    $this->encuesta->delete($id);
    $this->session->set_flashdata('success', 'Registro eliminado con éxito.');
		redirect(base_url('index.php/encuestas/index'));
  }
}