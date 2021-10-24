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
  <script src="<?php echo base_url(); ?>template/vendor/jquery/jquery.min.js"></script>
 
  <script src="<?php echo base_url(); ?>template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>template/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>template/js/sb-admin-2.min.js"></script>


  <script src="<?php echo base_url(); ?>lib/DataTables/datatables.min.js"></script>
  
  <script src="<?php echo base_url(); ?>lib/DataTables/JSZip-2.5.0/jszip.min.js" type="text/javascript"></script>

  
   <script>

   
   
   
   
		$(document).ready(function() {
		
		$(".navbar-nav li.trigger-collapse a").click(function(event) {
          $(".navbar-collapse").collapse('hide');
        });

            var cont = 0;
            $('#dataTable tfoot th').each( function () {
                if(cont != 0)
                    $(this).html( '<input id="buscar'+cont+'" Style="width:70px" type="text" placeholder="Buscar' + '" value=""/>' );

                cont++;
            } );

            var table = $('#dataTable').DataTable( {
                'dom': 'Bfrtlip',
                'buttons': [],
                ajax: {
                    url: '<?php echo base_url(); ?>index.php/Reclamos/getReclamos/1/',
                    type: "POST",
                    data: {filter:true},
                },
                searching: true,
                bLengthChange: true,
                pageLength: 10,
                stateSave: true,
                serverSide: true,
                'language':{
                    "emptyTable": "Datos no disponibles."
                },
                columnDefs: [
                    {
                        targets: 0,
                        className: 'more-detail'
                    },
                    {
                        targets: 14,
                        visible: false
                    },
                    {
                        targets: 15,
                        visible: false
                    },
                    {
                        targets: 16,
                        visible: false
                    },
                    {
                        targets: 17,
                        visible: false
                    },
                    {
                        targets: 18,
                        visible: false
                    },
                    {
                        targets: 19,
                        visible: false
                    }
                ],
                initComplete: function () {
                    this.api().columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                }
            } );

            for(let i=0; i<cont; i++){
                $('#buscar' + i).val(table.column(i).search());
            }

            $('#dataTable tbody').on('click', 'td.more-detail', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var icon = tr.children()[0];
                icon = icon.getElementsByTagName('i')[0];

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    icon.classList.remove('fa-minus-circle');
                    icon.classList.add('fa-plus-circle');
                }
                else {
                    // Open this row
                    row.child( formatData(row.data()) ).show();
                    tr.addClass('shown');
                    icon.classList.remove('fa-plus-circle');
                    icon.classList.add('fa-minus-circle');
                }
            } );

			
		} );

		function formatData(d) {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>Fecha Compromiso:</td>'+
                '<td>'+d[13]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Detalle del reclamo:</td>'+
                '<td>'+d[14]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Detalle de atencion del reclamo:</td>'+
                '<td>'+d[18]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Fecha fin del reclamo:</td>'+
                '<td>'+d[19]+'</td>'+
                '</tr>'+
                '</table>';
        }

 </script>
  
  

</body>

</html>