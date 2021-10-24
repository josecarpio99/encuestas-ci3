<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #2ba71c;">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('Form/buscarClientes')?>">
        
        <div class="sidebar-brand-text mx-3"><?php echo 'Nombre_empresa'; ?><sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

	  
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExperiencia" aria-expanded="true" aria-controls="collapseExperiencia">
          <i class="fas fa-fw fa-smile"></i>
          <span>Experiencia de Cliente</span>
        </a>
        <div id="collapseExperiencia" class="collapse" aria-labelledby="headingPosventa" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item" href="<?php echo site_url('Reclamos')?>">Reclamos</a>
			<a class="collapse-item" href="<?php echo "#"; ?>">Encuestas</a>
			<a class="collapse-item" href="<?php echo site_url('Reclamos/historial')?>">Historial de Reclamos</a>
          </div>
        </div>
      </li>
	  
	  
	  
	  <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('Form/logout')?>">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Salir</span></a>
      </li>
	 
      

    </ul>
    <!-- End of Sidebar -->