
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
					    <h6 class="m-0 font-weight-bold text-primary">Encuestas Responsables</h6>
                 
              <div>
                <a href="<?= base_url("index.php/encuestas/$idEncuesta/responsables/agregar") ?>" class="btn btn-primary">Agregar</a>
                <a href="<?= base_url("index.php/encuestas/mostrar/$idEncuesta") ?>" class="btn btn-secondary">Volver</a>
              </div>
            </div>
			    </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered display compact" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sucursal</th>                                            
                      <th>Razón social</th>                                            
                      <th>Acciones</th>
                    </tr>
                  </thead>

                  <tbody></tbody>
                  
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
