 
 var tabla;
 var tabla_en_compras;
 //Función que se ejecuta al inicio
function init(){
	
	/*listar();*/

	//llama la lista de productos en ventana modal en compras.php
	listar_en_compras();

	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	/*$("#producto_form").on("submit",function(e)
	{

		guardaryeditar(e);	
	})*/
    
    //cambia el titulo de la ventana modal cuando se da click al boton
	/*$("#add_button").click(function(){
			
			$(".modal-title").text("Agregar Producto");
		
	  });*/

}


//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del id_usuario, sino no se registra
el Producto*/
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
	
}

//Función Listar
/*function listar()
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
}*/

 //Mostrar datos de la categoria en la ventana modal 
/*function mostrar(idProductos)
{
	$.post("../ajax/Producto.php?op=mostrar",{idProductos : idProductos}, function(data, status)
	{
		data = JSON.parse(data);

		
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
				$('#estadoProducto').val(data.estadoProducto);
				$('#producto_uploaded_image').html(data.producto_imagen);
				$('#datepicker').val(data.fechaExpiracion);
				$('#nombreProveedor').val(data.nombreProveedor);
				$('.modal-title').text("Editar Producto");
				$('#idProductos').val(idProductos);
				$('#resultados_ajax').html(data);
				$('#producto_data').DataTable().ajax.reload();	
				
	});
        
}*/

/*
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
       
}*/


//EDITAR ESTADO DEl PRODUCTO
function cambiarEstado(idCategoria, idProductos, est){


 	bootbox.confirm("¿Está Seguro de cambiar de estado?", function(result){
		if(result)
		{

   
			$.ajax({
				url:"../ajax/Producto.php?op=activarydesactivar",
				 method:"POST",
				//data:dataString,
				//toma el valor del id y del estado
				data:{idCategoria:idCategoria,idProductos:idProductos,est:est},
				//cache: false,
				//dataType:"html",
				success: function(data){
                 
                  $('#producto_data').DataTable().ajax.reload();
			    
			    }

			});

		}

	});//bootbox

}

 //Función Listar
