
 var tabla;
 var tabla_en_ventas;

 //Función que se ejecuta al inicio
function init(){
	
	listar();

	listar_en_ventas();

	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#producto_form").on("submit",function(e)
	{

		guardaryeditar(e);	
	})
    
    //cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function(){
			
			$(".modal-title").text("Agregar Producto");
		
	  });

}


//Función limpiar
function limpiar()
{
	
	$('#idProductos').val("");
	$('#nombreCategoria').val("");
	$('#producto').val("");
	$('#presentacion').val("");
	$('#UnidadMedida').val("");
	$('#productoSimilar').val("");
	$('#moneda').val("");
	$('#precioCompra').val("");
	$('#precioVenta').val("");
	$('#stock').val("");
	$('#estadoProducto').val("");
	$('#producto_imagen').val("");
	$('#datepicker').val("");
	$('#nombreProveedor').val("");
	$('#tipoProducto').val("");
	
}

//Función Listar
function listar()
{
	tabla=$('#producto_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/Producto.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    
	    "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
			    }

			   }//cerrando language
	       
	}).DataTable();
}

 //Mostrar datos de la categoria en la ventana modal 
function mostrar(idProductos)
{
	$.post("../ajax/Producto.php?op=mostrar",{idProductos : idProductos}, function(data, status)
	{
		data = JSON.parse(data);

		 		//alert(data);
		
				$('#productoModal').modal('show');
				$('#nombreCategoria').val(data.nombreCategoria);
				$('#producto').val(data.producto);
				$('#presentacion').val(data.presentacion);
				$('#UnidadMedida').val(data.UnidadMedida);
				$('#productoSimilar').val(data.productoSimilar);
				$('#moneda').val(data.moneda);
				$('#precioCompra').val(data.precioCompra);
				$('#precioVenta').val(data.precioVenta);
				$('#stock').val(data.stock);
				$('#tipoProducto').val(data.tipoProducto);
				$('#estadoProducto').val(data.estadoProducto);
				$('#producto_uploaded_image').html(data.producto_imagen);
				$('#datepicker').val(data.fechaExpiracion);
				$('#nombreProveedor').val(data.nombreProveedor);
				$('.modal-title').text("Editar Producto");
				$('#idProductos').val(idProductos);
				$('#resultados_ajax').html(data);
				$('#producto_data').DataTable().ajax.reload();	
				
	});
        
}

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#producto_form")[0]);


		$.ajax({
			url: "../ajax/Producto.php?op=guardaryeditar",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(datos)
		    {                    
		         
		         console.log(datos);

	            $('#producto_form')[0].reset();
				$('#productoModal').modal('hide');

				$('#resultados_ajax').html(datos);
				$('#producto_data').DataTable().ajax.reload();
				
                limpiar();
					
		    }

		});
       
}

//EDITAR ESTADO DEl PRODUCTO
function cambiarEstado(idCategoria, idProductos, est){


 	bootbox.confirm("¿Está Seguro de cambiar de estado?", function(result){
		if(result)
		{

   
			$.ajax({
				url:"../ajax/Producto.php?op=activarydesactivar",
				 method:"POST",
				
				//toma el valor del id y del estado
				data:{idCategoria:idCategoria,idProductos:idProductos,est:est},
				
				success: function(data){
                 
                  $('#producto_data').DataTable().ajax.reload();
			    
			    }

			});

		}

	});

}

/****************VENTAS*****************/

