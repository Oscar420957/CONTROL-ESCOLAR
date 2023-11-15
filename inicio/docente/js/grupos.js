let id_docente = $("#id_docente").val();
let grupo_mat = $("#grupo-mat");

let ajax_grupos = $.ajax({
	url: "./phps/grupos.php",
	method: "post",
	data: {"id_docente" : id_docente},
	dataType: "json"
});

ajax_grupos.done(function(respuesta) {
	llenar_grupos(respuesta);
});

ajax_grupos.fail(function(jqXHR, status) {
	console.log(jqXHR);
	console.log(status);
});

function llenar_grupos(respuesta) {
	let arr1 = respuesta.arr1;

	let c = 1;
	for (let i of arr1) {
		let div = $(`<div id='${i[c].id_grupo}_${i[c].id_materia}'></div>`);
		div.html(`Grupo: ${i[c].grupo} Materia: ${i[c].materia}`);
		div.addClass("divgrupo");
		grupo_mat.append(div);
		c++;
	}

	// ON CLICK de GRUPOS
	$(document).on('click', '.divgrupo', function() {
		$("#alums").empty();
		$("#iC1").val("");
		$("#iC2").val("");
		$("#iC3").val("");
		let grupoMat = $(this).attr('id');
		remove_class("divgrupo");
		$(`#${grupoMat}`).addClass("active");
		llenar_alumnos(respuesta, grupoMat.split('_')[0], grupoMat.split('_')[1]);
	});
}

function llenar_alumnos(respuesta, idGrupo, idMateria) {
	let arr2 = respuesta.arr2;

	let c = 1;
	for (let i of arr2) {
		if (i[c].idGrupAlum == idGrupo) {
			let div = $(`<div id='${i[c].id_alumno}'></div>`);
			div.html(`${i[c].nomAlum}`);
			div.addClass("divalum");
			$("#alums").append(div);
			c++;
		}
	}

	if (c != 1) { 
		// ON CLICK de ALUMNOS
		$(document).on('click', '.divalum', function() {
			let idAlum = $(this).attr('id');
			$("#id_alumno").val(idAlum);
			remove_class("divalum");
			$(`#${idAlum}`).addClass("active");
			
			ver_calif_alum(idAlum, idMateria);
		});
	}
}


function ver_calif_alum(id, materia) {
	let ajax_alum = $.ajax({
		url: "./phps/califAlum.php",
		method: "post",
		data: {"id_alumno":id,"id_materia":materia},
		dataType: "json"
	});

	ajax_alum.done(function(respuesta) {
		if (respuesta.length != 0) {
			$("#iC1").val((respuesta[1] == -1) ? "0.0" : respuesta[1]);
			$("#iC2").val((respuesta[4] == -1) ? "0.0" : respuesta[4]);
			$("#iC3").val((respuesta[7] == -1) ? "0.0" : respuesta[7]);
		} else {
			$("#iC1").val("0.0");
			$("#iC2").val("0.0");
			$("#iC3").val("0.0");
		}
	});

	ajax_alum.fail(function(jqXHR, status) {
		console.log(jqXHR);
		console.log(status);
	});
}


function remove_class(clas) {
	$(`.${clas}`).each((indx, elem) => {
		$(elem).removeClass("active");
	});
}