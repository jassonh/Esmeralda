<?php

	require_once '../config/conn.php';

	require_once '../modelos/Compras.php';

	$compras = new Compras();

	switch($_GET["op"]){

		case "ver_detalle_proveedor_compra":


   		$datos= $compras->get_detalle_proveedor($_POST["numero_compra"]);	

	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					
					$output["proveedor"] = $row["proveedor"];
					$output["numero_compra"] = $row["numero_compra"];
					$output["nitProveedor"] = $row["nitProveedor"];
					$output["direccion"] = $row["direccion"];
					$output["fechaCompra"] = date("d-m-Y", strtotime($row["fechaCompra"]));
									
				}
		      
		          echo json_encode($output);


	        } else {
                 
                $errors[]="no existe";

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

  		case "ver_detalle_compra":

  	   		$datos= $compras->get_detalle_compras_proveedor($_POST["numero_compra"]);	

  	 	break;

		case "buscar_compras":

		     $datos=$compras->get_compras();

		 	 $data= Array();

		     foreach($datos as $row)
					{
						$sub_array = array();

						//Estado Compra
						$est = '';

						$atrib = "btn btn-success btn-sm estado";
						if($row["estado"] == 0){

	 						$est = 'Pagado';
						
						}else{
							if($row["estado"] == 1){
								$est = 'Anulado';

								$atrib = "btn btn-secondary btn-sm estado";
							}
						}

						//Pago
						if($row["idTipoPago"]==1){
							$pago = "Efectivo";
						} else {
							if($row["idTipoPago"]==2){
								$pago = "Cheque";
							}
						}


			            $sub_array[] = date("d-m-Y", strtotime($row["fechaCompra"]));
						$sub_array[] = $row["numero_compra"];
						$sub_array[] = $row["proveedor"];
						$sub_array[] = $row["nitProveedor"];
						$sub_array[] = $row["Contacto"];
						$sub_array[] = $pago;
						$sub_array[] = $row["tipoProducto"];
						$sub_array[] = $row["moneda"]." ".$row["totalCompra"];

						
		           /*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
		                $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idCompra"].',\''.$row["numero_compra"].'\','.$row["estado"].');" name="estado" id="'.$row["idCompra"].'" class="'.$atrib.'">'.$est.'</button>';

		                $sub_array[] = '<button class="btn btn-primary btn-sm detalle"  id="'.$row["numero_compra"].'"  data-toggle="modal" data-target="#detalle_compra"><i class="fa fa-eye"></i> Ver </button>';
		                
						$data[] = $sub_array;
					}

		      	$results = array(
		 			"sEcho"=>1, //Información para el datatables
		 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		 			"aaData"=>$data);

		 		echo json_encode($results);

     	break;


     	case "cambiar_estado_compra":	

          $datos=$compras->get_compras_por_id($_POST["idCompra"]);

	      if(is_array($datos)==true and count($datos)>0){

                  //cambia el estado de la compra
				  $compras->cambiar_estado($_POST["idCompra"], $_POST["numero_compra"], $_POST["est"]);
		     
	        } 

     	break;


     	case "buscar_compras_fecha":
          
		     $datos=$compras->lista_busca_registros_fecha($_POST["fechaInicial"], $_POST["fechaFinal"]);

		     //Vamos a declarar un array
		 	 $data= Array();

		     foreach($datos as $row)
					{
						$sub_array = array();

					//Estado
					$est = '';

					$atrib = "btn btn-success btn-sm estado";
					if($row["estado"] == 0){

						$est = 'Pagado';
						
					}else{
						if($row["estado"] == 1){
							$est = 'Anulado';
							$atrib = "btn btn-secondary btn-sm estado";
						}
					}

					//Pago
						if($row["idTipoPago"]==1){
							$pago = "Efectivo";
						} else {
							if($row["idTipoPago"]==2){
								$pago = "Cheque";
							}
						}
		               
			       $sub_array[] = date("d-m-Y", strtotime($row["fechaCompra"]));

					$sub_array[] = $row["numero_compra"];
					$sub_array[] = $row["proveedor"];
					$sub_array[] = $row["nitProveedor"];
					$sub_array[] = $row["Contacto"];
					$sub_array[] = $pago;
					$sub_array[] = $row["tipoProducto"];
					$sub_array[] = $row["moneda"]." ".$row["totalCompra"];

						
		           /*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
		            $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idCompra"].',\''.$row["numero_compra"].'\','.$row["estado"].');" name="estado" id="'.$row["idCompra"].'" class="'.$atrib.'">'.$est.'</button>';

		            $sub_array[] = '<button class="btn btn-primary btn-sm detalle" id="'.$row["numero_compra"].'"  data-toggle="modal" data-target="#detalle_compra"><i class="fa fa-eye"></i> Ver </button>';
		                
						$data[] = $sub_array;
					}


		      	$results = array(
		 			"sEcho"=>1, //Información para el datatables
		 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		 			"aaData"=>$data);

		 		echo json_encode($results);

     	break;


     	case "buscar_compras_fecha_mes":

	    $datos= $compras->lista_busca_registros_fecha_mes($_POST["mes"],$_POST["ano"]);

	 	$data= Array();

	    foreach($datos as $row)
				{
					$sub_array = array();

					//Estado
					$est = '';

					$atrib = "btn btn-success btn-sm estado";
					if($row["estado"] == 0){

						$est = 'Pagado';
						
					}else{
						if($row["estado"] == 1){
							$est = 'Anulado';
							$atrib = "btn btn-secondary btn-sm estado";
						}
					}

					//Pago
						if($row["idTipoPago"]==1){
							$pago = "Efectivo";
						} else {
							if($row["idTipoPago"]==2){
								$pago = "Cheque";
							}
						}

		      
	         		$sub_array[] = date("d-m-Y", strtotime($row["fechaCompra"]));

					$sub_array[] = $row["numero_compra"];
					$sub_array[] = $row["proveedor"];
					$sub_array[] = $row["nitProveedor"];
					$sub_array[] = $row["Contacto"];
					$sub_array[] = $pago;
					$sub_array[] = $row["tipoProducto"];
					$sub_array[] = $row["moneda"]." ".$row["totalCompra"];

					
	                $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idCompra"].',\''.$row["numero_compra"].'\','.$row["estado"].');" name="estado" id="'.$row["idCompra"].'" class="'.$atrib.'">'.$est.'</button>';

	                $sub_array[] = '<button class="btn btn-primary btn-sm detalle" id="'.$row["numero_compra"].'"  data-toggle="modal" data-target="#detalle_compra"><i class="fa fa-eye"></i> Ver </button>';
	                
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

?>