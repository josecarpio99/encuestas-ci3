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
   
   // Show Table
   $(document).ready(function(){

    tablePosting = $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      order: [ 0, 'desc' ],
      ajax: {
          url: '<?php echo base_url(); ?>index.php/Encuestas/getEncuestas/0/',
          'type': "POST"
      },
      columnDefs: [
          { 
            'targets': [ -1 ], 
            'orderable': false, 
          },
          // { 'width': '5px', 'targets': 0 },
          // { 'width': '5px', 'targets': 2 },
          // { 'width': '5px', 'targets': 3 },
          // { 'width': '5px', 'targets': 4 },
          // { 'width': '5px', 'targets': 6 },
      ],
      lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]]
});

});
   
		// $(document).ready(function() {
		
		// $(".navbar-nav li.trigger-collapse a").click(function(event) {
        //   $(".navbar-collapse").collapse('hide');
        // });

        //     var cont = 0;
        //     $('#dataTable tfoot th').each( function () {
        //         if(cont != 0)
        //             $(this).html( '<input id="buscar'+cont+'" Style="width:70px" type="text" placeholder="Buscar' + '" value=""/>' );
		// 		if(cont == 1)
        //             $(this).html( '<input id="buscar'+cont+'" Style="width:30px" type="text" placeholder="' + '" value=""/>' );
		// 		if(cont == 3)
        //             $(this).html( '<input id="buscar'+cont+'" Style="width:200px" type="text" placeholder="Buscar' + '" value=""/>' );

        //         cont++;
        //     } );

        //     var table = $('#dataTable').DataTable( {
        //         'dom': 'Bfrtlip',
        //         'buttons': [ {
		// 					extend: 'excelHtml5',
		// 					className:'btn btn-success'
		// 				}],
        //         ajax: {
        //             url: '<?php echo base_url(); ?>index.php/Encuestas/getEncuestas/0/',
        //             type: "POST",
        //             data: {filter:true},
        //         },
        //         searching: true,
        //         bLengthChange: true,
        //         pageLength: 10,
        //         stateSave: true,
        //         serverSide: true,
        //         'language':{
        //             "emptyTable": "Datos no disponibles."
        //         },
        //         columnDefs: [
        //             {
        //                 targets: 0,
        //                 className: 'more-detail'
        //             },
					
        //             {
        //                 targets: 16,
        //                 visible: false
        //             },
        //             {
        //                 targets: 17,
        //                 visible: false
        //             },
        //             {
        //                 targets: 18,
        //                 visible: false
        //             },
        //             {
        //                 targets: 19,
        //                 visible: false
        //             },
        //             {
        //                 targets: 20,
        //                 visible: false
        //             },
        //             {
        //                 targets: 21,
        //                 visible: false
        //             }
        //         ],
        //         initComplete: function () {
        //             this.api().columns().every( function () {
        //                 var that = this;

        //                 $( 'input', this.footer() ).on( 'keyup change clear', function () {
        //                     if ( that.search() !== this.value ) {
        //                         that
        //                             .search( this.value )
        //                             .draw();
        //                     }
        //                 } );
        //             } );
        //         }
        //     } );

        //     for(let i=0; i<cont; i++){
        //         $('#buscar' + i).val(table.column(i).search());
        //     }

        //     $('#dataTable tbody').on('click', 'td.more-detail', function () {
        //         var tr = $(this).closest('tr');
        //         var row = table.row( tr );
        //         var icon = tr.children()[0];
        //         icon = icon.getElementsByTagName('i')[0];

        //         if ( row.child.isShown() ) {
        //             // This row is already open - close it
        //             row.child.hide();
        //             tr.removeClass('shown');
        //             icon.classList.remove('fa-minus-circle');
        //             icon.classList.add('fa-plus-circle');
        //         }
        //         else {
        //             // Open this row
        //             row.child( formatData(row.data()) ).show();
        //             tr.addClass('shown');
        //             icon.classList.remove('fa-plus-circle');
        //             icon.classList.add('fa-minus-circle');
        //         }
        //     } );

			
		// } );

		// function formatData(d) {
        //     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        //         '<tr>'+
        //         '<td>Fecha Compromiso:</td>'+
        //         '<td>'+d[15]+'</td>'+
        //         '</tr>'+
        //         '<tr>'+
        //         '<td>Detalle del reclamo:</td>'+
        //         '<td>'+d[16]+'</td>'+
        //         '</tr>'+
        //         '<tr>'+
        //         '<td>Detalle de atencion del reclamo:</td>'+
        //         '<td>'+d[20]+'</td>'+
        //         '</tr>'+
        //         '<tr>'+
        //         '<td>Fecha fin del reclamo:</td>'+
        //         '<td>'+d[21]+'</td>'+
        //         '</tr>'+
        //         '</table>';
        // }

 </script>
  
  

</body>

</html>