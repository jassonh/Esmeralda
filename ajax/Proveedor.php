<?php

  require_once '../config/conn.php';	

  require_once '../modelos/Proveedores.php';

  require_once '../modelos/Compras.php';

    $proveedores = new Proveedor();

   $idUsuario=isset($_POST["idUsuario"]);
   $nit=isset($_POST["nit"]);
   $nitProveedor=isset($_POST["nitProveedor"]);
   $nombreProveedor=isset($_POST["nombreProveedor"]);
   $contacto = isset($_POST["contacto"]);
   $telefonoContacto = isset($_POST["telefonoContacto"]);
   $telefonoProveedor=isset($_POST["telefonoProveedor"]);
   $correo=isset($_POST["correo"]);
   $direccion=isset($_POST["direccion"]);
   $estado=isset($_POST["estado"]);
   $idDepartamentoProveedor=isset($_POST["idDepartamentoProveedor"]);
   $idRegionProveedor=isset($_POST["idRegionProveedor"]);

    switch($_GET["op"]){

    	case "guardaryeditar":

      			$datos = $proveedores->get_datos_proveedor($_POST["nit"], $_POST["nombreProveedor"]);

    
    	        if(empty($_POST["nitProveedor"])){ // SI VA nitProveedor

	       	       	   if(is_array($datos)==true and count($datos)==0){
     	   	  
	 					$proveedores->registrar_proveedor($nombreProveedor, $contacto, $telefonoContacto, $nit, $telefonoProveedor, $correo, $direccion, $estado, $idDepartamentoProveedor, $idRegionProveedor, /*$FechaInicioProveedor,*/ $idUsuario);

			       	   	  $messages[]="El Proveedor se registró correctamente";
			       	   }

			       	 	else {
				             	$errors[]="El Proveedor ya existe";
				          	 }

			    } //Cierre del empty

	            else {

	    			$proveedores->editar_proveedor($nombreProveedor, $contacto, $telefonoContacto, $nit, $telefonoProveedor, $correo, $direccion, $estado, $idDepartamentoProveedor, $idRegionProveedor, /*$FechaInicioProveedor,*/ $idUsuario);

	            	$messages[]="El proveedor se editó correctamente";
		        }
    

		if(isset($messages)){
			?>
			<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Bien Hecho!</strong> 

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

    
			$datos=$proveedores->get_proveedor_por_nit($_POST["nitProveedor"]); //SI VA nitProveedor

            if(is_array($datos)==true and count($datos)>0){

    				foreach($datos as $row)
    				{
    					
						$output["nombreProveedor"] = $row["nombreProveedor"];
						$output["contacto"] = $row["contacto"];
						$output["telefonoContacto"] = $row["telefonoContacto"];
		/*nitProveedor*/$output["nit"] = $row["nitProveedor"]; 
						$output["telefonoProveedor"] = $row["telefonoProveedor"];
						$output["correo"] = $row["correo"];
						$output["direccion"] = $row["direccion"];
						$output["estado"] = $row["estado"];
						$output["idDepartamentoProveedor"] = $row["idDepartamentoProveedor"];
						$output["idRegionProveedor"] = $row["idRegionProveedor"];
						//$output["fechaInicioProveedor"] = $row["fechaInicioProveedor"];
    				}

                  echo json_encode($output);

	        } else {
                $errors[]="El proveedor no existe";

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
     
		$datos=$proveedores->get_proveedor_por_id($_POST["idProveedor"]);

          if(is_array($datos)==true and count($datos)>0){

            $proveedores->editar_estado($_POST["idProveedor"],$_POST["est"]);
	      } 

break;

    	case "listar":

     $datos=$proveedores->get_proveedores();
     $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();

				// Cambio de Estado
				$est = '';
				
				 $atrib = "btn btn-success btn-sm estado";
				if($row["estado"] == 0){
					$est = 'Activo';
					
				}
				else{
					if($row["estado"] == 1){
						$est = 'Inactivo';
						$atrib = "btn btn-secondary btn-sm estado";
						
					}	
				}

				//Regiones
				if($row["idRegionProveedor"]==1){
					$idRegionProveedor = "Metropolitana";
				} else {
					if($row["idRegionProveedor"]==2){
						$idRegionProveedor = "Norte";
					} else {
						if($row["idRegionProveedor"]==3){
							$idRegionProveedor = "Nororiente";
						} else {
							if($row["idRegionProveedor"]==4){
								$idRegionProveedor = "Suroriente";
							} else {
								if($row["idRegionProveedor"]==5){
									$idRegionProveedor = "Central";
								} else {
									if($row["idRegionProveedor"]==6){
										$idRegionProveedor = "Noroccidente";
									} else {
										if($row["idRegionProveedor"]==7){
											$idRegionProveedor = "Suroccidente";
										} else {
											if($row["idRegionProveedor"]==8){
												$idRegionProveedor = "Region Peten";
											}
										}
									}
								}
							}
						}
					}
				}

			//Departamentos
		if($row["idDepartamentoProveedor"]==1){
					$idDepartamentoProveedor = "Alta Verapaz";
				} else {
					if($row["idDepartamentoProveedor"]==2){
						$idDepartamentoProveedor = "Baja Verapaz";
					} else {
						if($row["idDepartamentoProveedor"]==3){
							$idDepartamentoProveedor = "Chimaltenango";
						} else {
							if($row["idDepartamentoProveedor"]==4){
								$idDepartamentoProveedor = "Chiquimula";
							} else {
								if($row["idDepartamentoProveedor"]==5){
									$idDepartamentoProveedor = "Petén";
								} else {
									if($row["idDepartamentoProveedor"]==6){
										$idDepartamentoProveedor = "El Progreso";
									} else {
										if($row["idDepartamentoProveedor"]==7){
											$idDepartamentoProveedor = "Quiché";
										} else {
											if($row["idDepartamentoProveedor"]==8){
												$idDepartamentoProveedor = "Escuintla";
											} else {
												if($row["idDepartamentoProveedor"]==9){
													$idDepartamentoProveedor = "Guatemala";
												} else {
													if($row["idDepartamentoProveedor"]==10){
														$idDepartamentoProveedor = "Huehuetenango";
													} else {
														if($row["idDepartamentoProveedor"]==11){
															$idDepartamentoProveedor = "Izabal";
														} else {
															if($row["idDepartamentoProveedor"]==12){
																$idDepartamentoProveedor = "Jalapa";
												 			} else {
																if($row["idDepartamentoProveedor"]==13){
																	$idDepartamentoProveedor = "Escuintla";
																} else {
																	if($row["idDepartamentoProveedor"]==14){
																		$idDepartamentoProveedor = "Jutiapa";
																	} else {
																		if($row["idDepartamentoProveedor"]==15){
																			$idDepartamentoProveedor = "Quetzaltenango";
																		} else {
																			if($row["idDepartamentoProveedor"]==16){
																				$idDepartamentoProveedor = "Retalhuleu";
																			} else {
																				if($row["idDepartamentoProveedor"]==17){
																					$idDepartamentoProveedor = "San Marcos";
																				} else {
																					if($row["idDepartamentoProveedor"]==18){
																						$idDepartamentoProveedor = "Santa Rosa";
																					} else {
																						if($row["idDepartamentoProveedor"]==19){
																							$idDepartamentoProveedor = "Sololá";
																						} else {
																							if($row["idDepartamentoProveedor"]==20){
																								$idDepartamentoProveedor = "Suchitepequez";
																							} else {
																								if($row["idDepartamentoProveedor"]==21){
																										$idDepartamentoProveedor = "Totonicapan";
																								} else {
																									if($row["idDepartamentoProveedor"]==22){
																										$idDepartamentoProveedor = "Zacapa";
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}							


				$sub_array[] = $row["nombreProveedor"];
				$sub_array[] = $row["contacto"];
			    $sub_array[] = $row["telefonoContacto"];
				$sub_array[] = $row["nitProveedor"];
				$sub_array[] = $row["telefonoProveedor"];
				$sub_array[] = $row["correo"];
				$sub_array[] = $row["direccion"];
						
                $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["idProveedor"].','.$row["estado"].');" name="estado" id="'.$row["idProveedor"].'" class="'.$atrib.'">'.$est.'</button>';

                $sub_array[] = $idDepartamentoProveedor;
				$sub_array[] = $idRegionProveedor;
				//$sub_array[] = date("d-m-Y", strtotime($row["fechaInicioProveedor"]));

                $sub_array[] = '<button type="button"  onClick="mostrar('.$row["nitProveedor"].');" id="'.$row["idProveedor"].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</button>';
                

                $sub_array[] = '<button type="button" onClick="eliminar('.$row["idProveedor"].');" id="'.$row["idProveedor"].'" class="btn btn-danger btn-sm"> <i class="fas fa-trash-alt"></i> Eliminar</button>';

				$data[] = $sub_array;
			}

      		$results = array(
 			"sEcho"=>1, 
 			"iTotalRecords"=>count($data), 
 			"iTotalDisplayRecords"=>count($data), 
 			"aaData"=>$data);
 			echo json_encode($results);


break;
     

		case "listar_en_compras":

     $datos=$proveedores->get_proveedores();

     $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';
				
				 $atrib = "btn btn-success btn-sm estado";
				if($row["estado"] == 0){
					$est = 'Activo';
					
				}
				else{
					if($row["estado"] == 1){
						$est = 'Inactivo';
						$atrib = "btn btn-secondary btn-sm estado";
						
					}	
				}
				
				//$sub_array = array();
	            $sub_array[] = $row["nitProveedor"];
				$sub_array[] = $row["nombreProveedor"];
				$sub_array[] = $row["direccion"];

                $sub_array[] = '<button type="button"  name="estado" id="'.$row["idProveedor"].'" class="'.$atrib.'">'.$est.'</button>';

                $sub_array[] = '<button type="button" onClick="agregar_registro('.$row["idProveedor"].','.$row["estado"].');" id="'.$row["idProveedor"].'" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


break;


		case "buscar_proveedor":

	$datos=$proveedores->get_proveedor_por_id_estado($_POST["idProveedor"],$_POST["est"]);

          // comprobamos que el proveedor esté activo, de lo contrario no lo agrega
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["nit"] = $row["nitProveedor"];
					$output["nombreProveedor"] = $row["nombreProveedor"];
					$output["direccion"] = $row["direccion"];
					$output["estado"] = $row["estado"];				
				}

	        } else {       
                 //si no existe el registro entonces no recorre el array
                 $output["error"]="El proveedor seleccionado está inactivo, intenta con otro";
	        }

	        echo json_encode($output);


     break;


    case "eliminar_proveedor":
         
	    $compras = new Compras();

        $comp= $compras->get_compras_por_id_proveedor($_POST["idProveedor"]);

        $detalle_comp= $compras->get_detalle_compras_por_id_proveedor($_POST["idProveedor"]);

        if(is_array($comp)==true and count($comp)>0 && is_array($detalle_comp)==true and count($detalle_comp)>0){

		    $errors[]="El proveedor existe en compras y/o en detalle compras, no se puede eliminar";
				
   	    }

   	  else{

            $datos= $proveedores->get_proveedor_por_id($_POST["idProveedor"]);

		       if(is_array($datos)==true and count($datos)>0){

		            $proveedores->eliminar_proveedor($_POST["idProveedor"]);

		            $messages[]="El Proveedor se eliminó exitosamente";
		       
		       }
		      
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