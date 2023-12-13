$(document).ready(() => {
	$("#docentes").on('click', fill_combos);

	$("#doc-to-bind-g").on('change',disable_4tris);
	$("#md-sav").on('click', bind_md);
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
		setTimeout(first,1000);
	});

	ajax_doc_mat.fail(function(jqXHR, status, error) {
		console.log(jqXHR,status,error);
	});
}

function fill_selects(datos, id) {
	let select = $(`#${id}`);
	let id_mat_doc = new Map();

	if (id == "doc-to-bind-g") {
		for (let i in datos) {
			let id_doc = i.split('-')[0] + `-${datos[i].split('|')[1]}`;
			let nom = datos[i].split('-')[0];
			let id_md = (datos[i].split('|')[0]).split('-')[1];

			if (!id_mat_doc.has(id_doc)) {
				id_mat_doc.set(id_doc, `${nom}_${id_md}`);
			} else {
				id_mat_doc.set(id_doc, (id_mat_doc.get(id_doc) + `-${id_md}`));
			}
		}

		for (let [k,v] of id_mat_doc) {
			let optgr = $(`<optgroup label='Cuatrimestre ${k.split('-')[1]}°'></optgroup>`);
			let opt = $(`<option value='${v.split('_')[1]}'></option>`);
			opt.text(`${k.split('-')[0]} - ${v.split('_')[0]}`);
			optgr.append(opt);
			select.append(optgr);
		}
	} else {
		let map4tri = new Map();
		
		for (let i in datos) {
			
			let cuatri = datos[i].split('-')[0];

			if (!map4tri.has(cuatri)) {
				let optgr = $(`<optgroup label='Cuatrimestre ${cuatri}°'></optgroup>`);
				let opt = $(`<option value='${i}'></option>`);
				opt.text(`Grupo: ${datos[i].split('-')[1]}`);
				optgr.append(opt);
				map4tri.set(cuatri, optgr);
			} else {
				let opt = $(`<option value='${i}'></option>`);
				opt.text(`Grupo: ${datos[i].split('-')[1]}`);
				map4tri.get(cuatri).append(opt);
			}
		}

		for (let [k,v] of map4tri) {
			select.append(v);
		}
	}
}

function disable_4tris(event) {
	let optgr = $("#gru-to-bind optgroup");

	optgr.each((indx,elem) => {
		$(elem).prop("disabled",true);
		$(elem).children().each((indx,innerE) => {
			$(innerE).prop("disabled",true);
		});
	});

	let cuatri;
	for (let i of event.target.options) {
		if (i.selected == true) {
			let l = i.parentNode.label;
			cuatri = l.substring(l.length-2, l.length-1);
		}
	}

	$(`#gru-to-bind optgroup[label='Cuatrimestre ${cuatri}°']`).each((indx,elem) => {
		$(elem).removeAttr("disabled");
		$(elem).children().each((indx,innerE) => {
			$(innerE).removeAttr("disabled");
		});
	});
}

function first() {
	let optgr = $("#gru-to-bind optgroup");
	optgr.each((indx,elem) => {
		$(elem).prop("disabled",true);
		$(elem).children().each((indx,innerE) => {
			$(innerE).prop("disabled",true);
		});
	});
	$("#doc-to-bind-g optgroup:first-child").each((indx,elem) => {
		let l = $(elem)[0].label;
    	let cuatri = l.substring(l.length-2, l.length-1);
	    $(`#gru-to-bind optgroup[label='Cuatrimestre ${cuatri}°']`).each((indx,elem) => {
			$(elem).removeAttr("disabled");
			$(elem).children().each((indx,innerE) => {
				$(innerE).removeAttr("disabled");
			});
		});
	});
}

function bind_md(event) {
	if ($("#doc-to-bind-g").val() == null) {/*!$($(event.target.form).children()[0]).children()[1].value*/
		alert("Sin docentes por asignar!");
		return;
	}

	if ($("#gru-to-bind").val() == null) {
		alert("Seleccione un grupo adecuado!");
		return;
	}

	let form = $("#form-cre-gru").serialize();

	let ajax_md = $.ajax({
		url: "./phps/bind_md.php",
		method: "post",
		data: form,
		dataType: "json"
	});

	ajax_md.done(function(respuesta) {
		if (respuesta.res == "success") {
			alert("Docente asignado al grupo correctamente!");
		} else if (respuesta.res == "fail") {
			alert("Ocurrio un error!");
			console.log(respuesta.errors);
		}

		$("#doc-to-bind-g").empty();
		$("#gru-to-bind").empty();
		fill_combos();
	});

	ajax_md.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}