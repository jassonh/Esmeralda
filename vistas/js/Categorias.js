
var tabla;

	//funcion que se ejecuta al inicio
	function init(){

		listar();
		//Cuando se le da click al boton submit se ejecuta la funcion guardaryeditar(e)
		$("#categoria_form").on("submit", function(e)
		{
			guardaryeditar(e);
		})

		//Cambia el titulo de la ventana modal cuando se le da click
		$("#add_button").click(function()
		{
			$(".modal-title").text("Agregar Categoria");
		});

	}

	//Funcion que limpia los campos, no se limpia el campo
	//idUsuario de la categoria o no se registra elusuario
	function limpiar(){

		$("#nombreCategoria").val("");
		$("#descripcion").val("");
		$("#estadoCategoria").val("");
		$("#idCategoria").val("");
	}


	//En esta funcion se crea la Datatable
	function listar(){

		tabla=$('#categoria_data').dataTable({

			"aProcessing": true, //Activamos el procedimiento datatables
			"aServerSide": true, //Paginacion y Filtrado realizados por el servicio
			dom: 'Bfrtip', //Definimos elementos de control de tabla

			buttons: [
							'copyHtml5',
							'excelHtml5',
							'csvHtml5',
							'pdf',
							'print'
					 ],

			"ajax":

					{
							url: "../ajax/Categoria.php?op=listar",
							type: "GET",
							dataType: "json",
							error: function(e){
								console.log(e.responseText);
							}
					},

				"bDestroy": true,
				"responsive": true,
				"bInfo": true,
				"iDisplayLength": 10, //Por cada 5 registros hace una paginacion
				"order": [[ 0, "desc"]], //Ordenar (columna, orden)

				"language": 
				{

						"sProcessing": 		"Procesando...",
						"sLengthMenu": 		"Mostrar _MENU_ registros",
						"sZeroRecords": 	"No se encontraron resultados",
						"sEmptyTable": 		"Ningun dato disponible en esta tabla",
						"sInfo": 			"Mostrando un total de _TOTAL_ registros",
						"sInfoEmpty": 		"Mostrando un total de 0 registros",
						"sInfoFiltered": 	"(filtrando de un total de _MAX_ registros)",
						"sInfoPostFix": 	"",
						"sSearch": 			"Buscar",
						"sUrl": 			"",
						"sInfoThousands": 	",",
						"sLoadingRecords": 	"Cargando...",

						"oPaginate": {

							"sFirst": 		"Primeros",
							"sLast": 		"Ultimo",
							"sNext": 		"Siguiente",
							"sPrevious": 	"Anterior"
							},

						"oAria": {

							"sSortAscending": ": Activar para ordenar columna ascendente",
							"sSortDescending": ": Activar para ordenar columna descendiente"
						}	

				}//Cerrar el language

		}).DataTable();
	}

	//Muestra los datos de la categoria en el Formulario
	function mostrar(idCategoria){

		$.post("../ajax/Categoria.php?op=mostrar",{idCategoria : idCategoria}
			,function(data, status)
		{

			data = JSON.parse(data);

			$("#categoriaModal").modal("show"); 
			$('#nombreCategoria').val(data.nombreCategoria);
			$('#descripcion').val(data.descripcion);
			$('#estadoCategoria').val(data.estadoCategoria);
			$('.modal-title').text("Editar Categoria");
			$('#idCategoria').val(idCategoria);
			$('#action').val("Edit");
			//$('#operation').val("Edit");

		});

	}


	// Se le llama cuando se le da Click al boton submit
	function guardaryeditar(e){

		e.preventDefault(); //No se activara la accion predeterminada del evento
		var formData = new FormData($("#categoria_form")[0]);


				$.ajax({

					url: "../ajax/Categoria.php?op=guardaryeditar",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,

					//Se envian los datos si las password son iguales
					success: function(datos){
						            
						            
						console.log(datos);

						$('#categoria_form')[0].reset(); //limpian los campos
						$('#categoriaModal').modal('hide'); //oculta ventana modal

						//Muestra el mensaje de exito de envio de datos
						$('#resultado_ajax').html(datos); 
						$('#categoria_data').DataTable().ajax.reload(); //Recarga el Datatable

						limpiar();
					}

				});

	}


	function cambiarEstado(idCategoria, est){

		bootbox.confirm("¿Estas seguro que deseas cambiar el estado?", 
			function(result){

			if(result){

				$.ajax({

					url:"../ajax/Categoria.php?op=activarydesactivar",
					method : "POST",

					data:{idCategoria:idCategoria, est:est},

					success : function(data){

						$('#categoria_data').DataTable().ajax.reload();

					}
				}); //Cierre de ajax
			}
		}); //bootbox

	}


		 function eliminar(idCategoria){

	    bootbox.confirm("¿Está Seguro de eliminar la categoría?", function(result){
		
		if(result)
		{

				$.ajax({
					url:"../ajax/Categoria.php?op=eliminar_categoria",
					method:"POST",
					data:{idCategoria:idCategoria},

					success:function(data)
					{
						$("#resultado_ajax").html(data);
						$("#categoria_data").DataTable().ajax.reload();
					}
				});

		      }

		 });//bootbox

   		}


init();