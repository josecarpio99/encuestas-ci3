
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
					    <h6 class="m-0 font-weight-bold text-primary">Reporte detallado</h6>
                 
                <div>
                  <a href="<?= base_url('index.php/encuestas/mostrar/'.$encuesta->idEncuesta) ?>" class="btn btn-secondary">Volver</a>
                </div>
              </div>
			    </div>
            <div class="card-body">
              <div class="row text-center">
                <div class="col-md-4">
                  <h4>Enviadas / Total a encuestar</h4>                  
                  <h4><?= $encuesta->respondieron + $encuesta->enviadas .' / '. $encuesta->total_a_encuestar  ?></h4>
                </div>
                <div class="col-md-4">
                  <h4>Respondieron / Enviadas</h4>                  
                  <h4><?= $encuesta->respondieron .' / '. $encuesta->respondieron + $encuesta->enviadas  ?></h4>
                </div>
                <div class="col-md-4">
                  <h4>Respondieron / Total a encuestar</h4>                  
                  <h4><?= $encuesta->respondieron .' / '. $encuesta->total_a_encuestar  ?></h4>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered display compact" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <?php foreach($preguntas as $pregunta) : ?>
                        <th><?= $pregunta->detalle ?></th>
                      <?php endforeach ?>  
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach($clientesRespuestas as $clienteRespuestas) : ?>
                      <tr>
                        <td><?= $clienteRespuestas->razonSocial ?></td>
                        <?php $respuestas = explode('|', $clienteRespuestas->respuestas) ?>
                        <?php foreach($respuestas as $respuesta) : ?>
                          <td><?= $respuesta ?></td>
                        <?php endforeach ?>  

                      </tr>
                    <?php endforeach ?>  
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Buscar...</th>
                      <?php $respuestas = explode('|', $clientesRespuestas[0]->respuestas) ?>
                      <?php foreach($respuestas as $respuesta) : ?>
                        <th>Buscar...</th>
                      <?php endforeach ?>                    
                    </tr>
                </tfoot>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
