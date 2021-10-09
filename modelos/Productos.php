<?php

	require_once '../config/conn.php';

	class Producto extends conn{

	//método para seleccionar registros


      public function get_filas_producto(){

      $conn= parent::conexion();

          $sql="select * from productos";

          $sql=$conn->prepare($sql);
          $sql->execute();

          $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

          return $sql->rowCount();

        }


      public function get_productos(){

          $conn=parent::conexion();
          parent::set_names();

          $sql= "select p.idProductos, p.idCategoria, p.producto, p.presentacion, p.UnidadMedida, p.productoSimilar, p.moneda, p.precioCompra, p.precioVenta, p.stock, p.tipoProducto, p.estadoProducto, p.imagen, p.fechaExpiracion, p.idProveedor, ca.nombreCategoria, pro.nombreProveedor from productos p inner join categoria ca on ca.idCategoria = p.idCategoria inner join proveedor pro on pro.idProveedor = p.idProveedor

           ";

           $sql=$conn->prepare($sql);
           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

         }


          //método para seleccionar registros

      public function get_productos_en_ventas(){

           $conn= parent::conexion();

          $sql= "select p.idProductos, p.idCategoria, c.nombreCategoria as nombreCategoria, p.producto, p.presentacion, p.UnidadMedida, p.moneda, p.precioCompra, p.precioVenta, p.stock, p.tipoProducto, p.estadoProducto, p.imagen, p.fechaExpiracion as fechaExpiracion, c.idCategoria from productos p INNER JOIN categoria c ON p.idCategoria=c.idCategoria where p.stock >= 0 and p.estadoProducto='0' ";
           $sql=$conn->prepare($sql);
           $sql->execute();
           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


         }


            /*poner la ruta vistas/upload*/
        public function upload_image() {

            if(isset($_FILES["producto_imagen"]))
            {
              $extension = explode('.', $_FILES['producto_imagen']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../vistas/upload/' . $new_name;
              move_uploaded_file($_FILES['producto_imagen']['tmp_name'], $destination);
              return $new_name;
            }


          }



        //método para insertar registros
        public function registrar_producto($idCategoria,$producto,$presentacion,$UnidadMedida,$productoSimilar,$moneda,$precioCompra,$precioVenta,$stock,$tipoProducto, $estadoProducto,$imagen,$idProveedor,$idUsuario){

            $conn=parent::conexion();
            parent::set_names();

               /* $stock = "";

               if($stock==""){

                $stocker=0;

               } else {

                  $stocker = $_POST["stock"];
               } */


            require_once("Productos.php");


            $imagen_producto = new Producto();


            $image = '';
            if($_FILES["producto_imagen"]["name"] != '')
            {
              $image = $imagen_producto->upload_image();
            }

            //fecha
             $date = $_POST["datepicker"];
             $date_inicial = str_replace('/', '-', $date);
             $fecha = date("Y-m-d",strtotime($date_inicial));


            $sql="insert into productos
            values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);"; //Stock = ?

            //echo $sql;

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $_POST["nombreCategoria"]);
            $sql->bindValue(2, $_POST["producto"]);
            $sql->bindValue(3, $_POST["presentacion"]);
            $sql->bindValue(4, $_POST["UnidadMedida"]);
            $sql->bindValue(5, $_POST["productoSimilar"]);
            $sql->bindValue(6, $_POST["moneda"]);
            $sql->bindValue(7, $_POST["precioCompra"]);
            $sql->bindValue(8, $_POST["precioVenta"]);
            $sql->bindValue(9, $_POST["stock"]);
            $sql->bindValue(10, $_POST["tipoProducto"]);
            $sql->bindValue(11, $_POST["estadoProducto"]);
            $sql->bindValue(12, $image);
            $sql->bindValue(13, $fecha);
            $sql->bindValue(14, $_POST["nombreProveedor"]);
            $sql->bindValue(15, $_POST["idUsuario"]);
            $sql->execute();

        }


        //obtiene el registro por id despues de editar
        public function get_producto_por_id($idProductos){

          	$conn=parent::conexion();

            $sql="select * from productos where idProductos=?";

               $sql=$conn->prepare($sql);

             $sql->bindValue(1, $idProductos);
              $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

          }

