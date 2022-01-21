<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaCliente extends CI_Controller {
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
    'clientes_contactos' => [
      'id' => 'idCliente',
      'selfId' => 'idCliente',
    ], 
    'encuesta_cliente_estado' => [
      'id' => 'idEncuestaClienteEstado',
      'selfId' => 'idEstado',
    ],
    'encuestas_responsable' => [
      'id' => 'idEncuesta',
      'selfId' => 'idEncuesta',
    ]
  ];
	var $id = 'idEncuestaCliente';
  var $groupBy = 'encuestas_clientes.idCliente';
	var $select = ['encuestas_clientes.*','encuestas.titulo as titulo','encuestas.mensaje as encuestaMensaje', 'clientes.razonSocial as razonSocial', 'clientes.cuit as cuit', 'clientes.idCliente as idCliente', 'clientes.celular as celular','encuesta_cliente_estado.nombre as estado','adm_usuarios.razonSocial as vendedor', 'sucursales.nombreSucursal as sucursal', 'COUNT(clientes_contactos.idCliente) as contactos'];
  var $where = [];
	var $column_order = ['encuestas.titulo', 'adm_usuarios.razonSocial', 'sucursales.nombreSucursal', 'clientes.razonSocial', 'clientes.cuit', 'encuestas_clientes.fechaEnvio','encuestas_clientes.fechaRespuesta', 'estado','encuestas_clientes.respuesta', 'encuestas_clientes.respuesta_pregunta_resumen'];
	var $column_search = ['encuestas.titulo', 'adm_usuarios.razonSocial', 'sucursales.nombreSucursal', 'clientes.razonSocial', 'clientes.cuit', 'encuestas_clientes.fechaEnvio','encuestas_clientes.fechaRespuesta', 'estado','encuestas_clientes.respuesta'];

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

  public function mostrarEncuestasClientes()
  {
    $this->load->view('_header');
    $this->load->view('encuestas/mostrar_encuestas_clientes',);
    $this->load->view('_footerTablasEncuestasClientes');
  }

  public function saveMensaje($idEncuesta, $idEncuestaCliente)
  {
    $encuesta = $this->encuesta->getById($idEncuesta);
    
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}

    $encuestaCliente = $this->encuestaCliente->getById($idEncuestaCliente);

    if(!$_POST){
			$input = $encuestaCliente; 
      $data['form_action'] = base_url("index.php/encuestas/$idEncuesta/encuestaCliente/$idEncuestaCliente/guardar");			
			$data['input'] = $input;
			$data['encuesta'] = $encuesta;
			$data['idEncuesta'] = $idEncuesta;

			$this->load->view('_header',$data);
      $this->load->view('encuestas/encuesta_cliente_form',$data);
		}else{
			$input = (object) $this->input->post(null, true);

      $this->db->update($this->table, ['mensaje' => $input->mensaje], ['idEncuestaCliente' => $encuestaCliente->idEncuestaCliente]);

      $this->session->set_flashdata('success', 'Registro guardado con éxito.');

			redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
		} 

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
				'idUsuario'  => $this->session->userdata('logged_user_admin')->idUsuario,					
				'fechaEnvio'  => date('Y-m-d'),					
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

  public function getClientesDeEncuesta($estadoEncuesta = 2, $idEncuesta = null)
  {

    // $encuesta = $this->encuesta->getById($idEncuesta);    

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

    $this->where[] = ['encuestas_clientes.idEstado != 1', '', true];

    if(!isAdmin()) {
      $this->where[] = ['encuestas_responsable.idUsuario', $this->session->userdata('logged_user_admin')->idUsuario];
    }    

    $data = [];
    $list = $this->my->get_datatables($this->tableJoin, $this->select);
    foreach($list as $li){
      $encrypted = $this->encryption->encrypt($idEncuesta.'/'.$li->idCliente);
      $encrypted = urlencode($encrypted);

      $whatsappText = $li->encuestaMensaje.'%0a%0a'.$li->mensaje.'%0a%0a'.base_url("index.php/survey/?q=$encrypted");


			$row = [];
      if(!$idEncuesta) {
        $row[] = $li->titulo;          
      }
			$row[] = $li->vendedor;
			$row[] = $li->sucursal;
			$row[] = $li->razonSocial;
			$row[] = $li->cuit;
			$row[] = $li->fechaEnvio ? date('d-m-Y H:i', strtotime($li->fechaEnvio)) : 'No enviado';	
			$row[] = $li->fechaRespuesta ? date('d-m-Y H:i', strtotime($li->fechaRespuesta)) : 'No ha respondido';	
			$row[] = $li->estado == 'respondido' ? 'SI' : 'NO';
      if($li-> respuesta == 'insatisfecho' || is_null($li-> respuesta)) $row[] = '<span class="text-danger">'.$li->respuesta.'</span>';
      if($li-> respuesta == 'indiferente') $row[] = '<span class="text-warning">'.$li->respuesta.'</span>';
      if($li-> respuesta == 'satisfecho') $row[] = '<span class="text-success">'.$li->respuesta.'</span>';
      $row[] = $li->respuesta_pregunta_resumen;   
      
      $row[] = 
					  ' <a class="btn btn-sm btn-info text-white" type="button"  onclick="contactos(\''. $li->idEncuestaCliente. '\', \'enviadas\')"
						  title="Contactos">  <i class="fa fa-link mr-1"></i> '.$li->contactos.' </a>';

      $row[] = 
          '
          <a target="_blank" href="https://wa.me/'.$li->celular.'/?text='.$whatsappText.'" >
              <button type="button" style="border-radius: 50% 50% 50% 0%;display: inline-block;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
              </button>
          </a>
          <a  target="_blank" href="whatsapp://send?text='.$whatsappText.'&phone='.$li->celular.'&abid='.$li->celular.'"> 
                <button type="button" style="display: inline-block;border-color:#661cc8;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
                </button>
          </a>
          <a class="btn btn-sm btn-primary mr-1" target="_blank"
          href="'.( ($li->idEstado == 1 || $li->idEstado == 2) 
            ? base_url("index.php/survey/?q=$encrypted")
            : base_url("index.php/encuestas/$li->idEncuesta/cliente/$li->idEncuestaCliente") ).'">
              <i class="fa fa-eye"></i>
          </a>'.
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

  public function pausar($idEncuesta, $idCliente)
  {
    $encuestaCliente = $this->encuestaCliente->getByClientAndEncuestaId($idEncuesta, $idCliente);

    $this->db->update(
      $this->table, 
      ['pausada' => $encuestaCliente->pausada == 0 ? 1 : 0], 
      ['idEncuestaCliente' => $encuestaCliente->idEncuestaCliente]
    );

		redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));

  }

  public function cambiarEstadoAEnviado($idEncuesta, $idCliente)
  {
    $encuestaCliente = $this->encuestaCliente->getByClientAndEncuestaId($idEncuesta, $idCliente);

    if(!$encuestaCliente) {
      $data['idCliente'] = $idCliente;
      $data['idEncuesta'] = $idEncuesta;
      $data['idEstado'] = 2;
      $this->db->insert($this->table, $data);
    }else {
      $this->db->update($this->table, ['idEstado' => 2], ['idEncuestaCliente' => $encuestaCliente->idEncuestaCliente]);
    }

		redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
  }

  public function mostrarExportar($idEncuesta)
  {
    $data = ['idEncuesta' => $idEncuesta];
    $this->load->view('_header',$data);
    $this->load->view('encuestas/exportar_encuesta_cliente',$data);
  }
  
  public function exportar($idEncuesta)
  {
    $encuesta = $this->encuesta->getById($idEncuesta);

    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		} 
    
    $fechaEnvio = date('Y-m-d', strtotime(" + $encuesta->cantidad_dias days"));
   
    $path = $_FILES["excel-file"]["tmp_name"];;    
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
    $worksheet = $spreadsheet->getActiveSheet();            
    // Convert spread sheet to array
    $data = $worksheet->toArray();
    foreach($data as $row) {
      if (is_null($row[0])) continue;
      $cliente = $this->db->select('idCliente, idLocalidad')
      ->from('clientes')
      ->where('cuit', $row[0])
      ->get()
      ->row();

      $responsable = $this->db->select('er.idUsuario')
      ->from('sucursales_localidades sl')
      ->join('encuestas_responsable er', "er.idSucursal = sl.Idsucursal")
      ->where('sl.idLocalidad', $cliente->idLocalidad)
      ->get()
      ->row(); 
      
      $fechaDeEnvio = $fechaEnvio;
      $fechaArr = explode('/', $row[2]);
      if (count($fechaArr) == 3) {
        $fechaDeEnvio = $fechaArr[2].'-'.$fechaArr['0'].'-'.$fechaArr[1];
      }

      $this->db->insert($this->table, [
        'idCliente'  => $cliente->idCliente,
        'idUsuario'  => $responsable ? $responsable->idUsuario : NULL,
        'idEncuesta' => $idEncuesta,
        'mensaje'    => $row[1],
        'fechaEnvio' =>  $fechaDeEnvio
      ]);      
      
    }
    redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
  }

  public function eliminar($idEncuesta, $idEncuestaCliente)
  {
    if(!isAdmin()) return redirect(base_url('index.php/encuestas/index'));;
    $this->db->delete($this->table, ['idEncuestaCliente' => $idEncuestaCliente]);
    $this->session->set_flashdata('success', 'Registro eliminado con éxito.');
		redirect(base_url('index.php/encuestas/mostrar/'.$idEncuesta));  
  }
  
}