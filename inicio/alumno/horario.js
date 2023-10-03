let user = $("#user").val();
let ajax = $.ajax({
			url: "horarios.php", // Lee la url de action del form
			method: "post", // Lee el metodo a usar del form
			data: {"user" : user}, // Variable con los datos serializados
			dataType: "json" // Tipo de datos que le pasamos en data
		});
ajax.done(function(respuesta)
{
		
})