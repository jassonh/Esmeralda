	

		$("#perfil_form").on("submit",function(e)
		{
			editar_perfil(e);
		});

	

	function mostrar_perfil(idUsuario_perfil){

		$.post("../ajax/Perfil.php?op=mostrar_perfil",
			{idUsuario_perfil : idUsuario_perfil},function(data, status)
		{

			data = JSON.parse(data);

			$("#perfilModal").modal("show"); 
			$('#nombre_perfil').val(data.nombreUsuario);
			$('#apellido_perfil').val(data.apellidoUsuario);
			$('#tipoDocumento_perfil').val(data.tipoDocumento);
			$('#numDocumento_perfil').val(data.numDocumento);
			$('#direccion_perfil').val(data.direccion);
			$('#telefono_perfil').val(data.telefono);
			$('#email_perfil').val(data.email);
			$('#userName_perfil').val(data.userName_perfil);
			$('#password_perfil').val(data.password);
			$('#password2_perfil').val(data.password2);
			$('#imagen_perfil').val(data.imagen);
			//$('#producto_uploaded_image').html(data.producto_imagen);
			$('.modal-title').text("Editar Perfil");
			$('#idUsuario_perfil').val(idUsuario_perfil);
			$('#action').val("Edit");
			$('#operation').val("Edit");

		});

	}


	function editar_perfil(e){

		e.preventDefault(); //No se activara la accion predeterminada del evento
		var formData = new FormData($("#perfil_form")[0]);

			var password = $("#password_perfil").val();
			var password2 = $("#password2_perfil").val();

			//si coinciden las password se envia el formulario
			if(password == password2){

				$.ajax({

					url: "../ajax/Perfil.php?op=editar_perfil",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,

					//Se envian los datos si las password son iguales
					success: function(datos){

						console.log(datos);

						//$('#perfil_form')[0].reset();
						$('#perfilModal').modal('hide'); //oculta ventana modal		
						//Muestra el mensaje de exito de envio de datos
						$('#resultados_ajax').html(datos); 
						//$('#usuario_data').DataTable().ajax.reload();
					}

				});

			}	 //Cierre de la Validacion de password
			else{

				bootbox.alert("Las contraseñas son diferentes, intente de nuevo!");
			}	

	}