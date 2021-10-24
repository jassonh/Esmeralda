<?php

	require_once "../config/conn.php";

	class Usuarios extends conn{

		public function get_filas_usuario(){

            $conn= parent::conexion();
            $sql="select * from usuarios";
            $sql=$conn->prepare($sql);
            $sql->execute();
            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

						return $sql->rowCount();
        }

		//Metodo para Iniciar Sesion
		public function login(){

			$conn=parent::conexion();
			parent::set_names();

			if(isset($_POST["enviar"])){
				//Validaciones de Usuario
				$userName = $_POST["userName"];
				//$password = $_POST["password"];
				$password = md5($_POST["password"]);
				$estadoUsuario = "0";

				if(empty($userName) and empty($password))
				{
					header("Location: ../vistas/index.php?m=2");
					exit();
				}

				else if(!preg_match("/^[a-z0-9]+$/", $password))
				{
					header("Location: ../vistas/index.php?m=1");
					exit();
				}
				else
				{
					$sql = "select * from usuarios where userName=? and password=? and estadoUsuario=?";

					$sql = $conn->prepare($sql);

					$sql->bindValue(1, $userName);
					$sql->bindValue(2, $password);
					$sql->bindValue(3, $estadoUsuario);
					$sql->execute();

					$resultado = $sql->fetch();
					//Si existe registro entonces se conecta a la session
					if(is_array($resultado) and count($resultado)>0){
							//La session guarda los valores de los campos de la tabla de la Base de Datos
							$_SESSION["idUsuario"] = $resultado["idUsuario"];
							$_SESSION["email"] = $resultado["email"];
							$_SESSION["userName"] = $resultado["userName"];
							$_SESSION["numDocumento"] = $resultado["numDocumento"];
							$_SESSION["nombreUsuario"] = $resultado["nombreUsuario"];
							$_SESSION["apellidoUsuario"] = $resultado["apellidoUsuario"];
							$_SESSION["usuario_imagen"] = $resultado["usuario_imagen"];


	//**************PERMISOS DEL USUARIO PARA ACCEDER A LOS MODULOS****************//

        require_once("Usuarios.php");
        $usuario = new Usuarios();

        $marcados = $usuario->listar_permisos_por_usuario($resultado["idUsuario"]);
        $valores=array();

          foreach($marcados as $row){
              $valores[]= $row["idPermiso"];
          }

      ////Determinamos los accesos del usuario
      in_array(1,$valores)?$_SESSION['categoria']=1:$_SESSION['categoria']=0;
      in_array(2,$valores)?$_SESSION['productos']=1:$_SESSION['productos']=0;
      in_array(3,$valores)?$_SESSION['proveedores']=1:$_SESSION['proveedores']=0;
      in_array(4,$valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
      in_array(5,$valores)?$_SESSION['clientes']=1:$_SESSION['clientes']=0;
      in_array(6,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
      in_array(7,$valores)?$_SESSION['reporte_compras']=1:$_SESSION['reporte_compras']=0;
      in_array(8,$valores)?$_SESSION['reporte_ventas']=1:$_SESSION['reporte_ventas']=0;
      in_array(9,$valores)?$_SESSION['usuarios']=1:$_SESSION['usuarios']=0;
      in_array(10,$valores)?$_SESSION['empresa']=1:$_SESSION['empresa']=0;

				header("Location: ../vistas/home.php");
							exit();
					}else{
							header("Location: ../vistas/index.php?m=1");
							exit();
					}
				}
			}
		}


		public function get_usuarios(){
			$conn=parent::conexion();
			parent::set_names();
			$sql="select * from usuarios";
			$sql=$conn->prepare($sql);
			$sql->execute();

			return $resultado=$sql->fetchAll();
		}


		//-----------------Metodo Registrar-------------------//
		public function registrarUsuarios($nombreUsuario,$apellidoUsuario,$tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $userName, $password,$password2,$imagen,$estadoUsuario,$permisos){

			$conn = parent::conexion();
			parent::set_names();

			require_once("Usuarios.php");


            $imagen_usuario = new Usuarios();


            $image = '';
            if($_FILES["usuario_imagen"]["name"] != '')
            {
              $image = $imagen_usuario->upload_image();
            }


            //Determino la consulta que se mandara a MYSQL
			$sql = "insert into usuarios values(null,?,?,?,?,?,?,?,?,?,?,?,now(),?,?);";
			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $_POST["nombreUsuario"]);
			$sql->bindValue(2, $_POST["apellidoUsuario"]);
			$sql->bindValue(3, $_POST["tipoDocumento"]);
			$sql->bindValue(4, $_POST["numDocumento"]);
			$sql->bindValue(5, $_POST["direccion"]);
			$sql->bindValue(6, $_POST["telefono"]);
			$sql->bindValue(7, $_POST["email"]);
			$sql->bindValue(8, $_POST["cargo"]);
			$sql->bindValue(9, $_POST["userName"]);
			$sql->bindValue(10, md5($_POST["password"]));
			$sql->bindValue(11, md5($_POST["password2"]));
			//$sql->bindValue(12, $_POST["imagen"]);
			$sql->bindValue(12, $image);
			$sql->bindValue(13, $_POST["estadoUsuario"]);
			$sql->execute();

			$idUsuario = $conn->lastInsertId();

			//array que almacena todos los checkbox marcados
			$permisos= $_POST["permiso"];

			$num_elementos=0;

			while($num_elementos<count($permisos)){
				$sql_detalle="insert into usuarios_permisos values(null,?,?)";

					$sql_detalle=$conn->prepare($sql_detalle);
					$sql_detalle->bindValue(1, $idUsuario);
					$sql_detalle->bindValue(2, $permisos[$num_elementos]);
					$sql_detalle->execute();

					$num_elementos=$num_elementos+1;
			}
		}

		//Mostrar datos de Usuarios segun ID
		public function get_usuario_por_id($idUsuario){

			$conn = parent::conexion();
			parent::set_names();
			$sql = "select * from usuarios where idUsuario=?";
			//echo $sql;
			$sql=$conn->prepare($sql);
			$sql->bindValue(1, $idUsuario);
			$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}

		//-----------------Metodo Editar---------------------//
		public function editarUsuario($nombreUsuario,$apellidoUsuario,$tipoDocumento,$numDocumento,$direccion,$telefono,$email,$cargo,$userName,$password,$password2,$imagen,$estadoUsuario, $idUsuario,$permisos){

			$conn = parent::conexion();
			parent::set_names();
			/*-----------------------------------------------------------------------
			-------SE LLAMA LA FUNCION upload_image PARA EDITAR LA IMAGEN -----------
			------------------------------------------------------------------------*/
			require_once("Usuarios.php");
		      $imagen_usuario = new Usuarios();
		      $imagen = '';
		      if($_FILES["usuario_imagen"]["name"] != '')
		        {
		          $imagen = $imagen_usuario->upload_image();
		        }
		      else
		        {
		          $imagen = $_POST["hidden_usuario_imagen"];
		        }


			$sql = "update usuarios set
				nombreUsuario=?,
				apellidoUsuario=?,
				tipoDocumento=?,
				numDocumento=?,
				direccion=?,
				telefono=?,
				email=?,
				cargo=?,
				userName=?,
				password=?,
				password2=?,
				imagen=?,
				estadoUsuario=?

				where
				idUsuario=?";

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $_POST["nombreUsuario"]);
			$sql->bindValue(2, $_POST["apellidoUsuario"]);
			$sql->bindValue(3, $_POST["tipoDocumento"]);
			$sql->bindValue(4, $_POST["numDocumento"]);
			$sql->bindValue(5, $_POST["direccion"]);
			$sql->bindValue(6, $_POST["telefono"]);
			$sql->bindValue(7, $_POST["email"]);
			$sql->bindValue(8, $_POST["cargo"]);
			$sql->bindValue(9, $_POST["userName"]);
			$sql->bindValue(10, $_POST["password"]);
			$sql->bindValue(11, $_POST["password2"]);
			//$sql->bindValue(12, $_POST["imagen"]);
			$sql->bindValue(12, $imagen);
			$sql->bindValue(13, $_POST["estadoUsuario"]);
			$sql->bindValue(14, $_POST["idUsuario"]);

			$sql->execute();

			//print_r($_FILES);

			//Elimina los permisos ya obtenidos
			$sql_delete="delete from usuarios_permisos where idUsuario=?";
			$sql_delete=$conn->prepare($sql_delete);
			$sql_delete->bindValue(1, $_POST["idUsuario"]);
			$sql_delete->execute();

			//array que almacena todos los checkbox marcados
			$permisos= $_POST["permiso"];

			$num_elementos=0;

			while($num_elementos<count($permisos)){
				$sql_detalle="insert into usuarios_permisos values(null,?,?)";

					$sql_detalle=$conn->prepare($sql_detalle);
					$sql_detalle->bindValue(1, $idUsuario);
					$sql_detalle->bindValue(2, $permisos[$num_elementos]);
					$sql_detalle->execute();

					$num_elementos=$num_elementos+1;
			}

		}


		//---------------Metodo editar---------------------//
		//-----cambiar estado activo e inactivo------------//

		public function editar_estado($idUsuario, $estadoUsuario){

			$conn = parent::conexion();
			parent::set_names();

			// el parametro est se envia por via ajax
			if($_POST["est"]=="0"){

				$estadoUsuario=1;

			}else{

				$estadoUsuario=0;

			}

			$sql = "update usuarios set estadoUsuario=? where idUsuario=?";
			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $estadoUsuario);
			$sql->bindValue(2, $idUsuario);
			$sql->execute();

		}

		//--------Metodo validar email, documento-------------//
		public function get_numDocumento_userName($numDocumento,$userName){

			$conn = parent::conexion();
			parent::set_names();

			$sql = "select * from usuarios where numDocumento=?
			or userName=?";

			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $numDocumento);
			$sql->bindValue(2, $userName);
			$sql->execute();

			$resultado = $sql->fetchAll();
			return $resultado;
		}

		// esta function alista los permisos (NO MARCADOS)
        public function permisos(){

            $conn=parent::conexion();

            $sql="select * from permisos;";

            $sql=$conn->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        //listamos los permisos asignados al usuario
        //tambien se usa para verificar para que modulos tiene acceso
        public function listar_permisos_por_usuario($idUsuario){

            $conn=parent::conexion();
            $sql="select * from usuarios_permisos where idUsuario=?";

            $sql=$conn->prepare($sql);
            $sql->bindValue(1, $idUsuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_permiso_por_id_usuario($idUsuario){

          $conn= parent::conexion();
           $sql="select * from usuarios_permisos where idUsuario=?";
           $sql=$conn->prepare($sql);

           $sql->bindValue(1, $idUsuario);
           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

      }

      //método para eliminar un registro
        public function eliminar_usuario($idUsuario){

           $conn=parent::conexion();
           $sql="delete from usuarios where idUsuario=?";
           $sql=$conn->prepare($sql);
           $sql->bindValue(1,$idUsuario);
           $sql->execute();

           return $resultado=$sql->fetch();
        }

	}
?>
