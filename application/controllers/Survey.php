<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {
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

  public function index()
  {  
    $params = $this->encryption->decrypt(rawurldecode($_GET['q']));
    $params = explode('/', $params);
    $idEncuesta = $params[0];
    $idCliente = $params[1];

    $encuestaCliente = $this->encuestaCliente->getByClientAndEncuestaId($idEncuesta, $idCliente);
    if($encuestaCliente && $encuestaCliente->estado == 'respondido') {
      return $this->load->view('survey_respondida');
    }

    $cliente = $this->db->get_where('clientes', ['idCliente' => $idCliente])->row();
    if(!$cliente) show_404();

    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta) show_404();

    $preguntas = $this->pregunta->getPreguntasOfEncuesta($idEncuesta);

    $data = [
      'cliente'     => $cliente,
      'encuesta'    => $encuesta,
      'preguntas'   => $preguntas,
      'form_action' => base_url("index.php/survey/guardar/$idEncuesta/$idCliente")
    ];

    $this->load->view('_header',$data);
    $this->load->view('survey',$data);
  }

  public function guardar($idEncuesta, $idCliente)
  {
    // dd(isset($this->input->post('respuestas')[4]['aprobacion']));
    $cliente = $this->db->get_where('clientes', ['idCliente' => $idCliente])->row();
    if(!$cliente) show_404();

    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta) show_404();

    $encuestaCliente = $this->encuestaCliente->getByClientAndEncuestaId($idEncuesta, $idCliente);   

    if(!$encuestaCliente) {
      $data = [
        'idEncuesta' => $idEncuesta,
        'idCliente'  => $idCliente,
        'fechaRespuesta' => date('Y-m-d H:i'),
        'idEstado' => 3
      ];
      $this->db->insert('encuestas_clientes', $data);
    }else{
      $data = [
        'idEstado' => 3,
        'fechaRespuesta' => date('Y-m-d H:i')
      ];
      $this->db->update('encuestas_clientes', $data,
        ['idEncuestaCliente' => $encuestaCliente->idEncuestaCliente] 
      );     
    }

    $encuestaClienteId = $encuestaCliente ? $encuestaCliente->idEncuestaCliente : $this->db->insert_id();

    $respuestas = $this->input->post('respuestas', true);

    foreach ($respuestas as $key => $respuesta) {
      $data = [
        'idEncuestaCliente'  => $encuestaClienteId,
        'idEncuestaPregunta' => $respuesta['idPregunta'],
        'valor'              => $respuesta['valor'],
      ];
      $this->db->insert('encuestas_clientes_respuestas', $data);     
      
      if(isset($respuesta['aprobacion'])) {
        $response = $respuesta['valor'] < $respuesta['aprobacion'] ? 'insatisfecho' : 'indiferente';
        $response = $respuesta['valor'] >= $respuesta['satisfaccion'] ? 'satisfecho' : $response;
        $this->db->update('encuestas_clientes', 
          [
            'respuesta' => $response,
            'respuesta_pregunta_resumen' => $respuesta['valor']
          ],
          ['idEncuestaCliente' => $encuestaClienteId]
        );
      }
    }

    $this->session->set_flashdata('success', 'Datos enviados. Gracias por responder.');

		redirect(base_url('index.php'));
  }
}
