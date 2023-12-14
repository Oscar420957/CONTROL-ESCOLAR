$(document).ready(() => {
	$("#docentes").on('click', fill_comboboxes);
	$("#mat-by-doc-sav").on('click', bind_mat_to_doc);
});

function fill_comboboxes() {
	$("#doc-to-bind").empty();
	$("#mat-to-bind").empty();

	let ajax_doc_mat = $.ajax({
		url: "./phps/docentes-mat.php",
		method: "post",
		dataType: "json"
	});

	ajax_doc_mat.done(function(respuesta) {
		fill_select(respuesta[0], "doc-to-bind");
		console.log(respuesta[1]);
		fill_select(respuesta[1], "mat-to-bind");
	});

	ajax_doc_mat.fail(function(jqXHR, status, error) {
		console.log(jqXHR,status,error);
	});
}

function fill_select(datos, id) {
	let select = $(`#${id}`);

	if (id == 'mat-to-bind') {
		let map_matCuatri = new Map();

		for (let i in datos) {
			let id_mat = i;
			let nom_mat = datos[i].split('-')[0];
			let cuatri = datos[i].split('-')[1];

			if (!map_matCuatri.has(cuatri)) {
				map_matCuatri.set(cuatri, new Map());
				map_matCuatri.get(cuatri).set(id_mat, nom_mat);
			} else {
				map_matCuatri.set(cuatri, map_matCuatri.get(cuatri).set(id_mat,nom_mat));
			}

			console.log(map_matCuatri);
		}

		for (let [k,v] of map_matCuatri) {
			let optgr = $(`<optgroup label='Cuatrimestre ${k}°'></optgroup>`);

			for (let [ki,vi] of v) {
				let opt = $(`<option value='${ki}'></option>`);
				opt.text(vi);
				optgr.append(opt);
			}

			select.append(optgr);
		}
	} else {
		for (let i in datos) {
			let opt = $(`<option value='${i}'></option>`);
			opt.html(datos[i]);

			select.append(opt);
		}
	}
}

function bind_mat_to_doc(event) {
	if ($("#doc-to-bind").val() == null) {/*!$($(event.target.form).children()[0]).children()[1].value*/
		alert("Sin docentes por asignar!");
		return;
	}

	if ($("#mat-to-bind").val() == null) {
		alert("Seleccione una materia adecuada!");
		return;
	}

	let form = $("#matgroup-by-docente").serialize();

	let ajax_mat_by_doc = $.ajax({
		url: "./phps/mat_by_doc.php",
		method: "post",
		data: form,
		dataType: "json"
	});

	ajax_mat_by_doc.done(function(respuesta) {
		if (respuesta.res == "success") {
			alert("Docente asignado a la materia correctamente!");
		} else if (respuesta.res == "fail") {
			alert("Ocurrio un error!");
		}

		$("#doc-to-bind").empty();
		$("#mat-to-bind").empty();
		fill_comboboxes();
	});

	ajax_mat_by_doc.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}