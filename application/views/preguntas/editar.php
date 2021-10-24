
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
					    <h6 class="m-0 font-weight-bold text-primary">Editar pregunta</h6>                
              
              </div>
			    </div>
            <div class="card-body">
            <?= form_open_multipart($form_action) ?>

            <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>

            <div class="form-group row">
              <label for="detalle" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Detalle</label>
              <div class="col-sm-10">
                  <?= form_input('detalle', $input->detalle, ['class' => 'form-control', 'id' => 'detalle', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off']) ?>
                  <?= form_error('detalle', '<small class="form-text text-danger">', '</small>') ?>
              </div>
            </div>    

            <div class="form-group row">
              <label for="tipo" class="col-sm-2 col-form-label"><span class="text-danger">*</span> Tipo</label>
              <div class="col-sm-10">
                <select class="form-control" id="tipo" name="tipo">
                  <?php foreach($tipos as $value => $tipo) : ?>
                      <option value="<?= $value ?>" <?php if($value == $input->tipo){ echo 'selected'; }?>><?= $tipo ?></option> 
                  <?php endforeach ?>
                </select>
              </div>
              
              <?= form_error('tipo', '<small class="form-text text-danger">', '</small>') ?>
            </div>

            <div class="<?= $input->tipo == 2 ? '' : 'd-none' ?>" id="opcionesContainer">
              <div class="row text-center mb-4">
                <h6 class="offset-sm-2 col-sm-8">Opciones</h6>
                <button class="btn btn-sm btn-primary ml-auto mr-5" id="agregarOpcionBtn">+</button>
              </div>
              <div class="opciones-div col-sm-10 offset-sm-2">
                <?php if($input->tipo == 2 ) { ?>                  
                  <?php foreach($input->opciones as $key => $opcion): ?> 
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label"><span class="text-danger">*</span>Opción <?= $key + 1 ?> </label>
                      <div class="col-10">
                          <?= form_input('opciones[]', $opcion->valor, ['class' => 'form-control pregunta-opcion', 'id' => 'opcion', 'required' => true, 'autocomplete' => 'off']) ?>                      
                      </div>
                    </div> 
                  <?php endforeach ?>  
                <?php } else { ?>  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><span class="text-danger">*</span>Opción 1</label>
                    <div class="col-10">
                        <?= form_input('opciones[]', '', ['class' => 'form-control pregunta-opcion', 'id' => 'opcion', 'autocomplete' => 'off']) ?>                      
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><span class="text-danger">*</span>Opción 2</label>
                    <div class="col-sm-10">
                        <?= form_input('opciones[]', '', ['class' => 'form-control pregunta-opcion', 'id' => 'opcion', 'autocomplete' => 'off']) ?>                     
                    </div>
                  </div>   
                <?php } ?>  
               
              </div>

            </div>

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            </div>

            <?= form_close() ?>
           
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
