var tabla;

var tabla_en_ventas;

//Función que se ejecuta al inicio
function init(){
	
	listar();

	//llama la lista de clientes en ventana modal en ventas.php
    listar_en_ventas();

	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#cliente_form").on("submit",function(e)
	{

		guardaryeditar(e);	
	})
    
    //cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function(){
			
			$(".modal-title").text("Agregar Cliente");
		
	 });

	
}

//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del idUsuario, sino no se registra
el cliente*/
function limpiar()
{
	
	$('#nit').val("");
	$('#nombreCliente').val("");
	$('#apellidoCliente').val("");
	$('#telefonoCliente').val("");
	$('#direccionCliente').val("");
	$('#CorreoCliente').val("");
	$('#estadoCliente').val("");
	$('#nitcliente').val("");
}


//Función Listar
function listar()
{
	tabla=$('#cliente_data').dataTable(
	{
		"aProcessing": true,
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf',
		            'print'
		        ],
		"ajax":
				{
					url: '../ajax/cliente.php?op=listar',
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


//Mostrar datos del cliente en la ventana modal 
function mostrar(nit)
{
	$.post("../ajax/cliente.php?op=mostrar",{nit : nit}, 
		function(data, status)
	{
		data = JSON.parse(data);

		 //alert(data.cedula);

		   console.log(data);
		
				$('#clienteModal').modal('show');
				$('#nitCliente').val(nit);
				$('#nombreCliente').val(data.nombreCliente);
				$('#apellidoCliente').val(data.apellidoCliente);
				$('#telefonoCliente').val(data.telefonoCliente);
				$('#direccionCliente').val(data.direccionCliente);
				$('#correoCliente').val(data.correoCliente);
				$('#estadoCliente').val(data.estadoCliente);
				$('.modal-title').text("Editar Cliente");
				$('#nit').val(nit);
			
				
		});
        
        
	}

	//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#cliente_form")[0]);


		$.ajax({
			url: "../ajax/cliente.php?op=guardaryeditar",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(datos)
		    {     
		         console.log(datos);

	            $('#cliente_form')[0].reset();
				$('#clienteModal').modal('hide');

				$('#resultado_ajax').html(datos);
				$('#cliente_data').DataTable().ajax.reload();
				
                limpiar();
					
		    }

		});
       
}


//EDITAR ESTADO DEL CLIENTE

    function cambiarEstado(idCliente, est){


 bootbox.confirm("¿Está Seguro de cambiar de estado?", function(result){
		if(result)
		{
   
			$.ajax({
				url:"../ajax/cliente.php?op=activarydesactivar",
				 method:"POST",
				//data:dataString,
				//toma el valor del id y del estado
				data:{idCliente:idCliente, est:est},
				//cache: false,
				//dataType:"html",
				success: function(data){
                 
                  $('#cliente_data').DataTable().ajax.reload();
			    
			    } //Cierre Success

			});

			 } //Cierre de if(result)

		 });//bootbox
   }


    //Función Listar
function listar_en_ventas(){

	tabla_en_ventas=$('#lista_clientes_data').dataTable(
	{
		"aProcessing": true,
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/Cliente.php?op=listar_en_ventas',
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


//AUTOCOMPLETAR DATOS DEL CLIENTE EN VENTAS
	

	 	function agregar_registro(idCliente,est){
      
			$.ajax({
				url:"../ajax/Cliente.php?op=buscar_cliente",
				method:"POST",
				data:{idCliente:idCliente, est:est},
				dataType:"json",
				success:function(data)
				{
	               
	             
	            /*si el cliente esta activo entonces se ejecuta, de lo contrario 
	            el formulario no se envia y aparecerá un mensaje */
	            if(data.estadoCliente){

					$('#modalCliente').modal('hide');
					$('#nit').val(data.nit);
					$('#nombreCliente').val(data.nombreCliente);
					$('#apellidoCliente').val(data.apellidoCliente);
					$('#direccionCliente').val(data.direccionCliente);
					$('#idCliente').val(idCliente);
					

	            } else{
	                
	                bootbox.alert(data.error);   	

	            } //cierre condicional error              
					
				}
			}) //Cierre de ajax
    }


    function eliminar(idCliente){

	  
	    bootbox.confirm("¿Está Seguro de eliminar el cliente?", function(result){
		if(result)
		{

				$.ajax({
					url:"../ajax/Cliente.php?op=eliminar_cliente",
					method:"POST",
					data:{idCliente:idCliente},

					success:function(data)
					{
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#cliente_data").DataTable().ajax.reload();
					}
				});

		      }

		 });//bootbox


   }





init();