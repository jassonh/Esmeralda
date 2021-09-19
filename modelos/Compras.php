<?php 

require_once '../config/conn.php';

  class Compras extends conn{


    public function get_filas_compras(){

      $conn= parent::conexion();

          $sql="select * from compras";

          $sql=$conn->prepare($sql);
          $sql->execute();

          $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

          return $sql->rowCount();

        }


    public function get_compras(){

             $conn= parent::conexion();

             $sql="select * from compras";

             $sql=$conn->prepare($sql);
             $sql->execute();

             return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }


    public function get_compras_por_id($idCompra){

             $conn= parent::conexion();

             $sql="select * from compras where idCompra=?";

             $sql=$conn->prepare($sql);
             $sql->bindValue(1,$idCompra);
             $sql->execute();

             return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    //Metodo para generar numeros de orden para la compra
    public function numero_compra(){

        $conn=parent::conexion();
        parent::set_names();


        $sql="select numero_compra from detallecompras;";

        $sql=$conn->prepare($sql);

        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

           foreach($resultado as $k=>$v){

                     $numero_compra["numero"]=$v["numero_compra"];

                 }

                    if(empty($numero_compra["numero"]))
                    {
                        echo 'F000001';
                    }
                    else
                    {
                        $num = substr($numero_compra["numero"] , 1);
                        $dig = $num + 1;
                        $fact = str_pad($dig, 6, "0", STR_PAD_LEFT);
                        echo 'F'.$fact;

                    }

      }

      //Metodo para agregar registro de la compra
      public function agrega_detalle_compra(){

        $str = '';
        $detalles = array();
        $detalles = json_decode($_POST['arrayCompra']);


         $conn=parent::conexion();


        foreach ($detalles as $k => $v) {

          //IMPORTANTE:estas variables son del array detalles
          $cantidad = $v->cantidad;
          $codProd = $v->codProd;
          $codCat = $v->codCat;
          $producto = $v->producto;
          $moneda = $v->moneda;
          $precio = $v->precio;
          $dscto = $v->dscto;
          $importe = $v->importe;
          //$total = $v->total;
          $estado = $v->estado;

             $numero_compra = $_POST["numero_compra"];
             $nit = $_POST["nit"];
             $nombreProveedor = $_POST["nombreProveedor"];
             $direccion = $_POST["direccion"];
             $total = $_POST["total"];
             $contacto = $_POST["contacto"];
             $idTipoPago = $_POST["idTipoPago"];
             $tipoProducto = $_POST["tipoProducto"];
             $idUsuario = $_POST["idUsuario"];
             $idProveedor = $_POST["idProveedor"];


              $sql="insert into detallecompras
              values(null,?,?,?,?,?,?,?,?,now(),?,?,?,?,?);";


              $sql=$conn->prepare($sql);

              $sql->bindValue(1,$numero_compra);
              $sql->bindValue(2,$codProd);
              $sql->bindValue(3,$producto);
              $sql->bindValue(4,$moneda);
              $sql->bindValue(5,$precio);
              $sql->bindValue(6,$cantidad);
              $sql->bindValue(7,$dscto);
              $sql->bindValue(8,$importe);
              $sql->bindValue(9,$idUsuario);
              $sql->bindValue(10,$idProveedor);
              $sql->bindValue(11,$nit);
              $sql->bindValue(12,$estado);
              $sql->bindValue(13,$codCat);
              $sql->execute();

               //print_r($_POST);


             $sql3="select * from productos where idProductos=?;";

             $sql3=$conn->prepare($sql3);

             $sql3->bindValue(1,$codProd);
             $sql3->execute();

             $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);

                  foreach($resultado as $b=>$row){

                    $re["existencia"] = $row["stock"];

                  }

                //la cantidad total es la suma de la cantidad más la cantidad actual
                $cantidad_total = $cantidad + $row["stock"];

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

               } //cierre la condicional


       }//cierre del foreach

       //SUMO EL TOTAL DE IMPORTE SEGUN EL CODIGO DE DETALLES DE COMPRA
         $sql5="select sum(importe) as total from detallecompras where numero_compra=?";

         $sql5=$conn->prepare($sql5);

         $sql5->bindValue(1,$numero_compra);
         $sql5->execute();

         $resultado2 = $sql5->fetchAll();

             foreach($resultado2 as $c=>$d){

                $row["total"]=$d["total"];

             }

             $subtotal=$d["total"];

              //REALIZO EL CALCULO A REGISTRAR
          $iva= 12/100;
          $total_iv=$subtotal*$iva;
          $total_iva=round($total_iv);
          $tot=$subtotal+$total_iva;
          $total=round($tot);

           $sql2="insert into compras
           values(null,now(),?,?,?,?,?,?,?,?,?,?,?,?,?);";

           $sql2=$conn->prepare($sql2);

           $sql2->bindValue(1,$numero_compra);
           $sql2->bindValue(2,$idUsuario);
           $sql2->bindValue(3,$contacto);


           $sql2->bindValue(4,$moneda);
           $sql2->bindValue(5,$subtotal);
           $sql2->bindValue(6,$total_iva);
           $sql2->bindValue(7,$total);

           $sql2->bindValue(8,$idTipoPago);
           $sql2->bindValue(9,$tipoProducto);
           $sql2->bindValue(10,$estado);
           $sql2->bindValue(11,$idProveedor);
           $sql2->bindValue(12,$nombreProveedor);
           $sql2->bindValue(13,$nit);
           $sql2->execute();

           //print_r($_POST);

      }


      //Metodo para obtener los detalles del proveedor en la compra
      public function get_detalle_proveedor($numero_compra){

          $conn=parent::conexion();
           parent::set_names();

          $sql="select c.fechaCompra, c.numero_compra, c.proveedor, c.nitProveedor, c.totalCompra, p.idProveedor, p.nitProveedor, p.nombreProveedor, p.telefonoProveedor, p.correo, p.direccion, p.FechaInicioProveedor, p.estado from compras as c, proveedor as p

            where c.nitProveedor = p.nitProveedor and c.numero_compra=?

          ;";


          $sql=$conn->prepare($sql);

          $sql->bindValue(1, $numero_compra);
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      }


      //Metodo para obtener todos los detalles de la compra, productos, subtota, total.
      public function get_detalle_compras_proveedor($numero_compra){

          $conn=parent::conexion();
          parent::set_names();

          $sql="select d.numero_compra, d.nitProveedor, d.Producto, d.moneda, d.PrecioCompra, d.CantidadCompra, d.descuento, d.importe, d.FechaCompra, c.numero_compra, c.moneda, c.subtotal, c.totalIVA, c.totalCompra, p.idProveedor, p.nitProveedor, p.nombreProveedor, p.telefonoProveedor, p.correo, p.direccion, p.FechaInicioProveedor, p.estado from detallecompras as d, compras as c, proveedor as p

            where d.numero_compra = c.numero_compra
            and
            d.nitProveedor = p.nitProveedor
            and
            d.numero_compra=?
          ;";

          //echo $sql; exit();

          $sql=$conn->prepare($sql);

          $sql->bindValue(1,$numero_compra);
          $sql->execute();
          $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

              $html= "

              <thead style='background-color:#A9D0F5'>

                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Descuento (%)</th>
                                    <th>Monto</th>

                                </thead>


                              ";



        foreach($resultado as $row)
        {


        $html.="<tr class='filas'><td>".$row['CantidadCompra']."</td><td>".$row['Producto']."</td> <td>".$row["moneda"]." ".$row['PrecioCompra']."</td> <td>".$row['descuento']."</td> <td>".$row["moneda"]." ".$row['importe']."</td></tr>";

                   $subtotal= $row["moneda"]." ".$row["subtotal"];
                   $subtotal_iva= $row["moneda"]." ".$row["totalIVA"];
                   $total= $row["moneda"]." ".$row["totalCompra"];
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


      public function cambiar_estado($idCompra, $numero_compra, $est){

            $conn=parent::conexion();
            parent::set_names();

            $estado = 1;

          if($_POST["est"] == 1){
              $estado = 0;

          //declaro $numero_compra, viene via ajax
          $numero_compra=$_POST["numero_compra"];


          $sql="update compras set

                estado=?
                where
                idCompra=?

                  ";

            // echo $sql;

            $sql=$conn->prepare($sql);

            $sql->bindValue(1,$estado);
            $sql->bindValue(2,$_POST["idCompra"]);
            $sql->execute();

            $resultado= $sql->fetch(PDO::FETCH_ASSOC);


            $sql_detalle= "update detallecompras set

                estadoCompra=?
                where
                numero_compra=?
                ";

            $sql_detalle=$conn->prepare($sql_detalle);

            $sql_detalle->bindValue(1,$estado);
            $sql_detalle->bindValue(2,$numero_compra);
            $sql_detalle->execute();

            $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);

            //INICIO CONSULTA DE DETALLE DE COMPRAS Y COMPRAS

            $sql2="select * from detallecompras where numero_compra=?";

            $sql2=$conn->prepare($sql2);


            $sql2->bindValue(1,$numero_compra);
            $sql2->execute();

            $resultado=$sql2->fetchAll();

              foreach($resultado as $row){

                 $idProducto=$output["idProducto"]=$row["idProducto"];
                //selecciona la cantidad comprada
                $CantidadCompra=$output["CantidadCompra"]=$row["CantidadCompra"];

                  if(isset($idProducto)==true and count($idProducto)>0){

                      $sql3="select * from productos where idProductos=?";

                      $sql3=$conn->prepare($sql3);

                      $sql3->bindValue(1, $idProducto);
                      $sql3->execute();

                      $resultado=$sql3->fetchAll();

                         foreach($resultado as $row2){

                           $stock=$output2["stock"]=$row2["stock"];

                           $cantidadActual= $stock + $CantidadCompra;

                         }
                  }


                //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO

               $sql6="update productos set
               stock=?
               where

               idProductos=?

               ";

               $sql6=$conn->prepare($sql6);

               $sql6->bindValue(1,$cantidadActual);
               $sql6->bindValue(2,$idProducto);

               $sql6->execute();


              }//cierre del foreach

          }//cierre del if del estado

          else {

              if($_POST["est"] == 0){
              $estado = 1;

      //declaro $numero_compra, viene via ajax
      $numero_compra=$_POST["numero_compra"];


      $sql="update compras set

            estado=?
            where
            idCompra=?

              ";

            // echo $sql;

            $sql=$conn->prepare($sql);

            $sql->bindValue(1,$estado);
            $sql->bindValue(2,$_POST["idCompra"]);
            $sql->execute();

            $resultado= $sql->fetch(PDO::FETCH_ASSOC);


            $sql_detalle= "update detallecompras set

                estadoCompra=?

                where
                numero_compra=?
                ";

            $sql_detalle=$conn->prepare($sql_detalle);

            $sql_detalle->bindValue(1,$estado);
            $sql_detalle->bindValue(2,$numero_compra);
            $sql_detalle->execute();

            $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);

            //INICIO ACTUALIZAR LA CANTIDAD DE PRODUCTOS COMPRADOS EN EL STOCK

          $sql2="select * from detallecompras where numero_compra=?";

          $sql2=$conn->prepare($sql2);


            $sql2->bindValue(1,$numero_compra);
            $sql2->execute();

            $resultado=$sql2->fetchAll();

              foreach($resultado as $row){

                 $idProducto=$output["idProducto"]=$row["idProducto"];

                $CantidadCompra=$output["CantidadCompra"]=$row["CantidadCompra"];

                  if(isset($idProducto)==true and count($idProducto)>0){

                      $sql3="select * from productos where idProductos=?";

                      $sql3=$conn->prepare($sql3);

                      $sql3->bindValue(1, $idProducto);
                      $sql3->execute();

                      $resultado=$sql3->fetchAll();

                         foreach($resultado as $row2){

                           $stock=$output2["stock"]=$row2["stock"];

                           $cantidadActual= $stock - $CantidadCompra;

                         }
                  }


                //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO
               $sql6="update productos set
               stock=?
               where

               idProductos=?

               ";

               $sql6=$conn->prepare($sql6);

               $sql6->bindValue(1,$cantidadActual);
               $sql6->bindValue(2,$idProducto);

               $sql6->execute();

              }//cierre del foreach

          }//cierre del if del estado del else

        }

       }//CIERRE DEL METODO

       //Metodo para mostrar segun fecha
       public function lista_busca_registros_fecha($fechaInicial, $fechaFinal){

            $conn= parent::conexion();

            $dateInicial = $_POST["fechaInicial"];
            $date = str_replace('/', '-', $dateInicial);
            $fechaInicial = date("Y-m-d", strtotime($date));

            $dateFinal = $_POST["fechaFinal"];
            $date = str_replace('/', '-', $dateFinal);
            $fechaFinal = date("Y-m-d", strtotime($date));


            $sql= "select * from compras where fechaCompra>=? and fechaCompra<=? ";


            $sql = $conn->prepare($sql);

            $sql->bindValue(1,$fechaInicial);
            $sql->bindValue(2,$fechaFinal);
            $sql->execute();

            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        }


        public function lista_busca_registros_fecha_mes($mes, $ano){

            $conn= parent::conexion();

            $mes=$_POST["mes"];
            $ano=$_POST["ano"];
            $fecha= ($ano."-".$mes."%");

            $sql= "select * from compras where fechaCompra like ? ";

            $sql = $conn->prepare($sql);

            $sql->bindValue(1,$fecha);
            $sql->execute();

            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);


        }


        //Inician métodos de reportes de compras
        public function get_compras_reporte_general(){

       $conn=parent::conexion();
       parent::set_names();


       //hacer la consulta que seleccione la fecha de mayor a menos
      $sql="SELECT MONTHname(fechaCompra) as mes, MONTH(fechaCompra) as numero_mes, YEAR(fechaCompra) as ano, SUM(totalCompra) as total_compra, moneda
        FROM compras where estado='0' GROUP BY YEAR(fechaCompra) desc, month(fechaCompra) desc";


         $sql=$conn->prepare($sql);

         $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

     }


     //suma el total de compras por año
     public function suma_compras_total_ano(){

      $conn=parent::conexion();

       $sql="SELECT YEAR(fechaCompra) as ano,SUM(totalCompra) as total_compra_ano, moneda FROM compras where estado='0' GROUP BY YEAR(fechaCompra) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           return $resultado= $sql->fetchAll();


     }

     public function suma_compras_total_grafica(){

      $conn=parent::conexion();


       $sql="SELECT YEAR(fechaCompra) as ano,SUM(totalCompra) as total_compra_ano FROM compras where estado='0' GROUP BY YEAR(fechaCompra) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){
                 $ano= $output["ano"]=$row["ano"];
                 $p = $output["total_compra_ano"]=$row["total_compra_ano"];
                 echo $grafica= "{name:'".$ano."', y:".$p."},";
           }


     }

      public function suma_compras_canceladas_total_grafica(){

      $conn=parent::conexion();


       $sql="SELECT YEAR(fechaCompra) as ano,SUM(totalCompra) as total_compra_ano FROM compras where estado='1' GROUP BY YEAR(fechaCompra) desc";

           $sql=$conn->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["ano"]=$row["ano"];
                 $p = $output["total_compra_ano"]=$row["total_compra_ano"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }

       }



