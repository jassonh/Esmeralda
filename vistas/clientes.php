<?php

  require_once "../config/conn.php";

  if(isset($_SESSION["idUsuario"])){

?>

<?php require_once "header.php"; ?>

<?php if($_SESSION["clientes"]==1)
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

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-olive">
                <h5 class="card-title">Panel clientes</h5>

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
                    <div class="card card-outline card-olive">
                      <div class="card-header border-transparent">
                          <button type="button" class="btn btn-dark" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#clienteModal">
                             <i class="fas fa-user-plus" aria-hidden="true"></i> Nuevo Cliente
                          </button>

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
                          <table id="cliente_data" class="table table-sm table-bordered table-striped table-hover">

                            <thead>
                              <tr class="bg-dark small">

								<th>Nit</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Correo</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th width="10%">Editar</th>
                                <th width="12%">Eliminar</th>

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

  <!--       FORMULARIO VENTANA MODAL         -->

  <div id="clienteModal" class="modal fade">

    <div class="modal-dialog">

      <form method="POST" id="cliente_form">

        <div class="modal-content modal-md">

          <div class="modal-header bg-navy">

            <h4 class="modal-title">Agregar Cliente</h4>

          <button type="button" class="close" data-dismiss="modal">&times;
          </button>

          </div> <!-- Fin de Modal Header -->

          <div class="modal-body">

               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Nit</label>
                   <input type="text" class="form-control" id="nit" name="nit" placeholder="Nit">
              </div>

              <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Nombres</label>
                  <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
              </div>

                <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
              </div>

               <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente" placeholder="Teléfono" required pattern="[0-9]{0,15}">
                </div>


                <div class="form-group">
                  <label for="inputText5" class="col-lg-1 control-label">Dirección</label>
                  <textarea class="form-control" rows="3" id="direccionCliente" name="direccionCliente"  placeholder="Direccion ..." required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$"></textarea>
              </div>


                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Correo</label>
                    <input type="email" class="form-control" id="correoCliente" name="correoCliente" placeholder="Correo">
                </div>


               <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Estado</label>
                      <select class="form-control" id="estadoCliente" name="estadoCliente" required>
                      <option value="">-- Selecciona estado --</option>
                      <option value="0" selected>Activo</option>
                      <option value="1">Inactivo</option>
                    </select>
                </div>




          </div>
<!-- Fin de Modal Body -->

        <div class="modal-footer">

          <input type="hidden" name="idUsuarioCliente" id="idUsuarioCliente" value="<?php echo $_SESSION["idUsuario"];?>"/>
          <input type="hidden" name="idCliente" id="idCliente"/>
          <input type="hidden" name="nitCliente" id="nitCliente"/>

          <button type="submit" name="action" id="#" class="btn btn-outline-success pull-left btn-sm btn-block" value="Add"><i class="fas fa-sync-alt" aria-hidden="true"></i> Guardar </button>
          <br />
          <button type="button" onclick="limpiar()" class="btn btn-outline-danger btn-sm btn-block" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
        </div>
      </div>
    </form>
  </div>
</div>

 <!--FIN FORMULARIO VENTANA MODAL-->

 <?php } else {

    require_once "noacceso.php";
   }
  ?>

<?php

  require_once("footer.php");
?>

<script type="text/javascript" src="js/clientes.js"></script>
<script type="text/javascript" src="js/perfil.js"></script>
<script type="text/javascript" src="js/empresa.js"></script>




<?php

  } else {

    header("Location:index.php");
  }



?>
