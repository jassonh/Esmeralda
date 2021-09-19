		/*function init(){*/

		$("#empresa_form").on("submit", function(e)
		{
			editar_empresa(e);
		})
		/*}*/



	function mostrar_empresa(idUsuarioEmpresa){

	$.post("../ajax/empresa.php?op=empresa",{idUsuarioEmpresa : idUsuarioEmpresa}, function(data, status)
	{
		data = JSON.parse(data);
		        
		        //console.log(data);

				$('#empresaModal').modal('show');
				$('#idEmpresa').val(idEmpresa);
				$('#nombreEmpresa').val(data.nombreEmpresa);
				$('#nitEmpresa').val(data.nitEmpresa);
				$('#direccionEmpresa').val(data.direccionEmpresa);
				$('#telefonoEmpresa').val(data.telefonoEmpresa);
				$('#correoEmpresa').val(data.correoEmpresa);
				$('#horarioEmpresa').val(data.horarioEmpresa);
				
				$('.modal-title').text("Editar Empresa");
				$('#idUsuarioEmpresa').val(idUsuarioEmpresa);
				
				
		});
        
	}


	function editar_empresa(e)
	{
	e.preventDefault(); 
	var formData = new FormData($("#empresa_form")[0]);


		$.ajax({
			url: "../ajax/Empresa.php?op=editar_empresa",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(datos)
		    {                    

		    	//console.log(datos);
		         //alert(datos);

				$('#empresaModal').modal('hide');

				$("#resultados_ajax").html(datos);

					
		    }

		});

	}

//init();