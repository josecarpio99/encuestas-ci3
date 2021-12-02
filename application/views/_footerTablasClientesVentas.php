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
    const desde = document.querySelector('#desde');    
    const hasta = document.querySelector('#hasta');    
    const buscar = document.querySelector('#buscar');    
    const enviar = document.querySelector('#enviar');    
    const tbdody = document.querySelector('#table tbody');    
    const endpoint = '<?= base_url('index.php/ComprasRepuesto/getComprasRepuesto/') ?>'
    const endpoint2 = '<?= base_url('index.php/ComprasRepuesto/crearEncuestaCliente/') ?>'
    buscar.addEventListener('click', renderVentas);
    enviar.addEventListener('click', sendVentasId);

    function renderVentas() {
      const tipo = document.querySelector('input[name="tipoServicio"]:checked').value;   

      if(!desde.value || !hasta.value) {
        alert('Rellena todos los campos');
      }
      $.ajax({
          url: endpoint+desde.value+'/'+hasta.value+'/'+tipo,
          method: 'POST',
          dataType: 'text',
          success: function (response) {
            response = JSON.parse(response)
            let html = ''         
              response.forEach(data => {
                let id = tipo == 'repuesto' ? data.idCliente : data.idCompraRespuesto
                html += `<tr>
                  <td><input type="checkbox" name="ventasId[]" value="${id}"></td>
                  <td>${data.idCliente}</td>
                  <td>${data.cod_Repuesto}</td>
                  <td>${data.idEncuestaCliente || 'NULL'}</td>
                </tr>`;
              })

            tbdody.innerHTML = html;  
          }
      });
    }

    function sendVentasId() {
      const ventasId = [...document.querySelectorAll('input[name="ventasId[]"]')]; 
      const tipo = document.querySelector('input[name="tipoServicio"]:checked').value;   

      const ids = []
      ventasId.forEach( venta => {
        if(venta.checked) {
          ids.push(venta.value);
        }
      } );
      $.ajax({
          url: endpoint2,
          method: 'POST',
          dataType: 'text',
          data: {
            clientes: ids,
            desde: desde.value,
            hasta: hasta.value,
            tipo: tipo,
          },
          success: function (response) {
            renderVentas();
          }
      });

    }
   });
  </script> 
</body>

</html>