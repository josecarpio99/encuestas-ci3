<?php
class Encuesta_model  extends CI_Model  {

	public function __construct()
	{
		parent::__construct();		
	}

  public function getDefaultValues()
  {
    return [
        'nombre'        => '',        
        'titulo'        => '',        
    ];
  }

  public function getById($id)
  {
    return $this->db->get_where($this->table, ['idEncuesta' => $id])->row();
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