/*validacion*/
        public function get_producto_por_id_estado($idProductos,$estadoProducto){

           $conn= parent::conexion();

            $estadoProducto=0;

            $sql="select * from productos where idProductos=? and estadoProducto=?";

            $sql=$conn->prepare($sql);


            $sql->bindValue(1, $idProductos);
            $sql->bindValue(2, $estadoProducto);

            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


    }

    //metodo para editar registro de productos
    public function editar_producto($idProductos, $idCategoria, $producto, $presentacion, $UnidadMedida, $productoSimilar, $moneda, $precioCompra, $precioVenta, $stock, $tipoProducto , $estadoProducto, $imagen, $idProveedor,$idUsuario){

              $conn=parent::conexion();
              parent::set_names();

              /* $stock = "";

               if($stock==""){

                 $stocker=0;

               } else {

                  $stocker = $_POST["stock"];
               } */

              //llamo a la funcion upload_image()
              require_once "Productos.php";

              $imagen_producto = new Producto();
              $imagen = '';

              if($_FILES["producto_imagen"]["name"] != '')
              {
                $imagen = $imagen_producto->upload_image();
              }
              else
              {
                $imagen = $_POST["hidden_producto_imagen"];
              }

              //fecha
              $fecha = $_POST["datepicker"];
              $date_inicial = str_replace('/','-', $fecha);
              $fecha = date("Y-m-d", strtotime($date_inicial));


              $sql = "update productos set
                  idCategoria=?,
                  producto=?,
                  presentacion=?,
                  UnidadMedida=?,
                  productoSimilar=?,
                  moneda=?,
                  precioCompra=?,
                  precioVenta=?,
                  stock=?,
                  tipoProducto=?,
                  estadoProducto=?,
                  imagen=?,
                  fechaExpiracion=?,
                  idProveedor=?,
                  idUsuarioProductos=?

                  where
                  idProductos=?"; //Stock despues de precioVenta

              $sql = $conn->prepare($sql);


              $sql->bindValue(1, $_POST["nombreCategoria"]);
              $sql->bindValue(2, $_POST["producto"]);
              $sql->bindValue(3, $_POST["presentacion"]);
              $sql->bindValue(4, $_POST["UnidadMedida"]);
              $sql->bindValue(5, $_POST["productoSimilar"]);
              $sql->bindValue(6, $_POST["moneda"]);
              $sql->bindValue(7, $_POST["precioCompra"]);
              $sql->bindValue(8, $_POST["precioVenta"]);
              $sql->bindValue(9, $_POST["stock"]);
              $sql->bindValue(10, $_POST["tipoProducto"]);
              $sql->bindValue(11, $_POST["estadoProducto"]);
              $sql->bindValue(12, $imagen);
              $sql->bindValue(13, $fecha);
              $sql->bindValue(14, $_POST["nombreProveedor"]);
              $sql->bindValue(15, $_POST["idUsuario"]);
              $sql->bindValue(16, $_POST["idProductos"]);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }


 			//método para activar o desactivar el estado del producto
            public function editar_estado($idProductos,$estadoProducto){

              $conn=parent::conexion();
              parent::set_names();

              $estadoProducto = 0;
              if($_POST["est"] == 0){
                $estadoProducto = 1;
              }

              $sql="update productos set

                    estadoProducto=?
                    where
                    idProductos=?
               ";

                $sql=$conn->prepare($sql);

                $sql->bindValue(1, $estadoProducto);
                $sql->bindValue(2, $idProductos);
                $sql->execute();


          	}


     	public function get_producto_nombre($producto){

              $conn=parent::conexion();

              $sql= "select * from productos where producto=?";

              $sql=$conn->prepare($sql);

              $sql->bindValue(1, $producto);
              $sql->execute();

              return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    //editar estado del producto por categoria
    public function editar_estado_producto_por_categoria($idCategoria,$estadoProducto){

      $conn=parent::conexion();
      parent::set_names();


      $estadoProducto = 0;

      if($_POST["est"] == 0){
        $estadoProducto = 1;
      }


      $sql="update productos set

            estadoProducto=?
            where
            idCategoria=?
              ";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $estadoProducto);
            $sql->bindValue(2, $idCategoria);
            $sql->execute();

    }

      //editar estado de la categoria por producto
      public function editar_estado_categoria_por_producto($idCategoria,$estadoProducto){

          $conn=parent::conexion();
          parent::set_names();

          //si es inactivo entonces la categoria pasa a activo
          if($_POST["est"] == 1){

            $sql="update categoria set

                estadoCategoria=?
                where
                idCategoria=?
                  ";

                $sql=$conn->prepare($sql);

                $sql->bindValue(1, 0);
                $sql->bindValue(2, $idCategoria);
                $sql->execute();

          }

    }

      public function get_prod_por_id_cat($idCategoria){

      $conn= parent::conexion();

      $sql="select * from productos where idCategoria=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idCategoria);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

          }


      public function get_producto_por_id_detalle_compra($idProductos){


             $conn=parent::conexion();
             parent::set_names();


      $sql="select p.idProductos,p.producto,c.idProducto, c.idProducto as producto_compras


      from productos p

      INNER JOIN detallecompras c ON p.idProductos=c.idProducto

      where p.idProductos=?
             ";

             $sql=$conn->prepare($sql);
             $sql->bindValue(1,$idProductos);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      }


      public function get_producto_por_id_detalle_venta($idProductos){


             $conn=parent::conexion();
             parent::set_names();


              $sql="select p.idProductos,p.producto, v.idProducto, v.Producto as producto_ventas

           from productos p

              INNER JOIN detalleventas v ON p.idProductos=v.idProducto

              where p.idProductos=?

              ";

             $sql=$conn->prepare($sql);
             $sql->bindValue(1,$idProductos);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      }

        public function eliminar_producto($idProductos){

        $conn=parent::conexion();

              $sql="delete from productos where idProductos=?";

              $sql=$conn->prepare($sql);

              $sql->bindValue(1, $idProductos);
              $sql->execute();

              return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
      }

      //Verifica si existe el ID de productos para eliminarlo
      public function get_producto_por_id_usuario($idUsuario){

        $conn= parent::conexion();

        $sql="select * from productos where idUsuario=?";

        $sql=$conn->prepare($sql);

        $sql->bindValue(1, $idUsuario);
        $sql->execute();

        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
      }


	}


?>
