<?php

	require_once "../config/conn.php";

	require_once "../modelos/Productos.php";

	$productos = new Producto();

	   $idProductos=isset($_POST["idProductos"]);
	   $idCategoria=isset($_POST["nombreCategoria"]);
	   $idProveedor=isset($_POST["nombreProveedor"]);
	   $idUsuario=isset($_POST["idUsuario"]);
	   $producto=isset($_POST["producto"]);
	   $presentacion=isset($_POST["presentacion"]);
	   $UnidadMedida=isset($_POST["UnidadMedida"]);
	   $productoSimilar=isset($_POST["productoSimilar"]);
	   $moneda=isset($_POST["moneda"]);
	   $precioCompra=isset($_POST["precioCompra"]);
	   $precioVenta=isset($_POST["precioVenta"]);
	   $stock = isset($_POST["stock"]);
	   $estadoProducto = isset($_POST["estadoProducto"]);
	   $imagen = isset($_POST["hidden_producto_imagen"]);
	   $tipoProducto = isset($_POST["tipoProducto"]);


	switch($_GET["op"]){

		case "guardaryeditar":

	          	if(empty($_POST["idProductos"])){

              			//$datos = $productos->get_producto_nombre($_POST["producto"]);
              			$datos = $productos->get_producto_por_id($_POST["idProductos"]);

			       	   	if(is_array($datos)==true and count($datos)==0){


							$productos->registrar_producto($idCategoria,$producto,$presentacion,$UnidadMedida,$productoSimilar,$moneda,$precioCompra,$precioVenta,$stock,$tipoProducto,$estadoProducto,$imagen,$idProveedor,$idUsuario);

			       	   	  	$messages[]="El producto se registró correctamente";

			       	    }	//cierre de validacion de $datos 
			       	      
				        else {

				            $errors[]="El producto ya existe";
				        }

			    }	//cierre de empty
	            else {

	                $productos->editar_producto($idProductos,$idCategoria,$producto,$presentacion,$UnidadMedida,$productoSimilar,$moneda,$precioCompra,$precioVenta,$stock,$tipoProducto,$estadoProducto,$imagen,$idProveedor,$idUsuario);

	            	$messages[]="El producto se editó correctamente";

	            }

    	//print_r($_POST);

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

        if (isset($errors)){
			
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

		break;


		case 'mostrar':

		$datos=$productos->get_producto_por_id($_POST["idProductos"]);

		      if(is_array($datos)==true and count($datos)>0){


				foreach($datos as $row)
				{
					$output["idProductos"] = $row["idProductos"];
					$output["nombreCategoria"] = $row["idCategoria"];
					$output["producto"] = $row["producto"];
					$output["presentacion"] = $row["presentacion"];
					$output["UnidadMedida"] = $row["UnidadMedida"];
					$output["productoSimilar"] = $row["productoSimilar"];
					$output["moneda"] = $row["moneda"];
					$output["precioCompra"] = $row["precioCompra"];
					$output["precioVenta"] = $row["precioVenta"];
					$output["stock"] = $row["stock"];
					$output["tipoProducto"] = $row["tipoProducto"];
					$output["estadoProducto"] = $row["estadoProducto"];

					if($row["imagen"] != '')
					
					{
						$output['producto_imagen'] = '<img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="300" height="50" /><input type="hidden" name="hidden_producto_imagen" value="'.$row["imagen"].'" />';
					}
					else
					{
						$output['producto_imagen'] = '<input type="hidden" name="hidden_producto_imagen" value="" />';
					}


					$output["fechaExpiracion"] = date("d-m-Y",strtotime($row["fechaExpiracion"]));
					$output["nombreProveedor"] = $row["idProveedor"];


					}

	              echo json_encode($output);

		        } else {
	                $errors[]="El producto no existe";
		        }

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

	 	break;



	 	case "activarydesactivar":
     
	     $datos=$productos->get_producto_por_id($_POST["idProductos"]);

	      	if(is_array($datos)==true and count($datos)>0){

		    	$productos->editar_estado($_POST["idProductos"],$_POST["est"]);

	        } 

     	break;


     	case "listar":

	     	$datos=$productos->get_productos();

	 	 	$data= Array();

	     		foreach($datos as $row)
				{
					$sub_array = array();

					//estado
					$est = '';

						$atrib = "btn btn-success btn-sm estadoProducto";
						if($row["estadoProducto"] == 0){

							$est = 'Activo';
						
						}else{
							if($row["estadoProducto"] == 1){
								$est = 'Inactivo';

								$atrib = "btn btn-secondary btn-sm estadoProducto";
							}
						}

					//STOCK, si es mejor de 10 se pone rojo sino se pone verde
					  $stock=""; 

					  if($row["stock"]<=10){
	                      
	                     $stock = $row["stock"];
	                     $atributo = "badge badge-pill badge-danger active";
	                            
					 
					  } else {

					     $stock = $row["stock"];
	                     $atributo = "badge badge-pill badge-success";
	                 
	                 }

	                $moneda = $row["moneda"];

					$sub_array[] = $row["nombreCategoria"];
					$sub_array[] = $row["producto"];
					$sub_array[] = $row["presentacion"];
					$sub_array[] = $row["UnidadMedida"];
					$sub_array[] = $row["productoSimilar"];
					$sub_array[] = $moneda." ".$row["precioCompra"];
					$sub_array[] = $moneda." ".$row["precioVenta"];
	/* AQUI */		$sub_array[] = $row["nombreProveedor"];

					$sub_array[] = '<span class="'.$atributo.'">'.$row["stock"].'</span>';

	               	$sub_array[] = $row["tipoProducto"];

					$sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idCategoria"].','.$row["idProductos"].','.$row["estadoProducto"].');" name="estadoProducto" id="'.$row["idProductos"].'" class="'.$atrib.'">'.$est.'</button>';

					$sub_array[] = '<button type="button" onClick="mostrar('.$row["idProductos"].');" id="'.$row["idProductos"].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</button>';
				
					/*$sub_array[] = '<button type="button" onClick="eliminar('.$row["idProductos"].');" id="'.$row["idProductos"].'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>';*/

	               
	                $fecha= date("d-m-Y", strtotime($row["fechaExpiracion"]));

					if($row["imagen"] != '')
					{
						$sub_array[] = '

		 				<img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="100" height="50" /><input type="hidden" name="hidden_producto_imagen" value="'.$row["imagen"].'" />

         				<br /><span><i class="fa fa-calendar" aria-hidden="true"></i>  '.$fecha.' <br/><strong>(Fecha de Vencimiento)</strong></span> 



						';
					}
					else
					{
						

						$sub_array[] = '<button type="button" id="" class="btn btn-primary btn-sm"><i class="far fa-images" aria-hidden="true"></i> Sin imagen</button>';
					}
	                
					$data[] = $sub_array;
				 
				}	//Cierre del foreach


	      	$results = array(
	 			"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
	 			"aaData"=>$data);

	 		echo json_encode($results);


     	break;

		/***********************INICIO COMPRAS**************************/
		case "listar_en_compras":

	    $datos=$productos->get_productos();

	     //Vamos a declarar un array
	 	 $data= Array();

	    foreach($datos as $row)
				{
					$sub_array = array();

					$est = '';

						$atrib = "btn btn-success btn-sm estadoProducto";
						if($row["estadoProducto"] == 0){

							$est = 'Activo';
						
						}else{
							if($row["estadoProducto"] == 1){
								$est = 'Inactivo';

								$atrib = "btn btn-secondary btn-sm estadoProducto";
							}
						}

					  //STOCK, si es mejor de 10 se pone rojo sino se pone verde
					  $stock=""; 

					  if($row["stock"]<10){
	                      
	                     $stock = $row["stock"];
	                     $atributo = "badge badge-pill badge-danger active";
	                            
					 
					  } else {

					     $stock = $row["stock"];
	                     $atributo = "badge badge-pill badge-success";
	                 
	                 }


	                 //moneda

	                 $moneda = $row["moneda"];

					
					//$sub_array = array();
					$sub_array[] = $row["nombreCategoria"];
					$sub_array[] = $row["producto"];
					$sub_array[] = $row["presentacion"];
					$sub_array[] = $row["UnidadMedida"];
					$sub_array[] = $moneda." ".$row["precioCompra"];
					$sub_array[] = $moneda." ".$row["precioVenta"];

					$sub_array[] = '<span class="'.$atributo.'">'.$row["stock"].'
	                  </span>';

	                $sub_array[] = $row["tipoProducto"];
				   /*declaro la variable fecha*/
	               /*$fecha= date("d-m-Y", strtotime($row["fechaExpiracion"]));	*/			


					/* if($row["imagen"] != '')
						{
							$sub_array[] = '

					 <img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="50" height="50" /><input type="hidden" name="hidden_producto_imagen" value="'.$row["imagen"].'" />

			         <br /><span><i class="fa fa-calendar" aria-hidden="true"></i>  '.$fecha.' <br/><strong>(vencimiento)</strong></span> 


							';
						}
						else
						{
							

					$sub_array[] = '<button type="button" id="" class="btn btn-primary btn-sm"><i class="fa fa-picture-o" aria-hidden="true"></i> Sin imagen</button>';
						} */
	               		
						

				$sub_array[] = '<button type="button"  name="estadoProducto" id="'.$row["idProductos"].'" class="'.$atrib.'">'.$est.'</button>';

				$sub_array[] = '<button type="button" name="" id="'.$row["idProductos"].'" class="btn btn-primary btn-sm" onClick="agregarDetalle('.$row["idProductos"].',\''.$row["producto"].'\','.$row["estadoProducto"].')"><i class="fa fa-plus"></i> Agregar</button>';
	                
				

					$data[] = $sub_array;
				 
				 }


	      $results = array(
	 			"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
	 			"aaData"=>$data);
	 		echo json_encode($results);


     break;



     case "buscar_producto";
          
          $datos=$productos->get_producto_por_id_estado($_POST["idProductos"], $_POST["estadoProducto"]);

            /*comprobamos que el producto esté activo, de lo contrario no lo agrega*/
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					
					$output["idProductos"] = $row["idProductos"];
					$output["idCategoria"] = $row["idCategoria"];
					$output["producto"] = $row["producto"];
					$output["moneda"] = $row["moneda"];
					$output["precioCompra"] = $row["precioCompra"];
					$output["stock"] = $row["stock"];
				    $output["estadoProducto"] = $row["estadoProducto"];				
					
				}
		
		      
		          //echo json_encode($output);


	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                 $output["error"]="El producto seleccionado está inactivo, intenta con otro";

	        }

	        echo json_encode($output);

     break;


     case "registrar_compra";

        require_once('../modelos/Compras.php');

	    $compra = new Compras();

	    $compra->agrega_detalle_compra();

     break;
