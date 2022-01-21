<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComprasRepuesto extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  public function mostrarVentas()
  {
    $data = [];
    $this->load->view('_header',$data);
    $this->load->view('encuestas/clientes_ventas',$data);
    $this->load->view('_footerTablasClientesVentas',$data);
  }

  public function getComprasRepuesto($desde = null, $hasta = null, $tipoServicio = 'repuesto')
  {    
    $query = $this->db
    ->from('clientes_compras_repuestos ccr');
    
    if($desde & $hasta) {
      $query->where('fecha >', $desde);
      $query->where('fecha <', $hasta);
    }   

    foreach($columns = $this->input->post('columns') as $field => $value) {
      if(!empty($value)) {
        $query->like($field, $value);
      }
    }
    
    if($tipoServicio == 'servicio') {
      $query->like('cod_repuesto', 'MO');
    }else {
      $query->not_like('cod_repuesto', 'MO');
      $query->group_by('idCliente');
    }

    $result = $query->get()->result();

    echo json_encode($result);
  }
  
  public function crearEncuestaCliente()
  {
    $clientes = $this->input->post('clientes', true);
    $tipo = $this->input->post('tipo', true);
    $desde = $this->input->post('desde', true);
    $hasta = $this->input->post('hasta', true);
    
    if($tipo == 'repuesto') {
      foreach($clientes as $clienteId) {
        $compraRepuesto = $this->db
        ->from('clientes_compras_repuestos ccr')
        ->where('idCliente', $clienteId)
        ->where('fecha >', $desde)
        ->where('fecha <', $hasta)
        ->not_like('cod_repuesto', 'MO')
        ->group_by('idCliente')
        ->get()
        ->row();

        if(!is_null($compraRepuesto->idEncuestaCliente)) continue;
      
        $encuesta = $this->db->from('encuestas')
        ->where('estado', 'abierto')
        ->where('idTipoEncuesta', 1)
        ->get()
        ->row();

        $responsable = $this->db->select('er.idUsuario')
        ->from('sucursales_localidades sl')
        ->join('encuestas_responsable er', "er.idSucursal = sl.Idsucursal")
        ->where('sl.idLocalidad', $clienteId)
        ->get()
        ->row(); 

        $fechaEnviada = date('Y-m-d', strtotime(" + $encuesta->cantidad_dias days"));

        $this->db->insert('encuestas_clientes', [
          'idCliente' => $clienteId,
          'idUsuario' => $responsable ? $responsable->idUsuario : NULL,
          'idEncuesta' => $encuesta->idEncuesta,
          'mensaje'   => '',
          'fechaEnvio' => $fechaEnviada
        ]);  

        $idEncuestaCliente = $this->db->insert_id();

        $this->db->set('idEncuestaCliente', $idEncuestaCliente);
        $this->db->where('idCliente', $clienteId);
        $this->db->where('fecha >', $desde);
        $this->db->where('fecha <', $hasta);
        $this->db->not_like('cod_repuesto', 'MO');

        $this->db->update('clientes_compras_repuestos'); 

        echo 'ok';
      }
    }

    if($tipo == 'servicio') {
      foreach($clientes as $ventaId) {
        $venta = $this->db->from('clientes_compras_repuestos')
        ->where('idCompraRespuesto', $ventaId)
        ->get()
        ->row();

        if(!is_null($venta->idEncuestaCliente)) continue;

        $clienteId = $venta->idCliente;

        $encuesta = $this->db->from('encuestas')
        ->where('estado', 'abierto')
        ->where('idTipoEncuesta', 2)
        ->get()
        ->row();

        $responsable = $this->db->select('er.idUsuario')
        ->from('sucursales_localidades sl')
        ->join('encuestas_responsable er', "er.idSucursal = sl.Idsucursal")
        ->where('sl.idLocalidad', $clienteId)
        ->get()
        ->row(); 

        $fechaEnviada = date('Y-m-d', strtotime(" + $encuesta->cantidad_dias days"));

        $this->db->insert('encuestas_clientes', [
          'idCliente' => $clienteId,
          'idUsuario' => $responsable ? $responsable->idUsuario : NULL,
          'idEncuesta' => $encuesta->idEncuesta,
          'mensaje'   => '',
          'fechaEnvio' => $fechaEnviada
        ]);  

        $idEncuestaCliente = $this->db->insert_id();

        $this->db->set('idEncuestaCliente', $idEncuestaCliente);
        $this->db->where('idCompraRespuesto', $ventaId);
        $this->db->like('cod_repuesto', 'MO');
        $this->db->update('clientes_compras_repuestos'); 

        echo 'ok';
      }
    }

    
  }

}  