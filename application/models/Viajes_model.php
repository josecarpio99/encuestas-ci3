<?php
class Viajes_model  extends CI_Model  {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
	
	
	
	public function get_listadoClientesDeLocalidad($idEmpresa,$idViaje, $idLocalidad)
	{
	
		$query =  $this->db->query("SELECT distinct c.*									
									FROM ((((viajes_clientes vc LEFT JOIN  clientes c ON (c.idEmpresa = $idEmpresa AND c.idCliente = vc.idCliente))
									LEFT JOIN accionesMkt_contactos ac ON c.idCliente = ac.idCliente )
									LEFT JOIN accionesMkt acc ON acc.idAccion = ac.idAccion))
									LEFT JOIN view_localidades l ON c.idLocalidad = l.idLocalidad
									WHERE vc.idViaje = $idViaje AND acc.idEstado = 1 AND acc.idEmpresa = $idEmpresa AND c.idLocalidad = $idLocalidad
									
									order by c.razonSocial");
							
		$todas = $query->result();

        return $todas;
	
	}
	
	
    public function get_listadoClientesDeRepuesto($idViaje, $idRepuesto){
        $query =  $this->db->query("SELECT distinct c.*, vm.nombreCompleto 								
									FROM ((((repuestos r LEFT JOIN  view_modelos_repuestos vmr ON (r.idRepuesto = vmr.idRepuesto))
									LEFT JOIN clientes_modelos cm ON vmr.idModelo = cm.idModelo)
									LEFT JOIN view_modelos vm ON cm.idModelo = vm.idModelo))
									LEFT JOIN clientes c ON cm.idCliente = c.idCliente
									LEFT JOIN viajes_clientes vc ON vc.idCliente = c.idCliente
									WHERE r.idRepuesto = $idRepuesto AND vc.idViaje = $idViaje
									
									order by c.razonSocial");

        $todas = $query->result();

        return $todas;
    }

    public function get_listadoClientesDeAccion($idViaje, $idAccion){
        $query =  $this->db->query("SELECT distinct c.* 								
									FROM accionesMkt_contactos ac LEFT JOIN clientes c ON ac.idCliente = c.idCliente
									LEFT JOIN viajes_clientes vc ON vc.idCliente = c.idCliente 
									WHERE ac.idAccion = $idAccion AND vc.idViaje = $idViaje
									
									order by c.razonSocial");

        $todas = $query->result();

        return $todas;
    }

    public function get_listadoClientesContactos($idEmpresa=null,$idCliente=null){
        $query =  $this->db->query("SELECT c.*, f.nombreFuncion 
		                            FROM clientes_contactos c 
		                            LEFT JOIN funcionesContacto f ON c.idFuncionContacto = f.idFuncionContacto
                                	WHERE  c.idEmpresa= $idEmpresa   AND   c.idCliente = $idCliente");
        $todas = $query->result();

        return $todas;
    }
}