/***************************FIN DE COMPRAS*******************************/



 /***************************VENTAS*******************************/

       case "listar_en_ventas":

     $datos=$productos->get_productos();

     //Vamos a declarar un array
 	 $data= Array();

    foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';

						
						if($row["estadoProducto"] == 0){
							$est = 'ACTIVO';
							$atrib = "btn btn-success btn-sm estadoProducto";
						
						}else{
							if($row["estadoProducto"] == 1){
								$est = 'INACTIVO';
								$atrib = "btn btn-secondary btn-sm estadoProducto";
							}
				}

				  //STOCK, si es menor o igual a 10 se pone rojo sino se pone verde
				  $stock=""; 

				  if($row["stock"]<=10){
                      
                     $stock = $row["stock"];
                     $atributo = "badge badge-pill badge-danger active";
                            
				 
				  } else {

				     $stock = $row["stock"];
                     $atributo = "badge badge-pill badge-success";
                 
                 }

                 //moneda
                 $moneda = $row["moneda"];

				//$sub_array = array();
				$sub_array[] = $row["nombreCategoria"];
				$sub_array[] = $row["producto"];
				$sub_array[] = $row["presentacion"];
				$sub_array[] = $row["UnidadMedida"];
				$sub_array[] = $moneda." ".$row["precioCompra"];
				$sub_array[] = $moneda." ".$row["precioVenta"];

				$sub_array[] = '<span class="'.$atributo.'">'.$row["stock"].'
                  </span>';

                $sub_array[] = $row["tipoProducto"];

				$sub_array[] = '<button type="button"  name="estadoProducto" id="'.$row["idProductos"].'" class="'.$atrib.'">'.$est.'</button>';

               /*declaro la variable fecha*/
               /*$fecha= date("d-m-Y", strtotime($row["fechaExpiracion"]));	 */			

				/*if($row["imagen"] != '')
					{
						$sub_array[] = '

		 <img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="60" height="60" align="center"/><input type="hidden" name="hidden_producto_imagen" value="'.$row["imagen"].'" />

		 <br>

         <span><i class="fa fa-calendar" aria-hidden="true"></i>  '.$fecha.' <br/><strong>(vencimiento)</strong></span> 
						';
					}
					else
					{
				$sub_array[] = '<button type="button" id="" class="btn btn-primary btn-md"><i class="fa fa-picture-o" aria-hidden="true"></i> Sin imagen</button>

					<span><i class="fa fa-calendar" aria-hidden="true"></i>  '.$fecha.' <br/><strong>(vencimiento)</strong></span>';
					} */

			$sub_array[] = '<button type="button" name="" id="'.$row["idProductos"].'" class="btn btn-success btn-sm" onClick="agregarDetalleVenta('.$row["idProductos"].',\''.$row["producto"].'\','.$row["estadoProducto"].')"><i class="fa fa-plus"></i> Agregar</button>';
        
				$data[] = $sub_array;
			 
			 }

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

     break;

