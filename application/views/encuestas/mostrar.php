
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
                <div>
                  <a href="<?= base_url("index.php/encuestacliente/mostrarexportar/$encuesta->idEncuesta/") ?>" class="btn btn-success" title="Importar excel"><i class="fa fa-file-csv"></i></a>
                  <a href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/reporte-detalle/") ?>" class="btn btn-info" title="Reporte detallado"><i class="fa fa-th-list"></i></a>
                  <a href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/reporte-promedios/") ?>" class="btn btn-success" title="Reporte promedios"><i class="fa fa-chart-bar"></i></a>
                  <a href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/preguntas/") ?>" class="btn btn-primary">Preguntas</a>
                  <a href="<?= base_url("index.php/encuestas/$encuesta->idEncuesta/responsables") ?>" class="btn btn-secondary">Responsables</a>
                  <a href="<?= base_url('index.php/encuestas') ?>" class="btn btn-secondary">Volver</a>   
                </div>
              </div>
			      </div>
            
            <div class="card-body" >
              <h6 class="my-4 font-weight-bold text-center">Pendientes de enviar</h6>
              <div class="table-responsive">
                <table class="table table-bordered display compact" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Vendedor</th>                                            
                      <th>Sucursal</th>                                            
                      <th>Razón social</th>                                            
                      <th>Cuit</th>                                            
                      <th>Pausar</th>                                            
                      <th>Acciones</th>
                    </tr>
                  </thead>

                  <tbody></tbody>
                  <tfoot>
                    <tr>
                      <th></th>                                            
                      <th></th>                                            
                      <th></th>                                            
                      <th></th>                                            
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <hr>
            <div class="card-body mt-3" >
              <h6 class="my-4 font-weight-bold text-center">Enviadas</h6>
              <div class="table-responsive">
                <table class="table table-bordered display compact" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Vendedor</th>                                            
                      <th>Sucursal</th>                                            
                      <th>Razón social</th>                                            
                      <th>Cuit</th>                                            
                      <th>Fecha envio</th>                                            
                      <th>Fecha respuesta</th>                                            
                      <th>Respondio</th>
                      <th>Respuesta</th>
                      <th>Respuesta valor</th>
                      <th style="width: 150px;">Acciones</th>
                    </tr>
                  </thead>

                  <tbody></tbody>
                  <tfoot>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tfoot>
                  
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
