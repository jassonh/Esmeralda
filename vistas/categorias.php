<?php

  require_once "../config/conn.php";

  if(isset($_SESSION["userName"])){

?>

<?php require_once "header.php"; ?>

<?php if($_SESSION["categoria"]==1)
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
                <h5 class="card-title">Panel Categorias</h5>

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
                          <button type="button" class="btn btn-dark" id="add_button"  data-toggle="modal" data-target="#categoriaModal" onclick="limpiar()">
                             <i class="fas fa-cubes" aria-hidden="true"></i> Nueva Categoria
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
                          <table id="categoria_data" class="table table-sm table-bordered table-striped table-hover">

                            <thead>
                              <tr class="bg-dark small">

                                <th width="20%" scope="row">Categoria</th>
                                <th width="43%">Descripcion</th>
                                <th width="5%">Estado</th>
                                <th width="10%">Editar</th>
                                <th width="11%">Eliminar</th>

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

  <div id="categoriaModal" class="modal fade">

    <div class="modal-dialog">

      <form method="POST" id="categoria_form">

        <div class="modal-content">

          <div class="modal-header bg-navy">

            <h4 class="modal-title">Agregar Categoria</h4>

          <button type="button" class="close" data-dismiss="modal">&times;
          </button>

          </div> <!-- Fin de Modal Header -->

          <div class="modal-body">

            <input type="text" name="nombreCategoria" id="nombreCategoria" class="form-control" placeholder="Nombres"/>

            <br />

            <textarea type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion" rows="3"></textarea>

            <br />

            <select name="estadoCategoria" id="estadoCategoria" required class="form-control">
              <option value="">-- Selecciona Estado --</option>
              <option value="0" selected>Activo</option>
              <option value="1">Inactivo</option>
            </select>

            <br />

          </div><!-- Fin de Modal Body -->

          <div class="modal-footer bg-light">

            <input type="hidden" name="idUsuarioCategoria" id="idUsuarioCategoria" value="<?php echo $_SESSION["idUsuario"]; ?>" />

            <input type="hidden" name="idCategoria" id="idCategoria"/>

            <button type="submit" name="action" id="btnGuardar"  class="btn btn-outline-success btn-sm btn-block" value="Add"> <i class="fas fa-sync-alt"></i>
              Guardar
            </button>
            <br />

            <button type="button" onclick="limpiar()" class="btn btn-outline-danger btn-sm btn-block" data-dismiss="modal"><i class="fas fa-window-close"></i>
              Cerrar
            </button>
          </div> <!-- Fin de Modal Footer -->

        </div>
      </form>
    </div>
  </div>

<?php } else {

    require_once "noacceso.php";
   }
  ?>

  <?php
      require_once "footer.php";
  ?>

  <script type="text/javascript" src="js/Categorias.js"></script>
  <script type="text/javascript" src="js/perfil.js"></script>
  <script type="text/javascript" src="js/empresa.js"></script>



  <?php

    } else {

      header("Location:index.php");
      exit();
    }

  ?>