case "buscar_producto_en_venta":
          
          $datos=$productos->get_producto_por_id_estado($_POST["idProductos"], $_POST["estadoProducto"]);

            /*comprobamos que el producto esté activo, de lo contrario no lo agrega*/
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["idProductos"] = $row["idProductos"];
					$output["producto"] = $row["producto"];
					$output["moneda"] = $row["moneda"];
					$output["precioVenta"] = $row["precioVenta"];
					$output["stock"] = $row["stock"];
					$output["estadoProducto"] = $row["estadoProducto"];
					
				}
		
		     
	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                 $output["error"]="El producto seleccionado está inactivo, intenta con otro";

	        }

	        echo json_encode($output);

     break;

      case "registrar_venta";

        //se llama al modelo Ventas.php

        require_once('../modelos/Ventas.php');

	    $venta = new Ventas();

	    $venta->agrega_detalle_venta();

	    //print_r($_POST);

     break;

      case "eliminar_producto":


        $datos= $productos->get_producto_por_id($_POST["idProductos"]);

        $producto_detalle_compra=$productos->get_producto_por_id_detalle_compra($_POST["idProductos"]);

        $producto_detalle_venta=$productos->get_producto_por_id_detalle_venta($_POST["idProductos"]);
  
          
	       if(is_array($datos)==true and count($datos)>0 and is_array($producto_detalle_compra)==true and count($producto_detalle_compra)==0 and is_array($producto_detalle_venta)==true and count($producto_detalle_venta)==0){

            	
	        	$productos->eliminar_producto($_POST["idProductos"]);

					
			    $errors[]="El producto tiene un registro asociado";
                

            } 

            else {

            	
   	  	         $errors[]="Hay stock o tienes compras o ventas realizadas o anuladas, no se puede eliminar";
            }

        
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

     		if (isset($errors)){
			
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


     break;
  	


	}


?>