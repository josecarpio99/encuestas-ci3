<?php 

class Opcion_model extends CI_Model {
  var $table = 'encuestas_preguntas_listas';
	var $id = 'idEncuestaPreguntaLista'; 

  public function __construct()
	{
		parent::__construct();		
	} 
  
  public function getOpcionesOfPregunta($idPregunta)
  {
    return $this->db->get_where($this->table, ['idEncuestaPregunta' => $idPregunta])->result();
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

  public function update($idPregunta, $opciones)
  {
    $this->deleteOpciones($idPregunta);
    foreach($opciones as $opcion) {
      $data = [
        'valor'              => $opcion,
        'idEncuestaPregunta' => $idPregunta
      ];
      $this->db->insert($this->table, $data);
    }  
  }

  public function deleteOpciones($idPregunta)
  {
    $this->db->delete($this->table, ['idEncuestaPregunta' => $idPregunta]);
  }

}