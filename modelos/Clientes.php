<?php
	   require_once("../config/conn.php");

	   class Cliente extends conn{

        public function get_filas_cliente(){
            $conn= parent::conexion();
            $sql="select * from cliente";
            $sql=$conn->prepare($sql);
            $sql->execute();
            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
        }

       //método para seleccionar registros
   	   public function get_clientes(){

   	   	  $conn=parent::conexion();
   	   	  parent::set_names();
   	   	  $sql="select * from cliente";
   	   	  $sql=$conn->prepare($sql);
   	   	  $sql->execute();
   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }


   	     //método para insertar registros

        public function registrar_cliente($nit,$nombreCliente,$apellidoCliente,$telefonoCliente,$direccionCliente,$correoCliente,$estadoCliente,$idUsuarioCliente){

           $conn= parent::conexion();
           parent::set_names();
           $sql="insert into cliente
           values(null,?,?,?,?,?,?,now(),?,?);";

           //echo $sql;
            $sql=$conn->prepare($sql);
            $sql->bindValue(1, $_POST["nit"]);
            $sql->bindValue(2, $_POST["nombreCliente"]);
            $sql->bindValue(3, $_POST["apellidoCliente"]);
            $sql->bindValue(4, $_POST["telefonoCliente"]);
            $sql->bindValue(5, $_POST["direccionCliente"]);
            $sql->bindValue(6, $_POST["correoCliente"]);
            $sql->bindValue(7, $_POST["estadoCliente"]);
            $sql->bindValue(8, $_POST["idUsuarioCliente"]);
            $sql->execute();
        }


        //método para mostrar los datos de un registro a modificar
        public function get_cliente_por_nit($nit){


            $conn= parent::conexion();
            parent::set_names();
            $sql="select * from cliente where nit=?";
            $sql=$conn->prepare($sql);
            $sql->bindValue(1, $nit);
            $sql->execute();

					  return $resultado=$sql->fetchAll();
        }


        public function get_cliente_por_id($idCliente){

          $conn= parent::conexion();
          $sql="select * from cliente where idCliente=?";
          $sql=$conn->prepare($sql);
          $sql->bindValue(1, $idCliente);
          $sql->execute();

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

         //método para editar un registro

        public function editar_cliente($nitCliente,$nombreCliente,$apellidoCliente,$telefonoCliente,$direccionCliente,$correoCliente,$estadoCliente,$idUsuarioCliente){

        	$conn=parent::conexion();
        	parent::set_names();

        	$sql="update cliente set
             nit=?,
             nombreCliente=?,
             apellidoCliente=?,
             telefonoCliente=?,
             direccionCliente=?,
             correoCliente=?,
             estadoCliente=?,
             idUsuarioCliente=?
             where
             nit=?
        	";


        	  $sql=$conn->prepare($sql);
		        $sql->bindValue(1, $_POST["nitCliente"]);
            $sql->bindValue(2, $_POST["nombreCliente"]);
            $sql->bindValue(3, $_POST["apellidoCliente"]);
            $sql->bindValue(4, $_POST["telefonoCliente"]);
            $sql->bindValue(5, $_POST["direccionCliente"]);
            $sql->bindValue(6, $_POST["correoCliente"]);
            $sql->bindValue(7, $_POST["estadoCliente"]);
            $sql->bindValue(8, $_POST["idUsuarioCliente"]);
            $sql->bindValue(9, $_POST["nit"]);
            $sql->execute();
        }



        /*metodo que valida si hay registros activos*/
        public function get_cliente_por_id_estado($idCliente,$estadoCliente){

          $conn= parent::conexion();
          //declaramos que el estado esté activo, igual a 0
          $estadoCliente=0;
          $sql="select * from cliente where idCliente=? and estadoCliente=?";

        	$sql=$conn->prepare($sql);
          $sql->bindValue(1, $idCliente);
          $sql->bindValue(2, $estadoCliente);
          $sql->execute();
          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
         }


          //método para activar y desactivar el estado del cliente

        public function editar_estado($idCliente,$estadoCliente){

        	 $conn=parent::conexion();
        	 if($_POST["est"]=="0"){
        	   $estadoCliente=1;
        	 } else {
        	 	 $estadoCliente=0;
        	 }
        	 $sql="update cliente set
              estadoCliente=?
              where
              idCliente=?
        	 ";

        	 $sql=$conn->prepare($sql);
        	 $sql->bindValue(1,$estadoCliente);
        	 $sql->bindValue(2,$idCliente);
        	 $sql->execute();
        }

        public function get_datos_cliente($nit,$nombreCliente){

          $conn=parent::conexion();
          $sql= "select * from cliente where nit=? or nombreCliente=?";
	        $sql=$conn->prepare($sql);
	        $sql->bindValue(1, $nit);
	        $sql->bindValue(2, $nombreCliente);
	        $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


        public function eliminar_cliente($idCliente){

                $conn=parent::conexion();
                $sql="delete from cliente where idCliente=?";
                $sql=$conn->prepare($sql);
                $sql->bindValue(1, $idCliente);
                $sql->execute();
                return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
				
        public function get_cliente_por_id_usuario($idUsuario){
          $conn= parent::conexion();
          $sql="select * from cliente where idUsuarioCliente=?";
					$sql=$conn->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();
          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
      }

  }


?>
