var tabla;
var tabla_en_compras;
var tabla_compras_mes;

	function init(){

		listar();


	}

		//Función Listar
	function listar()
	{	
		tabla=$('#compras_data').dataTable(
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
						url: '../ajax/Compra.php?op=buscar_compras',
						type : "get",
						dataType : "json",						
						error: function(e){
							console.log(e.responseText);	
						}
					},
			"bDestroy": true,
			"responsive": true,
			"bInfo":true,
			"iDisplayLength": 8,//Por cada 8 registros hace una paginación
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


	//VER DETALLE PROVEEDOR-COMPRA
	 $(document).on('click', '.detalle', function(){

		var numero_compra = $(this).attr("id");

		$.ajax({
			url:"../ajax/Compra.php?op=ver_detalle_proveedor_compra",
			method:"POST",
			data:{numero_compra:numero_compra},
			cache:false,
			dataType:"json",
			success:function(data)

			{
				
				$("#proveedor").html(data.proveedor);
				$("#numero_compra").html(data.numero_compra);
				$("#nitProveedor").html(data.nitProveedor);
				$("#direccion").html(data.direccion);
				$("#fechaCompra").html(data.fechaCompra);
                 
				//alert(data);
				
			}
		})
	});


	 //VER DETALLE COMPRA
	 $(document).on('click', '.detalle', function(){
	 	
		var numero_compra = $(this).attr("id");

		$.ajax({

			url:"../ajax/Compra.php?op=ver_detalle_compra",
			method:"POST",
			data:{numero_compra:numero_compra},
			cache:false,
			success:function(data)
			{
				
				$("#detalles").html(data);
				
			}
		})
	});



	function cambiarEstado(idCompra, numero_compra, est){
    
    //alert(numero_compra);
    	
	bootbox.confirm("¿Estas seguro que quieres anular esta compra?", function(result){
		if(result)
		{


			$.ajax({
				url:"../ajax/Compra.php?op=cambiar_estado_compra",
				 method:"POST",
				
				data:{idCompra:idCompra,numero_compra:numero_compra, est:est},
				cache: false,
				
				success:function(data){
	              
	              //alert(data);
                 $('#compras_data').DataTable().ajax.reload();
                 
                 //refresca el datatable de compras por fecha
                 $('#compras_fecha_data').DataTable().ajax.reload();
	             
	              //refresca el datatable de compras por fecha - mes
                 $('#compras_fecha_mes_data').DataTable().ajax.reload();

				}

			});

		   } 

	  });//bootbox


	  }


	   //CONSULTA COMPRAS-FECHA
       $(document).on("click","#btn_compra_fecha", function(){

           	var fechaInicial= $("#datepicker").val();
           	var fechaFinal= $("#datepicker2").val();

        //validamos si existe las fechas entonces se ejecuta el ajax

        if(fechaInicial!="" && fechaFinal!=""){

	       // BUSCA LAS COMPRAS POR FECHA
	      tabla_en_compras= $('#compras_fecha_data').DataTable({

	    
	      	"aProcessing": true,
	      	"aServerSide": true,
	      	dom: 'Bfrtip',
	      	buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],

	         	"ajax":{
		            url:"../ajax/Compra.php?op=buscar_compras_fecha",
	                type : "post",
					
					data:{fechaInicial:fechaInicial,fechaFinal:fechaFinal},						
					error: function(e){
						console.log(e.responseText);

					},
	          
	          	},

	            "bDestroy": true,
				"responsive": true,
				"bInfo":true,
				"iDisplayLength": 10,//Por cada 10 registros hace una paginación
			    "order": [[ 0, "desc" ]],

	        "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando _TOTAL_ registros de un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			 
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

			}, //cerrando language

	      });

	    }//cerrando condicional de las fechas

	});


   	//FECHA COMPRA POR MES
    $(document).on("click","#btn_compra_fecha_mes", function(){

    var mes= $("#mes").val();
    var ano= $("#ano").val();

        //validamos si existe las fechas entonces se ejecuta el ajax
        if(mes!="" && ano!=""){

	       // BUSCA LAS COMPRAS POR FECHA
	      var tabla_compras_mes= $('#compras_fecha_mes_data').DataTable({
	        
	       "aProcessing": true,
	       "aServerSide": true,
	      dom: 'Bfrtip',
	      buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],

	         "ajax":{
	            url:"../ajax/Compra.php?op=buscar_compras_fecha_mes",
                type : "post",
				//dataType : "json",
				data:{mes:mes,ano:ano},						
				error: function(e){
					console.log(e.responseText);

				},

	          
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
			 
			    "sEmptyTable":     "Ningún dato disponible en este mes",
			 
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			 
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

			   }, //cerrando language

	      	});

	    }//cerrando condicional de las fechas

	});

init();