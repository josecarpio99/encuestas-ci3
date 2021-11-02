
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
					    <h6 class="m-0 font-weight-bold text-primary">Responsable</h6>   
              <a href="<?= base_url("index.php/encuestas/".$encuesta->idEncuesta."/responsables") ?>" class="btn btn-secondary">Volver</a>            
            </div>
			    </div>
            <div class="card-body">
            <?= form_open_multipart($form_action) ?>

            <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>           

            <div class="form-group row">
              <label for="idSucursal" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Sucursal</label>
              <div class="col-sm-10">           
                  <select name="idSucursal" id="idSucursal" class="form-control">
                    <option value="">Selecciona la sucursal</option>
                    <?php foreach ($sucursales as $sucursal) : ?>
                      <option value="<?= $sucursal->idSucursal ?>">
                        <?= $sucursal->nombreSucursal ?>
                      </option>
                    <?php endforeach ?>
                  </select>                 
                  <?= form_error('idSucursal', '<small class="form-text text-danger">', '</small>') ?>
              </div>
            </div> 

            <div class="form-group row">
              <label for="idUsuario" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Usuario</label>
              <div class="col-sm-10">           
                  <select name="idUsuario" id="idUsuario" class="form-control">
                    <?php foreach ($usuarios as $usuario) : ?>
                      <option value="<?= $usuario->idUsuario ?>">
                        <?= $usuario->razonSocial ?>
                      </option>
                    <?php endforeach ?>
                  </select>                 
                  <?= form_error('idUsuario', '<small class="form-text text-danger">', '</small>') ?>
              </div>
            </div> 

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

            <?= form_close() ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
