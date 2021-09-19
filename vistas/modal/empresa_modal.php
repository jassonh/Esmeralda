


<div id="empresaModal" class="modal fade">
  <div class="modal-dialog">
    <form action="" method="post" id="empresa_form">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Editar Empresa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">

              <div class="form-group">
                  <label for="inputText1" class="col-lg-12 control-label">Nombre de la Empresa</label>

                  <div class="col-lg-12 col-lg-offset-1">
                    <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" placeholder="Nombre de la Empresa" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
                  </div>
              </div>

               <div class="form-group">
                  <label for="inputText3" class="col-lg-12 control-label">Nit de la Empresa</label>

                  <div class="col-lg-12 col-lg-offset-1">
                    <input type="text" class="form-control" id="nitEmpresa" name="nitEmpresa" placeholder="Nit de la Empresa" required pattern="[0-9-]{0,15}">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputText5" class="col-lg-12 control-label">Dirección de la Empresa</label>
                 
                 <div class="col-lg-12 col-lg-offset-1">
                 <textarea class="form-control  col-lg-12" rows="1" id="direccionEmpresa" name="direccionEmpresa"  placeholder="Direccion de la Empresa... " required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$"></textarea>
                 </div>
                 
              </div>

              <div class="form-group">
                  <label for="inputText4" class="col-lg-12 control-label">Teléfono de la Empresa</label>

                  <div class="col-lg-12 col-lg-offset-1">
                    <input type="text" class="form-control" id="telefonoEmpresa" name="telefonoEmpresa" placeholder="Teléfono de la Empresa" required pattern="[0-9]{0,15}">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputText4" class="col-lg-12 control-label">Correo de la Empresa</label>

                  <div class="col-lg-12 col-lg-offset-1">
                    <input type="email" class="form-control" id="correoEmpresa" name="correoEmpresa" placeholder="Correo de la Empresa" required="required">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputText4" class="col-lg-12 control-label">Horario de Atencion</label>

                  <div class="col-lg-12 col-lg-offset-1">
                    <input type="text" class="form-control" id="horarioEmpresa" name="horarioEmpresa" placeholder="Horario de Atencion">
                  </div>
              </div>  

          
          </div><!--modal-body-->    

        <div class="modal-footer">
          <input type="hidden" name="idEmpresa" id="idEmpresa"/>
          <input type="hidden" name="idUsuarioEmpresa" id="idUsuarioEmpresa"/>
        
          <button type="submit" name="action" class="btn btn-success pull-left" value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
        </div>
      </div>
    </form>
  </div>
</div>

