<?php
	require_once '../config/conn.php';

	require_once '../modelos/Empresa.php';

	 
	  $empresa= new Empresa();
	  
	  $idEmpresa=isset($_POST["idEmpresa"]);
	  $nombreEmpresa=isset($_POST["nombreEmpresa"]);
	  $nitEmpresa=isset($_POST["nitEmpresa"]);
	  $direccionEmpresa=isset($_POST["direccionEmpresa"]);
	  $telefonoEmpresa=isset($_POST["telefonoEmpresa"]);
	  $correoEmpresa=isset($_POST["correoEmpresa"]);
	  $horarioEmpresa=isset($_POST["horarioEmpresa"]);
	  $idUsuarioEmpresa=isset($_POST["idUsuarioEmpresa"]);
	    
	switch($_GET["op"]){

	case 'empresa':

	$datos=$empresa->get_empresa_por_id_usuario($_POST["idUsuarioEmpresa"]);

        if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["idEmpresa"] = $row["idEmpresa"];
					$output["nombreEmpresa"] = $row["nombreEmpresa"];
					$output["nitEmpresa"] = $row["nitEmpresa"];
					$output["direccionEmpresa"] = $row["direccionEmpresa"];
					$output["telefonoEmpresa"] = $row["telefonoEmpresa"];
					$output["correoEmpresa"] = $row["correoEmpresa"];
					$output["horarioEmpresa"] = $row["horarioEmpresa"];	
				}

	    } //Cierre del foreach

	echo json_encode($output);

	break;


    case 'editar_empresa':

    $datos= $empresa->get_datos_empresa($_POST["nitEmpresa"],$_POST["nombreEmpresa"],$_POST["correoEmpresa"]);

   	        if(is_array($datos)==true and count($datos)>0){

        		$empresa->editar_empresa($_POST["idEmpresa"],$_POST["nombreEmpresa"],$_POST["nitEmpresa"],$_POST["direccionEmpresa"],$_POST["telefonoEmpresa"],$_POST["correoEmpresa"],$_POST["horarioEmpresa"],$_POST["idUsuarioEmpresa"]);


            	$messages[]="La empresa se editó correctamente";

            }

            else {

            	 $errors[]="La empresa no existe";
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