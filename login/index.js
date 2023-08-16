$(document).ready(
	$("#enter").click(function() {
		let form = $("#form-log"); // Obtiene el objeto form 
		let datos = form.serialize(); // Serializa los datos del form

		console.log(datos);

		// Prepara la peticion ajax
		let ajax = $.ajax({
			url: "check.php", // Lee la url de action del form
			method: form.prop("method"), // Lee el metodo a usar del form
			data: datos, // Variable con los datos serializados
			dataType: "json" // Tipo de datos que le pasamos en data
		});

		// Esta parte se ejecuta si no hay error en la peticion
		ajax.done(function(respuesta) {
			if (respuesta.val == "pass") {
				form.submit();
			} else {
				alert("Datos erroneos!");
			}
		});

		// Esta parte se ejecuta si hay un error
		ajax.fail(function(jqXHR, status) {
			alert("Hubo un error: " + status);
		});
	})
);