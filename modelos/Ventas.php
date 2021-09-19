  
  <?php

 require_once("../config/conn.php");

  class Ventas extends conn{

   public function get_filas_ventas(){

      $conn= parent::conexion();

          $sql="select * from ventas";

          $sql=$conn->prepare($sql);
          $sql->execute();

          $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

          return $sql->rowCount();

        }

  	 public function get_ventas(){

		 $conn= parent::conexion();

         $sql="select * from ventas";

         //echo $sql;

         $sql=$conn->prepare($sql);

         $sql->execute();

         return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

		}

  //------------CONSULTA VENTA------------------//
    public function get_detalle_cliente($numero_venta){

       $conn=parent::conexion();
           parent::set_names();

          $sql="select v.fechaVenta,v.numero_venta, v.nombreCliente, v.nitCliente,v.total,c.idCliente,c.nit,c.nombreCliente, c.apellidoCliente,c.telefonoCliente,c.direccionCliente,c.correoCliente,c.fechaRegistro,c.estadoCliente
          from ventas as v, cliente as c
          where

          v.nitCliente=c.nit
          and
          v.numero_venta=?

          ;";

          //echo $sql; exit();

          $sql=$conn->prepare($sql);


              $sql->bindValue(1,$numero_venta);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }


    public function get_detalle_ventas_cliente($numero_venta){

       $conn=parent::conexion();
           parent::set_names();

          $sql="select d.numero_venta,d.nitCliente,d.Producto,d.PrecioVenta, d.CantidadVenta,d.moneda,d.descuento,d.importe,d.fechaVenta,v.numero_venta,
          v.moneda,v.subtotal,v.totalIVA,v.total,c.idCliente,c.nit,c.nombreCliente,c.apellidoCliente,c.telefonoCliente,c.direccionCliente,c.correoCliente,c.fechaRegistro,c.estadoCliente
          from detalleventas as d, ventas as v, cliente as c
          where

          d.numero_venta = v.numero_venta
          and
          d.nitCliente = c.nit
          and
          d.numero_venta=?

          ;";

          //echo $sql; exit();

          $sql=$conn->prepare($sql);


              $sql->bindValue(1,$numero_venta);
          $sql->execute();
          $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);


              $html= "

              <thead style='background-color:#A9D0F5'>

                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento (%)</th>
                                    <th>Importe</th>

                                </thead>


                              ";



              foreach($resultado as $row)
        {


  $html.="<tr class='filas'><td>".$row['CantidadVenta']."</td><td>".$row['Producto']."</td> <td>".$row["moneda"]." ".$row['PrecioVenta']."</td> <td>".$row['descuento']."</td> <td>".$row["moneda"]." ".$row['importe']."</td></tr>";

                   $subtotal= $row["moneda"]." ".$row["subtotal"];
                   $subtotal_iva= $row["moneda"]." ".$row["totalIVA"];
                   $total= $row["moneda"]." ".$row["total"];
        }

     $html .= "<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                     <p>SUB-TOTAL</p>
                                     <p>IVA(12%)</p>
                                     <p class='margen_total'>TOTAL</p>
                                    </th>

                                    <th>

                                    <p><strong>".$subtotal."</strong></p>

                                     <p><strong>".$subtotal_iva."</strong></p>

                                     <p><strong>".$total."</strong></p>

                                    </th>
                                </tfoot>";

      echo $html;

    }

