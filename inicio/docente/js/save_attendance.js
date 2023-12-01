function check_all_radio(ids, idMat, fecha) {
	let allChecked = true;
	let asistencias = new Map();

	for (let id of ids) {
		let radioAlumno = false;
		$(`input[name='${id}']`).each((indx, elem) => {
			if ($(elem).prop('checked') == true) {
				radioAlumno = true;
				asistencias.set(id, $(elem).val());
			}
		});
		allChecked = allChecked && radioAlumno;
	}

	if (allChecked) {
		// Funcion de guardad asistencia
		for (let [idA, asistencia] of asistencias) {
			save_asistencia(idMat, idA, asistencia, fecha);
		}
	} else {
		alert("Seleccione asistencia para todos los alumnos");
	}
}

function save_asistencia(id_materia, id_alumno, asistencia, fecha) {
	let ajax_registrar_asisten = $.ajax({
		url: "./phps/guardarAsistencia.php",
		method: "post",
		data: {"id_materia":id_materia, "id_alumno":id_alumno, "asistencia":asistencia, "fecha":fecha},
		dataType: "json"
	});

	ajax_registrar_asisten.done(function(respuesta) {
		if(respuesta.res == "guardado") {
			alert("¡Se guardaron los datos exitosamente!");
		} else {
			console.log("Ocurrio un error");
		}
	});

	ajax_registrar_asisten.fail(function(jqXHR, status) {
		console.log(jqXHR, status);
	});
}