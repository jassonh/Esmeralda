<?php

  require_once "../config/conn.php";

   class Empresa extends conn{

    public function get_empresa(){

      	 $conn=parent::conexion();
      	 parent::set_names();

      	 $sql="select * from empresa";

      	 $sql=$conn->prepare($sql);

      	 $sql->execute();
      	 return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function get_empresa_por_id_usuario($idUsuarioEmpresa){

      $conn= parent::conexion();

      $sql="select * from empresa where idUsuarioEmpresa=?";

      $sql=$conn->prepare($sql);

      $sql->bindValue(1, $idUsuarioEmpresa);
      $sql->execute();

      return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function get_datos_empresa($nitEmpresa,$nombreEmpresa, $correoEmpresa){

            $conn=parent::conexion();

            $sql= "select * from empresa where nitEmpresa=? or nombreEmpresa=? or correoEmpresa=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $nitEmpresa);
            $sql->bindValue(2, $nombreEmpresa);
            $sql->bindValue(3, $correoEmpresa);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function editar_empresa($idEmpresa,$nombreEmpresa,$nitEmpresa,$direccionEmpresa,$telefonoEmpresa,$correoEmpresa,$horarioEmpresa,$idUsuarioEmpresa){

          $conn=parent::conexion();


          $sql="update empresa set

                 idEmpresa=?,
                 nombreEmpresa=?,
                 nitEmpresa=?,
                 direccionEmpresa=?,
                 telefonoEmpresa=?,
                 correoEmpresa=?,
                 horarioEmpresa=?

                 where
                 idUsuarioEmpresa=?
          ";

          $sql=$conn->prepare($sql);

          $sql->bindValue(1,$_POST["idEmpresa"]);
          $sql->bindValue(2,$_POST["nombreEmpresa"]);
          $sql->bindValue(3,$_POST["nitEmpresa"]);
          $sql->bindValue(4,$_POST["direccionEmpresa"]);
          $sql->bindValue(5,$_POST["telefonoEmpresa"]);
          $sql->bindValue(6,$_POST["correoEmpresa"]);
          $sql->bindValue(7,$_POST["horarioEmpresa"]);
          $sql->bindValue(8,$_POST["idUsuarioEmpresa"]);
          $sql->execute();

          $resultado=$sql->fetch(PDO::FETCH_ASSOC);


        }


   }

?>
