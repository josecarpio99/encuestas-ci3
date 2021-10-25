
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
					    <h6 class="m-0 font-weight-bold text-primary">Listado de Encuestas</h6>
                 
              <a href="<?= base_url('index.php/encuestas/agregar') ?>" class="btn btn-primary">Agregar encuesta</a>
              </div>
			    </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered display compact" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Título</th>
                      <th>Responsable</th>
                      <th>Estado</th>
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
