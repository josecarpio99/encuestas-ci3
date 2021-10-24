<?php 

class Opcion_model extends CI_Model {
  var $table = 'encuestas_preguntas_listas';
	var $id = 'idEncuestaPreguntaLista'; 

  public function __construct()
	{
		parent::__construct();		
	}  

  public function save($idPregunta, $opciones)
  {
    foreach($opciones as $opcion) {
      $data = [
        'valor'              => $opcion,
        'idEncuestaPregunta' => $idPregunta
      ];
      $this->db->insert($this->table, $data);
    }
    
  }

}