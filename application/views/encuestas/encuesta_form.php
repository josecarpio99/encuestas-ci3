
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
					    <h6 class="m-0 font-weight-bold text-primary">Agregar encuesta</h6>                
              
              </div>
			    </div>
            <div class="card-body">
            <?= form_open_multipart($form_action) ?>

            <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>

            <div class="form-group row">
              <label for="nombre" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Nombre</label>
              <div class="col-sm-10">
                  <?= form_input('nombre', $input->nombre, ['class' => 'form-control', 'id' => 'nombre', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off']) ?>
                  <?= form_error('nombre', '<small class="form-text text-danger">', '</small>') ?>
              </div>
            </div> 

            <div class="form-group row">
              <label for="titulo" class="col-sm-2 col-form-label"><span class="text-danger">*</span>Título</label>
              <div class="col-sm-10">
                  <?= form_input('titulo', $input->titulo, ['class' => 'form-control', 'id' => 'titulo', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off']) ?>
                  <?= form_error('titulo', '<small class="form-text text-danger">', '</small>') ?>
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
