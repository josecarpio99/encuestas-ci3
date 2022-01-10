<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaResponsable extends CI_Controller {
  var $table = 'encuestas_responsable';
	var $tableJoin = [
    'adm_usuarios' => [
      'id' => 'idUsuario',
      'selfId' => 'idUsuario',
      'tableJoin' => [
        'sucursales' => [
          'id' => 'idSucursal',
          'selfId' => 'idSucursal',
        ],
      ]
    ],  
  ];
  var $group_by = NULL;
  var $id = 'idEncuestaResponsable';
	var $select = ['encuestas_responsable.*','adm_usuarios.razonSocial AS razonSocial', 'sucursales.*'];
  var $where = [];
	var $column_order = ['adm_usuarios.razonSocial'];
	var $column_search = ['adm_usuarios.razonSocial'];
		
  function __construct()
  {
    parent::__construct();    
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true);
  }

  public function index($idEncuesta)
  {
    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}     
    $data['idEncuesta'] = $idEncuesta;
    $this->load->view('_header',$data);
    $this->load->view('encuestas/responsables',$data);
    $this->load->view('_footerTablasResponsables',$data);
  }

  public function getResponsables($idEncuesta)
  {
    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
      if($li->idEncuesta != $idEncuesta) continue;
			$row = [];
			$row[] = $li->nombreSucursal;	
			$row[] = $li->razonSocial;	
      $row[] = 
          '			
        <a class="btn btn-sm btn-danger"
        href="'.base_url("index.php/encuestas/$idEncuesta/responsables/$li->idEncuestaResponsable/eliminar/").'" 
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

  public function agregar($idEncuesta)
  {
    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		} 
    if(!$_POST){
			$input = ['idUsuario' => ''];
		}else{
			$input = (object) $this->input->post(null, true);
		}

		$this->form_validation->set_rules('idUsuario','Responsable','required|integer', [
      'required' => 'El campo responsable es requerido',
      'integer' => 'El campo responsable no es válido'
    ]);		

		$this->form_validation->set_rules('idSucursal','Responsable','required|integer', [
      'required' => 'El campo sucursal es requerido',
      'integer' => 'El campo sucursal no es válido'
    ]);			

		if($this->form_validation->run() == false){
      // $usuarios = $this->db->query("
      //   SELECT * FROM `adm_usuarios`
      //   WHERE idUsuario NOT IN(
      //     SELECT idUsuario FROM encuestas_responsable WHERE idEncuesta = $idEncuesta
      //   );
      // ")->result(); 

			$data['form_action'] = base_url("index.php/encuestas/$idEncuesta/responsables/agregar");			
			$data['input'] = $input;
			$data['encuesta'] = $encuesta;
			$data['idEncuesta'] = $encuesta->idEncuesta;
			$data['usuarios'] = [];   
      $data['sucursales'] = $this->db->get('sucursales')->result();


			$this->load->view('_header',$data);
      $this->load->view('encuestas/responsable_form',$data);
      $this->load->view('_footerTablasResponsables',$data);
		}else{
      // dd($this->input->post('idUsuario', true));
      $usuario = $this->db->get_where(
        'adm_usuarios', ['idUsuario' => $this->input->post('idUsuario', true)]
      )->row();

			$data = [
				'idEncuesta' => $idEncuesta,					
				'idUsuario'  => $this->input->post('idUsuario', true),	
				'idSucursal' => $usuario->idSucursal,					
			];	
			
			$this->db->insert($this->table, $data);
			$this->session->set_flashdata('success', 'Registro asociado con éxito.');

			redirect(base_url("index.php/encuestas/$idEncuesta/responsables"));
		}
  }

  public function eliminar($idEncuesta, $idEncuestaResponsable)
  {
    $this->db->delete($this->table, [$this->id => $idEncuestaResponsable]);
    $this->session->set_flashdata('success', 'Registro eliminado con éxito.');
		redirect(base_url("index.php/encuestas/$idEncuesta/responsables"));
  }
}  