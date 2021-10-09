<?php

    require_once "../config/conn.php";

    require_once"../vistas/js/script.php";

    if(isset($_SESSION["idUsuario"])){

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


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Esmeralda</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Enlaces de DataTables -->
  <link rel="stylesheet" href="../public/DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="../public/DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="../public/DataTables/Buttons-1.6.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="../public/DataTables/Responsive-2.2.3/css/responsive.dataTables.min.css">

<link rel="stylesheet" href="../public/plugins/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css">
<!-- ESTILOS -->
<link rel="stylesheet" href="../public/css/estilos.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-black text-sm navbar-dark navbar-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <h5 style="color: #ccc;"> Sistema de ventas <i class="fas fa-cubes"></i></h5>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
          <div class="image">
            <img src="../public/dist/img/user1-128x128.jpg" class="img-circle" alt="User Avatar">
          </div>

          <div class="info">
            <a style="color: #fff;" href="#" class="d-block">
              <h6>
                <?php echo $_SESSION["nombreUsuario"];
                echo " ";
                echo $_SESSION["apellidoUsuario"]; ?>
              </h6>
            </a>
          </div>
        </div>
      </li>

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="">
          <center>
             <h5><i class="fas fa-cog"></i></h5>
          </center>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../public/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo $_SESSION["userName"]; ?>
                  <span class="float-right text-lg text-dark"><i class="fas fa-info-circle"></i></span>
                </h3>
                <p class="text-sm"><?php echo $_SESSION["email"]; ?></p>

                <p class="text-sm text-muted"><i class="fas fa-calendar"></i> <?php echo fechaC();?></p>

                <p class="text-sm text-muted"><i class="fas fa-clock"></i>
                  <?php echo Hora();?>
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>

          <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item dropdown-footer bg-light" onclick="mostrar_perfil('<?php echo $_SESSION["idUsuario"]?>')"
            data-toggle="modal" data-target="#perfilModal"><i class="fas fa-edit"></i> Editar Perfil</a>


          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item dropdown-footer bg-dark"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>

        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-navy">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link navbar-navy">
      <img src="../public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span style="color: #fff;" class="brand-text font-weight">Esmeralda</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item has-treeview">
              <a href="home.php" class="nav-link active">
                <i class="fas fa-home"></i>
                <p>
                  Panel Principal
                </p>
              </a>
            </li>

<?php if($_SESSION["categoria"]==1)
          {
            echo '
          <li class="nav-item has-treeview">
            <a href="categorias.php" class="nav-link">
                  <i class="fas fa-cubes"></i>
                  <p>Categorias</p>
                  <span class="badge right badge-pill bg-black">'.$categoria->get_filas_categoria().'<i class="far fa-bell"></i></span>
                </a>
          </li>';
          }
         ?>

<?php if($_SESSION["productos"]==1)
          {
            echo '
          <li class="nav-item has-treeview">
            <a href="productos.php" class="nav-link">
              <i class="fas fa-box-open"></i>
                  <p>Productos</p>
                  <span class="badge right badge-pill bg-black">'.$producto->get_filas_producto().'<i class="far fa-bell"></i></span>
            </a>
          </li>';
          }
         ?>

<?php if($_SESSION["proveedores"]==1)
          {
            echo '
          <li class="nav-item has-treeview">
            <a href="proveedores.php" class="nav-link">
                  <i class="fas fa-warehouse"></i>
                  <p>Proveedores</p>
                  <span class="badge right badge-pill bg-black">'.$proveedor->get_filas_proveedor().'<i class="far fa-bell"></i></span>
                </a>
          </li>';
        }
        ?>




<?php if($_SESSION["compras"]==1)
          {
            echo '
          <li class="nav-item has-treeview">
            <a href="Compras.php" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              <p>Compras</p>
              <span class="badge right badge-pill bg-black">'.$compra->get_filas_compras().'<i class="far fa-bell"></i></span>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="compras.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ingresar Compra</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consultar_compras.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar Compras</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consultar_compras_fecha.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras Por Fecha</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consultar_compras_mes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras Por Mes</p>
                </a>
              </li>
            </ul>
          </li>';
          }
         ?>


          <!--  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="productos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar Productos</p>
                </a>
              </li>
            </ul>
          </li> -->




<?php if($_SESSION["clientes"]==1)
          {
            echo '
          <li class="nav-item has-treeview">
            <a href="Clientes.php" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>Clientes</p>
                  <span class="badge right badge-pill bg-black">'.$cliente->get_filas_cliente().'<i class="far fa-bell"></i></span>
                </a>
          </li>';
        }
        ?>


        <?php if($_SESSION["ventas"]==1)
          {
            echo '
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shipping-fast"></i>
              <p>Ventas</p>
               <span class="badge right badge-pill bg-black">'.$ventas->get_filas_ventas().'<i class="far fa-bell"></i></span>
            </a>

             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ventas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ingresar Venta</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consultar_ventas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar Ventas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consultar_ventas_fecha.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas Por Fecha</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consultar_ventas_mes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas Por Mes</p>
                </a>
              </li>
            </ul>
          </li>';
          }
         ?>


          <li class="nav-header">INFORMACION</li>


          <?php if($_SESSION["reporte_compras"]==1)
          {

          echo '

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              <p>
                Reportes de compras
                <i class="right fas fa-angle-double-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte_general_compras.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rep. General de compras</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte_compras_mensual.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rep. Mensual de compras</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte_compras_proveedor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rep. Compras-Proveedor</p>
                </a>
              </li>
            </ul>
          </li>';

       }

     ?>

          <?php if($_SESSION["reporte_ventas"]==1)
          {

            echo '
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              <p>
                Reportes de Ventas
                <i class="right fas fa-angle-double-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte_general_ventas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rep. General de ventas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte_ventas_mensual.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rep. Mensual de ventas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte_ventas_cliente.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rep. Ventas-Cliente</p>
                </a>
              </li>
            </ul>
          </li>';
        }

     ?>

      <?php if($_SESSION["usuarios"]==1)
          {

          echo '

          <li class="nav-item has-treeview">
            <a href="usuarios.php" class="nav-link">
                  <i class="fa fa-user"></i>
                  <p>Usuarios</p>
                  <span class="badge right badge-pill bg-black">'.$usuario->get_filas_usuario().'<i class="far fa-bell"></i></span>
                </a>
          </li>';

        }

     ?>


    <?php if($_SESSION["empresa"]==1)
          {

          echo '

          <li class="nav-item">
            <a href="" onclick="mostrar_empresa('.$_SESSION["idUsuario"].')" data-toggle="modal" data-target="#empresaModal" class="nav-link">
              <i class="fas fa-store"></i>
              <p>
                Empresa
              </p>
            </a>
          </li> ';

        }

     ?>

      <!-- /.sidebar-menu -->
    </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="col-md-12 float-right">
    <br />
    <div id="resultados_ajax" class="text-center"></div>
  </div>



  <!--       FORMULARIO VENTANA MODAL         -->

  <div id="perfilModal" class="modal fade">

    <div class="modal-dialog">

      <form method="POST" id="perfil_form"  enctype="multipart/form-data" autocomplete="on">

        <div class="modal-content bg-light">

          <div class="modal-header">
          <center>
            <h4 class="modal-title">Editar Perfil</h4>
          </center>

          <button type="button" class="close" data-dismiss="modal">&times;
          </button>

          </div> <!-- Fin de Modal Header -->

          <div class="modal-body">

            <div class="col-lg-12">
                <div class="form-group">
                  <input type="text" name="nombre_perfil" id="nombre_perfil" class="form-control" placeholder="Nombres" require pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" name="apellido_perfil" id="apellido_perfil" class="form-control" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                    <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" name="tipoDocumento_perfil" id="tipoDocumento_perfil" class="form-control" placeholder="Tipo de Documento" required"/>
                    <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" name="numDocumento_perfil" id="numDocumento_perfil" class="form-control" placeholder="Numero de Documento" required pattern="[0-9_ ]{0,15}"/>
                    <br />
                </div>
            </div>


            <div class="col-lg-12">
                <div class="form-group">
                    <input name="direccion_perfil" id="direccion_perfil" class="form-control" placeholder="Direccion" required pattern="^[a-zA-Z_áéíóúñ°\s]{0,200}$">
                    </input>
                    <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" name="telefono_perfil" id="telefono_perfil" class="form-control" placeholder="Telefono" required pattern="[0-9_-]{0,15}"/>
                    <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="email" name="email_perfil" id="email_perfil" class="form-control" placeholder="Correo" required="required"/>
                    <br />
                </div>
            </div>


            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" name="userName_perfil" id="userName_perfil" class="form-control" placeholder="Nombre de usuario"/>
                    <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="password" name="password_perfil" id="password_perfil" class="form-control" placeholder="Contraseña" autocomplete="on" required/>
                    <br />
                </div>
            </div>


            <div class="col-lg-12">
                <div class="form-group">
                    <input type="password" name="password2_perfil" id="password2_perfil" class="form-control" placeholder="Confirmar contraseña" autocomplete="on" required/>
                    <br />
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <!--<input type="file" name="producto_imagen" id="producto_imagen"/>
                    <span id="producto_uploaded_image"></span>-->
                    <input type="hidden" name="imagen_perfil" id="imagen_perfil" class="form-control" />
                    <br />
                </div>
            </div>

      </div><!-- Fin de Modal Body -->

          <div class="modal-footer">

            <input type="hidden" name="idUsuario_perfil" id="idUsuario_perfil"/>

            <button type="submit" name="action" id="" class="btn btn bg-olive pull-left" value="Add">
              Guardar <i class="fas fa-share"></i>
            </button>

            <button type="button" onclick="limpiar()" class="btn btn-danger btn-md" data-dismiss="modal">
              Cancelar <i class="fas fa-trash"></i>
            </button>

          </div> <!-- Fin de Modal Footer -->

        </div>
      </form>
    </div>

  </div>

  <?php require_once 'modal/empresa_modal.php'; ?>

  <script type="text/javascript" src="js/perfil.js"></script>

  <script type="text/javascript" src="js/empresa.js"></script>

  <?php

  } else {

    header("Location:".conn::ruta()."vistas/index.php");
    exit();
  }

?>