function listar_en_ventas(){

	tabla_en_ventas=$('#lista_productos_ventas_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/producto.php?op=listar_en_ventas',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 8,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    
	    "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
			    }

			   }//cerrando language
	       
	}).DataTable();

}
    
    //este es un arreglo vacio
	var detalles = [];
	
	 function agregarDetalleVenta(idProductos,producto,estadoProducto){
		        $.ajax({
					url:"../ajax/producto.php?op=buscar_producto_en_venta",
					 method:"POST",
					//data:dataString,
					//toma el valor del id y del estado
					data:{idProductos:idProductos, producto:producto, estadoProducto:estadoProducto},
					cache: false,
					dataType:"json",

					success:function(data){
                       
                       if(data.idProductos){

						if (typeof data == "string"){
						      data = $.parseJSON(data);
						}
						console.log(data);
		      
						var obj = {
							cantidad : 1,
							codProd  : idProductos,
							producto : data.producto,
							moneda   : data.moneda,
							precio   : data.precioVenta,
							stock    : data.stock,
							dscto    : 0,
							importe  : 0,
							estado   : data.estadoProducto
						};
		               
						detalles.push(obj);
						listarDetallesVentas();

						$('#lista_productos_ventas_Modal').modal("hide");

						 }

                        else {

                        	  bootbox.alert(data.error);
                        }
                     
					}//fin success		

				});//fin de ajax
			
		  }// fin de funcion

  function listarDetallesVentas(){
  	$('#listProdVentas').html('');

  	var filas = "";
  	var subtotal = 0;
  	var total = 0;
    var subtotalFinal = 0;
  	var totalFinal = 0;
  	var iva = 12;
    var igv = (iva/100);

  	for(var i=0; i<detalles.length; i++){
		if(detalles[i].estado == 0){
       
            
            var importe = detalles[i].importe = detalles[i].cantidad * detalles[i].precio;

	  	    importe = detalles[i].importe = detalles[i].importe - (detalles[i].importe * detalles[i].dscto/100);

		    var filas = filas + "<tr><td>"+(i+1)+"</td> <td name='producto[]'>"+detalles[i].producto+"</td> <td name='precio[]' id='precio[]'>"+detalles[i].moneda+" "+detalles[i].precio+"</td> <td>"+detalles[i].stock+"</td> <td> <input type='number' class='cantidad input-group-sm' name='cantidad[]' id='cantidad[]' onClick='setCantidadAjax(event, this, "+(i)+");' onKeyUp='setCantidadAjax(event, this, "+(i)+");' value='"+detalles[i].cantidad+"'> </td>  <td><input type='number' name='descuento[]' id='descuento[]' onClick='setDescuento(event, this, "+(i)+");' onKeyUp='setDescuento(event, this, "+(i)+");' value='"+detalles[i].dscto+"'></td> <td> <span name='importe[]' id='importe"+i+"'>"+detalles[i].moneda+" "+detalles[i].importe+"</span> </td> <td>  <button href='#' class='btn btn-danger btn-lg' role='button' onClick='eliminarProd(event, "+(i)+");' aria-pressed='true'><span> <i class='fas fa-backspace'></i> </span> </button></td>   </tr>";
		
			subtotal = subtotal + importe;

			 //concatenar para poner la moneda con el subtotal
            subtotalFinal = detalles[i].moneda+" "+subtotal;

            var CalIVA = (detalles[i].precio * detalles[i].cantidad)*igv;

            var TotalIVA = detalles[i].moneda+" "+CalIVA;

			var su = subtotal*igv;
            var or=parseFloat(su);
            var total= Math.round(or+subtotal);

              //concatenar para poner la moneda con el total
            totalFinal = detalles[i].moneda+" "+total;

		}//cierre if

	}//cierre for
	
	$('#listProdVentas').html(filas);

	//subtotal
	$('#subtotal').html(subtotalFinal);
	$('#subtotal_venta').html(subtotalFinal);

	//total
	$('#total').html(totalFinal);
	$('#total_venta').html(totalFinal);

	//IVA
	$('#Calculo').html(TotalIVA);
	$('#CalculoIVA').html(TotalIVA);

  }
  
  function setCantidad(event, obj, idx){
  	event.preventDefault();
  	detalles[idx].cantidad = parseInt(obj.value);
  	recalcular(idx);
  }

  function setCantidadAjax(event, obj, idx){
  	event.preventDefault();
  	var idProductos = detalles[idx].codProd;
  	var cantidad_vender = detalles[idx].cantidad = parseInt(obj.value);
    var stock = detalles[idx].stock;

       $.ajax({
         
         url:"../ajax/ventas.php?op=consulta_cantidad_venta",
         method:"POST",
         data:{idProductos:idProductos, cantidad_vender:cantidad_vender},
         dataType:"json",

         success:function(data){
            
              $("#resultados_ventas_ajax").html(data);

                 /*si la cantidad a vender es igual a cero o a vacio o si es mayor al stock entonces se desabilita el boton de enviar formulario y de agregar productos*/
	             if(cantidad_vender=="0" || isNaN(cantidad_vender)==true || cantidad_vender>stock){
	             
	             //si la cantidad es mayor al stock el borde se pone en rojo
	             $("#cantidad_"+idx).addClass("rojo");

	             //bloquea el boton "agregar producto"
	             $(".btn_producto").removeAttr("data-target");

	             //oculta el boton "registrar venta"
	             $("#btn_enviar").addClass("oculta_boton");               

	              } else {
                                            
                     // si la cantidad seleccionada es menor al stock entonces remueve la clase rojo
	              	 $("#cantidad_"+idx).removeClass("rojo");

	              	 //Desbloquea el boton "agregar producto"
	                 $(".btn_producto").attr({"data-target":"#lista_productos_ventas_Modal"});

                      //boton "enviar formulario"
	                 $("#btn_enviar").removeClass("oculta_boton");
	              }
         }

       })

  	recalcular(idx);
  }

  function setDescuento(event, obj, idx){
  	event.preventDefault();
  	detalles[idx].dscto = parseFloat(obj.value);
  	recalcular(idx);
  }
  	
  function recalcular(idx){
  	
  	console.log(detalles[idx].cantidad);
  	console.log((detalles[idx].cantidad * detalles[idx].precio));

       var importe =detalles[idx].importe = detalles[idx].cantidad * detalles[idx].precio;
	  	importe = detalles[idx].importe = detalles[idx].importe - (detalles[idx].importe * detalles[idx].dscto/100);
	   
	   importeFinal = detalles[idx].moneda+" "+importe;
	    
         $('#importe'+idx).html(importeFinal);

	  	calcularTotales();

  }

  function calcularTotales(){
  	
  	var subtotal = 0;
  	var total = 0;
    var subtotalFinal = 0;
  	var totalFinal = 0;
    var iva = 12;
    var igv = (iva/100);

	for(var i=0; i<detalles.length; i++){
  		if( detalles[i].estado == 0 ){
			subtotal = subtotal + (detalles[i].cantidad * detalles[i].precio) - (detalles[i].cantidad*detalles[i].precio*detalles[i].dscto/100);
		
            //concatenar para poner la moneda con el subtotal
            subtotalFinal = detalles[i].moneda+" "+subtotal;

            var CalIVA = (detalles[i].precio * detalles[i].cantidad)*igv;

            var TotalIVA = detalles[i].moneda+" "+CalIVA;

            var su = subtotal*igv;
            var or=parseFloat(su);
            var total = Math.round(or+subtotal);

            //concatenar para poner la moneda con el total
            totalFinal = detalles[i].moneda+" "+total;
		}
	}

	//subtotal
	$('#subtotal').html(subtotalFinal);
	$('#subtotal_venta').html(subtotalFinal);

	//total
	$('#total').html(totalFinal);
	$('#total_venta').html(totalFinal);

	//IVA
	$('#Calculo').html(TotalIVA);
	$('#CalculoIVA').html(TotalIVA);
  }


  	function  eliminarProd(event, idx){
  		event.preventDefault();
  		console.log('ELIMINAR Eyter');
  		detalles[idx].estado = 1;

  	    $("#cantidad_"+idx).val(1);

  		listarDetallesVentas();
  	}

 function registrarVenta(){
    
    var numero_venta = $("#numero_venta").val();
    
    var nombreCliente = $("#nombreCliente").val();
    var apellidoCliente = $("#apellidoCliente").val();
    var direccionCliente = $("#direccionCliente").val();
    var nit = $("#nit").val();

     var Vendedor = $("#Vendedor").html();
    var total = $("#total").html();
   
    var idTipoPago = $("#idTipoPago").val();
    var tipoProducto = $("#tipoProducto").val();
    var idUsuario = $("#idUsuario").val();
    var idCliente = $("#idCliente").val();


    //validacion, si los campos de cliente estan vacios entonces no se envia el formulario

    if(nit!="" && nombreCliente!="" && apellidoCliente!="" && direccionCliente!="" && idTipoPago!="" && tipoProducto!="" && detalles!=""){

     console.log('HOLA');
    
    $.ajax({
		url:"../ajax/producto.php?op=registrar_venta",
		method:"POST",
		data:{'arrayVenta':JSON.stringify(detalles), 
				'numero_venta':numero_venta,
				'nombreCliente':nombreCliente,
				'apellidoCliente':apellidoCliente,
				'direccionCliente':direccionCliente,
				'nit':nit, 
				'total':total, 
				'idTipoPago':idTipoPago,
				'tipoProducto':tipoProducto, 
				'Vendedor':Vendedor, 
				'idUsuario':idUsuario,
				'idCliente':idCliente},
				
		cache: false,
		dataType:"html",
		error:function(x,y,z){
			console.log(x);
			console.log(y);
			console.log(z);
		},
         	
		success:function(data){

			var nit = $("#nit").val("");
		    var nombreCliente = $("#nombreCliente").val("");
            var apellidoCliente = $("#apellidoCliente").val("");
		    var direccionCliente = $("#direccionCliente").val("");   
            
            //console.log(tipoProducto);
            //alert(tipoProducto);

            detalles = [];
            $('#listProdVentas').html('');
            
          setTimeout ("bootbox.alert('Se ha registrado la venta con éxito');", 100); 
          
          setTimeout ("explode();", 2000); 
         	
		}

	});	

	 //cierre del condicional de validacion de los campos del cliente

	 } else{

	 	 bootbox.alert("Debe agregar un producto, los campos del cliente y el tipo de pago");
	 	 return false;
	 } 	
	
  }

   /*Refresca la pagina al registrar la venta*/
       function explode(){

	    location.reload();
}


 function eliminar(idProductos){

   
	    bootbox.confirm("¿Está Seguro de eliminar el producto?", function(result){
		if(result)
		{

				$.ajax({
					url:"../ajax/Producto.php?op=eliminar_producto",
					method:"POST",
					data:{idProductos:idProductos},

					success:function(data)
					{
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#producto_data").DataTable().ajax.reload();
					}
				});

		      }

		 });


   }




 init();


