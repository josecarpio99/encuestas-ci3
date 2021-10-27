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
      $data['idEncuesta'] = $idEncuesta;
			$this->load->view('_header',$data);
      $this->load->view('preguntas/crear',$data);
      $this->load->view('_footerTablasPreguntas',$data);
		}else{
			
			$data = [
        'idEncuesta' => $idEncuesta,
				'detalle' => $this->input->post('detalle', true),	
				'tipo' => $this->input->post('tipo', true),	
        'orden' => $this->pregunta->getPreguntaOrden($idEncuesta)
			];	
      // Es de tipo numero, entonces agregar campos minimo y maximo 
      if($data['tipo'] == 3) {
        $data['minimo'] = $this->input->post('minimo', true);
        $data['maximo'] = $this->input->post('maximo', true);
      }
			
			$idPregunta = $this->pregunta->save($data);

      // Es de tipo lista, entonces agregar sus opciones
      if($data['tipo'] == 2) {
        $this->opcion->save($idPregunta, $this->input->post('opciones', true));
      }

      
			$this->session->set_flashdata('success', 'Pregunta creada con éxito.');

			redirect(base_url("index.php/encuestas/$idEncuesta/preguntas"));
		}

  }

  public function editar($idEncuesta, $idPregunta){
    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}   

    $pregunta = $this->pregunta->getById($idPregunta);

    if(!$_POST){
			$input = $pregunta;
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
			$data['form_action'] = base_url("index.php/encuestas/$idEncuesta/preguntas/$idPregunta/editar");			
			$data['input'] = $input;
			$data['tipos'] = $this->pregunta->getTipos();
      $data['idEncuesta'] = $idEncuesta;
			$this->load->view('_header',$data);
      $this->load->view('preguntas/editar',$data);
      $this->load->view('_footerTablasPreguntas',$data);
		}else{		

			$data = [
        'idEncuesta' => $idEncuesta,
				'detalle' => $this->input->post('detalle', true),	
				'tipo' => $this->input->post('tipo', true),	
        'orden' => $this->pregunta->getPreguntaOrden($idEncuesta)
			];	

      // Es de tipo numero, entonces agregar campos minimo y maximo 
      if($data['tipo'] == 3) {
        $data['minimo'] = $this->input->post('minimo', true);
        $data['maximo'] = $this->input->post('maximo', true);
      }
			
			$this->pregunta->update(['idEncuestaPregunta' => $idPregunta], $data);

      // Es de tipo lista, entonces agregar sus opciones
      if($data['tipo'] == 2) {
        $this->opcion->update($idPregunta, $this->input->post('opciones', true));
      }

      // Pregunta ya no es de tipo lista, entonces borrar opciones de la tabla
      if($data['tipo'] != 2 && $pregunta->tipo == 2) {
        $this->opcion->deleteOpciones($idPregunta);
      }
			$this->session->set_flashdata('success', 'Pregunta actualizada con éxito.');

			redirect(base_url("index.php/encuestas/$idEncuesta/preguntas"));
		}

  }

  public function ordenar()
  {
    $positions = $this->input->post('positions', true);
    foreach ($positions as $position) {      
      $data = [        
        'orden' => $position[1],
      ];
      $this->db->update('encuestas_preguntas', $data, ['idEncuestaPregunta' => $position[0]]);
    }
    echo 'success';
  }

  public function eliminar($idEncuesta, $idPregunta)
  {
    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta){
			$this->session->set_flashdata('warning','Encuesta no encontrada!');
      redirect(base_url('index.php/encuestas/index'));
		}
   
    $this->pregunta->delete($idPregunta);
    $this->session->set_flashdata('success', 'Registro eliminado con éxito.');
    redirect(base_url("index.php/encuestas/mostrar/$idEncuesta"));
  }
}  