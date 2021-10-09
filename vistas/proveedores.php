<?php 

  require_once "../config/conn.php";

  if(isset($_SESSION["idUsuario"])){/*}*/

      require_once("../modelos/Proveedores.php");

      $proveedores = new Proveedor();

      $prov = $proveedores->get_proveedores();

?>

<?php require_once "header.php"; ?>

<?php if($_SESSION["proveedores"]==1)
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
        <div id="resultados_ajax"></div>
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-olive">
                <h5 class="card-title">Panel Proveedores</h5>

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
                          <button class="btn btn-dark" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#proveedorModal">
                             <i class="fas fa-warehouse" aria-hidden="true"></i> Nuevo Proveedor
                          </button>
                
                        <div class="card-tools">
                         
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table id="proveedor_data" class="table table-sm table-bordered table-striped table-hover">
                           
                            <thead>
                              <tr class="bg-dark small">
                                  
                                <th scope="row">Nombre</th>
                                <th scope="row">Contacto</th>
                                <th scope="row">Tel.Contacto</th>
                                <th scope="row">Nit</th>
                                <th scope="row">Tel.Proveedor</th>
                                <th scope="row">Correo</th>
                                <th scope="row">Direccion</th>
                                <th scope="row">Estado</th>
                                <th scope="row">Departamento</th>
                                <th scope="row">Region</th>
                                <!--<th scope="row">Fecha</th>-->
                                <th scope="row">Editar</th>
                                <th scope="row">Eliminar</th>

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

  <div id="proveedorModal" class="modal fade">
    <div class="modal-dialog modal-xl">
      <form method="POST" id="proveedor_form">
        
        <div class="modal-content bg-light">

          <div class="modal-header bg-navy">
          <center>
            <h4 class="modal-title">Agregar Proveedor</h4>
          </center>

          <button type="button" class="close" data-dismiss="modal">&times;
          </button>
          
          </div> <!-- Fin de Modal Header -->

          <div class="modal-body">

          <div class="form-row">

              <div class="col-md-3 mb-2">
                  <label>Nombre Proveedor</label>
                  <input type="text" name="nombreProveedor" id="nombreProveedor" class="form-control" placeholder="Nombre Proveedor"/>
                  
              </div>
              <div class="col-md-2 mb-2">
                <label>Contacto(opcional)</label>
                  <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Contacto"/>
                  
              </div>
              <div class="col-md-2 mb-1">
                <label>Telefono</label>
                  <input type="text" name="telefonoContacto" id="telefonoContacto" class="form-control" placeholder="Telefono del Contacto"/>
                  
              </div>
              <div class="col-md-2 mb-1">
                <label>Nit Proveedor</label>
                  <input type="text" name="nit" id="nit" class="form-control" placeholder="Nit del Proveedor" required pattern="[0-9_ ]{0,15}"/>
              </div>
          
          
              <div class="col-md-3 mb-2">
                <label>Telefono del proveedor (opcional)</label>
                  <input type="text" name="telefonoProveedor" id="telefonoProveedor" class="form-control" placeholder="Telefono del Proveedor"/>
                  
              </div>
          </div>
          <div class="form-row">
              
              <div class="col-md-3 mb-2">
                  <label>Correo</label>
                 <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo"/>
                
              </div>
              <div class="col-md-3 mb-2">
                  <label>Direccion</label>
                  <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion"/>
              </div>
              <div class="col-md-3 mb-2">
                  <label>Estado del Proveedor</label>
                  <select name="estado" id="estado" required class="form-control">
                    <option value="">-- Selecciona Estado --</option>
                    <option value="0" >Activo</option>
                    <option value="1">Inactivo</option>
                  </select>
              </div>
               <div class="col-md-3 mb-2">
                  <label>Departamento</label>
                  <select name="idDepartamentoProveedor" id="idDepartamentoProveedor" required class="form-control">
                    <option value="">-- Selecciona Departamento --</option>
                    <option value="1">Alta Verapaz</option>
                    <option value="2">Baja Verapaz</option>
                    <option value="3">Chimaltenango</option>
                    <option value="4">Chiquimula</option>
                    <option value="5">Peten</option>
                    <option value="6">El Progreso</option>
                    <option value="7">Quiche</option>
                    <option value="8">Escuintla</option>
                    <option value="9">Guatemala</option>
                    <option value="10">Huehuetenango</option>
                    <option value="11">Izabal</option>
                    <option value="12">Jalapa</option>
                    <option value="13">Jutiapa</option>
                    <option value="14">Quetzaltenango</option>
                    <option value="15">Retalhuleu</option>
                    <option value="16">Sacatepequez</option>
                    <option value="17">San Marcos</option>
                    <option value="18">Santa Rosa</option>
                    <option value="19">Solola</option>
                    <option value="20">Suchitepequez</option>
                    <option value="21">Totonicapan</option>
                    <option value="22">Zacapa</option>
                  </select>
              </div>
              
          </div>
          <div class="form-row">
              <div class="col-md-3 mb-2">
                  <label>Region</label>
                  <select name="idRegionProveedor" id="idRegionProveedor" required class="form-control">
                    <option value="">-- Selecciona Region --</option>
                    <option value="1">Metropolitana</option>
                    <option value="2">Norte</option>
                    <option value="3">Nororiente</option>
                    <option value="4">Suroriente</option>
                    <option value="5">Central</option>
                    <option value="6">Noroccidente</option>
                    <option value="7">Suroccidente</option>
                    <option value="8">Peten</option>
                  </select>
              </div>
          </div>

        
      </div><!-- Fin de Modal Body -->

          <div class="modal-footer justify-content-between">
          <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["idUsuario"];?>"/>

            <input type="hidden" name="nitProveedor" id="nitProveedor"/>
               
                  <button type="submit" name="action" id="#" class="btn btn-outline-success btn-md pull-left" value="add"><i class="fas fa-sync"></i>
                    Guardar
                  </button>
                
                  <button type="button" class="btn btn-outline-danger btn-md" data-dismiss="modal"><i class="fas fa-ban" aria-hidden="true"></i>
                    Cancelar
                  </button>
                
              </div>
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

  <script type="text/javascript" src="js/proveedores.js"></script>
  <script type="text/javascript" src="js/perfil.js"></script>
  <script type="text/javascript" src="js/empresa.js"></script>


  <?php 

    } else {

      header("Location:".Conectar::ruta()."vistas/index.php");
      exit();
    }

  ?>