
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
					    <h6 class="m-0 font-weight-bold text-primary">Encuesta Cliente</h6>  

              <a href="<?= base_url('index.php/encuestas/mostrar/'.$idEncuesta) ?>" class="btn btn-secondary">Volver</a>            
            </div>
			    </div>
            <div class="card-body">
            
            <?= form_open_multipart(base_url('index.php/encuestacliente/exportar/'.$idEncuesta), ['class' => 'col-6 mx-auto']) ?>

            <div class="form-group row">
              <label for="archivo" class="col-sm-2 col-form-label"><span class="text-danger">*</span>archivo</label>
              <div class="col-sm-10">
                  <input type="file"
                  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  <?= form_error('archivo', '<small class="form-text text-danger">', '</small>') ?>
              </div>
            </div>             

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

            <?= form_close() ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
