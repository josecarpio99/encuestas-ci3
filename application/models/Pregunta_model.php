<?php 

class Pregunta_model extends CI_Model {
  var $table = 'encuestas_preguntas';
	var $id = 'idEncuestaPregunta';
  var $tipos = [
    0 => 'texto',
    1 => 'si/no',
    2 => 'lista',
    3 => 'numero',
  ]; 

  public function __construct()
	{
		parent::__construct();	
    $this->load->model('opcion_model', 'opcion', true);
	}

  public function getDefaultValues()
  {
    return [
        'detalle'     => '',        
        'tipo'        => 0,        
    ];
  }

  public function getById($id)
  {
    $pregunta = $this->db->get_where($this->table, [$this->id => $id])->row();
    if($pregunta->tipo == 2) {
      $pregunta->opciones = $this->opcion->getOpcionesOfPregunta($pregunta->idEncuestaPregunta);
    }
    return $pregunta;
  }

  public function getPreguntasOfEncuesta($idEncuesta)
  {
    $preguntas = $this->db->from($this->table)
    ->where('idEncuesta', $idEncuesta)
    ->order_by('orden', 'ASC')
    ->get()
    ->result();
    foreach ($preguntas as $key => $pregunta) {
      if($pregunta->tipo == 2) {
        $preguntas[$key]->opciones = $this->opcion->getOpcionesOfPregunta($pregunta->idEncuestaPregunta);
      }
    }
    return $preguntas;
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

  public function update($where, $data){
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  } 

  public function setPreguntasResumenToFalse($idEncuesta)
  {
    $this->db->update($this->table, ['es_pregunta_resumen' => 0], ['idEncuesta' => $idEncuesta]);
  }

  public function delete($id)
  {
    $this->db->delete($this->table, [$this->id => $id]);  
  }

}