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
			crear_boton_as_alum(i[c].id_alumno, c);
			c++;
		}
	}

	boton_fecha_guardar($("#div-scroll-alum").children().length / 5);
}

function boton_fecha_guardar(gr) {
	let year = new Date().getFullYear();
	let month = new Date().getMonth() + 1;
	let day = new Date().getDate();

	if (month >= 1 && month <= 9) month = `0${month}`;
	if (day >= 1 && day <= 9) day = `0${day}`;

	let fecha = $(`<input type='date' name='fechaAs' id='date' style='grid-row: ${gr+1}' class='date' value='${year}-${month}-${day}'>`);
	let guardar = $(`<input type='button' name='guardarAs' id='gAsis' value='Guardar' class='save_as' style='grid-row: ${gr+1}'>`);

	guardar.on('click', () => {
		let alumnos = $("#div-scroll-alum div");
		let materia = $("#div-scroll-g-m .active");
		let id_mat = materia[0].id.split("-")[1];
		let idsAlumnos  = [];
		for (let i of alumnos) {
			idsAlumnos.push(i.id);
		}
		console.log($("#date").attr("value"));
		check_all_radio(idsAlumnos, id_mat, $("#date").attr("value"));
	});

	fecha.on('change', (elem) => {
		let val = $(elem.target).val();
		$("#date").attr("value",val);
	});
	$("#div-scroll-alum").append(fecha, guardar);
}

function crear_boton_as_alum(idAlu, row) {
	let si = $(`<input type='radio' class='uno' name ='${idAlu}' data-id-al='${idAlu}' value='Presente' style='grid-column: 2; grid-row: ${row}; width: 1.5rem'>`);
	let no = $(`<input type='radio' class='uno' name ='${idAlu}' data-id-al='${idAlu}' value='Ausente' style='grid-column: 3; grid-row: ${row}; width: 1.5rem'>`);
	let siLabel = $(`<label for='${idAlu}' style='grid-column: 2; grid-row: ${row}; height: fit-content; width: fit-content'>Presente</label>`);
	let noLabel = $(`<label for='${idAlu}' style='grid-column: 3; grid-row: ${row}; height: fit-content; width: fit-content'>Ausente</label>`);
	$("#div-scroll-alum").append(si, siLabel, no, noLabel);
}