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

  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js" type="text/javascript"></script>


  
   <script>  
   
   // Show Table
   $(document).ready(function(){

    const usuariosSelect = document.querySelector('#idUsuario')

    $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      order: [ 0, 'desc' ],
      ajax: {
          url: '<?php echo base_url(); ?>index.php/encuestas/<?= $idEncuesta ?>/getResponsables',
          'type': "POST"
      },
      columnDefs: [
          { 
            'targets': [ -1], 
            'orderable': false, 
          },          
      ],
      lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]]
    }); 

    document.querySelector('#idSucursal').addEventListener('change', function(e) {
      const id = e.target.value;
      $.ajax({
          url: '<?= base_url('index.php/usuarios/obtenerUsuariosDeSucursal/') ?>' + id,
          method: 'POST',
          dataType: 'json',
          success: function (response) {
              console.log(response);
              // console.log(typeof response);
              // return;
              let html = '';
              response.usuarios.forEach(usuario => {
                html += `<option value="${usuario.idUsuario}">${usuario.razonSocial}</option>`
              });
              usuariosSelect.innerHTML = html;
          }
      });
    })     
    

});
   


      



 </script>
  
  

</body>

</html>