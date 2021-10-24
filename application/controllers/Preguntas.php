<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas extends CI_Controller {
		
  function __construct()
  {
    parent::__construct();
    setSessionData();
    isAdmin();
    $this->load->helper(array('form'));
    $this->load->model('my_model', 'my', true);
    $this->load->model('encuesta_model', 'encuesta', true);
  }

  public function agregar($idEncuesta){
    dd($idEncuesta);

  }

  public function editar($idEncuesta, $idPregunta){
    dd($idPregunta);

  }

  public function eliminar($idEncuesta, $idPregunta)
  {
    dd($idPregunta);
  }
}  