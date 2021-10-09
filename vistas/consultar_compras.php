<?php 

  require_once "../config/conn.php";

  if(isset($_SESSION["idUsuario"])){

?>

<?php require_once "header.php"; ?>

<?php if($_SESSION["compras"]==1)
          {
            ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header"></div>
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div id="resultado_ajax"></div>
        <!-- Info boxes -->

        <!--VISTA MODAL PARA VER DETALLE COMPRA EN VISTA MODAL-->
        <?php require_once("modal/detalle_compra_modal.php");?>        

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-olive">
                <h5 class="card-title">Panel Categorias</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    
 <!-- TABLE: LATEST ORDERS -->
                    <div class="card card-outline card-olive">
                      <div class="card-header border-transparent">
                        
                         <a href="compras.php" id="add_button" class="btn btn-md bg-black" ><i class="fa fa-plus" aria-hidden="true"></i> Nueva Compra</a>

                          <a href="consultar_compras_fecha.php" class="btn btn-md bg-dark"><i class="fas fa-hourglass-half" aria-hidden="true"></i> Compras por Fecha</a>

                           <a href="consultar_compras_mes.php" class="btn btn-md bg-gray"><i class="fas fa-calendar" aria-hidden="true"></i> Compras por Mes</a>
                
                        <div class="card-tools">
                         
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table id="compras_data" class="table table-sm table-bordered table-striped table-hover table-sm text-sm-center">
                           
                            <thead class="bg-dark small">
                              <tr>
                                                              
                                <th width="9%">Fecha</th>
                                <th width="10%">Orden</th>
                                <th width="12%">Proveedor</th>
                                <th width="9%">Nit Proveedor</th>
                                <th width="10%">Comprador</th>
                                <th width="12%">Tipo Pago</th>
                                <th width="6%">CF/SF</th>
                                <th width="12%">Total</th>
                                <th width="10%">Estado</th>
                                <th width="9%">Detalles</th>

                              </tr>
                            </thead>

                            <tbody>
                              
                            </tbody>

                          </table>
                        </div>
                        <!-- /.table-responsive -->
                     </div>
                    <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--/. container-fluid -->
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper --> 

<aside class="control-sidebar control-sidebar-dark"> <!-- Control Sidebar -->
    <!-- Control sidebar content goes here -->
</aside><!-- /.control-sidebar -->


<?php } else {

    require_once "noacceso.php";
   }
  ?>


<?php 
      require_once "footer.php"; 
?>

  <script type="text/javascript" src="js/compras.js"></script>
  <script type="text/javascript" src="js/perfil.js"></script>
  <script type="text/javascript" src="js/empresa.js"></script>


<?php 

    } else {

      header("index.php");
      exit();
    }

?>