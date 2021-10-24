<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas extends CI_Controller {
		
  function __construct()
  {
    parent::__construct();    
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
    $this->load->model('pregunta_model', 'pregunta', true);
    $this->load->model('opcion_model', 'opcion', true);
  }

  public function agregar($idEncuesta){
    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}
    if(!$this->encuesta->userIsAuthorized($encuesta->idUsuario)) {
      $this->session->set_flashdata('warning','Usuario no autorizado!');
      redirect(base_url('index.php/encuestas/index'));
    }

    if(!$_POST){
			$input = (object) $this->pregunta->getDefaultValues();
		}else{
			$input = (object) $this->input->post(null, true);
		}

		$this->form_validation->set_rules('detalle','Detalle','required', [
      'required' => 'El campo detalle es requerido'
    ]);
		$this->form_validation->set_rules('tipo','Tipo','required|integer', [
      'required' => 'El campo tipo es requerido',
      'integer' => 'El campo tipo no es válido'
    ]);		

		if($this->form_validation->run() == false){
			$data['form_action'] = base_url("index.php/encuestas/$idEncuesta/preguntas/agregar");			
			$data['input'] = $input;
			$data['tipos'] = $this->pregunta->getTipos();
			$this->load->view('_header',$data);
      $this->load->view('preguntas/pregunta_form',$data);
      $this->load->view('_footerTablasPreguntas',$data);
		}else{
			
			$data = [
        'idEncuesta' => $idEncuesta,
				'detalle' => $this->input->post('detalle', true),	
				'tipo' => $this->input->post('tipo', true),	
        'orden' => $this->pregunta->getPreguntaOrden($idEncuesta)
			];	
			
			$idPregunta = $this->pregunta->save($data);
      // Es de tipo lista, entonces agregar sus opciones
      if($data['tipo'] == 2) {
        $this->opcion->save($idPregunta, $this->input->post('opciones', true));
      }
			$this->session->set_flashdata('success', 'Pregunta creada con éxito.');

			redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
		}

  }

  public function editar($idEncuesta, $idPregunta){
    dd($idPregunta);

  }

  public function eliminar($idEncuesta, $idPregunta)
  {
    dd($idPregunta);
  }
}  