<?php 

  require_once "../config/conn.php";

  if(isset($_SESSION["idUsuario"])){

?>

<?php require_once "header.php"; ?>

<?php if($_SESSION["usuarios"]==1) {    
            ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header"></div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div id="resultado_ajax"></div>
        <!-- Info boxes -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-olive">
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
                          <button class="btn btn-dark" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#usuarioModal">
                             <i class="fas fa-user-plus" aria-hidden="true"></i> Nuevo Usuario
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
                          <table id="usuario_data" class="table table-sm table-bordered table-striped table-hover">
                           
                            <thead>
                              <tr class="bg-dark active small">
                                  
                                <th scope="row">Documento</th>
                                <th scope="row">Tipo</th>
                                <th scope="row">Nombre</th>
                                <th scope="row">Apellido</th>
                                <th scope="row">Usuario</th>
                                <th scope="row">Cargo</th>
                                <th scope="row">Fecha</th>
                                <th scope="row">Estado</th>
                                <th scope="row">Editar</th>
                                <th scope="row">Eliminar</th>
                                <th scope="row">Correo</th>
                                <th scope="row">Direccion</th>
                                <th scope="row">Avatar</th>
                                <th scope="row">Telefono</th>
                                

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

  <aside class="control-sidebar control-sidebar-dark"></aside>

  <!--       FORMULARIO VENTANA MODAL         -->

  <div id="usuarioModal" class="modal fade">
    
    <div class="modal-dialog modal-md">

      <form method="POST" id="usuario_form" enctype="multipart/form-data">
        
        <div class="modal-content bg-light">

          <div class="modal-header bg-navy">
          <center>
            <h4 class="modal-title">Agregar Usuario</h4>
          </center>

          <button type="button" class="close" data-dismiss="modal">&times;
          </button>
          
          </div> <!-- Fin de Modal Header -->

    <div class="modal-body">
      <div class="row">
          <div class="col-lg-6">
            <div class="box">
              <div class="box-body">

                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                      <label>Nombres</label>
                      <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" placeholder="Nombres" require pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                  </div>
                </div>

                
                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                    <label>Apellidos</label>
                      <input type="text" name="apellidoUsuario" id="apellidoUsuario" class="form-control" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                      
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                    <label>Tipo</label>
                      <input type="text" name="tipoDocumento" id="tipoDocumento" class="form-control" placeholder="Tipo ID" required"/>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                    <label>Documento</label>
                      <input type="text" name="numDocumento" id="numDocumento" class="form-control" placeholder="Documento" required pattern="[0-9_ ]{0,15}"/>
                  </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                      <label>Direccion</label>
                        <input name="direccion" id="direccion" class="form-control" placeholder="Direccion" required pattern="^[a-zA-Z_áéíóúñ°\s]{0,200}$">
                        </input>
                    </div> 
                </div>


                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                      <label>Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" required pattern="[0-9_-]{0,15}"/>
                        
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Correo</label>
                       <input type="email" name="email" id="email" class="form-control" placeholder="Correo" required="required"/>
                    </div>
                </div>
          
                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Cargo</label>
                        <select name="cargo" id="cargo" required class="form-control">
                          <option value="">-- Selecciona Cargo --</option>
                          <option value="1" selected>Administrador</option>
                          <option value="2">Supervisor</option>
                          <option value="3">Vendedor</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Usuario</label>
                        <input type="text" name="userName" id="userName" class="form-control" placeholder="Nombre de usuario"/>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Contraseña</label>

                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required pattern="(?=.*\d)(?=.*[a-z]).{8,34}" title="Se Debe incluir minusculas y numeros"/>
                        
                    </div>
                </div>
              
                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                       <label>Confirmar Contraseña</label>

                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirmar contraseña" required pattern="(?=.*\d)(?=.*[a-z]).{8,34}" title="Se Debe incluir minusculas y numeros"/>

                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6">
              <div class="col-sm-12 col-lg-offset-3 col-sm-offset-3">
                <div class="form-group">
                   <label>Imagen del Usuario</label>
                  <input type="file" class="filestyle" data-btnClass="btn-primary" data-badge="true" data-text="" data-placeholder="Cargar imagen" data-size="md" data-input="true" name="usuario_imagen" id="usuario_imagen"/>
                  <span id="usuario_uploaded_image"></span>
                    
                  </span>
              </div>
              <div class="form-group">
                 <label>Estado</label>
                  <select name="estadoUsuario" id="estadoUsuario" required class="form-control">
                    <option value="">-- Selecciona Estado --</option>
                    <option value="0" selected>Activo</option>
                    <option value="1">Inactivo</option>
                  </select>
              </div>

              <br/><br/>
              <!--LISTA DE PERMISOS DE USUARIO-->
              <div class="form-group">
                <label for="" class="col-lg-1 control-label">Permisos</label>
                  <div class="col-lg-12">
                    <ul style="list-style:none;" id="permisos">
                    </ul>
                  </div>
              </div>

            </div>
      </div>

    </div>

    </div><!-- Fin de Modal Body -->

          <div class="modal-footer justify-content-between">

            <input type="hidden" name="idUsuario" id="idUsuario"/>
               
                  <button type="submit" name="action" id="btnGuardar" class="btn btn-outline-success btn-md pull-left" value="Add">
                    <i class="fas fa-sync"></i>
                    Guardar
                  </button>
                
                  <button type="button" onclick="limpiar()" class="btn btn-outline-danger btn-md" data-dismiss="modal"><i class="fas fa-ban" aria-hidden="true"></i>
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

  <script type="text/javascript" src="js/Usuarios.js"></script>
  <script type="text/javascript" src="js/perfil.js"></script>
  <script type="text/javascript" src="js/empresa.js"></script>


  <?php 

    } else {

      header("Location:".Conectar::ruta()."vistas/index.php");
      exit();
    }

  ?>