function listar_en_compras(){

	tabla_en_compras=$('#lista_productos_data').dataTable(
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
					url: '../ajax/Producto.php?op=listar_en_compras',
					type : "get",
					dataType : "json",						
					error: function(e){


						console.log(e.responseText);	
						console.log(datos);
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 8,//Por cada 3 registros hace una paginación
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



var detalles = [];
	
function agregarDetalle(idProductos, producto, estadoProducto){

		        $.ajax({
					url:"../ajax/Producto.php?op=buscar_producto",
					 method:"POST",

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
							codCat   : data.idCategoria,
							producto : data.producto,
							moneda   : data.moneda,
							precio   : data.precioCompra,
							stock    : data.stock,
							dscto    : 0,
							importe  : 0,
							estado   : data.estadoProducto
						};
		                
						detalles.push(obj);
						listarDetalles();

						$('#lista_productosModal').modal("hide");

                       }//if validacion id_producto

                        else {

                        	 //si el producto está inactivo entonces se muestra una ventana modal

                        	  bootbox.alert(data.error);
                        }
						
					}//fin success		

				});//fin de ajax
			
		    
		  }// fin de funcion


	function listarDetalles(){

  	  
	  	$('#listProdCompras').html('');

	  	var filas = "";
	  	var subtotal = 0;
	  	var total = 0;
	    var subtotalFinal = 0;
	  	var totalFinal = 0;
	  	var iva = 12;
	    var igv = (iva/100);


	  	 for(var i=0; i<detalles.length; i++){

			if( detalles[i].estado == 0){

		  	var importe = detalles[i].importe = detalles[i].cantidad * detalles[i].precio;
		  		
		  		importe = detalles[i].importe = detalles[i].importe - (detalles[i].importe * detalles[i].dscto/100);
				var filas = filas + "<tr><td>"+(i+1)+"</td> <td name='producto[]'>"+detalles[i].producto+"</td> <td name='precio[]' id='precio[]'>"+detalles[i].moneda+" "+detalles[i].precio+"</td> <td>"+detalles[i].stock+"</td> <td><input type='number' class='cantidad input-group-sm' name='cantidad[]' id='cantidad[]' onClick='setCantidad(event, this, "+(i)+");' onKeyUp='setCantidad(event, this, "+(i)+");' value='"+detalles[i].cantidad+"'></td>  <td><input type='number' name='descuento[]' id='descuento[]' onClick='setDescuento(event, this, "+(i)+");' onKeyUp='setDescuento(event, this, "+(i)+");' value='"+detalles[i].dscto+"'></td> <td> <span name='importe[]' id='importe"+i+"'>"+detalles[i].moneda+" "+detalles[i].importe+"</span> </td> <td>  <button href='#' class='btn btn-danger btn-sm' role='button' onClick='eliminarProd(event, "+(i)+");' aria-pressed='true'> <span><i class='fas fa-minus-circle' aria-hidden='true'></i> Quitar </span> </button></td> </tr>";
				subtotal = subtotal + importe;

			    //concatenar para poner la moneda con el subtotal
	            subtotalFinal = detalles[i].moneda+" "+subtotal;

				var su = subtotal*igv;
	            var or=parseFloat(su);

            var CalIVA = (detalles[i].precio * detalles[i].cantidad)*igv;
            var TotalIVA = detalles[i].moneda+" "+CalIVA;

	            var total= Math.round(or+subtotal);

	            //concatenar para poner la moneda con el total
	            totalFinal = detalles[i].moneda+" "+total;

			}

		}

	
		$('#listProdCompras').html(filas);

		//subtotal
		$('#subtotal').html(subtotalFinal);
		$('#subtotal_compra').html(subtotalFinal);

		//total
		$('#total').html(totalFinal);
		$('#total_compra').html(totalFinal);

		//IVA
		$('#Calculo').html(TotalIVA);
		$('#CalculoIVA').html(TotalIVA);
      
	}


  function setCantidad(event, obj, idx){
  	event.preventDefault();
  	detalles[idx].cantidad = parseInt(obj.value);
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

  	/*IMPORTANTE:porque cuando agregaba una segunda fila el importe se alteraba? El importe se modificaba por que olvidé restarle el descuento
Así que solo agregué esa resta a la operación*/

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
  		if(detalles[i].estado == 0){
			subtotal = subtotal + (detalles[i].cantidad * detalles[i].precio) - (detalles[i].cantidad*detalles[i].precio*detalles[i].dscto/100);
		    
		    //concatenar para poner la moneda con el subtotal
            subtotalFinal = detalles[i].moneda+" "+subtotal;

            var su = subtotal*igv;
            var or=parseFloat(su);
            var total = Math.round(or+subtotal);

            var CalIVA = (detalles[i].precio * detalles[i].cantidad)*igv;
            var TotalIVA = detalles[i].moneda+" "+CalIVA;

            //concatenar para poner la moneda con el total
            totalFinal = detalles[i].moneda+" "+total;

		}
	}

	//subtotal
	$('#subtotal').html(subtotalFinal);
	$('#subtotal_compra').html(subtotalFinal);

	//total
	$('#total').html(totalFinal);
	$('#total_compra').html(totalFinal);

	//IVA
	$('#Calculo').html(TotalIVA);
	$('#CalculoIVA').html(TotalIVA);
  }


  	function  eliminarProd(event, idx){
  		event.preventDefault();
  		detalles[idx].estado = 1;
  		listarDetalles();
  	}


  	function registrarCompra(){
    
    /*IMPORTANTE: se declaran las variables ya que se usan en el data, sino da error*/
    var numero_compra = $("#numero_compra").val();
    var nit = $("#nit").val();
    var nombreProveedor = $("#nombreProveedor").val();
    var direccion = $("#direccion").val();
    var total = $("#total").html();
    var contacto = $("#contacto").html();
    var idTipoPago = $("#idTipoPago").val();
    var tipoProducto = $("#tipoProducto").val();
    var idUsuario = $("#idUsuario").val();
    var idProveedor = $("#idProveedor").val();

    if(nit!="" && nombreProveedor!="" && direccion!="" && idTipoPago!="" &&idTipoPago!="" && detalles!=""){

     console.log('Hola');

    $.ajax({
		url:"../ajax/Producto.php?op=registrar_compra",
		method:"POST",
		data:{'arrayCompra':JSON.stringify(detalles), 'numero_compra':numero_compra,'nit':nit,'nombreProveedor':nombreProveedor,'direccion':direccion,'total':total,'contacto':contacto,'idTipoPago':idTipoPago,'tipoProducto':tipoProducto,'idUsuario':idUsuario,'idProveedor':idProveedor},
		cache: false,
		dataType:"html",
		error:function(x,y,z){
			console.log(x);
			console.log(y);
			console.log(z);
		},
         
			
		success:function(data){
	
			console.log(data);
		
			var nit = $("#nit").val("");
		    var nombreProveedor = $("#nombreProveedor").val("");
		    var direccion = $("#direccion").val("");
		    var subtotal = $("#subtotal").html("");
		    var total = $("#total").html("");
		   
            
            detalles = [];
            $('#listProdCompras').html('');

          setTimeout ("bootbox.alert('Se ha registrado la compra con éxito');", 100); 
          
          setTimeout ("explode();", 2000); 

         	
		}


	});	

	 //cierre del condicional de validacion de los campos del producto,proveedor,pago

	 } else{

	 	 bootbox.alert("Faltan campos por llenar, Verifique que haya seleccioando un proveedor, productos y tipo de pago");
	 	 return false;
	 } 	
	
  }

 /*RESFRESCA LA PAGINA DESPUES DE REGISTRAR LA COMPRA*/
       function explode(){

	    location.reload();
}

 function eliminar(idProductos){

   
	    bootbox.confirm("¿Está Seguro de eliminar el producto?", function(result){
		if(result)
		{

				$.ajax({
					url:"../ajax/producto.php?op=eliminar_producto",
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

		 });//bootbox


   }




 init();


