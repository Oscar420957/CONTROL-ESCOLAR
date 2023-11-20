$(document).ready(() => {
	$('#guardar').on('click', function()
	{
		let calif = 0;
		let parcial = 0;
		let idTable = 0;
		$('#form-califs input[name="parcial"]').each((index, elem) => {
			if($(elem).prop('checked') == true)
			{
				calif = $(`#iC${index+1}`).val();
				parcial = index+1;
				idTable = $(`#iC${index+1}`).attr('data-idB');
			}
		});
		guardar_Calif(idTable, calif);
	});
});

function guardar_Calif(idTable, calif)
{
	//AJAX PARA ACTUALIZAR LA CALIFICACIÓN
		let ajax_calif = $.ajax({
			url: "./phps/guardarCalif.php",
			method: "post",
			data: {"id_tabla":idTable, "calif":calif},
			dataType: "json"
		});

		ajax_calif.done(function(respuesta)
		{
			if(respuesta.res == "La calificaión ha sido midificada")
			{
				alert(respuesta.res);
				console.log(respuesta.res);
			}
			else
			{
				alert(respuesta.res);
				console.log(respuesta.res);
			}
		});

		ajax_calif.fail(function(jqXHR, status) {
			console.log(jqXHR);
			console.log(status);
		});
}