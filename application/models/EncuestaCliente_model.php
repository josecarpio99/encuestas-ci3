<?php
class EncuestaCliente_model  extends CI_Model  {

	public function __construct()
	{
		parent::__construct();		
	}

  public function getByID($id)
  {
    // return $this->db->get_where('encuestas_clientes', ['idEncuestaCliente' => $id])->row();
    return $this->db
    ->select('ec.*, c.*')
    ->from('encuestas_clientes ec')
    ->join('clientes c', 'c.idCliente = ec.idCliente')
    ->where('ec.idEncuestaCliente', $id)
    ->get()
    ->row();
  }

  public function getRespuestas($idEncuestaCliente)
  {
    return $this->db
    ->select('ecr.valor as respuesta, ep.detalle as pregunta')
    ->from('encuestas_clientes_respuestas ecr')
    ->join('encuestas_preguntas ep', 'ep.idEncuestaPregunta = ecr.idEncuestaPregunta')
    ->where('ecr.idEncuestaCliente', $idEncuestaCliente)
    ->order_by('ep.orden', 'ASC')
    ->get()
    ->result();
  }
}  