/*REPORTE DE COMPRAS MENSUAL*/

     public function suma_compras_anio_mes_grafica($fecha){

      $conn=parent::conexion();
      parent::set_names();

       //imprime la fecha por separado ejemplo: dia, mes y año
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

       //SI EXISTE EL ENVIO POST ENTONCES SE MUESTRA LA FECHA SELECCIONADA
        if(isset($_POST["year"])){

          $fecha=$_POST["year"];

       $sql="SELECT YEAR(fechaCompra) as ano, MONTHname(fechaCompra) as mes, SUM(totalCompra) as total_compra_mes FROM compras WHERE YEAR(fechaCompra)=? and estado='0' GROUP BY MONTHname(fechaCompra) desc";

           $sql=$conn->prepare($sql);
           $sql->bindValue(1,$fecha);
           $sql->execute();

           $resultado= $sql->fetchAll();

           foreach($resultado as $row){


                 $ano= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
                 $p = $output["total_compra_mes"]=$row["total_compra_mes"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


         } else {


//sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

          $fecha_inicial=date("Y");


          $sql="SELECT YEAR(fechaCompra) as ano, MONTHname(fechaCompra) as mes, SUM(totalCompra) as total_compra_mes FROM compras WHERE YEAR(fechaCompra)=? and estado='0' GROUP BY MONTHname(fechaCompra) desc";

           $sql=$conn->prepare($sql);
           $sql->bindValue(1,$fecha_inicial);
           $sql->execute();

           $resultado= $sql->fetchAll();

             //recorro el array y lo imprimo
            foreach($resultado as $row){

                 $ano= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
                 $p = $output["total_compra_mes"]=$row["total_compra_mes"];

            echo $grafica= "{name:'".$ano."', y:".$p."},";

           }//cierre del foreach


         }//cierre del else


     }


     public function get_year_compras(){

        $conn=parent::conexion();

          $sql="select year(fechaCompra) as fecha from compras group by year(fechaCompra) asc";


          $sql=$conn->prepare($sql);
          $sql->execute();
          return $resultado= $sql->fetchAll();

     }


     public function get_compras_mensual($fecha){

        $conn=parent::conexion();

      if(isset($_POST["year"])){

          $fecha=$_POST["year"];

        $sql="select MONTHname(fechaCompra) as mes, MONTH(fechaCompra) as numero_mes, YEAR(fechaCompra) as ano, SUM(totalCompra) as total_compra, moneda
        from compras where YEAR(fechaCompra)=? and estado='0' group by MONTHname(fechaCompra) asc";


            $sql=$conn->prepare($sql);
            $sql->bindValue(1,$fecha);
            $sql->execute();
            return $resultado= $sql->fetchAll();

            } else {

              $fecha_inicial=date("Y");

                 $sql="select MONTHname(fechaCompra) as mes, MONTH(fechaCompra) as numero_mes, YEAR(fechaCompra) as ano, SUM(totalCompra) as total_compra, moneda
            from compras where YEAR(fechaCompra)=? and estado='0' group by MONTHname(fechaCompra) asc";


                $sql=$conn->prepare($sql);
                $sql->bindValue(1,$fecha_inicial);
                $sql->execute();
                return $resultado= $sql->fetchAll();



            }//cierre del else

        }

      /*REPORTE POR RANGO DE FECHA Y PROVEEDOR*/


       public function get_pedido_por_fecha($nit,$fechaInicial,$fechaFinal){

            $conn=parent::conexion();
            parent::set_names();


            $date_inicial = $_POST["datepicker"];
            $date = str_replace('/', '-', $date_inicial);
            $fechaInicial = date("Y-m-d", strtotime($date));


            $date_final = $_POST["datepicker2"];
            $date = str_replace('/', '-', $date_final);
            $fechaFinal = date("Y-m-d", strtotime($date));


            $sql="select * from detallecompras where nitProveedor=? and FechaCompra>=? and FechaCompra<=? and estadoCompra='0';";


              $sql=$conn->prepare($sql);

              $sql->bindValue(1,$nit);
              $sql->bindValue(2,$fechaInicial);
              $sql->bindValue(3,$fechaFinal);
              $sql->execute();

              return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);


         }



           public function get_cant_productos_por_fecha($nit,$fechaInicial,$fechaFinal){

            $conn=parent::conexion();
            parent::set_names();

            $date_inicial = $_POST["datepicker"];
            $date = str_replace('/', '-', $date_inicial);
            $fechaInicial = date("Y-m-d", strtotime($date));


            $date_final = $_POST["datepicker2"];
            $date = str_replace('/', '-', $date_final);
            $fechaFinal = date("Y-m-d", strtotime($date));


           $sql="select sum(CantidadCompra) as total from detallecompras where nitProveedor=? and FechaCompra >=? and FechaCompra <=? and estadoCompra = '0';";


            $sql=$conn->prepare($sql);

            $sql->bindValue(1,$nit);
            $sql->bindValue(2,$fechaInicial);
            $sql->bindValue(3,$fechaFinal);
            $sql->execute();

            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);

        }

    /* ---------- METODOS PARA ELIMINAR EN PROVEEDORES ------------- */

    public function get_compras_por_id_proveedor($idProveedor){

      $conn= parent::conexion();

      $sql="select * from compras where idProveedor=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idProveedor);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_detalle_compras_por_id_proveedor($idProveedor){

      $conn= parent::conexion();

      $sql="select * from detallecompras where idProveedorCompra=?";

            $sql=$conn->prepare($sql);

            $sql->bindValue(1, $idProveedor);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_compras_por_id_usuario($idUsuario){

        $conn= parent::conexion();

        $sql="select * from compras where idUsuarioCompra=?";

              $sql=$conn->prepare($sql);

              $sql->bindValue(1, $idUsuario);
              $sql->execute();

        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_detalle_compras_por_id_usuario($idUsuario){

      $conn= parent::conexion();

      $sql="select * from detallecompras where idUsuarioCompra=?";

      $sql=$conn->prepare($sql);

      $sql->bindValue(1, $idUsuario);
      $sql->execute();

      return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }


  }

?>
