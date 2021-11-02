
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
					    <div>
                <h6 class="m-0 font-weight-bold text-primary">Encuesta cliente | Razón social: <?= $cliente->razonSocial ?></h6>   
              </div>
              <div>
                <a href="<?= base_url("index.php/encuestas/mostrar/".$encuesta->idEncuesta) ?>" class="btn btn-secondary">Volver</a>           

              </div> 
            </div>
			    </div>
            <div class="card-body">
            <?= form_open_multipart($form_action) ?>

            <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>           

            <div class="form-group row">
              <label for="idEncuestaClienteEstado" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Estado</label>
              <div class="col-sm-10">           
                  <select name="idEncuestaClienteEstado" id="idEncuestaClienteEstado" class="form-control">
                    <?php foreach ($estados as $estado) : ?>
                      <option value="<?= $estado->idEncuestaClienteEstado ?>"
                      <?= ($estado->idEncuestaClienteEstado == $input->idEncuestaClienteEstado) ? 'selected' : '' ?>
                      >
                        <?= $estado->nombre ?>
                      </option>
                    <?php endforeach ?>
                  </select>                 
                  <?= form_error('idEncuestaClienteEstado', '<small class="form-text text-danger">', '</small>') ?>
              </div>
            </div> 

            <div class="form-group row">
              <label for="mensaje" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Mensaje</label>
              <div class="col-sm-10">           
                  <textarea class="form-control" name="mensaje" id="mensaje" cols="30" rows="5"><?= $input->mensaje ?></textarea>              
                  <?= form_error('mensaje', '<small class="form-text text-danger">', '</small>') ?>
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
