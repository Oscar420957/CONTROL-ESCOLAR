let id_docen = $("#id_docente").val();
let grupo_m = $("#div-scroll-g-m");

let ajax_grup = $.ajax({
	url: "./phps/asisGrupos.php",
	method: "post",
	data: {"id_docente" : id_docen},
	dataType: "json"
});

ajax_grup.done(function(respuesta) {
	llenar_grup(respuesta);
});

ajax_grup.fail(function(jqXHR, status) {
	console.log(jqXHR);
	console.log(status);
});

function llenar_grup(respuesta) {
	let arr1 = respuesta.arr1;

	let c = 1;
	for (let i of arr1) {
		let div = $(`<div id='${i[c].id_grupo}-${i[c].id_materia}'></div>`);
		div.html(`Grupo: ${i[c].grupo} Materia: ${i[c].materia}`);
		div.addClass("divgrupos");
		grupo_m.append(div);
		c++;
	}
	// ON CLICK de GRUPOS
	$(document).on('click', '.divgrupos', function() {
		$("#div-scroll-alum").empty();
		let grupoMat = $(this).attr('id');
		remove_class("divgrupos");
		$(`#${grupoMat}`).addClass("active");
		$("#div-scroll-alum").css("opacity","0");
		llenar_alum(respuesta, grupoMat.split('-')[0], grupoMat.split('-')[1]);
		$("#div-scroll-alum").css("opacity","1");

	});
}

function llenar_alum(respuesta, idGrupo, idMateria) {
	let arr2 = respuesta.arr2;

	let c = 1;
	for (let i of arr2) {
		if (i[c].idGrupAlum == idGrupo) {
			let div = $(`<div id='${i[c].id_alumno}'></div>`);
			div.html(`${i[c].nomAlum}`);
			div.addClass("divalums");
			div.css({"grid-column": "1",
					"align-self": "flex-start",
					"justify-self": "center"});
			$("#div-scroll-alum").append(div);
			c++;
		}
	}
}