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
        'mensaje'         => '',        
        'idTipoEncuesta'  => 1,        
        'estado'          => 'abierto',        
    ];
  }

  public function getById($id)
  {
    return $this->db->select('e.*,u.*,count(ec.idEncuestaCliente) as total_a_encuestar')
    ->from('encuestas e')
    ->where('e.idEncuesta', $id)
    ->join('encuestas_clientes ec', 'ec.idEncuesta = e.idEncuesta', 'left')
    ->join('encuestas_responsable er', 'er.idEncuesta = e.idEncuesta', 'left')
    ->join('adm_usuarios u', 'er.idUsuario = u.idUsuario', 'left')
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
