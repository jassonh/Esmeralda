<?php 

	require_once '../config/conn.php';

	Class Perfil extends conn{

		/*-----------------------Metodo para subir la imagen---------------------*/
		/*public function upload_image() {

            if(isset($_FILES["producto_imagen"]))
            {
              $extension = explode('.', $_FILES['producto_imagen']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../vistas/upload/' . $new_name;
              move_uploaded_file($_FILES['producto_imagen']['tmp_name'], $destination);
              return $new_name;
            }

        }*/

		//Mostrar datos de Usuarios segun ID
		public function get_usuario_por_id($idUsuario_perfil){

			$conn = parent::conexion();
			parent::set_names();

			$sql = "select * from usuarios where idUsuario=?";
			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $idUsuario_perfil);
			$sql->execute();

			return $resultado=$sql->fetchAll();
		}

		public function get_numDocumento_userName($numDocumento_perfil,$userName_perfil){

			$conn = parent::conexion();
			parent::set_names();

			$sql = "select * from usuarios where numDocumento=?
			or userName=?";

			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $numDocumento_perfil);
			$sql->bindValue(2, $userName_perfil);
			$sql->execute();

			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
		}


		public function editar_perfil($idUsuario_perfil, $nombre_perfil, $apellido_perfil, $tipoDocumento_perfil, $numDocumento_perfil, $direccion_perfil, $telefono_perfil, $email_perfil, $userName_perfil, $password_perfil, $password2_perfil, $imagen_perfil){

			$conn = parent::conexion();
			parent::set_names();

			  /*require_once("Perfil.php");
		      $imagen_producto = new Perfil();

		      $imagen = '';

		      if($_FILES["producto_imagen"]["name"] != '')
		        {
		          $imagen_perfil = $imagen_producto->upload_image();
		        }
		      else
		        {

		          $imagen_perfil= $_POST["hidden_producto_imagen"];
		        }*/

			$sql = "update usuarios set
				nombreUsuario=?,
				apellidoUsuario=?,
				tipoDocumento=?,
				numDocumento=?,
				direccion=?,
				telefono=?,
				email=?,
				userName=?,
				password=?,
				password2=?,
				imagen=?

				where
				idUsuario=?";

				//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $_POST["nombre_perfil"]);
			$sql->bindValue(2, $_POST["apellido_perfil"]);
			$sql->bindValue(3, $_POST["tipoDocumento_perfil"]);
			$sql->bindValue(4, $_POST["numDocumento_perfil"]);
			$sql->bindValue(5, $_POST["direccion_perfil"]);
			$sql->bindValue(6, $_POST["telefono_perfil"]);
			$sql->bindValue(7, $_POST["email_perfil"]);
			$sql->bindValue(8, $_POST["userName_perfil"]);
			$sql->bindValue(9, $_POST["password_perfil"]);
			$sql->bindValue(10, $_POST["password2_perfil"]);
			//$sql->bindValue(11, $imagen_perfil);
			$sql->bindValue(11, $_POST["imagen_perfil"]);
			$sql->bindValue(12, $_POST["idUsuario_perfil"]);
			$sql->execute();

		}

	}

?>
