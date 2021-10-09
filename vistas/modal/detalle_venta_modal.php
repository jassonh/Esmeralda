


   <div class="modal fade" id="detalle_venta">
          <div class="modal-dialog modal-xl tamdetalleventa">
           
            <div class="modal-content">
              <div class="modal-header">
               
               <h4 class="modal-title"><i class="fa fa-user-circle" aria-hidden="true"></i> Detalles de la Venta</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              <div class="modal-body">

                 <div class="container box">
        
        <!--column-12 -->
        <div class="table-responsive">
          
             <div class="box-body">

               
                        <table id="detalle_cliente" class="table table-striped table-bordered table-condensed table-hover">

                          <thead style="background-color:#A9D0F5">
                            <tr>
                              <th>Cliente</th>
                              <th>Número Venta</th>
                              <th>NIT Cliente</th>
                              <th>Dirección</th>
                              <th>Fecha Venta</th>
                            </tr>
                          </thead>

                          <tbody>
                            
                            <td> <h5 id="nombreCliente"></h5><input type="hidden" name="nombreCliente" id="nombreCliente"></td>
                            <td><h5 id="numero_venta"></h5><input type="hidden" name="numero_venta" id="numero_venta"></td>
                            <td><h5 id="nit"></h5><input type="hidden" name="nit" id="nit"></td>
                            <td><h5 id="direccionCliente"></h5><input type="hidden" name="direccionCliente" id="direccionCliente"></td>
                            <td><h5 id="fechaVenta"></h5><input type="hidden" name="fechaVenta" id="fechaVenta"></td>

                          </tbody>

                        </table>


                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Importe</th>
                                </thead>
                                        
                               
                            </table>
                          </div>

                         
            </div>
            <!-- /.box-body -->

              <!--BOTON CERRAR DE LA VENTANA MODAL-->
             <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                
              </div>
              <!--modal-footer-->
          <!--</div>-->
          <!-- /.box -->

        </div>
        <!--/.col (12) -->
      </div>
      <!-- /.row -->
       
     
              </div>
              <!--modal body-->
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

     

    

        
  