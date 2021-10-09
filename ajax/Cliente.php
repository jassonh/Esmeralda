<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conn.php");
     //llamo al modelo Clientes
      require_once("../modelos/Clientes.php");
      //llamo al modelo ventas
      require_once("../modelos/Ventas.php");

  
     $clientes = new Cliente();

   $idUsuarioCliente=isset($_POST["idUsuarioCliente"]);
   $nit = isset($_POST["nit"]);
   $nitCliente = isset($_POST["nitCliente"]);
   $nombreCliente=isset($_POST["nombreCliente"]);
   $apellidoCliente=isset($_POST["apellidoCliente"]);
   $telefonoCliente=isset($_POST["telefonoCliente"]);
   $direccionCliente=isset($_POST["direccionCliente"]);
   $correoCliente=isset($_POST["correoCliente"]);
   $estadoCliente=isset($_POST["estadoCliente"]);

    switch($_GET["op"]){

      case "guardaryeditar":

      /*verificamos si existe el cliente en la base de datos*/
      
      $datos = $clientes->get_datos_cliente($_POST["nit"],$_POST["nombreCliente"]);
    
	       	   /*si nit no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
	          if(empty($_POST["nitCliente"])){

	       	  /*verificamos si nit del cliente en la base de datos, si ya existe un registro con el cliente entonces no se registra*/

			       	   if(is_array($datos)==true and count($datos)==0){

			       	   	  //no existe el cliente por lo tanto hacemos el registros

		 				$clientes->registrar_cliente($nit,$nombreCliente,$apellidoCliente,$telefonoCliente,$direccionCliente,$correoCliente,$estadoCliente,$idUsuarioCliente);



			       	   	  $messages[]="El Cliente se registró correctamente";

			       	   } //cierre de validacion de $datos 


			       	      /*si ya existe el cliente entonces aparece el mensaje*/
				              else {

				              	  $errors[]="El Cliente ya existe";
				              }

			    }//cierre de empty

	            else {


	            	/*si ya existe entonces editamos el cliente*/

	             $clientes->editar_cliente($nit,$nombreCliente,$apellidoCliente,$telefonoCliente,$direccionCliente,$correoCliente,$estadoCliente,$idUsuarioCliente);

	            	  $messages[]="El cliente se editó correctamente";

	            	 
	            }

	     //print_r($_POST);

    
      
     //mensaje success
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
	 //fin success

	 //mensaje error
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

	 //fin mensaje error


     break;

     case 'mostrar':

    
    //el parametro nit se envia por AJAX cuando se edita el cliente
	$datos=$clientes->get_cliente_por_nit($_POST["nit"]);


          // si existe el id del cliente entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){


    				foreach($datos as $row)
    				{
    					$output["nit"] = $row["nit"];
						$output["nombreCliente"] = $row["nombreCliente"];
						$output["apellidoCliente"] = $row["apellidoCliente"];
						$output["telefonoCliente"] = $row["telefonoCliente"];
						$output["direccionCliente"] = $row["direccionCliente"];
						$output["correoCliente"] = $row["correoCliente"];
						$output["fechaRegistro"] = $row["fechaRegistro"];
						$output["estadoCliente"] = $row["estadoCliente"];

    				}


                  echo json_encode($output);


	        } else {
                 
                 //si no existe el cliente entonces no recorre el array
                $errors[]="El cliente no existe";

	        }


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

      case "activarydesactivar":
     
     //los parametros id_cliente y est vienen por via ajax
     $datos=$clientes->get_cliente_por_id($_POST["idCliente"]);

          // si existe el id del cliente entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

              //edita el estado del cliente
		      $clientes->editar_estado($_POST["idCliente"],$_POST["est"]);
		     
	        } 

     break;

     case "listar":

     $datos=$clientes->get_clientes();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)

			{
				$sub_array = array();

				$est = '';
				
				 $atrib = "btn btn-secondary btn-sm estadoCliente";
				if($row["estadoCliente"] == 0){
					$est = 'Activo';
					$atrib = "btn btn-success btn-sm estadoCliente";
				}
				else{
					if($row["estadoCliente"] == 1){
						$est = 'Inactivo';
						
					}	
				}
				
			
	             $sub_array[] = $row["nit"];
				 $sub_array[] = $row["nombreCliente"];
				 $sub_array[] = $row["apellidoCliente"];
				 $sub_array[] = $row["telefonoCliente"];
				 $sub_array[] = $row["direccionCliente"];
				 $sub_array[] = $row["correoCliente"];
				 $sub_array[] = date("d-m-Y",strtotime($row["fechaRegistro"]));
				

                 $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idCliente"].','.$row["estadoCliente"].');" name="estadoCliente" id="'.$row["idCliente"].'" class="'.$atrib.'">'.$est.'</button>';
                
                

                 $sub_array[] = '<button type="button" onClick="mostrar('.$row["nit"].');" id="'.$row["idCliente"].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</button>';
                 

                 $sub_array[] = '<button type="button" onClick="eliminar('.$row["idCliente"].');" id="'.$row["idCliente"].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;

      /*se muestran en ventana modal el datatable de los clientes en ventas para seleccionar luego los clientes activos y luego se autocomplementa los campos de un formulario*/
     case "listar_en_ventas":

     $datos=$clientes->get_clientes();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';
				
				 
				if($row["estadoCliente"] == 0){
					$est = 'Activo';
					$atrib = "btn btn-success btn-md estadoCliente";
				}
				else{
					if($row["estadoCliente"] == 1){
						$est = 'Inactivo';
						$atrib = "btn btn-warning btn-md estadoCliente";
					}	
				}
				
				
	             $sub_array[] = $row["nit"];
				 $sub_array[] = $row["nombreCliente"];
				 $sub_array[] = $row["apellidoCliente"];
				 
				
                 $sub_array[] = '<button type="button"  name="estadoCliente" id="'.$row["idCliente"].'" class="'.$atrib.'">'.$est.'</button>';
// por aqui

                 $sub_array[] = '<button type="button" onClick="agregar_registro('.$row["idCliente"].','.$row["estadoCliente"].');" id="'.$row["idCliente"].'" class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;


     /*valida los clientes activos y se muestran en un formulario*/
     case "buscar_cliente":


	$datos=$clientes->get_cliente_por_id_estado($_POST["idCliente"],$_POST["est"]);


          // comprobamos que el cliente esté activo, de lo contrario no lo agrega
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["nit"] = $row["nit"];
					$output["nombreCliente"] = $row["nombreCliente"];
					$output["apellidoCliente"] = $row["apellidoCliente"];
					$output["direccionCliente"] = $row["direccionCliente"];
					$output["estadoCliente"] = $row["estadoCliente"];
					
				}

			

	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                
                 $output["error"]="El cliente seleccionado está inactivo, intenta con otro";


	        }

	        echo json_encode($output);

     break;

     	
     case "eliminar_cliente":

        $ventas = new Ventas();

        $vent= $ventas->get_ventas_por_id_cliente($_POST["idCliente"]);

        $detalle_vent= $ventas->get_detalle_ventas_por_id_cliente($_POST["idCliente"]);

        
        if(is_array($vent)==true and count($vent)>0 && is_array($detalle_vent)==true and count($detalle_vent)>0){


        	   //si existe el cliente en ventas y detalle_ventas entonces no lo elimina
			$errors[]="El cliente existe en ventas y en detalle ventas, no se puede eliminar";


   	    }//fin

   	    else{
            
             //validamos si existe el registro en la bd
            $datos= $clientes->get_cliente_por_id($_POST["idCliente"]);

		       if(is_array($datos)==true and count($datos)>0){

		            $clientes->eliminar_cliente($_POST["idCliente"]);

		            $messages[]="El Cliente se eliminó exitosamente";

		       
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

	   //inicio de mensaje de error

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

	   //fin de mensaje de error
	
     break;

	 	
	 }
  

   ?>