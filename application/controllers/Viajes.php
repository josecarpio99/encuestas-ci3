<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viajes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->helper('url');
		
		// $this->load->library('grocery_CRUD');
		// $this->load->library('ajax_grocery_crud');	
    $this->load->library('encryption');         
		
	}
	
	
	public function clientes_localidades($idViaje, $idLocalidad){
		if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');
		$data = [];
		$this->load->model('Users_model');
		$this->load->model('Viajes_model');
		
		$idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
		$idUsuario = $this->session->userdata('logged_user_admin')->idUsuario;

		
		$todas = $this->Viajes_model->get_listadoClientesDeLocalidad($idEmpresa,$idViaje, $idLocalidad);
		
		$response = "";
		
		$response .= '<div class="GFGclass" id="divGFG">';

		$response .= '	<div class="table-responsive">';
		$response .= '		<table class="table table-bordered display compact" id="dataTablePadres" width="100%" cellspacing="0">';
		$response .= "		  <thead>";
		$response .= "			<tr>";
		$response .= "			  <th>Nro</th>";
		$response .= "			  <th>Razón Social</th>";
		$response .= "			  <th>Cuit</th>";
		$response .= "			  <th>Celular</th>";
		$response .= "			  <th>Whatsapp</th>";
		$response .= "			  <th>Contactos</th>";
		$response .= "			</tr>";
		$response .= "		  </thead>";

		$response .= "		  <tbody>";
		
		
		foreach ($todas as $cc) { 
			$response .= "<tr>";
			
			$response .= "<td>" . $cc->codigoERP . "</td>";
			$response .= "<td>" . $cc->razonSocial . "</td>";
			$response .= "<td>" . $cc->cuit . "</td>";
			$response .= "<td>" . $cc->celular . "</td>";
            $response .= "<td class='closeModal'><a target='_blank' href='https://wa.me/".$cc->celular."/?text='><button class='btn btn-success'><i class='fa fa-phone' aria-hidden='true'></i></button></a></td>";
            $response .= "<td><button class='btn btn-success' onclick='getContactos(".$cc->idCliente.")'><i class='fa fa-link' aria-hidden='true'></i></button></td>";

            $response .= "</tr>";
                                   
        }
		
		$response .= "</tbody>";

		$response .= "		</table>";

		$response .= "	 </div>";
		$response .= "</div> ";
		
		
		echo  $response;
		//return $response;
	}
	
	public function clientes_repuestos($idViaje, $idRepuesto){
        if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');
        $data = [];
        $this->load->model('Viajes_model');

        $todas = $this->Viajes_model->get_listadoClientesDeRepuesto($idViaje, $idRepuesto);

        $response = "";

        $response .= '	<div class="table-responsive">';
        $response .= '		<table class="table table-bordered display compact" id="tableRepuesto" width="100%" cellspacing="0">';
        $response .= "		  <thead>";
        $response .= "			<tr>";
        $response .= "			  <th>NombreCompleto</th>";
        $response .= "			  <th>Razón Social</th>";
        $response .= "			  <th>Email</th>";
        $response .= "			  <th>Celular</th>";
        $response .= "			  <th>Whatsapp</th>";
        $response .= "			  <th>Contactos</th>";
        $response .= "			</tr>";
        $response .= "		  </thead>";

        $response .= "		  <tbody>";


        foreach ($todas as $cc) {
            $response .= "<tr>";

            $response .= "<td>" . $cc->nombreCompleto . "</td>";
            $response .= "<td>" . $cc->razonSocial . "</td>";
            $response .= "<td class='closeModal'><a href='mailto:".$cc->email."'>" . $cc->email . "</td>";
            $response .= "<td>" . $cc->celular . "</td>";
            $response .= "<td class='closeModal'><a target='_blank' href='https://wa.me/".$cc->celular."/?text='><button class='btn btn-success'><i class='fa fa-phone' aria-hidden='true'></i></button></a></td>";
            $response .= "<td><button class='btn btn-success' onclick='getContactos(".$cc->idCliente.")'><i class='fa fa-link' aria-hidden='true'></i></button></td>";

            $response .= "</tr>";

        }

        $response .= "</tbody>";

        $response .= "</table>";

        $response .= "</div> ";


        echo  $response;
    }

    public function clientes_accions($idViaje, $idAccion){
        if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');
        $data = [];
        $this->load->model('Viajes_model');

        $todas = $this->Viajes_model->get_listadoClientesDeAccion($idViaje, $idAccion);

        $response = "";

        $response .= '	<div class="table-responsive">';
        $response .= '		<table class="table table-bordered display compact" id="tableRepuesto" width="100%" cellspacing="0">';
        $response .= "		  <thead>";
        $response .= "			<tr>";
        $response .= "			  <th>Razón Social</th>";
        $response .= "			  <th>Email</th>";
        $response .= "			  <th>Celular</th>";
        $response .= "			  <th>Whatsapp</th>";
        $response .= "			  <th>Contactos</th>";
        $response .= "			</tr>";
        $response .= "		  </thead>";

        $response .= "		  <tbody>";


        foreach ($todas as $cc) {
            $response .= "<tr>";

            $response .= "<td>" . $cc->razonSocial . "</td>";
            $response .= "<td class='closeModal'><a href='mailto:".$cc->email."'>" . $cc->email . "</td>";
            $response .= "<td>" . $cc->celular . "</td>";
            $response .= "<td class='closeModal'><a target='_blank' href='https://wa.me/".$cc->celular."/?text='><button class='btn btn-success'><i class='fa fa-phone' aria-hidden='true'></i></button></a></td>";
            $response .= "<td><button class='btn btn-success' onclick='getContactos(".$cc->idCliente.")'><i class='fa fa-link' aria-hidden='true'></i></button></td>";

            $response .= "</tr>";

        }

        $response .= "</tbody>";

        $response .= "</table>";

        $response .= "</div> ";


        echo  $response;
    }

    public function clientes_contactos($idEncuestaCliente, $accion = 'pendientes'){
        // if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');
				$this->load->model('encuesta_model', 'encuesta', true);
				$this->load->model('encuestaCliente_model', 'encuestaCliente', true);

        $idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
				$encuestaCliente = $this->encuestaCliente->getByID($idEncuestaCliente);
				$encuesta = $this->encuesta->getById($encuestaCliente->idEncuesta);

				$fechaEnvio = date('m-d-Y', strtotime($encuestaCliente->fechaEnvio. ' ' . $encuesta->cantidad_dias . 'days'));
      	$menorAFechaEnvio = date('Y-m-d') < date('Y-m-d', strtotime($encuestaCliente->fechaEnvio. ' ' . $encuesta->cantidad_dias . 'days'));


        $data = [];
        $this->load->model('Viajes_model');

        $todas = $this->Viajes_model->get_listadoClientesContactos($idEmpresa, $encuestaCliente->idCliente);

        $response = "";

        $response .= '	<div class="table-responsive">';
        $response .= '		<table class="table table-bordered display compact" id="tableRepuesto" width="100%" cellspacing="0">';
        $response .= "		  <thead>";
        $response .= "			<tr>";
        $response .= "			  <th>Razón Social</th>";
        $response .= "			  <th>FuncionContacto</th>";
        $response .= "			  <th>Email</th>";
        $response .= "			  <th>Celular</th>";
        $response .= "			  <th>Alias</th>";
        $response .= "			  <th>Acciones</th>";
        $response .= "			</tr>";
        $response .= "		  </thead>";

        $response .= "		  <tbody>";

				$encrypted = $this->encryption->encrypt($encuesta->idEncuesta.'/'.$encuestaCliente->idCliente);
				$encrypted = urlencode($encrypted);

				$whatsappText = $encuesta->mensaje.'%0a%0a'.$encuestaCliente->mensaje.'%0a%0a'.base_url("index.php/survey/?q=$encrypted");

        foreach ($todas as $cc) {	
            $response .= "<tr>";

            $response .= "<td>" . $cc->razonSocial . "</td>";
            $response .= "<td>" . $cc->nombreFuncion . "</td>";
            $response .= "<td class='closeModal'><a href='mailto:".$cc->email."'>" . $cc->email . "</td>";
            $response .= "<td>" . $cc->celular . "</td>";
            $response .= "<td>" . $cc->alias . "</td>";

						$acciones = '<td>';
						if ($accion == 'pendientes') {
							if ($encuestaCliente->pausada == 0) { 
								$acciones .= '<a target="_blank" href="https://wa.me/'.$cc->celular.'/?text='.$whatsappText.'"
								'.($menorAFechaEnvio ? 'onclick="return confirm('."'Estas enviando la encuesta antes de la fecha pautada, confirmar?');".'"' : '').'
								>
								<button type="button" style="border-radius: 50% 50% 50% 0%;display: inline-block;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
								</button>
								</a>
								<a  target="_blank" href="whatsapp://send?text='.$whatsappText.'&phone='.$cc->celular.'&abid='.$cc->celular.'"
								'.($menorAFechaEnvio ? 'onclick="return confirm('."'Estas enviando la encuesta antes de la fecha pautada, confirmar?');".'"' : '').'
								> 
											<button type="button" style="display: inline-block;border-color:#661cc8;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
											</button>
								</a>
								<a class="btn btn-sm btn-secondary" title="Encuesta enviada"
									href="'.base_url("index.php/encuestas/$encuesta->idEncuesta/cliente/$encuestaCliente->idCliente/enviado").'"
									'.($menorAFechaEnvio ? 'onclick="return confirm('."'Estas enviando la encuesta antes de la fecha pautada, confirmar?');".'"' : '').'
									>
										<i class="fa fa-paper-plane mr-1"></i></a>
								';
							}
	
							$acciones .=  '          
								<a class="btn btn-sm btn-primary" target="_blank"
								href="'.base_url("index.php/survey/?q=$encrypted").'">
									<i class="fa fa-eye mr-1"></i></a>          
									<a class="btn btn-sm btn-warning text-white" href="'.base_url("index.php/encuestas/$encuesta->idEncuesta/encuestaCliente/$encuestaCliente->idEncuestaCliente/guardar").'" title="'.$encuestaCliente->mensaje.'" >
								<i class="fa fa-comment-alt mr-1"></i></a>';
							} else {
								$acciones .= '
								<a target="_blank" href="https://wa.me/'.$cc->celular.'/?text='.$whatsappText.'" >
										<button type="button" style="border-radius: 50% 50% 50% 0%;display: inline-block;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
										</button>
								</a>
								<a  target="_blank" href="whatsapp://send?text='.$whatsappText.'&phone='.$cc->celular.'&abid='.$cc->celular.'"> 
											<button type="button" style="display: inline-block;border-color:#661cc8;" class="btn btn-sm btn-success"><i class="fa fa-phone" aria-hidden="true"></i>
											</button>
								</a>
								<a class="btn btn-sm btn-primary mr-1" target="_blank"
								href="'.( ($encuestaCliente->idEstado == 1 || $encuestaCliente->idEstado == 2) 
									? base_url("index.php/survey/?q=$encrypted")
									: base_url("index.php/encuestas/$encuesta->idEncuesta/cliente/$encuestaCliente->idEncuestaCliente") ).'">
										<i class="fa fa-eye"></i>
								</a>'.
									(isAdmin() 
									? '<a class="btn btn-sm btn-danger"
										href="'.base_url("index.php/encuestas/$encuesta->idEncuesta/cliente/$encuestaCliente->idEncuestaCliente/eliminar").'" 
										title="Delete"
										onclick="return confirm('."'Seguro que quieres eliminar  este registro?');".'">
									<i class="fa fa-trash"></i></a>'
								: '')
								;
						}

						$acciones .= '</td>';

						$response .= $acciones;

            // $response .= "<td class='closeModal'><a target='_blank' href='https://wa.me/".$cc->celular."/?text='><button class='btn btn-success'><i class='fa fa-phone' aria-hidden='true'></i></button></a></td>";

            $response .= "</tr>";

        }

        $response .= "</tbody>";

        $response .= "</table>";

        $response .= "</div> ";


        echo  $response;
    }
	
	
	
	
	public function seleccion_clientes($idViaje)
	{
		try{

			if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');
			$data = [];
			$this->load->model('Users_model');
			$this->load->model('Tablero_model');
			$this->load->model('Maquinas_model');
			
			$data['perfilUsuario'] = $this->session->userdata('logged_user_admin')->perfil ;
			$data['userM'] = $this->session->userdata('logged_user_admin')->razonSocial;
			$idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
			$data['nombreEmpresa'] = $this->Users_model->get_nombreEmpresa( $idEmpresa);
			$data['coloresEmpresa'] = $this->Users_model->get_coloresEmpresa( $idEmpresa);
			$data['idEmpresa'] = $idEmpresa;
			
			$data['vendedores'] = $this->Users_model->get_vendedores($idEmpresa);
			
			$data['idViaje'] = $idViaje;
			
			$idUsuario = $this->session->userdata('logged_user_admin')->idUsuario;
			
			$totalLocalidades =  $this->Users_model->get_cantidadLocalidadesViaje( $idEmpresa, $idViaje);
			
			$data['oportunidades'] =  array();
			
			if($this->session->userdata('logged_user_admin')->perfil == 1){
				$data['clientes'] = $this->Maquinas_model->get_todos_Contactos_AccionMKT_viaje($idEmpresa,$this->session->userdata('logged_user_admin')->idUsuario,$idViaje,0);
				$data['viajes'] = $this->Users_model->get_viaje( $idEmpresa, $idViaje);
			} else {
				$data['clientes'] = $this->Maquinas_model->get_todos_Contactos_AccionMKT_viaje($idEmpresa,0,$idViaje,0);
				$data['viajes'] = $this->Users_model->get_viaje( $idEmpresa,$idViaje);
			}

			$data['allClientes'] = $this->Maquinas_model->get_todos_Contactos_localidades_viaje($idEmpresa, $idViaje, $totalLocalidades);
			
		$this->load->library('mobile_Detect');
		$detect = new Mobile_Detect();
		
		if($detect->isMobile())
		{
			
			$this->load->view('movil/_header');
			$this->load->view('seleccionClientesViajes',$data);
			$this->load->view('_footerTablasSeleccionClientesViajes',$data);
		}else {
			$this->load->view('_header',$data);
			$this->load->view('seleccionClientesViajes',$data);
			$this->load->view('_footerTablasSeleccionClientesViajes',$data);
		}
		
			
			
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function seleccion_clientes_ventas($idViaje)
	{
		try{
			
			if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');

			
			$data = [];
			$this->load->model('Users_model');
			$this->load->model('Tablero_model');
			$this->load->model('Maquinas_model');
			$this->load->model('Ventas_model');
			
			$data['perfilUsuario'] = $this->session->userdata('logged_user_admin')->perfil ;
			$data['userM'] = $this->session->userdata('logged_user_admin')->razonSocial;
			$idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
			$data['nombreEmpresa'] = $this->Users_model->get_nombreEmpresa( $idEmpresa);
			$data['coloresEmpresa'] = $this->Users_model->get_coloresEmpresa( $idEmpresa);
			$data['idEmpresa'] = $idEmpresa;
			
			$data['vendedores'] = $this->Users_model->get_vendedores($idEmpresa);
			
			$idUsuario = $this->session->userdata('logged_user_admin')->idUsuario;
			
			$data['idViaje'] = $idViaje;
			
			$data['viajes'] = $this->Users_model->get_viaje( $idEmpresa,$idViaje);
			$totalLocalidades =  $this->Users_model->get_cantidadLocalidadesViaje( $idEmpresa, $idViaje);
			$filtroLocalidades = "";
			if($totalLocalidades > 0) {
				$filtroLocalidades = " AND clientes.idLocalidad IN (SELECT idLocalidad FROM viajes_localidades WHERE idEmpresa = $idEmpresa AND idViaje = $idViaje) ";
			}
			
			if($this->session->userdata('logged_user_admin')->perfil == 1){
				$data['clientes'] = $this->Maquinas_model->get_todos_Contactos_AccionMKT_viaje($idEmpresa,$idUsuario ,$idViaje,1,$totalLocalidades);
				
				
				$oportunidades =  $this->Ventas_model->get_oportunidadesDeVentas($idEmpresa,0, $filtroLocalidades);
				$data['oportunidades'] = $oportunidades;
				
			} else {
				$data['clientes'] = $this->Maquinas_model->get_todos_Contactos_AccionMKT_viaje($idEmpresa,0,$idViaje,1, $totalLocalidades);
				
				
				$oportunidades =  $this->Ventas_model->get_oportunidadesDeVentas($idEmpresa,0, " AND o.idUsuario = $idUsuario  $filtroLocalidades");
				$data['oportunidades'] = $oportunidades;
			}

			$data['allClientes'] = $this->Maquinas_model->get_todos_Contactos_localidades_viaje($idEmpresa, $idViaje, $totalLocalidades);
			
		$this->load->library('mobile_Detect');
		$detect = new Mobile_Detect();
		
		if($detect->isMobile())
		{
			
			$this->load->view('movil/_header');
			$this->load->view('seleccionClientesViajes',$data);
			$this->load->view('_footerTablasSeleccionClientesViajes',$data);
		}else {
			$this->load->view('_header',$data);
			$this->load->view('seleccionClientesViajes',$data);
			$this->load->view('_footerTablasSeleccionClientesViajes',$data);
		}
		
			
			
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	
	public function actualizar_clientes_accion($idAccionContacto)
	{
		try{
			
			if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');

			$data = [];
			$this->load->model('Users_model');
			$this->load->model('Tablero_model');
			$this->load->model('Maquinas_model');
			
			$data['userM'] = $this->session->userdata('logged_user_admin')->razonSocial;
			$idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
			
			$data['idEmpresa'] = $idEmpresa;
			$accionMKT = $this->Maquinas_model->actualizar_AccionCliente($idAccionContacto,$idEmpresa);
			
			return true;

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
	public function actualizar_estado_visita($idviaje_cliente, $estado)
	{
		try{
			
			if(!@$this->session->userdata('logged_user_admin')->email) redirect ('Form/login');

			$data = [];
			$this->load->model('Users_model');
			$this->load->model('Tablero_model');
			$this->load->model('Maquinas_model');
			
			$data['userM'] = $this->session->userdata('logged_user_admin')->razonSocial;
			$idEmpresa = $this->session->userdata('logged_user_admin')->idEmpresa;
			
			$data['idEmpresa'] = $idEmpresa;
			$accionMKT = $this->Maquinas_model->actualizarViajeCliente($idviaje_cliente, $estado,$idEmpresa);
			
			return true;

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
	
}