//-------------FIN CONSULTA VENTA-------------------//



     public function numero_venta(){

		    $conn=parent::conexion();
		    parent::set_names();


		    $sql="select numero_venta from detalleventas;";

		    $sql=$conn->prepare($sql);

		    $sql->execute();
		    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		       foreach($resultado as $k=>$v){

		                 $numero_venta["numero"]=$v["numero_venta"];

		             }

		                   if(empty($numero_venta["numero"]))
		                {
		                  echo 'F000001';
		                }else

		                  {
		                    $num     = substr($numero_venta["numero"] , 1);
		                    $dig     = $num + 1;
		                    $fact = str_pad($dig, 6, "0", STR_PAD_LEFT);
		                    echo 'F'.$fact;

		                  }

		  }

 public function agrega_detalle_venta(){
	$str = '';
	$detalles = array();
	$detalles = json_decode($_POST['arrayVenta']);


	 $conn=parent::conexion();


	foreach ($detalles as $k => $v) {

		//estas variables son del array detalles
		$cantidad = $v->cantidad;
		$codProd = $v->codProd;
		$producto = $v->producto;
		$moneda = $v->moneda;
		$precio = $v->precio;
		$dscto = $v->dscto;
		$importe = $v->importe;
		//$total = $v->total;
		$estado = $v->estado;

		   $numero_venta = $_POST["numero_venta"];
		   $nit = $_POST["nit"];
		   $nombreCliente = $_POST["nombreCliente"];
		   $apellidoCliente = $_POST["apellidoCliente"];
		   $direccionCliente = $_POST["direccionCliente"];
		   $total = $_POST["total"];
		   $Vendedor = $_POST["Vendedor"];
		   $idTipoPago = $_POST["idTipoPago"];
       $tipoProducto = $_POST["tipoProducto"];
       $idUsuario = $_POST["idUsuario"];
       $idCliente = $_POST["idCliente"];


        $sql="insert into detalleventas
        values(null,?,?,?,?,?,?,?,?,?,now(),?,?,?);";


        $sql=$conn->prepare($sql);

        //echo $sql;

        $sql->bindValue(1,$numero_venta);
        $sql->bindValue(2,$nit);
        $sql->bindValue(3,$codProd);
        $sql->bindValue(4,$producto);
        $sql->bindValue(5,$precio);
        $sql->bindValue(6,$cantidad);
        $sql->bindValue(7,$moneda);
        $sql->bindValue(8,$dscto);
        $sql->bindValue(9,$importe);
        $sql->bindValue(10,$idUsuario);
        $sql->bindValue(11,$idCliente);
        $sql->bindValue(12,$estado);

        $sql->execute();


             $sql3="select * from productos where idProductos=?;";

             $sql3=$conn->prepare($sql3);

             $sql3->bindValue(1,$codProd);
             $sql3->execute();

             $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);

                  foreach($resultado as $b=>$row){

                  	$re["existencia"] = $row["stock"];

                  }

                //la cantidad total es la resta del stock menos la cantidad de productos vendido
                $cantidad_total = $row["stock"] - $cantidad;

               //si existe el producto entonces actualiza el stock en producto
               if(is_array($resultado)==true and count($resultado)>0) {

                  //actualiza el stock en la tabla producto
             	   $sql4 = "update productos set

                      stock=?
                      where
                      idProductos=?
             	   ";

             	  $sql4 = $conn->prepare($sql4);
             	  $sql4->bindValue(1,$cantidad_total);
             	  $sql4->bindValue(2,$codProd);
             	  $sql4->execute();

               }

	     }//cierre del foreach

         $sql5="select sum(importe) as total from detalleventas where numero_venta=?";

         $sql5=$conn->prepare($sql5);
         $sql5->bindValue(1,$numero_venta);
         $sql5->execute();

         $resultado2 = $sql5->fetchAll();

             foreach($resultado2 as $c=>$d){

                $row["total"]=$d["total"];

             }

             $subtotal=$d["total"];

              //calculo a registrar
		      $iva= 12/100;
		      $total_iv=$subtotal*$iva;
		      $total_iva=round($total_iv);
		      $tot=$subtotal+$total_iva;
		      $total=round($tot);

           $sql2="insert into ventas
           values(null,now(),?,?,?,?,?,?,?,?,?,?,?,?,?);";

           //echo $sql2;
           //exit();

           $sql2=$conn->prepare($sql2);

           $sql2->bindValue(1,$numero_venta);
           $sql2->bindValue(2,$nombreCliente);
           $sql2->bindValue(3,$nit);
           $sql2->bindValue(4,$Vendedor);
           $sql2->bindValue(5,$moneda);
           $sql2->bindValue(6,$subtotal);
           $sql2->bindValue(7,$total_iva);
           $sql2->bindValue(8,$total);
           $sql2->bindValue(9,$idTipoPago);
           $sql2->bindValue(10,$tipoProducto);
           $sql2->bindValue(11,$estado);
           $sql2->bindValue(12,$idUsuario);
           $sql2->bindValue(13,$idCliente);
           $sql2->execute();

  	  }

      public function get_ventas_por_id($idVentas){

     $conn= parent::conexion();

     $idVentas=$_POST["idVentas"];

         $sql="select * from ventas where idVentas=?";

         $sql=$conn->prepare($sql);
         $sql->bindValue(1,$idVentas);
         $sql->execute();

         return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    /*cambiar estado de la venta, solo se cambia si se quiere eliminar una venta y se revertería la cantidad de venta al stock*/
    public function cambiar_estado($idVentas, $numero_venta, $est){

      $conn=parent::conexion();
      parent::set_names();

      //si estado es igual a 0 entonces lo cambia a 1
      $estadoVenta = 1;
      //el parametro est se envia por via ajax, viene del $est:est
    if($_POST["est"] == 1){
        $estadoVenta = 0;

      //declaro $numero_venta, viene via ajax
      $numero_venta=$_POST["numero_venta"];

      $sql="update ventas set
            estadoVenta=?
            where
            idVentas=?";

            // echo $sql;

            $sql=$conn->prepare($sql);

            $sql->bindValue(1,$estadoVenta);
            $sql->bindValue(2,$_POST["idVentas"]);
            $sql->execute();

            $resultado= $sql->fetch(PDO::FETCH_ASSOC);

      $sql_detalle= "update detalleventas set
                     estadoVenta=?
                     where
                     numero_venta=? ";

            $sql_detalle=$conn->prepare($sql_detalle);

            $sql_detalle->bindValue(1,$estadoVenta);
            $sql_detalle->bindValue(2,$numero_venta);
            $sql_detalle->execute();

            $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);

            /*caundo se cambie de estado a ACTIVO entonces actualizamos la cantidad de stock en productos*/

            //INICIO CONSULTA EN DETALLE DE VENTAS Y VENTAS
          $sql2="select * from detalleventas where numero_venta=?";

          $sql2=$conn->prepare($sql2);


            $sql2->bindValue(1,$numero_venta);
            $sql2->execute();

            $resultado=$sql2->fetchAll();

              foreach($resultado as $row){

                 $idProducto=$output["idProducto"]=$row["idProducto"];
                //selecciona la cantidad vendida
                $CantidadVenta=$output["CantidadVenta"]=$row["CantidadVenta"];

                 //si el idProducto existe entonces consulta si la cantidad de productos existe en la tabla producto
                  if(isset($idProducto)==true and count($idProducto)>0){

                      $sql3="select * from productos where idProductos=?";

                      $sql3=$conn->prepare($sql3);

                      $sql3->bindValue(1, $idProducto);
                      $sql3->execute();

                      $resultado=$sql3->fetchAll();

                         foreach($resultado as $row2){

                           //este es la cantidad de stock para cada producto
                           $stock=$output2["stock"]=$row2["stock"];

                           //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la venta
                           //cuando das click a estado pasa a PAGADO Y RESTA la cantidad de stock con la cantidad de venta
                           $cantidad_actual= $stock - $CantidadVenta;

                         }
                  }


                //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO

               $sql6="update productos set
                      stock=?
                      where
                      idProductos=?";

               $sql6=$conn->prepare($sql6);

               $sql6->bindValue(1,$cantidad_actual);
               $sql6->bindValue(2,$idProducto);

               $sql6->execute();

              }//cierre del foreach

          }//cierre del if del estado

          else {

              /*si el estado es igual a 0, entonces pasaria a ANULADO y reverteria de nuevo la cantidad de productos al stock*/

              if($_POST["est"] == 0){
        $estadoVenta = 1;

      //declaro $numero_venta, viene via ajax
      $numero_venta=$_POST["numero_venta"];


      $sql="update ventas set
            estadoVenta=?
            where
            idVentas=?";

            // echo $sql;

            $sql=$conn->prepare($sql);

            $sql->bindValue(1,$estadoVenta);
            $sql->bindValue(2,$_POST["idVentas"]);
            $sql->execute();

            $resultado= $sql->fetch(PDO::FETCH_ASSOC);


      $sql_detalle= "update detalleventas set
          estadoVenta=?
          where
          numero_venta=?";

            $sql_detalle=$conn->prepare($sql_detalle);

            $sql_detalle->bindValue(1,$estadoVenta);
            $sql_detalle->bindValue(2,$numero_venta);
            $sql_detalle->execute();

            $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);

            /*cuando se cambie de estado a ACTIVO entonces revertimos la cantidad de stock en productos*/

            //INICIO REVERTIR LA CANTIDAD DE PRODUCTOS VENDIDOS EN EL STOCK
          $sql2="select * from detalleventas where numero_venta=?";

          $sql2=$conn->prepare($sql2);

            $sql2->bindValue(1,$numero_venta);
            $sql2->execute();

            $resultado=$sql2->fetchAll();

              foreach($resultado as $row){

                 $idProducto=$output["idProducto"]=$row["idProducto"];
                //selecciona la cantidad vendida
                $CantidadVenta=$output["CantidadVenta"]=$row["CantidadVenta"];

                 //si el idProducto existe entonces que consulte si la cantidad de productos existe en la tabla productos
                  if(isset($idProducto)==true and count($idProducto)>0){

                      $sql3="select * from productos where idProductos=?";

                      $sql3=$conn->prepare($sql3);

                      $sql3->bindValue(1, $idProducto);
                      $sql3->execute();

                      $resultado=$sql3->fetchAll();

                         foreach($resultado as $row2){

                           //este es la cantidad de stock para cada producto
                           $stock=$output2["stock"]=$row2["stock"];

                           //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la venta
                      //cuando le da click al estado pasa de PAGADO A ANULADO y SUMA la cantidad de stock en productos con la cantidad de venta de detalle_ventas, aumentando de esta manera la cantidad actual de productos en el stock de productos
                           $cantidad_actual= $stock + $CantidadVenta;

                         }
                  }

                //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO
               $sql6="update productos set
                      stock=?
                      where
                      idProductos=?";

               $sql6=$conn->prepare($sql6);

               $sql6->bindValue(1,$cantidad_actual);
               $sql6->bindValue(2,$idProducto);

               $sql6->execute();

              }//cierre del foreach

         }//cierre del if del estado del else

       }

    }//CIERRE DEL METODO

    //BUSCA REGISTROS VENTAS-FECHA

  public function lista_busca_registros_fecha($fecha_inicial, $fecha_final){

                $conn= parent::conexion();

            $date_inicial = $_POST["fecha_inicial"];
            $date = str_replace('/', '-', $date_inicial);
            $fecha_inicial = date("Y-m-d", strtotime($date));

              $date_final = $_POST["fecha_final"];
              $date = str_replace('/', '-', $date_final);
              $fecha_final = date("Y-m-d", strtotime($date));

      $sql= "SELECT * FROM ventas WHERE fechaVenta>=? and fechaVenta<=? ";

            $sql = $conn->prepare($sql);
            $sql->bindValue(1,$fecha_inicial);
            $sql->bindValue(2,$fecha_final);
            $sql->execute();
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

       }

       //BUSCA REGISTROS VENTAS-FECHA-MES
        public function lista_busca_registros_fecha_mes($mes, $ano){

          $conn= parent::conexion();

          //variables que vienen por POST de Ajax
             $mes=$_POST["mes"];
             $ano=$_POST["ano"];

           $fecha= ($ano."-".$mes."%");

          $sql= "SELECT * FROM ventas WHERE fechaVenta like ? ";

            $sql = $conn->prepare($sql);
            $sql->bindValue(1,$fecha);
            $sql->execute();
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        }

