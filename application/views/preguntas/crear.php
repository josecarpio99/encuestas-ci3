
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
					    <h6 class="m-0 font-weight-bold text-primary">Agregar pregunta</h6>                
              <div>
                <a href="<?= base_url("index.php/encuestas/$idEncuesta/preguntas") ?>" class="btn btn-secondary">Volver</a> 
              </div>
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
                      <option value="<?= $value ?>" <?php if($tipo == $input->tipo){ print ' selected'; }?>><?= $tipo ?></option> 
                  <?php endforeach ?>
                </select>
              </div>
              
              <?= form_error('tipo', '<small class="form-text text-danger">', '</small>') ?>
            </div>

            <div class="d-none" id="opcionesContainer">
              <div class="row text-center mb-4">
                <h6 class="offset-sm-2 col-sm-8">Opciones</h6>
                <button class="btn btn-sm btn-primary ml-auto mr-5" id="agregarOpcionBtn">+</button>
              </div>
              <div class="opciones-div col-sm-10 offset-sm-2">
                <div class="form-group row">
                  <label class="col-6 col-form-label"><span class="text-danger">*</span>Opción 1</label>
                  <div class="col-10">
                      <?= form_input('opciones[]', '', ['class' => 'form-control pregunta-opcion', 'id' => 'opcion', 'autocomplete' => 'off']) ?>                      
                  </div>
                </div> 
                <div class="form-group row">
                  <label class="col-6 col-form-label"><span class="text-danger">*</span>Opción 2</label>
                  <div class="col-sm-10">
                      <?= form_input('opciones[]', '', ['class' => 'form-control pregunta-opcion', 'id' => 'opcion', 'autocomplete' => 'off']) ?>                     
                  </div>
                </div> 
              </div>

            </div>

            <div class="d-none mt-3" id="minMaxContainer">              
              <div class="col-sm-10 offset-sm-2">
                <div class="form-group row">

                  <div class="col-6">
                    <label class="col-6 col-form-label"><span class="text-danger">*</span>Mínimo</label>
                    <div class="col-10">                       
                        <input type="number" name="minimo" class="form-control" id="minimo">                    
                    </div>
                  </div>

                  <div class="col-6">
                    <label class="col-6 col-form-label"><span class="text-danger">*</span>Máximo</label>
                    <div class="col-sm-10">
                        <input type="number" name="maximo" class="form-control" id="maximo"> 
                    </div>

                  </div>
                </div>           

                <div class="form-group row">

                  <div class="col-6">
                    <label class="col-6 col-form-label"><span class="text-danger">*</span>Aprobación</label>
                    <div class="col-10">                       
                        <input type="number" name="aprobacion" class="form-control" id="aprobacion">                    
                    </div>
                  </div>
                 
                </div>    

                <div class="form-group row">

                  <div class="col-6">
                    <label class="col-form-label">Es pregunta de resumén</label>
                                          
                    <input type="checkbox" name="es_pregunta_resumen" class="" id="es_pregunta_resumen"
                    style="width: 16px; height: 16px; vertical-align: middle;"
                    >                    
                    
                  </div>
                 
                </div>                 
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
