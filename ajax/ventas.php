 <?php
  
  //llamo a la conexion de la base de datos 
  require_once("../config/conn.php");

  //llamo al modelo de venta
  require_once'../modelos/Ventas.php';

  $ventas = new Ventas(); 
 
 

  switch($_GET["op"]){

 case "buscar_ventas":

     $datos=$ventas->get_ventas();

     //Se declara un array
 	 $data= Array();

     	foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';
				//$atrib = 'activo';
				if($row["estadoVenta"] == 0){
					$est = 'PAGADO';
					$atrib = "btn btn-success btn-md estadoVenta";
				}
				else{
					if($row["estadoVenta"] == 1){
						$est = 'ANULADO';
						$atrib = "btn btn-danger btn-md estadoVenta";
						//$atrib = '';
					}	
				}


				if($row["idTipoPago"] == 1){
					$tipopago = 'Efectivo';
				}
				else{
					if($row["idTipoPago"] == 2){
						$tipopago = 'Cheque';
					}	
				}

				 
	             $sub_array[] = date("d-m-Y",strtotime($row["fechaVenta"]));
				 $sub_array[] = $row["numero_venta"];
				 $sub_array[] = $row["nombreCliente"];
				 $sub_array[] = $row["nitCliente"];
				 $sub_array[] = $row["Vendedor"];
				 $sub_array[] = $tipopago;
				 $sub_array[] = $row["tipoProducto"];
				 $sub_array[] = $row["moneda"]." ".$row["total"];

           /*poner \' cuando no sea numero, sino no imprime*/
                 $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idVentas"].',\''.$row["numero_venta"].'\','.$row["estadoVenta"].');" name="estadoVenta" id="'.$row["idVentas"].'" class="'.$atrib.'">'.$est.'</button>';

                  $sub_array[] = '<button class="btn btn-warning detalle" id="'.$row["numero_venta"].'"  data-toggle="modal" data-target="#detalle_venta"><i class="fa fa-eye"></i></button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //envio del total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //envio del total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break; 

     case "ver_detalle_cliente_venta":

   $datos= $ventas->get_detalle_cliente($_POST["numero_venta"]);	

            // si existe el proveedor entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					
					$output["nombreCliente"] = $row["nombreCliente"];
					$output["numero_venta"] = $row["numero_venta"];
					$output["nit"] = $row["nit"];
					$output["direccionCliente"] = $row["direccionCliente"];
					$output["fechaVenta"] = date("d-m-Y", strtotime($row["fechaVenta"]));
									
				}
	
		          echo json_encode($output);

	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                $errors[]="no existe";

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

  	 case "ver_detalle_venta":

  	   $datos= $ventas->get_detalle_ventas_cliente($_POST["numero_venta"]);	

  	 break;

 case "consulta_cantidad_venta":

         //selecciona el id del registro

    require_once("../modelos/Productos.php");

	$producto= new Producto();

	$datos=$producto->get_producto_por_id($_POST["idProductos"]);

          // si existe el id del producto entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					
					$stock = $s["stock"] = $row["stock"];

					$result = null;

					$stock_vender=$_POST["cantidad_vender"];

					if($stock_vender>$stock and $stock_vender!=0){

                       $result="<h4 class='text-danger'>La cantidad seleccionada es mayor al stock</h4>";
					
					}  

					else {

						if($stock_vender==0){

						$result="<h4 class='text-danger'>El campo está vacío</h4>";

						 }

				      }
					
					}//cierre del foreach
		
		          echo json_encode($result);

	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                $errors[]="El producto no existe";

	        }

	         //mensaje de error

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

      case "cambiar_estado_venta":

          $datos=$ventas->get_ventas_por_id($_POST["idVentas"]);

          // si existe el id de la venta entonces se edita el estado del detalle de la venta
	      if(is_array($datos)==true and count($datos)>0){

                  //cambia el estado de la compra
				  $ventas->cambiar_estado($_POST["idVentas"], $_POST["numero_venta"], $_POST["est"]); 
	        }

     break;

     case "buscar_ventas_fecha":
          
     $datos=$ventas->lista_busca_registros_fecha($_POST["fecha_inicial"], $_POST["fecha_final"]);

     //Vamos a declarar un array
 	 $data= Array();

    foreach($datos as $row)
      {
        $sub_array = array();

        $est = '';
        
        if($row["estadoVenta"] == 0){
          $est = 'PAGADO';
          $atrib = "btn btn-success btn-md estado";
        }
        else{
          if($row["estadoVenta"] == 1){
            $est = 'ANULADO';
            $atrib = "btn btn-danger btn-md estado";           
          } 
        }

						if($row["idTipoPago"]==1){
							$tipopago = "Efectivo";
						} else {
							if($row["idTipoPago"]==2){
								$tipopago = "Cheque";
							}
						}

        
         		 $sub_array[] = date("d-m-Y",strtotime($row["fechaVenta"]));
				 $sub_array[] = $row["numero_venta"];
				 $sub_array[] = $row["nombreCliente"];
				 $sub_array[] = $row["nitCliente"];
				 $sub_array[] = $row["Vendedor"];
				 $sub_array[] = $tipopago;
				 $sub_array[] = $row["tipoProducto"];
				 $sub_array[] = $row["moneda"]." ".$row["total"];

           /*poner \' cuando no sea numero, sino no imprime*/
                 $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idVentas"].',\''.$row["numero_venta"].'\','.$row["estadoVenta"].');" name="estadoVenta" id="'.$row["idVentas"].'" class="'.$atrib.'">'.$est.'</button>';

                  $sub_array[] = '<button class="btn btn-warning detalle" id="'.$row["numero_venta"].'"  data-toggle="modal" data-target="#detalle_venta"><i class="fa fa-eye"></i></button>';
                
        $data[] = $sub_array;
      }

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

     break;

     case "buscar_ventas_fecha_mes":
      
      $datos= $ventas->lista_busca_registros_fecha_mes($_POST["mes"],$_POST["ano"]);

        //Vamos a declarar un array
 	    $data= Array();

	      foreach($datos as $row)
	      {
		        $sub_array = array();

		        $est = '';
		        
		        if($row["estadoVenta"] == 0){
		          $est = 'PAGADO';
		          $atrib = "btn btn-success btn-md estado";
		        }
		        else{
		          if($row["estadoVenta"] == 1){
		            $est = 'ANULADO';
		            $atrib = "btn btn-danger btn-md estado";		           
		          } 
	        }

      					if($row["idTipoPago"]==1){
							$tipopago = "Efectivo";
						} else {
							if($row["idTipoPago"]==2){
								$tipopago = "Cheque";
							}
						}

        
         		 $sub_array[] = date("d-m-Y",strtotime($row["fechaVenta"]));
				 $sub_array[] = $row["numero_venta"];
				 $sub_array[] = $row["nombreCliente"];
				 $sub_array[] = $row["nitCliente"];
				 $sub_array[] = $row["Vendedor"];
				 $sub_array[] = $tipopago;
				 $sub_array[] = $row["tipoProducto"];
				 $sub_array[] = $row["moneda"]." ".$row["total"];

           /*poner \' cuando no sea numero, sino no imprime*/
                 $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idVentas"].',\''.$row["numero_venta"].'\','.$row["estadoVenta"].');" name="estadoVenta" id="'.$row["idVentas"].'" class="'.$atrib.'">'.$est.'</button>';

                  $sub_array[] = '<button class="btn btn-warning detalle" id="'.$row["numero_venta"].'"  data-toggle="modal" data-target="#detalle_venta"><i class="fa fa-eye"></i></button>';
                
        $data[] = $sub_array;
        
        }


      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;

}
