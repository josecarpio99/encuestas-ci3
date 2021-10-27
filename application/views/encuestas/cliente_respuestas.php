
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
                <h6 class="m-0 font-weight-bold text-primary"><?= $encuestaCliente->razonSocial ?></h6>                
                <div>                                   
                  <a href="<?= base_url("index.php/encuestas/mostrar/$idEncuesta") ?>" class="btn btn-secondary">Volver</a>   
                </div>
              </div>
			      </div>
            <div class="card-body" id="listaPreguntas" >
            <?php foreach ($respuestas as $respuesta) :  ?>
              <div class="card mt-4" style="cursor: all-scroll;">
                <div class="card-header d-flex justify-content-between">
                  <h6><?= $respuesta->pregunta ?></h6>
                </div>               
                <div class="card-body">
                  <small>Respuesta:</small>  <span class="text-primary font-weight-bold"><?= $respuesta->respuesta ?></span>
                </div>
              </div>
            <?php endforeach  ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
