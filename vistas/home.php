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

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">

 <!-- TABLE: LATEST ORDERS -->
                    <!-- /.col -->

                       <div class="row">

                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-danger">
                              <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                              <div class="info-box-content">

                                <a style="color: #fff" href="compras.php">
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

                                <a style="color: #fff" href="proveedores.php">
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


                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-black">
                              <span class="info-box-icon"><i class="fas fa-box-open"></i></span>
                              <div class="info-box-content">

                                <a style="color: #fff;" href="productos.php">
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

                                <a style="color: #fff;" href="ventas.php">
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

                          <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-info">
                              <span class="info-box-icon"><i class="fas fa-portrait"></i></span>
                              <div class="info-box-content">

                                <a style="color: #fff;" href="clientes.php">
                                  <span class="info-box-text">Clientes</span>
                                  <span class="info-box-number"><?php echo $cliente->get_filas_cliente()?></span>

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


<?php
   } else {

    header("Location:index.php");
   }
?>
