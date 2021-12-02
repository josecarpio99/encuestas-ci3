
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
					    <h6 class="m-0 font-weight-bold text-primary">Listado de Ventas</h6>
                 
                <div>                  
                  <a href="<?= base_url('index.php/encuestas') ?>" class="btn btn-secondary">Volver</a>
                </div>
              </div>
			    </div>
            <div class="card-body">
              <div class="table-responsive" style="max-height: 80vh;">
                <div class="row">
                  <div class="col-3">
                    <label for="desde">Desde:</label>
                    <input type="date" class="form-control" name="desde" id="desde" />
                  </div>
                  <div class="col-3">
                    <label for="hasta">Hasta:</label>
                    <input type="date" class="form-control" name="hasta" id="hasta" /> 
                  </div>
                  <div class="col-2">
                    <label for="">Tipo de venta</label>
                    <div>
                      <label for="repuesto">Repuesto</label>
                      <input type="radio" name="tipoServicio" id="repuesto" value="repuesto" checked>
                      <label for="servicio">Servicio</label>
                      <input type="radio" name="tipoServicio" value="servicio" id="servicio">
                    </div>
                  </div>
                  <div class="col-2">
                    <div>&nbsp;</div>
                    <button id="buscar" class="btn btn-primary w-100">Buscar</button>
                  </div>
                </div>
                <table class="table table-bordered display compact" id="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Cliente Id</th>
                      <th>Código repuesto</th>
                      <th>Encuesta cliente</th>
                    </tr>
                  </thead>

                  <tbody></tbody>
                  
                </table>
              </div>
              <div class="text-center mt-3">
                <button id="enviar" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
