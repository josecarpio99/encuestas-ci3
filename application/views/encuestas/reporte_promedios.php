
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
                <h6 class="m-0 font-weight-bold text-primary"><?= $encuesta->nombre ?></h6>                
                <div>                                   
                  <a href="<?= base_url("index.php/encuestas/mostrar/$encuesta->idEncuesta") ?>" class="btn btn-secondary">Volver</a>   
                </div>
              </div>
			      </div>
            <div class="card-body" id="listaPreguntas" >
              <form action="">
                <div class="row">
                  <div class="col-3">
                    <label for="desde">Desde:</label>
                    <input type="date" class="form-control" value="<?= $desde ?>" name="desde" id="desde" />
                  </div>
                  <div class="col-3">
                    <label for="hasta">Hasta:</label>
                    <input type="date" class="form-control" value="<?= $hasta ?>" name="hasta" id="hasta" /> 
                  </div>
                  <div class="col-2 align-self-end">
                    <!-- <div>&nbsp;</div> -->
                    <button id="buscar" class="btn btn-primary w-100">Buscar</button>
                  </div>   
                </div>                
              </form> 
              <div class="row text-center my-5">
                <div class="col-md-4">
                  <h4>Enviadas / Total a encuestar</h4>                  
                  <h4><?= $encuesta->respondieron + $encuesta->enviadas .' / '. $encuesta->total_a_encuestar  ?></h4>
                </div>
                <div class="col-md-4">
                  <h4>Respondieron / Enviadas</h4>                  
                  <h4><?= $encuesta->respondieron .' / '. $encuesta->respondieron + $encuesta->enviadas  ?></h4>
                </div>
                <div class="col-md-4">
                  <h4>Respondieron / Total a encuestar</h4>                  
                  <h4><?= $encuesta->respondieron .' / '. $encuesta->total_a_encuestar  ?></h4>
                </div>
              </div>
            <?php foreach ($preguntas as $pregunta) :  ?>
              <div class="card mt-4" style="cursor: all-scroll;" >
                <div class="card-header d-flex justify-content-between">
                  <h6><?= $pregunta->detalle ?></h6>                  
                </div>
                
                <?php if($pregunta->tipo == 1) { ?>
                  <ul class="list-group list-group-flush">                 
                    <li class="list-group-item d-flex justify-content-between">
                      <span>SÍ</span>
                      <span class="text-primary font-weight-bold"><?= $pregunta->porcentaje_si ?>%</span>                     
                    </li>  
                    <li class="list-group-item d-flex justify-content-between">
                      <span>NO</span>
                      <span class="text-primary font-weight-bold"><?= $pregunta->porcentaje_no ?>%</span>                     
                    </li>  
                  </ul> 
                <?php } ?>

                <?php if($pregunta->tipo == 2) { ?>
                  <ul class="list-group list-group-flush">

                  <?php foreach($pregunta->opciones as $opcion) : ?>
                    <li class="list-group-item d-flex justify-content-between">
                      <span><?= $opcion->valor ?></span>
                      <span class="text-primary font-weight-bold"><?= $opcion->porcentaje ?>%</span>                     
                    </li>                  
                  <?php endforeach ?>                  
                  </ul> 
                <?php } ?>

                <?php if($pregunta->tipo == 3) { ?>
                  <ul class="list-group list-group-flush">                 
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Promedio</span>
                      <span class="text-primary font-weight-bold"><?= $pregunta->promedio ?></span>                     
                    </li>                    
                  </ul> 
                <?php } ?>

               
              </div>
            <?php endforeach  ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
		
		
      </div>
      <!-- End of Main Content -->
