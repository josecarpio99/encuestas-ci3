
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
              
              </div>
			      </div>
            <div class="card-body">
            <?php foreach ($preguntas as $pregunta) :  ?>
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <h6><?= $pregunta->detalle ?></h6>
                    <div class="actions">
                      <a class="btn btn-sm btn-danger"
                      href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/preguntas/$pregunta->idEncuestaPregunta/eliminar") ?>" 
                      title="Delete"
                      onclick="return confirm('Seguro que quieres eliminar  este registro?');">
                      <i class="fa fa-trash mr-1"></i>
                    </a>
                    </div>
                  </div>
                  <!-- <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                  </ul> -->
                </div
              <?php endforeach  ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
