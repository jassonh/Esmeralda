<?php 

    require_once "../config/conn.php";

    require_once "../modelos/Categorias.php";
    require_once "../modelos/Proveedores.php";

    if(isset($_SESSION["idUsuario"])){

    $categorias = new Categoria();
    $cat = $categorias->get_categorias();

    $proveedores = new Proveedor();
    $prov = $proveedores->get_proveedores();

?>

<?php require_once "header.php"; ?>

<?php if($_SESSION["productos"]==1)
          {
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
                <h5 class="card-title">Panel Productos</h5>
            
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    
                      <!-- TABLE: LATEST ORDERS -->
                    <div class="card card-outline card-olive">
                      <div class="card-header border-transparent">
                          <button class="btn btn-dark" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#productoModal">
                             <i class="fas fa-user-plus" aria-hidden="true"></i> Nuevo Producto
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
                          <table id="producto_data" class="table table-sm table-bordered table-striped table-hover">
                           
                            <thead class="bg-dark small">
                              <tr>
                                  
                                <th scope="row">Categoria</th>
                                <th scope="row">Producto</th>
                                <th scope="row">Presentacion</th>
                                <th scope="row">Unid. Medida</th>
                                <th scope="row">Producto Similar</th>
                                <th scope="row">Precio Compra</th>
                                <th scope="row">Precio Venta</th>
                                <th scope="row">Proveedor</th>
                                <th scope="row">Existencia</th>
                                <th scope="row">SF/CF</th>
                                <th scope="row">Estado</th>
                                <th scope="row">Editar</th>
                                <!-- <th scope="row">Eliminar</th> -->
                                <th scope="row">Imagen</th>
                                

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

  <div id="productoModal" class="modal fade">
    
    <div class="modal-dialog modal-md">

      <form method="POST" id="producto_form" enctype="multipart/form-data">
        
        <div class="modal-content bg-light">

          <div class="modal-header bg-navy">
          <center>
            <h4 class="modal-title">Agregar Producto</h4>
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
                      <label>Categoria</label>

                        <select class="form-control" name="nombreCategoria" id="nombreCategoria">
                        <option  value="0">Seleccione</option>

                          <?php

                             for($i=0; $i<sizeof($cat);$i++){
                               
                               ?>
                                <option value="<?php echo $cat[$i]["idCategoria"]?>"><?php echo $cat[$i]["nombreCategoria"];?></option>
                               <?php
                             }
                          ?>
                        
                      </select>
                  </div>
                </div>

                
                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                    <label>Producto</label>
                    <input type="text" name="producto" id="producto" class="form-control" placeholder="Nombre del Producto" required/>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                    <label>Presentacion</label>
                      <select name="presentacion" id="presentacion" class="form-control">
                        <option value="">Seleccione Presentacion</option>
                        <option value="Saco">Saco</option>
                        <option value="Caja">Caja</option>
                        <option value="Bolsa">Bolsa</option>
                        <option value="Paquete">Paquete</option>
                        <option value="Envase">Envase</option>
                      </select>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-12 col-lg-offset-1">
                    <label>Unidad</label>
                      <select name="UnidadMedida" id="UnidadMedida" class="form-control">
                        <option value=""> --Seleccione Unidad-- </option>
                        <option value="Litro">Litro (1000 ml)</option>
                        <option value="1/2 Litro">Medio Litro (500 ml)</option>
                        <option value="1/4 Litro">Cuarto de Litro (250 ml)</option>
                        <option value="1/8 Litro">Octavo de Litro (100 ml)</option>/
                        <option value="Galon 3.5L">Galon 3.5 Litros</option>
                        <option value="Galon 5L">Galon 5 Litros</option>
                        <option value="Caneca 18L">Caneca de 18 Litros</option>
                        <option value="Caneca 20L">Caneca de 20 Litros</option>
                        <option value="10 ml">10 mililitros</option>
                        <option value="20 ml">20 mililitros</option>
                        <option value="25 ml">25 mililitros</option>
                        <option value="30 ml">30 mililitros</option>
                        <option value="50 ml">50 mililitros</option>
                        <option value="60 ml">60 mililitros</option>
                        <option value="100 ml">100 mililitros</option>
                        <option value="120 ml">120 mililitros</option>
                        <option value="240 ml">240 mililitros</option>
                        <option value="10 g">10 gramos</option>
                        <option value="15 g">15 gramos</option>
                        <option value="25 g">25 gramos</option>
                        <option value="100 g">100 gramos</option>
                        <option value="200 g">200 gramos</option>
                        <option value="400 g">400 gramos</option>
                        <option value="800 g">800 gramos</option>
                        <option value="Gramo">Gramo</option>
                        <option value="Onza">Onza</option>
                        <option value="Libra">Libra</option>
                        <option value="Kilo">Kilo</option>
                        <option value="Quintal">Quintal</option>
                        <option value="Ninguna">Ninguna</option>
                      </select>
                  </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                      <label>Producto Similar</label>
                        <input name="productoSimilar" id="productoSimilar" class="form-control" placeholder="Producto Similar"/>
                        </input>
                    </div> 
                </div>


                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                      <label>Precio de Compra</label>

                        <select name="moneda" id="moneda" class="form-control">
                          <option value=""> --Seleccione Moneda-- </option>
                          <option value="Q">Q</option>
                          <option value="USD$">USD$</option>
                          <option value="EUR€">EUR€</option>
                      </select>

                        <input type="text" name="precioCompra" id="precioCompra" class="form-control" placeholder="Precio de Compra" required pattern="^[0-9]+(\.[0-9]+)?$"/>
                        
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Precio de Venta</label>
                       <input type="text" name="precioVenta" id="precioVenta" class="form-control" placeholder="Precio de Venta" required pattern="^[0-9]+(\.[0-9]+)?$"/>
                    </div>
                </div>
          

                <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Existencia</label>
                        <input type="text" name="stock" id="stock" class="form-control">
                    </div>
                </div>



            </div>
        </div>
      </div>
      <div class="col-lg-6">
              <div class="col-sm-11 col-lg-offset-3 col-sm-offset-3">

              <div class="form-group">
                 <label>Con Factura/Sin Factura</label>
                  <select name="tipoProducto" id="tipoProducto" required class="form-control">
                    <option value="">-- Selecciona CF/SF --</option>
                    <option value="CF">CF</option>
                    <option value="SF">SF</option>
                  </select>
              </div>

              <div class="form-group">
                 <label>Estado</label>
                  <select name="estadoProducto" id="estadoProducto" required class="form-control">
                    <option value="">-- Selecciona Estado --</option>
                    <option value="0" selected>Activo</option>
                    <option value="1">Inactivo</option>
                  </select>
              </div>

              <div class="form-group">
                   <label>Imagen del Producto</label>
                  <input type="file" id="producto_imagen" name="producto_imagen">
                  <span id="producto_uploaded_image"></span>
                    
                  </span>
              </div>

              <div class="form-group">
                    <div class="col-lg-12 col-lg-offset-1">
                        <label>Fecha de Expiracion</label>
                        <input type="text" name="datepicker" id="datepicker" class="form-control" placeholder="Fecha de Expiracion">
                    </div>
              </div>

              <div class="form-group">
                 <label>Proveedor</label>
                  <select class="form-control" name="nombreProveedor" id="nombreProveedor">
                        <option  value="0">Seleccione Proveedor</option>

                          <?php

                             for($i=0; $i<sizeof($prov);$i++){
                               
                               ?>
                                <option value="<?php echo $prov[$i]["idProveedor"]?>"><?php echo $prov[$i]["nombreProveedor"]; ?></option>
                               <?php
                             }
                          ?>
                        
                      </select>
              </div>
              
            </div>
      </div>
    </div>

    </div><!-- Fin de Modal Body -->

          <div class="modal-footer justify-content-between">

            <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["idUsuario"] ?>"/>

            <input type="hidden" name="idProductos" id="idProductos"/>
               
                  <button type="submit" name="action" id="#" class="btn btn-outline-success btn-md pull-left" value="Add">
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

  <script type="text/javascript" src="js/productos.js"></script>
  <script type="text/javascript" src="js/productos2.js"></script>
  <script type="text/javascript" src="js/perfil.js"></script>
  <script type="text/javascript" src="js/empresa.js"></script>


  <?php 

    } else {

      header("Location:index.php");
      exit();
    }

  ?>