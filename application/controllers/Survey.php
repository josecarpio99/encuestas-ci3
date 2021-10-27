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
    $this->load->library('encryption');
  }

  public function index()
  {  
    $params = $this->encryption->decrypt(rawurldecode($_GET['q']));
    $params = explode('/', $params);
    $idEncuesta = $params[0];
    $idCliente = $params[1];

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
    $this->load->view('_footerSurvey',$data);
  }

  public function guardar($idEncuesta, $idCliente)
  {
    $cliente = $this->db->get_where('clientes', ['idCliente' => $idCliente])->row();
    if(!$cliente) show_404();

    $encuesta = $this->encuesta->getById($idEncuesta);
    if(!$encuesta) show_404();

    //guardar encuesta_cliente
    $encuestaCliente = [
      'idEncuesta' => $idEncuesta,
      'idCliente'  => $idCliente,
      // 'idUsuario'  => $encuesta->idUsuario,     
    ];

    $this->db->insert('encuestas_clientes', $encuestaCliente);
    $encuestaClienteId = $this->db->insert_id();

    //guardar encesuta_cliente_respuestas
    $respuestas = $this->input->post('respuestas', true);

    foreach ($respuestas as $key => $respuesta) {
      $data = [
        'idEncuestaCliente'  => $encuestaClienteId,
        'idEncuestaPregunta' => $respuesta['idPregunta'],
        'valor'              => $respuesta['valor'],
      ];
      $this->db->insert('encuestas_clientes_respuestas', $data);
    }

    $this->session->set_flashdata('success', 'Datos enviados. Gracias por responder.');

		redirect(base_url('index.php'));
  }
}
