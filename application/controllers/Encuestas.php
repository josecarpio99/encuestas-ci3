<?php
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
    isAdmin();
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true);
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
    $data['preguntas'] = $this->pregunta->getPreguntasOfEncuesta($id);
    
    $this->load->view('_header',$data);
    $this->load->view('encuestas/mostrar',$data);
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
			$this->load->view('_header',$data);
      $this->load->view('encuestas/encuesta_form',$data);
      $this->load->view('_footerTablasEncuestas',$data);
		}else{
			
			$data = [
				'nombre' => $this->input->post('nombre', true),	
				'titulo' => $this->input->post('titulo', true),	
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
			$this->load->view('_header',$data);
      $this->load->view('encuestas/encuesta_form',$data);
      $this->load->view('_footerTablasEncuestas',$data);
		}else{
			
			$data = [
				'nombre' => $this->input->post('nombre', true),	
				'titulo' => $this->input->post('titulo', true),	
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