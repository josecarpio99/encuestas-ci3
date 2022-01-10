
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
                 
                <div>
                  <a href="<?= base_url('index.php/encuestas/encuestas_clientes') ?>" class="btn btn-primary">Encuestas clientes</a>
                  <a href="<?= base_url('index.php/encuestas/mostrar') ?>" class="btn btn-primary">Mostrar encuestas</a>
                  <a href="<?= base_url('index.php/encuestas/agregar') ?>" class="btn btn-secondary">Agregar encuesta</a>
                </div>
              </div>
			    </div>
            <div class="card-body">
              <div class="table-responsive">
                <div class="text-center">
                  <label for="encuestaEstadoAbierta">Abiertas</label>
                  <input type="radio" name="encuestaEstado" id="encuestaEstadoAbierta" value="0" checked="checked" />
                  <label for="encuestaEstadoCerrada">Cerradas</label>
                  <input type="radio" name="encuestaEstado" id="encuestaEstadoCerrada" value="1" />
                  <label for="encuestaEstadoTodas">Todas</label>
                  <input type="radio" name="encuestaEstado" id="encuestaEstadoTodas" value="2"  />
                </div>
                <table class="table table-bordered display compact" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Título</th>
                      <th>Tipo</th>
                      <th>Estado</th>
                      <th>Enviadas / Total a encuestar</th>
                      <th >Respondieron / Enviadas</th>
                      <th>Respondieron / Total a encuestar</th>
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
