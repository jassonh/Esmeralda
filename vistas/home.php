<?php

	require_once "../config/conn.php";

	if(isset($_SESSION["idUsuario"])){ /*}*/


    require_once '../modelos/Categorias.php';
    require_once '../modelos/Clientes.php';
    require_once '../modelos/Compras.php';
    require_once '../modelos/Productos.php';
    require_once '../modelos/Proveedores.php';
    require_once '../modelos/Usuarios.php';
    require_once '../modelos/Ventas.php';


    $categoria = new Categoria();
    $cliente = new Cliente();
    $compra = new Compras();
    $producto = new Producto();
    $proveedor = new Proveedor();
    $usuario = new Usuarios();
    $ventas = new Ventas();

    //OBJETOS PARA REPORTES.
  $ventas=new Ventas();

    if(isset($_POST["year"])){


      $datos= $ventas->get_ventas_mensual($_POST["year"]);

    } else {

      $fecha_inicial=date("Y");

        $datos= $ventas->get_ventas_mensual($fecha_inicial);
    }

    $fecha_ventas= $ventas->get_year_ventas();
?>

?>

<?php require_once "header.php"; ?>
	<!-- Contenido que se contrae -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header"></div>
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-12">

            <div class="card">

              <div class="card-header">
                <h5 class="card-title">Panel Usuarios</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                   <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">

 <!-- TABLE: LATEST ORDERS -->
                    <!-- /.col -->

                       <div class="row">
                          <!--
                            <div class="col-md-3 col-sm-6 col-12">
                              <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                  <a style="color: #fff;" href="<?php echo conn::ruta()?>vistas/clientes.php">
                                    <span class="info-box-text">Clientes</span>
                                    <span class="info-box-number"><?php echo $cliente->get_filas_cliente()?>
                                      </span>

                                    <div class="progress">
                                      <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">

                                    </span>
                                  </a>
                                </div>
                              </div>

                            </div>
                          -->

                        <!-- col-12 -->

                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-danger">
                              <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                              <div class="info-box-content">

                                <a style="color: #fff" href="<?php echo conn::ruta()?>vistas/compras.php">
                                  <span class="info-box-text">Compras</span>
                                  <span class="info-box-number"><?php echo $compra->get_filas_compras()?></span>
                                </a>

                                <div class="progress">
                                  <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div> <!-- /.col 12 -->

                            <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-success">
                              <span class="info-box-icon"><i class="fas fa-warehouse"></i></span>

                              <div class="info-box-content">

                                <a style="color: #fff" href="<?php echo conn::ruta()?>vistas/proveedores.php">
                                  <span class="info-box-text">Proveedores</span>
                                  <span class="info-box-number"><?php echo $proveedor->get_filas_proveedor()?></span>
                                </a>

                                <div class="progress">
                                  <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                        <!--
                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-indigo">
                              <span class="info-box-icon"><i class="fas fa-cubes"></i></span>
                              <div class="info-box-content">

                                <a style="color: #fff;" href="<?php echo conn::ruta()?>vistas/categorias.php">
                                  <span class="info-box-text">Categorias</span>
                                  <span class="info-box-number"><?php echo $categoria->get_filas_categoria()?></span>

                                </a>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 20%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div>
                            </div>
                          </div>
                          -->

                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-black">
                              <span class="info-box-icon"><i class="fas fa-box-open"></i></span>
                              <div class="info-box-content">

                                <a style="color: #fff;" href="<?php echo conn::ruta()?>vistas/productos.php">
                                  <span class="info-box-text">Productos</span>
                                  <span class="info-box-number"><?php echo $producto->get_filas_producto()?></span>

                                </a>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 35%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-info">
                              <span class="info-box-icon"><i class="fas fa-shipping-fast"></i></span>
                              <div class="info-box-content">

                                <a style="color: #fff;" href="<?php echo conn::ruta()?>vistas/ventas.php">
                                  <span class="info-box-text">Ventas</span>
                                  <span class="info-box-number"><?php echo $ventas->get_filas_ventas()?></span>

                                </a>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>



                  </div>
                <!-- /.row -->

              </div>
            </div>
          </div>
        </div>

        <div class="card">
         <h4 class="card-header bg-light" align="center">REPORTES DE VENTAS MENSUAL</h4>
          <div class="card-body">
              <div class="row">

   <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

      <div class="box">

         <div class="">

          <h3 class="reporte_ventas_general container-fluid bg-navy text-white col-lg-12 text-center mh-50">REPORTE DE VENTAS MENSUAL</h3>

          <table class="table table-bordered">
            <thead class="bg-white">
              <tr>
                <th>AÑO</th>
                <th>N° MES</th>
                <th>NOMBRE MES</th>
                <th>TOTAL</th>
              </tr>
            </thead>

             <tbody style="background-color: #EBF5FB">


                   <?php


            //si existe el envia del post entonces se llama al metodo
            if(isset($_POST["year"])){

        //SI EXISTE EL POST ENTONCES SE LLAMA AL METODO

            $datos= $ventas->get_ventas_mensual($_POST["year"]);


                    for($i=0;$i<count($datos);$i++){

                    //imprime la fecha por separado ejemplo: dia, mes y año
                      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                       $fecha= $datos[$i]["mes"];

                       $fecha_mes = $meses[date("n", strtotime($fecha))-1];


               ?>


                <tr>
                  <td><?php echo $datos[$i]["ano"]?></td>
                  <td><?php echo $datos[$i]["numero_mes"]?></td>
                  <td><?php echo $fecha_mes?></td>
                            <td><?php echo $datos[$i]["moneda"]." ".$datos[$i]["total_venta"]?></td>
                </tr>

              <?php


                        }//cierre del for



                     } else {


                     //SI NO EXISTE EL POST ENTONCES SE LLAMA AL METODO

                      $fecha_inicial=date("Y");

                 $datos= $ventas->get_ventas_mensual($fecha_inicial);


                        for($i=0;$i<count($datos);$i++){

                        //imprime la fecha por separado ejemplo: dia, mes y año
                      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                       $fecha= $datos[$i]["mes"];

                       $fecha_mes = $meses[date("n", strtotime($fecha))-1];


               ?>


                <tr>
                  <td><?php echo $datos[$i]["ano"]?></td>
                  <td><?php echo $datos[$i]["numero_mes"]?></td>
                  <td><?php echo $fecha_mes?></td>
                            <td><?php echo $datos[$i]["moneda"]." ".$datos[$i]["total_venta"]?></td>
                </tr>

              <?php


                        }//cierre ciclo for

                     }//cierre condicional else

              ?>


            </tbody>


          </table>

       </div><!--fin box-body-->
      </div><!--fin box-->

    </div><!--fin col-xs-12-->

      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div class="box">

               <!--<div class="">-->


             <h3 class="reporte_ventas_general container-fluid bg-navy text-white col-lg-12 text-center mh-50">REPORTE DE VENTAS MENSUAL</h3>


            <!--GRAFICA-->
           <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>



             <!--</div>--><!--fin box-body-->
               </div><!--fin box-->
      </div><!--fin col-xs-6-->

  </div><!--fin row-->

          </div>
        </div>

      </div>
    </div><!--/. container-fluid -->
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php require_once "footer.php"; ?>


<script type="text/javascript" src="js/perfil.js"></script>
<script type="text/javascript" src="js/empresa.js"></script>

<script type="text/javascript">

     $(document).ready(function() {

      Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
          return {
            radialGradient: {
              cx: 0.5,
              cy: 0.3,
              r: 0.7
            },
            stops: [
              [0, color],
              [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
          };
        })
      });

      var chart = new Highcharts.Chart({

         chart: {

              renderTo: 'container',
              plotBackgroundColor: '#EBF5FB',
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },

              exporting: {
              url: 'http://export.highcharts.com/',
              enabled: false

                },

          title: {
              text: ''
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                showInLegend:true,
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',

                          fontSize: '20px'
                      }
                  }
              }
          },
           legend: {
              symbolWidth: 12,
              symbolHeight: 18,
              padding: 0,
              margin: 15,
              symbolPadding: 5,
              itemDistance: 40,
              itemStyle: { "fontSize": "17px", "fontWeight": "normal" }
          },

          series: [

                {
              name: 'Browser share',
            innerSize: '60%',
              colorByPoint: true,
              data: [

                <?php

           //si existe el envia del post entonces se llama al metodo
      if(isset($_POST["year"])){

          echo $datos_grafica= $ventas->suma_ventas_anio_mes_grafica($_POST["year"]);

           } else {

           //si no existe el envio post entonces se mostraran los datos de la grafica del año actual

           $fecha_inicial=date("Y");

            echo $datos_grafica= $ventas->suma_ventas_anio_mes_grafica($fecha_inicial);
           }

          ?>

          ]

          }],

          exporting: {
                enabled: false
             }

      });

      //si se le da click al boton entonces se envia la imagen al archivo PDF por ajax
      $('#buttonExport').click(function() {


         //alert("clic");
            printHTML()
      document.addEventListener("DOMContentLoaded", function(event) {
       printHTML();
      });


    });
      //fin prueba

});

 //function

  function printHTML() {
    if (window.print) {
      window.print();
    }
  }
  
</script>


<?php
   } else {

    header("Location:index.php");
   }
?>
