
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="card-body d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><?= $encuesta->nombre ?></h6>                
                <a href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/preguntas/agregar") ?>" class="btn btn-primary">Agregar pregunta</a>
              </div>
			      </div>
            <div class="card-body" id="listaPreguntas" >
            <?php foreach ($preguntas as $pregunta) :  ?>
              <div class="card mt-4" style="cursor: all-scroll;"
              data-index="<?= $pregunta->idEncuestaPregunta ?>" data-position="<?= $pregunta->orden ?>" >
                <div class="card-header d-flex justify-content-between">
                  <h6><?= $pregunta->detalle ?></h6>
                  <div class="actions">
                    <a class="btn btn-sm btn-warning"
                    href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/preguntas/$pregunta->idEncuestaPregunta/editar") ?>" 
                    >
                      <i class="fa fa-edit mr-1"></i>
                    </a>
                    <a class="btn btn-sm btn-danger"
                    href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/preguntas/$pregunta->idEncuestaPregunta/eliminar") ?>" 
                    title="Delete"
                    onclick="return confirm('Seguro que quieres eliminar  este registro?');">
                      <i class="fa fa-trash mr-1"></i>
                    </a>
                  </div>
                </div>
                <?php if($pregunta->tipo == 2) { ?>
                  <ul class="list-group list-group-flush">

                  <?php foreach($pregunta->opciones as $opcion) : ?>
                    <li class="list-group-item"><?= $opcion->valor ?></li>                  
                  <?php endforeach ?>
                  
                  </ul> 

                <?php } ?>
               
              </div>
            <?php endforeach  ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
