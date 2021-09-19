
<?php

 require_once "../config/conn.php";

    if(isset($_SESSION["idUsuario"])){

    require_once '../modelos/Compras.php';

    $compras = new Compras();

?>


<!-- INICIO DEL HEADER - LIBRERIAS -->
<?php require_once("header.php");?>

<?php if($_SESSION["compras"]==1)
          {
            ?>

<!-- FIN DEL HEADER - LIBRERIAS -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card">
        <div class="card-body">
         <div class="btn-group text-center">
          <a href="consultar_compras.php" class="btn btn-outline-dark btn-md" ><i class="fa fa-search" aria-hidden="true"></i> Consultar Compras</a>
         </div>
       </div>
    </div>



    <section class="formulario-compra">

    <form class="form-horizontal" id="form_compra">

    <!--FILA PROVEEDOR - COMPROBANTE DE PAGO-->
     <div class="row">

        <div class="col-lg-1"> </div>

        <div class="col-lg-10">

          <div class="card">

            <div class="card-body">

            <div class="box">

              <div class="box-body">

              <div class="form-group">

              <div class="col-lg-3 col-lg-offset-2">
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalProveedor"><i class="fa fa-search" aria-hidden="true"></i>  Buscar Proveedor
                  </button>
              </div>

              </div>

               <div class="form-group row">
                 <label for="" class="col-lg-3"><h6><strong>Numero de Compra</strong></h6></label>

                  <div class="col-lg-7">
                      <input type="text" class="form-control" id="numero_compra" name="numero_compra" value="<?php $codigo=$compras->numero_compra();?>"  readonly>
                  </div>
              </div>


               <div class="form-group row">
                  <label for="" class="col-lg-3"><h6><strong>Nit del Proveedor</strong></h6></label>

                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="nit" name="nit" placeholder="Nit del Proveedor" required pattern="[0-9]{0,15}" readonly>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="" class="col-lg-3"><h6><strong>Nombre del Proveedor</strong></h6></label>


                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="nombreProveedor" name="nombreProveedor" placeholder="Nombre del Proveedor" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" readonly>
                  </div>
              </div>

               <div class="form-group row">
                   <label for="" class="col-lg-3"><h6><strong>Dirección del Proveedor</strong></h6></label>

                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$" readonly>
                  </div>
              </div>

            </div><!-- /.box-body -->

          </div><!-- /.box -->

        </div> <!-- fin del card-body-->
      </div> <!-- fin del card -->

      <div class="col-lg-1"> </div>

      </div><!--fin col-lg-9-->

    </div><!--fin row-->


     <!--FILA CATEGORIA - PRODUCTO-->
     <div class="row">

        <div class="col-sm-12">

          <div class="card">
            <h5 class="card-header bg-light" align="center">Seleccione los Productos y la forma de Pago</h5>

            <div class="card-body">

            <div class="box">

              <div class="box-body">

              <div class="row">

                  <div class="col-lg-5">
                     <div class="col-lg-5 text-center">
                     <button type="button" id="#" class="btn btn-dark" data-toggle="modal" data-target="#lista_productosModal"> <i class="fas fa-box-open" aria-hidden="true"></i>  Agregar Productos</button>
                      </div>
                  </div>


                 <div class="col-lg-5">
                     <div class="col-lg-5 text-center">
                     <h4 class="text-center"><strong> Comprador </strong></h4>
                      <h4 id="contacto" name="contacto"><?php echo $_SESSION["nombreUsuario"]; echo " "; echo $_SESSION["apellidoUsuario"]; ?></h4>
                    </div>
                  </div>

                  <div class="col-lg-2">
                     <div class="">

                    <!--<label for=""><strong>Tipo de Pago:</strong> </label>-->
                    <h5 class="text-center"><strong>Tipo de Pago</strong></h5>

                    <select name="idTipoPago" class="col-lg-offset-2 col-xs-offset-2 form-control" id="idTipoPago" class="select" maxlength="10">
                            <option value="">Seleccione Pago</option>
                            <option value="1"> Efectivo </option>
                            <option value="2"> Cheque </option>
                    </select>
                    </div>
                  </div>

                </div><!--fin row-->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
           </div>
          </div>
        </div><!--fin col-sm-6-->
     </div><!--fin row-->


  <div class="container box">

   <div class="row">

    <div class="col-lg-12">

       <div class="card" align="center">

         <h5 class="card-header bg-light">Listado de Productos para la Compra</h5>

        <div class="card-body">

        <div class="table-responsive">

            <!-- /.box-header -->
            <div class="box-body">
              <table id="detalles" class="table table-striped table-sm">
                <thead>
                 <tr class="bg-black">


                  <th class="all">No.</th>
                  <th class="all">Producto</th>
                  <th class="all">Precio Compra</th>
                  <th class="min-desktop">Existencia</th>
                  <th class="min-desktop">Cantidad</th>
                  <th class="min-desktop">Descuento %</th>
                  <th class="min-desktop">Monto</th>
                  <th class="min-desktop">Acciones</th>

                  </tr>
                </thead>

                 <tbody id="listProdCompras" class="text-center">

                </tbody>


              </table>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.table responsive -->

      </div> <!-- Cierre del acrd-body-->
    </div> <!-- card -->

      </div>
      <!-- /.col -->

    </div>
        <!-- /row -->
  </div>
      <!-- /container -->

      <!--TABLA SUBTOTAL - TOTAL -->

       <div class="row">
        <div class="col-12">
        <div class="card">
          <div class="card-body">
          <div class="table-responsive">

            <div class="box-body">
              <table id="resultados_footer" class="table table-striped table-sm">
                <thead>
                <tr class="row text-center bg-black">

                    <th class="col-4"> Subtotal</th>

                    <th class="col-4"> Iva(%)</th>

                    <th class="col-4"> Total</th>

                </tr>
                </thead>


                <tbody>
                <tr class="row text-center">
                  <!--<td></td>
                  <td></td>
                  <td></td>-->
                  <td class="col-4"><h5 id="subtotal"> 0.00</h5><input type="hidden" name="subtotal_compra" id="subtotal_compra"></td>

                  <td class="col-4" ='col'><h4 id="Calculo"> 0.00 </h4><input type="hidden" name="CalculoIVA" id="CalculoIVA"></td>
                   <!--<td></td>-->
                  <!--IMPORTANTE: hay que poner el name=total en el h4 para que lo pueda enviar, NO se envia si lo pones en el input hidden-->
                  <td class="col-4"><h5 id="total" name="total"> 0.00</h5><input type="hidden" name="total_compra" id="total_compra"></td>
                   <!--<td></td>-->


                 </tr>

                  <tr class="">



                  <input type="hidden" name="grabar" value="si">
                  <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["idUsuario"];?>"/>

                   <input type="hidden" name="idProveedor" id="idProveedor"/>


                 </tr>
            </tbody>


              </table>



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
      <div class="row justify-content-center">
        <div class="card">
          <div class="card-body">
             <div class="boton_registrar" align="center">
               <button type="button" onClick="registrarCompra()" class="btn btn-primary btn-md col-lg-offset-10 col-xs-offset-3" id="btn"><i class="fa fa-save" aria-hidden="true"></i>  Registrar Compra</button>

              </div>
          </div>
        </div>
      </div>

      </form>
      <!--formulario-pedido-->

      </section>
      <!--section formulario - pedido -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--FIN DE CONTENIDO-->

       <!--VISTA MODAL PARA AGREGAR PROVEEDOR-->
    <?php require_once("modal/lista_proveedores_modal.php");?>
    <!--VISTA MODAL PARA AGREGAR PROVEEDOR-->

     <!--VISTA MODAL PARA AGREGAR PRODUCTO-->
    <?php require_once("modal/lista_productos_modal.php");?>


   <?php } else {

    require_once "noacceso.php";
   }
  ?>

   <?php require_once("footer.php");?>


<script type="text/javascript" src="js/proveedores.js"></script>
<script type="text/javascript" src="js/productos2.js"></script>
<script type="text/javascript" src="js/perfil.js"></script>
<script type="text/javascript" src="js/empresa.js"></script>


<?php

  } else {

         header("Location:".conn::ruta()."vistas/index.php");

     }

?>
