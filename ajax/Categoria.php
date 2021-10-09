<?php

	require_once '../config/conn.php';

	require_once '../modelos/Categorias.php';

	require_once '../modelos/Productos.php';

	$categorias = new Categoria();

	$productos = new Producto();

	//declaramos en variables valores recibidos por ajax, declarando si existe el parametro que estamos recibiendo

	//Valores que vienen del atributo name del formulario 
	$idCategoria = isset($_POST["idCategoria"]);
	$nombreCategoria = isset($_POST["nombreCategoria"]);
	$descripcion = isset($_POST["descripcion"]);
	$estadoCategoria = isset($_POST["estadoCategoria"]);
	$idUsuarioCategoria = isset($_POST["idUsuarioCategoria"]);


	switch($_GET["op"]){

		case "guardaryeditar":
			
			//Verificamos si hay un registro en la base de datos, si ya hay un registro entonces no se crea
			$datos = $categorias->get_nombre_categoria($_POST["nombreCategoria"]);

						//Si el ID no existe entonces se registra
					 	if(empty($_POST["idCategoria"])){

					 			//Verificamos si existe el array con el registro de la categoria de lo contrario no se registra
				 				if(is_array($datos)==true and count($datos)==0){

				 					$categorias->registrar_categoria($nombreCategoria, $descripcion, $estadoCategoria, $idUsuarioCategoria);

				 					$messages[] = "La Categoria se registro correctamente";

				 				} //Cierre del la validacion de is_array

				 				else {

				 					//Si ya existe la categoria se muestra el mensaje
				 					$errors[]="La categoria ya existe";

				 				}
				 		 

				 		} else { // termina Validacion (empty)

				 				/*--Si ya existe editamos el Usuarios*/
				 				$categorias->editar_categoria($idCategoria, $nombreCategoria, $descripcion, $estadoCategoria, $idUsuarioCategoria);

				 				$messages[] = "La Categoria se edito correctamente";
				 		}


				//print_r($_POST);


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

		//---------------Mensaje de Error ----------------//
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
			
			//el parametro id se envia por ajax para editar el registro de la categoria
			$datos = $categorias->get_categoria_por_id($_POST["idCategoria"]);

				// verifica si existe el registro entonces recorre el array
				if(is_array($datos)== true and count($datos)>0){

					foreach($datos as $row){

						
						$output["nombreCategoria"] = $row["nombreCategoria"];
						$output["descripcion"] = $row["descripcion"];
						$output["estadoCategoria"] = $row["estadoCategoria"];
						//$output["idUsuario"] = $row["idUsuario"];

					}
						echo json_encode($output);
					

				}else{

					//Si no existe el registro no recorre el array
					$errors[]="La categoria no existe";
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
			
			//los parametros idCategoria y est vienen via ajax
			$datos = $categorias->get_categoria_por_id($_POST["idCategoria"]);

				//si el idCategoria existe recorre el array
				if(is_array($datos)==true and count($datos)>0){

					$categorias->editar_estado($_POST["idCategoria"], $_POST["est"]);

					//edita el estado del producto
					$productos->editar_estado_producto_por_categoria($_POST["idCategoria"],$_POST["est"]);
				}

		break;


		case "listar":

		$datos = $categorias->get_categorias();

		$data = Array();

			foreach ($datos as $row )
			{
				$sub_array = array();

					//Cambiamos el estado de Activo/Inactivo
					$est = '';

						$atrib = "btn btn-success btn-sm estadoCategoria";
						if($row["estadoCategoria"] == 0){

							$est = 'Activo';
						
						}else{
							if($row["estadoCategoria"] == 1){

								$est = 'Inactivo';
								$atrib = "btn btn-secondary btn-sm estadoCategoria";
							}
						}

						//Los datos que se mostraran en la tabla y su orden
						$sub_array[]=$row["nombreCategoria"];
						$sub_array[]=$row["descripcion"];
						//$sub_array[]=$row["idUsuario"];


						$sub_array[] = '<button type="button" onClick="cambiarEstado(
						'. $row["idCategoria"]. ','.$row["estadoCategoria"].');" 
						name="estadoCategoria" id=" '.$row["idCategoria"].'" class="' .$atrib .'">' .$est. '</button>';

						$sub_array[] = '<button type="button" onClick="mostrar(
						'.$row["idCategoria"].');" id="' .$row["idCategoria"].'"class="btn btn-warning btn-sm update"> <i class="fas fa-edit"></i> Editar </button> ';

						$sub_array[] = '<button type="button" onClick="eliminar('. $row["idCategoria"].');" id="' .$row["idCategoria"].' "class="btn btn-danger btn-sm"> <i class="fas fa-trash-alt"></i> Eliminar </button>';

						$data[] = $sub_array;


			} //Cierre del Foreach

						$results = array(

						"sEcho"=>1,//Informacion para el dataTables
						"iTotalRecords"=>count($data), //enviamos el total de registros
						"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
						"aaData"=>$data);

						echo json_encode($results);
		break;


		case "eliminar_categoria":
        
            $datos= $productos->get_prod_por_id_cat($_POST["idCategoria"]);
        
             if(is_array($datos)==true and count($datos)>0)
             {

      		    $errors[]="La categoría existe en productos";
			}

   		else{
            $datos= $categorias->get_categoria_por_id($_POST["idCategoria"]);

		       if(is_array($datos)==true and count($datos)>0)
		       {

		            $categorias->eliminar_categoria($_POST["idCategoria"]);

		            $messages[]="La categoría se eliminó exitosamente";
		       }
		}

//*******esto esta agregado 
	if(isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach($messages as $message) 
							{
								echo $message;
							}
				?>
				
				</div>
				<?php
			}


		if(isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach($errors as $error) 
						{
							echo $error;
						}
			?>
			</div>
			<?php
			}
 
     break;




	} //Cierre del Switch


?>