<?php 

	require_once "../config/conn.php";

	class Proveedor extends conn{

      public function get_filas_proveedor(){

        $conn= parent::conexion();

        $sql="select * from proveedor";

        $sql=$conn->prepare($sql);
        $sql->execute();

        $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

        return $sql->rowCount();

      }

		public function get_proveedores(){

			$conn=parent::conexion();
			parent::set_names();

			$sql="select * from proveedor";

			$sql=$conn->prepare($sql);
			$sql->execute();

			return $resultado=$sql->fetchAll();
		}

		public function registrar_proveedor($nombreProveedor, $contacto, $telefonoContacto, $nit, $telefonoProveedor, $correo, $direccion, $estado, $idDepartamentoProveedor, $idRegionProveedor, /*$FechaInicioProveedor,*/ $idUsuario){

			$conn=parent::conexion();
			parent::set_names();

			$sql="insert into proveedor
			values(null,?,?,?,?,?,?,?,?,?,?,now(),?)";

			$sql=$conn->prepare($sql);

			      $sql->bindValue(1, $_POST["nombreProveedor"]);
            $sql->bindValue(2, $_POST["contacto"]);
            $sql->bindValue(3, $_POST["telefonoContacto"]);
            $sql->bindValue(4, $_POST["nit"]);
            $sql->bindValue(5, $_POST["telefonoProveedor"]);
            $sql->bindValue(6, $_POST["correo"]);
            $sql->bindValue(7, $_POST["direccion"]);
            $sql->bindValue(8, $_POST["estado"]);
            $sql->bindValue(9, $_POST["idDepartamentoProveedor"]);
            $sql->bindValue(10, $_POST["idRegionProveedor"]);
            $sql->bindValue(11, $_POST["idUsuario"]);
            $sql->execute();

		}

		public function get_proveedor_por_nit($nit){


            $conn= parent::conexion();
            parent::set_names();

            $sql="select * from proveedor where nitProveedor=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $nit);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function get_proveedor_por_id($idProveedor){


            $conn= parent::conexion();
            parent::set_names();

            $sql="select * from proveedor where idProveedor=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idProveedor);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); /*fetchAll() puede que vaya vacio*/
        }

        public function get_proveedor_por_id_estado($idProveedor,$estado){

        $conn= parent::conexion();

        $estado=0;


        $sql="select * from proveedor where idProveedor=? and estado=?";

              $sql=$conn->prepare($sql);

              $sql->bindValue(1, $idProveedor);
              $sql->bindValue(2, $estado);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

        }

        public function editar_proveedor($nombreProveedor, $contacto, $telefonoContacto, $nit, $telefonoProveedor, $correo, $direccion, $estado, $idDepartamentoProveedor, $idRegionProveedor, /*$FechaInicioProveedor,*/ $idUsuario){

        	$conn=parent::conexion();
        	parent::set_names();

        	$sql="update proveedor set

             nombreProveedor=?,
             contacto=?,
             telefonoContacto=?,
             nitProveedor=?,
             telefonoProveedor=?,
             correo=?,
             direccion=?,
             estado=?,
             idDepartamentoProveedor=?,
             idRegionProveedor=?,
             idUsuarioProveedor=?

             where
             nitProveedor=?

        	";

        	$sql=$conn->prepare($sql);

		    $sql->bindValue(1, $_POST["nombreProveedor"]);
            $sql->bindValue(2, $_POST["contacto"]);
            $sql->bindValue(3, $_POST["telefonoContacto"]);
            $sql->bindValue(4, $_POST["nit"]);
            $sql->bindValue(5, $_POST["telefonoProveedor"]);
            $sql->bindValue(6, $_POST["correo"]);
            $sql->bindValue(7, $_POST["direccion"]);
            $sql->bindValue(8, $_POST["estado"]);
            $sql->bindValue(9, $_POST["idDepartamentoProveedor"]);
            $sql->bindValue(10, $_POST["idRegionProveedor"]);
            $sql->bindValue(11, $_POST["idUsuario"]);
            $sql->bindValue(12, $_POST["nitProveedor"]);
            $sql->execute();

        }

        public function get_datos_proveedor($nit, $nombreProveedor){

           $conn=parent::conexion();

           $sql= "select * from proveedor where nitProveedor=? or nombreProveedor=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $nit);
            $sql->bindValue(2, $nombreProveedor);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


        public function editar_estado($idProveedor,$estado){

        	 $conn=parent::conexion();

        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update proveedor set

              estado=?
              where
              idProveedor=?

        	 ";

        	 $sql=$conn->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$idProveedor);
        	 $sql->execute();
        }


        public function eliminar_proveedor($idProveedor){

              $conn=parent::conexion();

              $sql="delete from proveedor where idProveedor=?";

              $sql=$conn->prepare($sql);

              $sql->bindValue(1, $idProveedor);
              $sql->execute();

              return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
      }

      public function get_proveedor_por_id_usuario($idUsuario){

           $conn= parent::conexion();

           $sql="select * from proveedor where idUsuarioProveedor=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idUsuario);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

      }


	}

 ?>