//METODOS PARA REPORTES DE VENTAS
           public function get_ventas_por_id_cliente($idCliente){

           $conn= parent::conexion();


            $sql="select * from ventas where idCliente=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idCliente);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

       public function get_detalle_ventas_por_id_cliente($idCliente){

        $conn= parent::conexion();

        $sql="select * from detalleventas where idCliente=?";

              $sql=$conn->prepare($sql);

              $sql->bindValue(1, $idCliente);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
      }


         public function get_ventas_por_id_usuario($idUsuario){

           $conn= parent::conexion();


           $sql="select * from ventas where idUsuario=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idUsuario);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }

         public function get_detalle_ventas_por_id_usuario($idUsuario){

           $conn= parent::conexion();


           $sql="select * from detalleventas where idUsuario=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idUsuario);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }


        /*REPORTE VENTAS*/
        public function get_ventas_reporte_general(){

       $conn=parent::conexion();
       parent::set_names();


      $sql="SELECT MONTHname(fechaVenta) as mes, MONTH(fechaVenta) as numero_mes, YEAR(fechaVenta) as ano, SUM(total) as total_venta, moneda FROM ventas where estadoVenta='0' GROUP BY YEAR(fechaVenta) desc, month(fechaVenta) desc";


         $sql=$conn->prepare($sql);

         $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

     }

     //suma el total de ventas por año

     public function suma_ventas_total_ano(){

      $conn=parent::conexion();


       $sql="SELECT YEAR(fechaVenta) as ano,SUM(total) as total_venta_ano, moneda FROM ventas where estadoVenta='0' GROUP BY YEAR(fechaVenta) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           return $resultado= $sql->fetchAll();

     }

     //recorro el array para traerme la lista de una en vez de traerlo con el return, y hago el formato para la grafica
     //suma total por año
     public function suma_ventas_total_grafica(){

      $conn=parent::conexion();


       $sql="SELECT YEAR(fechaVenta) as ano,SUM(total) as total_venta_ano FROM ventas where estadoVenta='0' GROUP BY YEAR(fechaVenta) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["ano"]=$row["ano"];
                 $p = $output["total_venta_ano"]=$row["total_venta_ano"];

            echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


     }


       public function suma_ventas_cancelada_total_grafica(){

      $conn=parent::conexion();


       $sql="SELECT YEAR(fechaVenta) as ano,SUM(total) as total_venta_ano FROM ventas where estadoVenta='0' GROUP BY YEAR(fechaVenta) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["ano"]=$row["ano"];
                 $p = $output["total_venta_ano"]=$row["total_venta_ano"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


     }


     public function suma_ventas_anio_mes_grafica($fecha){

      $conn=parent::conexion();
      parent::set_names();

      //se usa para traducir el mes en la grafica
       //imprime la fecha por separado ejemplo: dia, mes y año
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


       //SI EXISTE EL ENVIO POST ENTONCES SE MUESTRA LA FECHA SELECCIONADA
        if(isset($_POST["year"])){

          $fecha=$_POST["year"];

    $sql="SELECT YEAR(fechaVenta) as ano, MONTHname(fechaVenta) as mes, SUM(total) as total_venta_mes FROM ventas WHERE YEAR(fechaVenta)=? and estadoVenta ='0' GROUP BY MONTHname(fechaVenta) desc";

           $sql=$conn->prepare($sql);
           $sql->bindValue(1,$fecha);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
                 $p = $output["total_venta_mes"]=$row["total_venta_mes"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


         } else {


//sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

          $fecha_inicial=date("Y");


   $sql="SELECT YEAR(fechaVenta) as ano, MONTHname(fechaVenta) as mes, SUM(total) as total_venta_mes FROM ventas WHERE YEAR(fechaVenta)=? and estadoVenta ='0' GROUP BY MONTHname(fechaVenta) desc";

           $sql=$conn->prepare($sql);
           $sql->bindValue(1,$fecha_inicial);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
                 $p = $output["total_venta_mes"]=$row["total_venta_mes"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }//cierre del foreach


         }//cierre del else


     }

      public function get_year_ventas(){

        $conn=parent::conexion();

          $sql="select year(fechaVenta) as fecha from ventas group by year(fechaVenta) asc";


          $sql=$conn->prepare($sql);
          $sql->execute();
          return $resultado= $sql->fetchAll();


     }


      public function get_ventas_mensual($fecha){


        $conn=parent::conexion();

      if(isset($_POST["year"])){

          $fecha=$_POST["year"];

        $sql="select MONTHname(fechaVenta) as mes, MONTH(fechaVenta) as numero_mes, YEAR(fechaVenta) as ano, SUM(total) as total_venta, moneda
        from ventas where YEAR(fechaVenta)=? and estadoVenta='0' group by MONTHname(fechaVenta) desc";


          $sql=$conn->prepare($sql);
          $sql->bindValue(1,$fecha);
          $sql->execute();
          return $resultado= $sql->fetchAll();



        } else {

          //sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

          $fecha_inicial=date("Y");

             $sql="select MONTHname(fechaVenta) as mes, MONTH(fechaVenta) as numero_mes, YEAR(fechaVenta) as ano, SUM(total) as total_venta, moneda
        from ventas where YEAR(fechaVenta)=? and estadoVenta='0' group by MONTHname(fechaVenta) desc";


         $sql=$conn->prepare($sql);
          $sql->bindValue(1,$fecha_inicial);
          $sql->execute();
            return $resultado= $sql->fetchAll();



        }
     }



       public function get_venta_por_fecha($nit_cliente,$fecha_inicial,$fecha_final){

        $conn=parent::conexion();
        parent::set_names();


            $date_inicial = $_POST["datepicker"];
            $date = str_replace('/', '-', $date_inicial);
            $fecha_inicial = date("Y-m-d", strtotime($date));


            $date_final = $_POST["datepicker2"];
            $date = str_replace('/', '-', $date_final);
            $fecha_final = date("Y-m-d", strtotime($date));


        $sql="select * from detalleventas where nitCliente=? and fechaVenta>=? and fechaVenta<=? and estadoVenta='0';";


        $sql=$conn->prepare($sql);

        $sql->bindValue(1,$nit_cliente);
        $sql->bindValue(2,$fecha_inicial);
        $sql->bindValue(3,$fecha_final);
        $sql->execute();

        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


      public function get_ventas_anio_actual(){

        $conn=parent::conexion();
        parent::set_names();

        $sql="SELECT YEAR(fechaVenta) as ano, MONTHname(fechaVenta) as mes, SUM(total) as total_venta_mes, moneda FROM ventas WHERE YEAR(fechaVenta)=YEAR(CURDATE()) and estadoVenta='0' GROUP BY MONTHname(fechaVenta) desc";

        $sql=$conn->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();

    }

    public function get_ventas_anio_actual_grafica(){

       $conn=parent::conexion();
       parent::set_names();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

       $sql="SELECT  MONTHname(fechaVenta) as mes, SUM(total) as total_venta_mes FROM ventas WHERE YEAR(fechaVenta)=YEAR(CURDATE()) and estadoVenta='0' GROUP BY MONTHname(fechaVenta) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){


          $mes= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
          $p = $output["total_venta_mes"]=$row["total_venta_mes"];

         echo $grafica= "{name:'".$mes."', y:".$p."},";

           }

    }

        public function get_cant_productos_por_fecha($nit_cliente,$fecha_inicial,$fecha_final){

          $conn=parent::conexion();
          parent::set_names();

              $date_inicial = $_POST["datepicker"];
              $date = str_replace('/', '-', $date_inicial);
              $fecha_inicial = date("Y-m-d", strtotime($date));


              $date_final = $_POST["datepicker2"];
              $date = str_replace('/', '-', $date_final);
              $fecha_final = date("Y-m-d", strtotime($date));


          $sql="select sum(CantidadVenta) as total from detalleventas where nitCliente=? and fechaVenta >=? and fechaVenta <=? and estadoVenta='0';";


          $sql=$conn->prepare($sql);

          $sql->bindValue(1,$nit_cliente);
          $sql->bindValue(2,$fecha_inicial);
          $sql->bindValue(3,$fecha_final);
          $sql->execute();

          return $resultado=$sql->fetch(PDO::FETCH_ASSOC);

         }



   }
