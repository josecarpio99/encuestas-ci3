<?php 

class Pregunta_model extends CI_Model {
  var $table = 'encuestas_preguntas';
	var $id = 'idEncuestaPregunta';

  public function __construct()
	{
		parent::__construct();		
	}

  public function getPreguntasOfEncuesta($idEncuesta)
  {
    return  $this->db->from($this->table)->where('idEncuesta', $idEncuesta)->get()->result();
  }

}