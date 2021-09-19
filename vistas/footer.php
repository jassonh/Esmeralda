<footer class="main-footer">
   <!-- <strong>Copyright &copy; 2020, Todos los Derechos Reservados</strong>
   <div class="float-right d-none d-sm-inline-block">
     <b>Version</b> 1.1 -->
   </div>
 </footer>
</div>


 <script src="../public/plugins/jquery/jquery.min.js"></script>
 <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <script src="../public/dist/js/adminlte.js"></script>
 <script src="../public/dist/js/demo.js"></script>
 <script src="../public/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
 <script src="../public/plugins/raphael/raphael.min.js"></script>
 <script src="../public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
 <script src="../public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
 <script src="../public/plugins/chart.js/Chart.min.js"></script>--
 <script src="../public/plugins/bootstrap/js/bootstrap.min.js"></script>
 <script src="js/bootbox.min.js"></script>
 <script src="../public/DataTables/datatables.min.js"></script>
 <script src="../public/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
 <script src="../public/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
 <script src="../public/DataTables/Buttons-1.6.1/js/buttons.print.min.js"></script>
 <script src="../public/DataTables/Buttons-1.6.1/js/buttons.print.js"></script>
 <script src="../public/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
 <script src="../public/DataTables/Buttons-1.6.1/js/buttons.colVis.min.js"></script>
 <script src="../public/DataTables/Buttons-1.6.1/js/buttons.print.js"></script>
 <script src="../public/DataTables/JSZip-2.5.0/jszip.min.js"></script>
 <script src="../public/plugins/pdfmake/vfs_fonts.js"></script>

 <!-- datepicker -->
 <script src="../public/plugins/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>

 <!--BOOTSTRAP FILE STYLE -->
 <script src="js/bootstrap-filestyle.min.js"></script>
 <script>

   //PRODUCTO
   $(":file").filestyle({input: true, size: "md", htmlIcon: '<i class="fas fa-folder-open"></i>', text: "", badge: true, btnClass: "btn-primary", buttonName: "btn-dark btn-sm", placeholder: "Cargar imagen"});

 </script>

 <!--CAMPO FECHA - DATEPICKER - PRODUCTOS-->

 <script>

   $('#datepicker').datepicker({
     /*dateFormat: 'dd-mm-yy',
     autoclose: true*/
     format: 'dd/mm/yyyy',
     /*clearBtn: true,
     language: "es",*/
     autoclose: true,
     /*keyboardNavigation: false,
     todayHighlight: true*/
     })

   /*EN EL SEGUNDO CAMPO DEL ARCHIVO CONSULTAR COMPRAS FECHA*/
      $('#datepicker2').datepicker({
       /*dateFormat: 'dd-mm-yy',
       autoclose: true*/
        format: "dd/mm/yyyy",
         clearBtn: true,
         language: "es",
         autoclose: true,
         keyboardNavigation: false,
         todayHighlight: true
     })

 </script>

 <!-- <script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>

 <script src="http://www.geoplugin.net/ajax_currency_converter.gp" type="text/javascript"></script>
 <script>gp_currencySymbols()</script>-->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


</body>

</html>
