<?php

	require_once "../config/conn.php";

	/*llamo a los modelos categoria, cliente, compra, empresa, producto, proveedor y venta para verificar si el usuario tiene registros asociados a las tablas de la base de datos*/
	require_once '../modelos/Categorias.php';
	require_once '../modelos/Clientes.php';  
	require_once '../modelos/Compras.php';
	require_once '../modelos/Empresa.php';
	require_once '../modelos/Productos.php';
	require_once '../modelos/Proveedores.php';
	require_once '../modelos/Ventas.php';

	//Se llama el modelo de Usuarios
	require_once "../modelos/Usuarios.php";

	$usuarios = new Usuarios();

	//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

	$idUsuario = isset($_POST["idUsuario"]);
	$nombreUsuario = isset($_POST["nombreUsuario"]);
	$apellidoUsuario = isset($_POST["apellidoUsuario"]);
	$tipoDocumento = isset($_POST["tipoDocumento"]);
	$numDocumento = isset($_POST["numDocumento"]);
	$direccion = isset($_POST["direccion"]);
	$telefono = isset($_POST["telefono"]);
	$email = isset($_POST["email"]);
	$cargo = isset($_POST["cargo"]);
	$userName = isset($_POST["userName"]);
	$password =  isset($_POST["password"]);
	$password2 =  isset($_POST["password2"]);
	$imagen = isset($_POST["hidden_usuario_imagen"]);
	//$imagen = isset($_POST["imagen"]);
	$estadoUsuario = isset($_POST["estadoUsuario"]);
	$idUsuarioEmpresa = isset($_POST["idUsuarioEmpresa"]);

	//Permisos
	$permisos= isset($_POST["permiso"]);
	//$nombrePermiso= isset($_POST["nombrePermiso"]);

	switch($_GET["op"]){

		case "guardaryeditar":
				
			$datos = $usuarios->get_numDocumento_userName($_POST["numDocumento"], $_POST["userName"]);


				if($password==$password2){

					 	if(empty($_POST["idUsuario"])){


				 				if(is_array($datos)==true and count($datos)==0){

				 					$usuarios->registrarUsuarios($nombreUsuario,$apellidoUsuario,$tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $userName, $password,$password2,$imagen,$estadoUsuario,$permisos);

				 					$messages[] = "El usuario se registro correctamente";

				 				} else {

				 					$errors[]="Documento y/o usuario ya existen";

				 				}
				 		 

				 		} else { // termina Validacion (empty)

				 				/*--Si ya existe editamos el Usuarios*/
				 				$usuarios->editarUsuario($nombreUsuario,$apellidoUsuario,$tipoDocumento,$numDocumento,$direccion,$telefono,$email,$cargo,$userName,$password,$password2,$imagen,$estadoUsuario,$idUsuario,$permisos);

				 				$messages[] = "El usuario se edito correctamente";
				 		}


				} else {

					//Sino coincide el password se muestre este mensaje
					$errors[]="El password no coincide";

				}

				//print_r($_POST);
				//print_r($_FILES);


				//---------------Mensaje de Envio exitoso----------------//
		if(isset($messages)){
				?>
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Bien Hecho</strong>
						<?php
							foreach ($messages as $message) {
								echo $message;
							}
						?>
	  				</div>
				<?php
		}
		if(isset($errors)){

			?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;
					</button>
					<strong>Error!</strong>
					<?php
						foreach ($errors as $error) {
							echo $error;
						}
					?>
  				</div>
			<?php
		}
		break;
		
		case "mostrar":
			
			$datos = $usuarios->get_usuario_por_id($_POST["idUsuario"]);

				// verifica si existe el registro
				if(is_array($datos)== true and count($datos)>0){

					foreach($datos as $row){

						$output["idUsuario"] = $row["idUsuario"];
						$output["nombreUsuario"] = $row["nombreUsuario"];
						$output["apellidoUsuario"] = $row["apellidoUsuario"];
						$output["tipoDocumento"] = $row["tipoDocumento"];
						$output["numDocumento"] = $row["numDocumento"];
						$output["direccion"] = $row["direccion"];
						$output["telefono"] = $row["telefono"];
						$output["email"] = $row["email"];
						$output["cargo"] = $row["cargo"];
						$output["userName"] = $row["userName"];
						$output["password"] = $row["password"];
						$output["password2"] = $row["password2"];
						//$output["fechaRegistro"] = $row["fechaRegistro"];
						//$output["imagen"] = $row["imagen"];
						$output["estadoUsuario"] = $row["estadoUsuario"];

						if($row["imagen"] != '')
					
							{
								$output['usuario_imagen'] = '<img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="175" height="70" /><input type="hidden" name="hidden_usuario_imagen" value="'.$row["imagen"].'" />';
							}
							else
							{
								$output['usuario_imagen'] = '<input type="hidden" name="hidden_usuario_imagen" value="" />';
							}

						
					} // Cierre del foreach

						echo json_encode($output);
					

				}else{

					//Si no existe el registro no recorre el array
					$errors[]="el usuario no existe";
				}

				if(isset($errors)){

						?>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-miss="alert">&times;
						</button>
						<strong>Error!</strong>

						<?php
							foreach ($Errors as $error) {
								echo $error;
								}
						?>

	  				</div>

						<?php
						
					}

			break;

		case "activarydesactivar":
			
			//los parametros id_usuario y est vienen via ajax
			$datos = $usuarios->get_usuario_por_id($_POST["idUsuario"]);

				//si el idUsuario existe cambia el estado 
				if(is_array($datos)==true and count($datos)>0){

					$usuarios->editar_estado($_POST["idUsuario"], $_POST["est"]);
				}

			break;
		
		case "listar":
				$datos=$usuarios->get_usuarios();

				//declaramos array
				$data = Array();

				foreach ($datos as $row){
					
					$sub_array = array();

					//estado
					$est = '';

						$atrib = "btn btn-success btn-sm estadoUsuario";
						if($row["estadoUsuario"] == 0){

							$est = 'Activo';
						
						}else{
							if($row["estadoUsuario"] == 1){
								$est = 'Inactivo';

								$atrib = "btn btn-secondary btn-sm estadoUsuario";
							}
						}


					//cargo 
					if($row["cargo"]==1)
					{
						$cargo = "Administrador";
					}else{
						if($row["cargo"]==2)
						{
							$cargo = "Supervisor";
						}else{
							if($row["cargo"]==3)
							{
								$cargo = "Vendedor";
							}
						}
					}

					// LOS DATOS EN EL ORDEN QUE SE MUESTRAN EN LA TABLA

					$sub_array[]=$row["numDocumento"];
					$sub_array[]=$row["tipoDocumento"];
					$sub_array[]=$row["nombreUsuario"];
					$sub_array[]=$row["apellidoUsuario"];
					$sub_array[]=$row["userName"];
					$sub_array[]=$cargo;
					$sub_array[]=$row["fechaRegistro"];

					$sub_array[] = '<button type="button" onClick="cambiarEstado(
						'. $row["idUsuario"]. ','.$row["estadoUsuario"].');" 
						name="estadoUsuario" id=" '.$row["idUsuario"].'" class="' .$atrib .'">' .$est. '</button>';

					$sub_array[] = '<button type="button" onClick="mostrar(
						'.$row["idUsuario"].');" id="' .$row["idUsuario"].'"class="btn btn-warning btn-sm update"> <i class="fas fa-edit"></i> Editar </button> ';

					$sub_array[] = '<button type="button" onClick="eliminar('. $row["idUsuario"].');" id="' .$row["idUsuario"].' "class="btn btn-danger btn-sm"> <i class="fas fa-trash-alt"></i> Eliminar </button>';

					$sub_array[]=$row["email"];
					$sub_array[]=$row["direccion"];
					//$sub_array[]=$row["imagen"];


					if($row["imagen"] != '')
					{
						$sub_array[] = '

						 <img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="100" height="100" /><input type="hidden" name="hidden_usuario_imagen" value="'.$row["imagen"].'" />
						';
					}
					else
					{
						

						$sub_array[] = '<button type="button" id="" class="btn btn-primary btn-md"><i class="fas fa-images"></i> Sin imagen</button>';
					} 

					$sub_array[]=$row["telefono"];

					

					$data[] = $sub_array;

				}
					$results = array(

						"sEcho"=>1,//Informacion para el dataTables
						"iTotalRecords"=>count($data), //enviamos el total de registros
						"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
						"aaData"=>$data);
					echo json_encode($results);
		break;

		case "eliminar_usuario":
          
        //verificamos si el usuario existe en las tablas productos, compras, clientes, compras, ventas, categoria, si existe entonces el usuario no se elimina, si no existe entonces se puede eliminar el usuario

        $producto = new Producto();
        $categoria = new Categoria();
        $cliente = new Cliente();
        $compra =  new Compras();
        //$empresa = new Empresa();
        $proveedor = new Proveedor();
        $venta = new Ventas();

        $prod= $producto->get_producto_por_id_usuario($_POST["idUsuario"]);

        $cat= $categoria->get_categoria_por_id_usuario($_POST["idUsuario"]);

        $cli= $cliente->get_cliente_por_id_usuario($_POST["idUsuario"]);

        $comp= $compra->get_compras_por_id_usuario($_POST["idUsuario"]);

        $detalle_comp= $compra->get_detalle_compras_por_id_usuario($_POST["idUsuario"]);

        //$emp= $empresa->get_empresa_por_id_usuario($_POST["idUsuarioEmpresa"]);    
    
        $prov= $proveedor->get_proveedor_por_id_usuario($_POST["idUsuario"]); 

        $vent= $venta->get_ventas_por_id_usuario($_POST["idUsuario"]);

       $detalle_vent= $venta->get_detalle_ventas_por_id_usuario($_POST["idUsuario"]); 

       $usuario_permiso= $usuarios->get_usuario_permiso_por_id_usuario($_POST["idUsuario"]);

        if(
          is_array($usuario_permiso)==true and count($usuario_permiso)>0 or
          is_array($prod)==true and count($prod)>0 or 
          is_array($cat)==true and count($cat)>0 or 
          is_array($cli)==true and count($cli)>0 or 
          is_array($comp)==true and count($comp)>0 or 
          is_array($detalle_comp)==true and count($detalle_comp)>0 or 
          //is_array($emp)==true and count($emp)>0 or 
          is_array($prov)==true and count($prov)>0 or 
          is_array($vent)==true and count($vent)>0 or 
          is_array($detalle_vent)==true and count($detalle_vent)>0)

        {

            //si existe el usuario en las tablas productos, compras, clientes, compras, ventas, categoria, no lo elimina
        
          $errors[]="El usuario existe en los registros, no se puede eliminar";

        }//fin

      else{

           $datos= $usuarios->get_usuario_por_id($_POST["idUsuario"]);

             //si el usuario no existe en las tablas de la bd y que existe en la tabla de usuario entonces se elimina
           if(is_array($datos)==true and count($datos)>0){

                $usuarios->eliminar_usuario($_POST["idUsuario"]);

                $messages[]="El usuario se eliminó exitosamente";

           }
          
      }


  	//prueba mensaje de success
     if (isset($messages)){
        
        ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
              foreach ($messages as $message) {
                  echo $message;
                }
              ?>
        </div>
        <?php
      }
  	//fin mensaje success

    //inicio de mensaje de error
    if(isset($errors)){
      
      ?>
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error!</strong> 
          <?php
            foreach ($errors as $error) {
                echo $error;
              }
            ?>
      </div>
      <?php
      }
     //fin de mensaje de error

    	break;

		case 'permisos':
            
            //Obtenemos todos los permisos de la tabla permisos
          $listar_permisos= $usuarios->permisos();

          //Obtener los permisos asignados al usuario
          /*el id_usuario se envía cuando se edita un usuario*/
        $idUsuario=$_GET['idUsuario'];


        //echo $idUsuario;


        $marcados = $usuarios->listar_permisos_por_usuario($idUsuario);


        //print_r($marcados);


            //Declaramos el array para almacenar todos los permisos marcados
        $valores=array();

        //Almacenar los permisos asignados al usuario en el array

          foreach($marcados as $re){

            /*NO hay que tratar a $re como si fuera un objeto o un metodo
                hay que manejarlo como un array como en el siguiente ejemplo*/

                $valores[]=$re["idPermiso"];
             
              }


          //Mostramos la lista de permisos en la vista y si están o no marcados

          foreach($listar_permisos as $row){

                $output["idPermiso"]=$row["idPermiso"];
                $output["nombrePermiso"]=$row["nombrePermiso"];

                /*verificamos si el $row["id_permiso"] estan dentro del array $valores y y si lo está entonces estaría marcado, en caso contrario no estaría marcado*/
                
                $sw = in_array($row['idPermiso'],$valores) ? 'checked':'';
                 
                 echo '<li><input type="checkbox" '.$sw.' name="permiso[]" value="'.$row["idPermiso"].'">'.$row["nombrePermiso"].'</li>';
            }

       break;

       
	}

?>