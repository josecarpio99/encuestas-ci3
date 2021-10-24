<!-- Footer -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy;</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js" type="text/javascript"></script>


  
  <script>   
   $(document).ready(function(){ 
    const tipoPregunta = document.querySelector('#tipo')
    const agregarOpcionBtn = document.querySelector('#agregarOpcionBtn')
    const opcionesContainer = document.querySelector('#opcionesContainer')
    tipoPregunta.addEventListener('change', handleTipoPregunta);
    agregarOpcionBtn.addEventListener('click', addOpcion);
    document.addEventListener('click', (e) => {
      if(e.target.classList.contains('btn-eliminar-opcion')) {
        e.preventDefault();
        eliminarOpcion(e.target);
      }
    })

    function handleTipoPregunta(e)
    {
      // Pregunta es de tipo lista
      if(e.target.value == 2) {
        opcionesContainer.classList.remove('d-none');
      }

      if(e.target.value != 2) {
        opcionesContainer.classList.add('d-none');
      }
    }

    function addOpcion(e)
    {
      e.preventDefault();
      const totalOpciones = opcionesContainer.querySelector('.opciones-div').querySelectorAll('.form-group').length
      opcionesContainer.querySelector('.opciones-div').insertAdjacentElement('beforeend', opcionHTML(totalOpciones + 1))
    }

    function opcionHTML(opcionNumber)
    {
      const div = document.createElement('div');
      div.classList.add(['form-group', 'row'])
      const htmlString = `
      <div class="form-group row">
        <label class="col-sm-2 col-form-label"><span class="text-danger">*</span>Opción ${opcionNumber}</label>
        <div class="col-10">
            <input type="text" name="opciones[]" value="" class="form-control pregunta-opcion" id="opcion" required="1" autofocus="1" autocomplete="off">
            <button class="btn btn-sm btn-danger btn-eliminar-opcion"
            style="position: absolute;
                  right: 16px;
                  z-index: 100;
                  top: 0;
                  height: 100%;"
            ><i class="fa fa-trash mr-1"
                style="pointer-events: none"
            ></i></button>
        </div>
      </div>
      `
      div.innerHTML = htmlString.trim();
      return div.firstChild;
    }

    function eliminarOpcion(el)
    {
      el.closest('.form-group').remove();
    }

    
   });
  </script> 
</body>

</html>