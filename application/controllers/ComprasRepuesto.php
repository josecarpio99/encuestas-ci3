<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComprasRepuesto extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  public function getComprasRepuesto($desde = null, $hasta = null, $servicios = true)
  {
    $query = $this->db
    ->from('clientes_compras_repuestos ccr');
    
    if($desde & $hasta) {
      $query->where('fecha >', $desde);
      $query->where('fecha <', $hasta);
    }   
    
    if($servicios) {
      $query->like('cod_repuesto', 'MO');
    }else {
      $query->not_like('cod_repuesto', 'MO');
    }

    $result = $query->limit(100)->get()->result();

    return json_encode($result);
  }


}  