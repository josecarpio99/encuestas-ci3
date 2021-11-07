<div class="container mx-auto">
  <div class="card mt-5">
    <h5 class="card-header text-center"><?= $encuesta->titulo ?></h5>
    <div class="card-body">
      <form action="<?= $form_action ?>" method="post">
      <?php $i = 0 ?>
      <?php foreach ($preguntas as $pregunta) : ?>
        <input type="hidden" name="respuestas[<?= $i ?>][idPregunta]" value="<?= $pregunta->idEncuestaPregunta ?>"> 
        <?php if($pregunta->es_pregunta_resumen == 1) : ?>
          <input type="hidden" name="respuestas[<?= $i ?>][aprobacion]" value="<?= $pregunta->aprobacion ?>"> 
          <input type="hidden" name="respuestas[<?= $i ?>][satisfaccion]" value="<?= $pregunta->satisfaccion ?>"> 
        <?php endif ?>          
        <div class="card mt-5">
          <h5 class="card-header"><?= $pregunta->detalle ?></h5>
          <div class="card-body">

            <?php if($pregunta->tipo == 0) : ?>
              <div class="form-group">     
                <textarea class="form-control" name="respuestas[<?= $i ?>][valor]" rows="3"required></textarea>
              </div>
            <?php endif ?>

            <?php if($pregunta->tipo == 1) : ?>
              <div class="form-group">     
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="respuestas[<?= $i ?>][valor]" id="respuestas[<?= $i ?>]['si']"  value="si"required>
                  <label class="form-check-label" for="respuestas[<?= $i ?>]['si']">SI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="respuestas[<?= $i ?>][valor]" id="respuestas[<?= $i ?>]['no']" value="no"required>
                  <label class="form-check-label" for="respuestas[<?= $i ?>]['no']">NO</label>
                </div>
              </div>
            <?php endif ?>

            <?php if($pregunta->tipo == 2) : ?>
              <?php foreach($pregunta->opciones as $key => $opcion) : ?>
                <div class="form-check <?= ($key != 0) ? 'mt-3' : '' ?>">
                  <input 
                  class="form-check-input" 
                  type="radio" 
                  name="respuestas[<?= $i ?>][valor]"
                  id="respuestas[<?= $i ?>][<?= $opcion->valor ?>]" 
                  value="<?= $opcion->valor ?>" required>
                  <label class="form-check-label" for="respuestas[<?= $i ?>][<?= $opcion->valor ?>]">
                    <?= $opcion->valor ?>
                  </label>
                </div>
              <?php endforeach ?>
            <?php endif ?>

            <?php if($pregunta->tipo == 3) : ?>
              <div class="form-group d-flex justify-content-center">     
                <div class="rate">
                  <?php 
                    $min = $pregunta->minimo;
                    $max = $pregunta->maximo;
                  ?>
                  <?php for ($j=$max; $j >= $min ; $j--) : ?>
                    <?php $id = 'start'.$i.'-'.$j ?>
                    <input type="radio" name="respuestas[<?= $i ?>][valor]" id="<?= $id ?>" value="<?= $j ?>" required/>
                    <label for="<?= $id ?>"><?= $j ?> stars</label>                   
                  <?php endfor ?>
                </div>            
              </div>
            <?php endif ?>

          </div>
        </div>
        <?php $i++ ?>
      <?php endforeach ?>
      <div class="mt-5 text-center">
        <button class="btn btn-lg btn-primary" type="submit">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>