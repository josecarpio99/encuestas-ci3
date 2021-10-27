<?php
class Encuesta_model  extends CI_Model  {

	public function __construct()
	{
		parent::__construct();		
	}

  public function getDefaultValues()
  {
    return [
        'nombre'          => '',        
        'titulo'          => '',        
        'idTipoEncuesta'  => 1,        
        'idEstadoEncuesta'=> 1,        
    ];
  }

  public function getById($id)
  {
    return $this->db->select('e.*,ec.*')
    ->from('encuestas e')
    ->where('e.idEncuesta', $id)
    ->join('encuestas_responsable ec', 'ec.idEncuesta = e.idEncuesta')
    ->get()
    ->row();
  }

  public function userIsAuthorized($idUsuario)
  {
    return $this->session->userdata('logged_user_admin')->idUsuario === $idUsuario;
  }  

  public function save($data)
  {
    $this->db->insert($this->table, $data);
    $encuesta_id = $this->db->insert_id();
    $this->db->insert('encuestas_responsable', [
      'idEncuesta' => $encuesta_id,
      'idUsuario' => $this->session->userdata('logged_user_admin')->idUsuario,
      'idSucursal' => $this->session->userdata('logged_user_admin')->idSucursal,
    ]);
  }

  public function update($where, $data){
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }  
  
  public function delete($id)
  {
    $this->db->delete($this->table, ['idEncuesta' => $id]);    
  }
}
