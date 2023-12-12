$(document).ready(() => {
	$("#docentes").on('click', fill_combos);
});

function fill_combos() {
	$("#doc-to-bind-g").empty();
	$("#gru-to-bind").empty();

	let ajax_doc_mat = $.ajax({
		url: "./phps/docentes-grup.php",
		method: "post",
		data: {"carrera":1},
		dataType: "json"
	});

	ajax_doc_mat.done(function(respuesta) {
		fill_selects(respuesta[0], "doc-to-bind-g");
		fill_selects(respuesta[1], "gru-to-bind");
	});

	ajax_doc_mat.fail(function(jqXHR, status, error) {
		console.log(jqXHR,status,error);
	});
}

function fill_selects(datos, id) {
	let select = $(`#${id}`);

	if (id == "doc-to-bind-g") {
		for (let i in datos) {
			let opt = $(`<option value='${datos[i].split('-')[1]}'></option>`);
			opt.html(datos[i].split('-')[0]);
			select.append(opt);
		}
	} else {
		for (let i in datos) {
			let opt = $(`<option value='${i}'></option>`);
			opt.text(`Grupo: ${datos[i].split('-')[1]} - Cuatrimestre: ${datos[i].split('-')[0]}`);
			select.append(opt);
		}
	}
}