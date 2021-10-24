<?php 

class Pregunta_model extends CI_Model {
  var $table = 'encuestas_preguntas';
	var $id = 'idEncuestaPregunta';
  var $tipos = [
    0 => 'texto',
    1 => 'bool',
    2 => 'lista',
    3 => 'numero',
  ]; 

  public function __construct()
	{
		parent::__construct();		
	}

  public function getDefaultValues()
  {
    return [
        'detalle'     => '',        
        'tipo'        => 0,        
    ];
  }

  public function getPreguntasOfEncuesta($idEncuesta)
  {
    return  $this->db->from($this->table)
    ->where('idEncuesta', $idEncuesta)
    ->order_by('orden', 'ASC')
    ->get()
    ->result();
  }

  public function getPreguntaOrden($idEncuesta)
  {
    return $this->db->from($this->table)->where('idEncuesta', $idEncuesta)->count_all_results() + 1;
  }

  public function getTipos()
  {
    return $this->tipos;
  }

  public function save($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id(); 
    
  }

}