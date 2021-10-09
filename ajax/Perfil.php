<?php

	require_once '../config/conn.php';

	require_once '../modelos/Perfil.php';

	$perfil = new Perfil();

	//Declara variables que se envian por el formulario
	$idUsuario_perfil = isset($_POST["idUsuario_perfil"]);
	$nombre_perfil = isset($_POST["nombre_perfil"]);
	$apellido_perfil = isset($_POST["apellido_perfil"]);
	$tipoDocumento_perfil = isset($_POST["tipoDocumento_perfil"]);
	$numDocumento_perfil = isset($_POST["numDocumento_perfil"]);
	$direccion_perfil = isset($_POST["direccion_perfil"]);
	$telefono_perfil = isset($_POST["telefono_perfil"]);
	$email_perfil = isset($_POST["email_perfil"]);
	$userName_perfil = isset($_POST["userName_perfil"]);
	$password_perfil=  isset($_POST["password_perfil"]);
	$password2_perfil =  isset($_POST["password2_perfil"]);
	//$imagen_perfil = isset($_POST["hidden_producto_imagen"]);
	$imagen_perfil  =  isset($_POST["imagen_perfil"]);


	switch($_GET["op"]){

	case 'mostrar_perfil':

		$datos = $perfil->get_usuario_por_id($_POST["idUsuario_perfil"]);


		if(is_array($datos)== true and count($datos)>0){

				foreach($datos as $row){
						
						$output["nombreUsuario"] = $row["nombreUsuario"];
						$output["apellidoUsuario"] = $row["apellidoUsuario"];
						$output["tipoDocumento"] = $row["tipoDocumento"];
						$output["numDocumento"] = $row["numDocumento"];
						$output["direccion"] = $row["direccion"];
						$output["telefono"] = $row["telefono"];
						$output["email"] = $row["email"];
						$output["userName_perfil"] = $row["userName"];
						$output["password"] = $row["password"];
						$output["password2"] = $row["password2"];
						$output["imagen"] = $row["imagen"];
						$output["idUsuario"] = $row["idUsuario"];

						/*if($row["imagen"] != '')
					
							{
								$output['producto_imagen'] = '<img src="upload/'.$row["imagen"].'" class="img-thumbnail img-fluid" alt="Responsive image" width="250" height="100" /><input type="hidden" name="hidden_producto_imagen" value="'.$row["imagen"].'" />';
							}
							else
							{
								$output['producto_imagen'] = '<input type="hidden" name="hidden_producto_imagen" value="" />';
							}*/

				}

						echo json_encode($output);
		} else {

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

	case 'editar_perfil':

		//Verificamos si el usuario ya existe en la base de datos, si ya existe un registro con el userName o el numero de Documento
		$datos = $perfil->get_numDocumento_userName($_POST["numDocumento_perfil"],$_POST["email_perfil"]);

		//Verificamos si las contrasenas coinciden
		if($_POST["password_perfil"]==$_POST["password2_perfil"])
		{

				if(is_array($datos)==true and count($datos)>0)
				{

					//Si existe un registro con el mismo numero de Documento o correo entonces sse edita el registro.

					$perfil->editar_perfil($idUsuario_perfil, $nombre_perfil, $apellido_perfil, $tipoDocumento_perfil, $numDocumento_perfil, $direccion_perfil, $telefono_perfil, $email_perfil, $userName_perfil, $password_perfil, $password2_perfil, $imagen_perfil);

					$messages[] = "El usuario se edito correctamente";

				}// Cierrre de condicion is_array 

		} // Cierre de condicion de password

		else {

			$errors[]="El password no coincide";

		}

		//print_r($_POST);

			//-------------Mensaje de envio de datos exitoso---------------------//
			if(isset($messages)){
					?>
						<div class="alert alert-success pull-right" role="alert">  <button type="button" class="close" data-dismiss="alert">&times;</button>
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

	}

?>