let id_docente = $("#id_docente").val();
let grupo_mat = $("#grupo-mat");
let alums = $("#alums");

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
		let div = $(`<div id='${i[c].id_grupo}${i[c].id_materia}'></div>`);
		div.html(`Grupo: ${i[c].grupo} Materia: ${i[c].materia}`);
		div.addClass("divgrupo");
		grupo_mat.append(div);

		div.on("click", () => {
			alums.empty();
			llenar_alumnos(respuesta, 1);
		});
		c++;
	}
}

function llenar_alumnos(respuesta, idGrupo) {
	let arr2 = respuesta.arr2;

	let c = 1;
	for (let i of arr2) {
		let div = $(`<div id='${i[c].id_alumno}'></div>`);
		div.html(`${i[c].nomAlum}`);
		div.addClass("divalum");
		alums.append(div);
		c++;
	}
}