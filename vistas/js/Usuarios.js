

var tabla;

	//funcion que se ejecuta al inicio
	function init(){

		listar();
		//Cuando se le da click al boton submit se ejecuta la funcion guardaryeditar(e)
		$("#usuario_form").on("submit", function(e)
		{
			guardaryeditar(e);

		})

		//Cambia el titulo de la ventana modal cuando se le da click
		$("#add_button").click(function()
		{
			$(".modal-title").text("Agregar Usuario");
		});

		//MOSTRAR PERMISOS al agregar un nuevo usuario
		$.post("../ajax/Usuario.php?op=permisos&idUsuario=",function(r){
	        $("#permisos").html(r);
	 	});

	}


	function limpiar(){

		$('#numDocumento').val("");
		$('#nombreUsuario').val("");
		$('#apellidoUsuario').val("");
		$('#tipoDocumento').val("");
		$('#direccion').val("");
		$('#telefono').val("");
		$('#email').val("");
		$('#cargo').val("");
		$('#userName').val("");
		$('#password').val("");
		$('#password2').val("");
		//$('#imagen').val("");
		$('#usuario_imagen').val("");
		$('#estadoUsuario').val("");
		$('#idUsuario').val("");
		//limpia los checkbox
		$('input:checkbox').removeAttr('checked');		
	}


	function listar(){

		tabla=$('#usuario_data').dataTable({

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
						url: "../ajax/Usuario.php?op=listar",
						type: "GET",
						dataType: "json",
						error: function(e){
							console.log(e.responseText);
						}
				},

		"fixedHeader": true,
		"bDestroy": true,
		"responsive": true,
		"bInfo": true,
		"iDisplayLength": 5, //Por cada 5 registros hace una paginacion
		"order": [[ 0, "desc"]], //Ordenar (columna, orden)

		"language": {

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

	function mostrar(idUsuario){

		$.post("../ajax/Usuario.php?op=mostrar",{idUsuario : idUsuario}
			,function(data, status)
		{

			data = JSON.parse(data);

			$("#usuarioModal").modal("show"); 
			$('#nombreUsuario').val(data.nombreUsuario);
			$('#apellidoUsuario').val(data.apellidoUsuario);
			$('#tipoDocumento').val(data.tipoDocumento);
			$('#numDocumento').val(data.numDocumento);
			$('#direccion').val(data.direccion);
			$('#telefono').val(data.telefono);
			$('#email').val(data.email);
			$('#cargo').val(data.cargo);
			$('#userName').val(data.userName);
			$('#password').val(data.password);
			$('#password2').val(data.password2);
			$('#usuario_uploaded_image').html(data.usuario_imagen);
			$('#estadoUsuario').val(data.estadoUsuario);
			$('.modal-title').text("Editar Usuario");
			$('#idUsuario').val(idUsuario);
			//$('#action').val("Edit");
			
			$("#usuario_data").DataTable().ajax.reload();

		});

		$.post("../ajax/Usuario.php?op=permisos&idUsuario="+idUsuario,function(r){
	        $("#permisos").html(r);
	    });

	}

	//funcion guardaryeditar(e) se le llama cuando se le da Click al boton submit
	function guardaryeditar(e){

		e.preventDefault(); //No se activara la accion predeterminada del evento
		var formData = new FormData($("#usuario_form")[0]);

			var password = $("#password").val();
			var password2 = $("#password2").val();

			//si coinciden las password se envia el formulario
			if(password == password2){

				$.ajax({

					url: "../ajax/Usuario.php?op=guardaryeditar",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,

					//Se envian los datos si las password son iguales
					success: function(datos){

						console.log(datos);

						$('#usuario_form')[0].reset(); //limpian los campos
						$('#usuarioModal').modal('hide'); //oculta ventana modal
						//Muestra el mensaje de exito de envio de datos
						$('#resultado_ajax').html(datos); 
						$('#usuario_data').DataTable().ajax.reload(); //Recarga el Datatable

						limpiar();
					}

				});

			}	 //Cierre de la Validacion de password

			else{

				bootbox.alert("Las contraseñas son diferentes, intente de nuevo!");

			}	

	}

	// estado de Usuario y el Id Usuario se envian por post via ajax
	function cambiarEstado(idUsuario, est){

		bootbox.confirm("¿Estas seguro que deseas cambiar el estado?", 
			function(result){

			if(result){

				$.ajax({

					url:"../ajax/Usuario.php?op=activarydesactivar",
					method : "POST",

					data:{idUsuario:idUsuario, est:est},

					success : function(data){

						$('#usuario_data').DataTable().ajax.reload();

					}
				}); //Cierre de ajax
			}
		}); //bootbox

	}

	//ELIMINAR USUARIO
	 function eliminar(idUsuario){

	    bootbox.confirm("¿Está Seguro de eliminar el usuario?", function(result){
		if(result)
		{
				$.ajax({
					url:"../ajax/Usuario.php?op=eliminar_usuario",
					method:"POST",
					data:{idUsuario:idUsuario},

					success:function(data)
					{
						//alert(data);
						$("#resultado_ajax").html(data);
						$("#usuario_data").DataTable().ajax.reload();
					}
				});

		      }

		 });//bootbox

   }


init();