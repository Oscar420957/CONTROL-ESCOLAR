let user = $("#user").val();

let ajaxHorario = $.ajax({
			url: "./phps/horarios.php", // Lee la url de action del form
			method: "post", // Lee el metodo a usar del form
			data: {"user" : user}, // Variable con los datos serializados
			dataType: "json" // Tipo de datos que le pasamos en data
		});

ajaxHorario.done(function(respuesta) {
	let colors = ['red','orange','purple','lime','cyan','blue','yellow','brown','pink','crimson'];
	let mapColors = new Map();

	let cont = 1;
	for (let obj of respuesta) {
		let obj2 = JSON.parse(obj[cont]);
		let materia = obj2["nombre"];
		let dia = obj2["dia_semana"];
		let horario = obj2["horario"];
		let horas = horario.split("-");

		if (!mapColors.has(materia)) {
			mapColors.set(materia,colors.shift());
		}
		
		for (let h of horas) {
			let pairH = h.substring(0,2);
			$(`#${dia[0].toUpperCase()}${pairH}`).css("background",mapColors.get(materia));
		}
		cont++;
	}

	let tabla = $("<table>");
	tabla.attr("id", "tabla-materias");
	tabla.append($("<tr><th>MATERIAS</th></tr>"));
	for(let [i,j] of mapColors)
	{
		tabla.append($(`<tr><td style='background: ${j}'>${i}</td></tr>`));
	}

	$("#v-horario").append(tabla);		
});

ajaxHorario.fail(function(jqXHR, status) {
	console.log("error: ",jqXHR);
	console.log("status: ",status);
});