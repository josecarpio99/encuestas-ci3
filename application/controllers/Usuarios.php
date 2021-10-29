<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
		
  function __construct()
  {
    parent::__construct();  
  }

  public function  obtenerUsuariosDeSucursal($idSucursal)
  {
    $usuarios = $this->db->get_where('adm_usuarios', ['idSucursal' => $idSucursal])->result();

    echo json_encode([
      'usuarios' => $usuarios
    ]);
  }
} 