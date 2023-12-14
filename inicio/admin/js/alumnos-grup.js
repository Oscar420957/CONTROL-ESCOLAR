$(document).ready(() => {
	$("#alumnos").on('click',ajax_gru_ctr);
	$("#ctri-alu").on('change',ajax_gru_ctr);
	$("#add-to-gru").on('click',add_to_group);
});

function ajax_gru_ctr() {
	erase_all();
	let cuatri = $("#ctri-alu").val();

	let ajax_to_fill = $.ajax({
		url: "./phps/alumnos-grup.php",
		method: "post",
		data: {"cuatri":cuatri},
		dataType: "json"
	});

	ajax_to_fill.done(function(respuesta) {
		fill_grupos(respuesta[1]);
		fill_alums(respuesta[0]);
	});

	ajax_to_fill.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}

function fill_grupos(datos) {
	let sel_grup = $("#gru-alu");

	for (let i in datos) {
		let opt = $(`<option value='${i}'></option>`);
		opt.text(`Grupo: ${datos[i].split('-')[1]}`);
		sel_grup.append(opt);
	}
}

function fill_alums(datos) {
	let divalums = $("#list-alu");
	let map_id_am = new Map();

	for (let i in datos) {
		let id_alu = i.split('-')[0];
		let nom_alu = datos[i].split('-')[0];
		let id_am = datos[i].split('-')[1];

		if (!map_id_am.has(id_alu)) {
			map_id_am.set(id_alu, nom_alu + `_${id_am}`);
		} else {
			map_id_am.set(id_alu, (map_id_am.get(id_alu) + `-${id_am}`));
		}
	}

	for (let [k,v] of map_id_am) {
		let div = $("<div class='innerdiv'></div>");
		div.text(v.split('_')[0]);

		let radio = $(`<input type='checkbox' class='radioAl' id='${k}' value='${v.split('_')[1]}'>`);
		divalums.append(radio);
		divalums.append(div);
	}
}

function erase_all() {
	$("#gru-alu").empty();
	$("#list-alu").empty();
}

function add_to_group() {
	let checkboxes = $("#list-alu input[type='checkbox']:checked");
	let cant = checkboxes.length;
	let arr_ids_am = [];
	let id_grupo = $("#gru-alu").val();

	let c = 0;
	checkboxes.each((indx,elem) => {
		arr_ids_am[c] = $(elem).val();
		c++;
	});

	if (cant == 0) {
		alert("Seleccione alumnos a agregar al grupo!");
		return;
	}

	let ajax_add_to_gr = $.ajax({
		url: "./phps/add-am-to-group.php",
		method: "post",
		data: {
			"num-to-add": cant,
			"ids_am": JSON.stringify(arr_ids_am),
			"id_grupo": id_grupo
		},
		dataType: "json"
	});

	ajax_add_to_gr.done(function(respuesta) {
		if (respuesta.res == "success") {
			alert("Alumnos asignados al grupo correctamente!");
			ajax_gru_ctr();
		}
	});

	ajax_add_to_gr.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}