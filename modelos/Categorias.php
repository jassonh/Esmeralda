<?php 

	require_once '../config/conn.php';

	class Categoria extends conn{

		public function get_filas_categoria(){

			$conn= parent::conexion();

        	$sql="select * from categoria";

        	$sql=$conn->prepare($sql);
        	$sql->execute();

        	$resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

        	return $sql->rowCount();

      	}

		//Obtener todos los datos de la tabla Categoria
		public function get_categorias(){

			$conn=parent::conexion();
			parent::set_names();

			$sql="select * from categoria";
			//echo $sql;

			$sql=$conn->prepare($sql);
			$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		}

		//Mostrar datos de Categoria segun ID
		public function get_categoria_por_id($idCategoria){

			$conn = parent::conexion();
			parent::set_names();

			$sql = "select * from categoria where idCategoria=?";
			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $idCategoria);
			$sql->execute();

			return $resultado=$sql->fetchAll();
		}

		//Se hace el registro de la categoria
		public function registrar_categoria($nombreCategoria, $descripcion, $estadoCategoria, $idUsuarioCategoria){

			$conn = parent::conexion();
			parent::set_names();

			$sql = "insert into categoria values(null,?,?,?,?);";
			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $_POST["nombreCategoria"]);
			$sql->bindValue(2, $_POST["descripcion"]);
			$sql->bindValue(3, $_POST["estadoCategoria"]);
			$sql->bindValue(4, $_POST["idUsuarioCategoria"]);
			$sql->execute();

			//print_r($_POST);
		}


		public function editar_categoria($idCategoria, $nombreCategoria, $descripcion, $estadoCategoria, $idUsuarioCategoria){

			$conn = parent::conexion();
			parent::set_names();


			$sql = "update categoria set

			nombreCategoria=?,
			descripcion=?,
			estadoCategoria=?,
			idUsuarioCategoria=?

			where
			idCategoria=?

			";

			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $_POST["nombreCategoria"]);
			$sql->bindValue(2, $_POST["descripcion"]);
			$sql->bindValue(3, $_POST["estadoCategoria"]);
			$sql->bindValue(4, $_POST["idUsuarioCategoria"]);
			$sql->bindValue(5, $_POST["idCategoria"]);
			$sql->execute();

			//print_r($_POST);

		}


		// activamos y desactivamos el estado de la categoria
		public function editar_estado($idCategoria, $estadoCategoria){

			$conn = parent::conexion();
			//parent::set_names();

			// el parametro est se envia por via ajax
			if($_POST["est"]=="0"){

				$estadoCategoria=1;

			}else{

				$estadoCategoria=0;

			}

			$sql = "update categoria set estadoCategoria=? where idCategoria=?";
			//echo $sql;

			$sql=$conn->prepare($sql);

			$sql->bindValue(1, $estadoCategoria);
			$sql->bindValue(2, $idCategoria);
			$sql->execute();

		}


		//Metodo si la categoria existe en la base de datos
		public function get_nombre_categoria($nombreCategoria){


		$conn = parent::conexion();
		parent::set_names();

		$sql ="select * from categoria where nombreCategoria=?";
		// echo $sql; exit();

		$sql=$conn->prepare($sql);

			$sql->bindValue(1, $nombreCategoria);
			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;

		}


			public function eliminar_categoria($idCategoria){

           $conn=parent::conexion();


           $sql="delete from categoria where idCategoria=?";

           $sql=$conn->prepare($sql);
           $sql->bindValue(1,$idCategoria);
           $sql->execute();

           return $resultado=$sql->fetch();
        }


        //Verifica si existe el id del usuario para eliminarlo
        public function get_categoria_por_id_usuario($idUsuario){

          $conn= parent::conexion();

          $sql="select * from categoria where idUsuarioCategoria=?";

          $sql=$conn->prepare($sql);

          $sql->bindValue(1, $idUsuario);
          $sql->execute();

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
      }

	}

?>
