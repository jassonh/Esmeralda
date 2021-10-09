
<?php

   require_once'../config/conn.php';

    if(isset($_SESSION["idUsuario"])){

      require_once'../modelos/Ventas.php';

      $venta = new Ventas();
    
?>

<!-- INICIO DEL HEADER - LIBRERIAS -->
<?php require_once("header.php");?>

<?php if($_SESSION["ventas"]==1)
          {
            ?>

<!-- FIN DEL HEADER - LIBRERIAS -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Realizar Ventas de Productos a Clientes
       
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card">
        
        <div class="card-body">

         <div class="btn-group text-center">

          <a href="consultar_ventas.php" class="btn btn-outline-dark btn-lg" btn-lg" ><i class="fa fa-search" aria-hidden="true"></i> Consultar Ventas </a>
         </div>

       </div>
      </div>

       <!--VISTA MODAL PARA AGREGAR CLIENTE-->
    <?php require_once("modal/lista_clientes_modal.php");?>
    <!--VISTA MODAL PARA AGREGAR CLIENTE-->
    
     <!--VISTA MODAL PARA AGREGAR PRODUCTO-->
    <?php require_once("modal/lista_productos_ventas_modal.php");?>


    <section class="formulario-compra">

    <form class="form-horizontal" id="form_compra">
    
    <!--FILA CLIENTE - COMPROBANTE DE PAGO-->

     <div class="row">

        <div class="col-lg-1"> </div>
          
        <div class="col-lg-10">

          <div class="card">

            <div class="card-body">

            <div class="box">
           
              <div class="box-body">

              <div class="form-group">

              <div class="col-lg-3 col-lg-offset-2">
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalCliente"><i class="fa fa-search" aria-hidden="true"></i>  Buscar Cliente
                  </button>
              </div>
                
             </div>

               <div class="form-group row">
                 <label for="" class="col-lg-3"><h6><strong>Número de Venta</strong></h6></label>
                
                  <div class="col-lg-7">
                      <input type="text" class="form-control" id="numero_venta" name="numero_venta" value="<?php $codigo=$venta->numero_venta();?>"  readonly>
                  </div>
              </div>

              <!-- <div class="form-group">
                  <label for="" class="col-lg-3 control-label">NIT Cliente</label>

                  <div class="col-lg-9">
                    <input type="text" class="form-control" id="nit" name="nit" placeholder="NIT Cliente" required pattern="[0-9]{0,15}" readonly>
                  </div>
             </div>-->

              <div class="form-group row">
                  <label for="" class="col-lg-3"><h6><strong>NIT Cliente</strong></h6></label>

                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="nit" name="nit" placeholder="NIT Cliente" required pattern="[0-9]{0,15}" readonly>
                  </div>
              </div>

              <!--<div class="form-group">
                  <label for="" class="col-lg-3 control-label">Nombres</label>

                  <div class="col-lg-9">
                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" readonly>
                  </div>
              </div>-->

              <div class="form-group row">
                  <label for="" class="col-lg-3"><h6><strong>Nombres del Cliente</strong></h6></label>


                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Nombres del Cliente" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" readonly>
                  </div>
              </div>

             <!--<div class="form-group">
                  <label for="" class="col-lg-3 control-label">Apellidos</label>

                  <div class="col-lg-9">
                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" readonly>
                  </div>
              </div>-->

              <div class="form-group row">
                  <label for="" class="col-lg-3"><h6><strong>Apellidos del Cliente</strong></h6></label>


                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" placeholder="Apellidos del Cliente" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" readonly>
                  </div>
              </div>

              <!-- <div class="form-group">
                  <label for="" class="col-lg-3 control-label">Dirección</label>

                  <div class="col-lg-9">
                    <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" placeholder="Direccion" required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$" readonly>
                  </div>-->

                <div class="form-group row">
                   <label for="" class="col-lg-3"><h6><strong>Dirección del Cliente</strong></h6></label>

                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" placeholder="Direccion" required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$" readonly>
                  </div>
             </div>
               
              </div>
              <!-- /.box-body -->
            
            <!--</form>-->
          </div>
          <!-- /.box -->
          
        </div>
        <!--fin col-lg-12-->
      
     </div>
     <!--fin row-->

     <!--FILA- PRODUCTO-->
     <div class="row">
        
        <div class="col-lg-12">

            <div class="card">
              <h4 class="card-header bg-light" align="center">Seleccione los Productos y la forma de Pago</h4>
            
              <div class="card-body">

              <div class="row justify-content-center">
                    
                 <div class="col-lg-5">
                     <div class="col-lg-6 text-center">
                     <button type="button" id="#" class="btn btn-outline-dark btn_producto" data-toggle="modal" data-target="#lista_productos_ventas_Modal"><i class="fa fa-plus" aria-hidden="true"></i>  Agregar Productos</button>
                      </div>
                  </div>    
               
                   <div class="col-lg-4">
                     <div class="col-lg-6">
                     <h5 class="text-center"><strong>Vendedor:</strong></h5>
                      <h4 id="Vendedor" name="Vendedor"><?php echo $_SESSION["nombreUsuario"]; echo " "; echo $_SESSION["apellidoUsuario"];?></h4>
                    </div>
                  </div>
         
                  <div class="col-lg-3">
                    <div class="">
                     <h4 class="text-center"><strong>Tipo de Pago</strong></h4>
                    <select name="idTipoPago" class="col-lg-offset-3 col-xs-offset-2 form-control" id="idTipoPago" class="select" maxlength="10" >
                            <option value="">Seleccione un tipo de pago</option>
                            <option value="1">Efectivo</option>
                            <option value="2">Cheque</option>
                            <!--<option value="TRANSFERENCIA">Depósito</option>-->
                          </select>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="">
                     <h4 class="text-center"><strong>CF/SF</strong></h4>
                    <select name="tipoProducto" class="col-lg-offset-3 col-xs-offset-2 form-control" id="tipoProducto" class="select" maxlength="10" >
                            <option value="">Seleccione el tipo de venta</option>
                            <option value="CF">CF</option>
                            <option value="SF">SF</option>
                            <!--<option value="TRANSFERENCIA">Depósito</option>-->
                          </select>
                    </div>
                  </div>

                </div><!--fin row-->
               
              </div>
              <!-- /.box-body -->
            
          </div>
          <!-- /.box -->
          
        </div>
        <!--fin col-sm-6-->
        
     </div>
     <!--fin row-->

      <div class="row">
        <div class="col-lg-12">
          
          <div class="table-responsive">
           <div class="card" align="center">
            <div class="card-header">
              <h4 class="card-text">Lista de Ventas a Clientes</h4>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="detalles" class="table table-striped table-bordered">
                <thead>
                 <tr class="thead-dark" align="center">
                  
                  <th class="all">Item</th>
                  <th class="all">Producto</th>
                  <th class="all">Precio Venta</th>
                  <th class="min-desktop">Stock</th>
                  <th class="min-desktop">Cantidad</th>
                  <th class="min-desktop">Descuento %</th>
                  <th class="min-desktop">Importe</th>
                  <th class="min-desktop">Acciones</th>

                  </tr>
                </thead>
                  
                  <div id="resultados_ventas_ajax"></div>            

                 <tbody id="listProdVentas">
                  
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!--TABLA SUBTOTAL - TOTAL -->
       <div class="row justify-content-center">
        <div class="col-lg-9">

          
          <div class="card">
           
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                <tr class="thead-dark" align="center">
                  
 
                    <th scope="" ='col'>SUBTOTAL</th>
                   
                    <th scope="" ='col'>I.V.A%</th>
               
                    <th scope="" ='col'>TOTAL</th>
                     
                    
                </tr>
                </thead>

                <tbody>
                <tr class="bg-light table-bordered" align="center">
                 
                  <td scope="" ='col'><h4 id="subtotal"> 0.00</h4><input type="hidden" name="subtotal_venta" id="subtotal_venta"></td>

                  <td scope="" ='col'><h4 id="Calculo"> 0.00 </h4><input type="hidden" name="CalculoIVA" id="CalculoIVA"></td>
      
                  <td scope="" ='col'><h4 id="total" name="total"> 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></td>
                   
                             
                 </tr>

                  <tr>
                 

                  <input type="hidden" name="grabar" value="si">
                  <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["idUsuario"];?>"/>

                    <input type="hidden" name="idCliente" id="idCliente"/>
                   

                 </tr>
            </tbody>

              </table>
 
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
       </div>
        <!-- /.col -->

<!--
        <div class="col-lg-12">
            <div class="card">
                <h4 class="card-header"> Calculo de Divisas </h4>

                  <div class="card-body">

                    <div class="col-lg-8">

                      
                      <input type='text' id='gp_amount' size='4' class="form-control" placeholder="Puede colocar aqui su total para verlo en otra moneda"/> 
                      <br />

                    </div>
                    <div class="col-lg-6">
                              
                      Seleccione Moneda
                      <select id="gp_from" class="form-control"></select> Convertir a  <select id="gp_to" class="form-control"></select>
                      <br />
                      <p><input type='button' class="btn btn-primary" onClick="gp_convertIt()" value='Convertir a moneda' /></p>
                      <div id="gp_converted"></div>

                    </div>

                  </div>
              </div>
          </div>
-->
      </div>
      <!-- /.row -->
     
      </form>
      <!--formulario-pedido-->

      </section>
      <!--section formulario - pedido -->

    </section>
    <!-- /.content -->
     <div class="row justify-content-center">
        <div class="card">
          <div class="card-body">
        <div class="justify-content-center">
               <div class="boton_registrar">
                <button type="button" onClick="registrarVenta()" class="btn btn-outline-success col-lg-offset-10 col-xs-offset-3" id="btn_enviar"><i class="fa fa-save" aria-hidden="true"></i>  Registrar Venta</button>
              </div>
            </div>
            </div>
            </div>
          </div>

  </div>
  <!-- /.content-wrapper -->

 <?php } else {

    require_once "noacceso.php";
   }
  ?>

   <?php require_once("footer.php");?>

    <!--AJAX CATEGORIAS-->
<script type="text/javascript" src="js/categorias.js"></script>
   
    <!--AJAX CLIENTES-->
<script type="text/javascript" src="js/clientes.js"></script>

   <!--AJAX PRODUCTOS-->
<script type="text/javascript" src="js/productos.js"></script>

  <!--AJAX VENTAS-->
<script type="text/javascript" src="js/ventas.js"></script>


<?php
   
   } else {

         header("Location:".Conectar::ruta()."vistas/index.php");

     }


?>
