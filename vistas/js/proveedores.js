var tabla;

var tabla_en_compras;

function init(){
	
	listar();

    listar_en_compras();

	$("#proveedor_form").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
    
	$("#add_button").click(function(){
			
			$(".modal-title").text("Agregar Proveedor");
		
	  });
	
}


function limpiar()
{
	/*IMPORTANTE NO LIMPIAR EL id Usuario o no se registrara el proveedor*/
	$('#nombreProveedor').val("");
	$('#contacto').val("");
	$('#telefonoContacto').val("");
	$('#nit').val("");
	$('#telefonoProveedor').val("");
	$('#correo').val("");
	$('#direccion').val("");  
	$('#estado').val("");
	$('#idDepartamentoProveedor').val("");
	$('#idRegionProveedor').val("");
	$('#datepicker').val("");
	$('#nitProveedor').val("");
}

function listar()
{
	tabla=$('#proveedor_data').dataTable(
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
					url: '../ajax/Proveedor.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,
	    "order": [[ 0, "desc" ]],
	    
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

			   }
	       
	}).DataTable();
}

function mostrar(nitProveedor){
	$.post("../ajax/Proveedor.php?op=mostrar",{nitProveedor: nitProveedor}, function(data, status)
	{
		data = JSON.parse(data);

		   console.log(data);
	
				$('#proveedorModal').modal('show');
				$('#nombreProveedor').val(data.nombreProveedor);
				$('#contacto').val(data.contacto);
				$('#telefonoContacto').val(data.telefonoContacto);
				$('#nitProveedor').val(nitProveedor);
				$('#telefonoProveedor').val(data.telefonoProveedor);
				$('#correo').val(data.correo);
				$('#direccion').val(data.direccion);
				$('#estado').val(data.estado);
				$('#idDepartamentoProveedor').val(data.idDepartamentoProveedor);
				$('#idRegionProveedor').val(data.idRegionProveedor);
				$('.modal-title').text("Editar Proveedor");
				$('#nit').val(nitProveedor);
				//$('#datepicker').val(data.fechaInicioProveedor); 
				
	});
      
	}

function guardaryeditar(e)
{
	e.preventDefault(); 
		var formData = new FormData($("#proveedor_form")[0]);

		$.ajax({
			url: "../ajax/Proveedor.php?op=guardaryeditar",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(datos)
		    {                    
		         console.log(datos);

	            $('#proveedor_form')[0].reset();
				$('#proveedorModal').modal('hide');

				$('#resultados_ajax').html(datos);
				$('#proveedor_data').DataTable().ajax.reload();
				
                limpiar();
					
		    }

		});
       
}

   function cambiarEstado(idProveedor, est){

 		bootbox.confirm("¿Está Seguro de cambiar de estado?", function(result){
			if(result)
			{
				$.ajax({
					url:"../ajax/Proveedor.php?op=activarydesactivar",
					 method:"POST",
				
					data:{idProveedor:idProveedor, est:est},
					
					success: function(data){
	                 
	                  $('#proveedor_data').DataTable().ajax.reload();
				    }
				}); //ajax
			}
		 }); // bootbox
   }

     //Función Listar
function listar_en_compras(){

	tabla_en_compras=$('#lista_proveedores_data').dataTable(
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
					url: '../ajax/Proveedor.php?op=listar_en_compras',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 5,//Por cada 5 registros hace una paginación
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

 
 //AUTOCOMPLETAR DATOS DEL PROVEEDOR EN COMPRAS
	

	 	function agregar_registro(idProveedor,est){

      
		$.ajax({
			url:"../ajax/Proveedor.php?op=buscar_proveedor",
			method:"POST",
			data:{idProveedor:idProveedor,est:est},
			dataType:"json",
			success:function(data)
			{
				//alert(data);
               
	            /*si el proveedor esta activo entonces se ejecuta, de lo contrario 
	            el formulario no se envia y aparecerá un mensaje */
	            if(data.estado){

					$('#modalProveedor').modal('hide');
					$('#nit').val(data.nit);
					$('#nombreProveedor').val(data.nombreProveedor);
					$('#direccion').val(data.direccion);
					$('#idProveedor').val(idProveedor);
					

	            } else{
	                
	                bootbox.alert(data.error);

	             } //cierre condicional error
                        
			}
		});
	
    }


    function eliminar(idProveedor){
   
	    bootbox.confirm("¿Está Seguro de eliminar el proveedor?", function(result){
		if(result)
		{

				$.ajax({
					url:"../ajax/Proveedor.php?op=eliminar_proveedor",
					method:"POST",
					data:{idProveedor:idProveedor},

					success:function(data)
					{
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#proveedor_data").DataTable().ajax.reload();
					}
				});

		      }

		 });//bootbox

   }




init();