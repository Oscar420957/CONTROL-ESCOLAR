let id_doc = $("#id_docente").val();
let div_scroll_gm = $("#div-scroll-g-m");

let ajax_lista = $.ajax({
	url: "./phps/grupos.php",
	method: "post",
	data: {"id_docente" : id_doc},
	dataType: "json"
});

ajax_lista.done(function(respuesta) {
	fill_groups(respuesta);
});

ajax_lista.fail(function(jqXHR, status) {
	console.log(jqXHR);
	console.log(status);
});

function fill_groups(respuesta) {
	let arr1 = respuesta.arr1;

	let c = 1;
	for (let i of arr1) {
		let div = $(`<div id='L${i[c].id_grupo}_${i[c].id_materia}'></div>`);
		div.html(`Grupo: ${i[c].grupo} Materia: ${i[c].materia}`);
		div.addClass("divgrupo");
		div_scroll_gm.append(div);
		c++;
	}
	// ON CLICK de GRUPOS
	$(document).on('click', '.divgrupo', function() {
		$("#div-scroll-alum").empty();
		$("#form-lista").css("display","none");
		let grupoMat = $(this).attr('id');
		remove_class("divgrupo");
		$(`#L${grupoMat}`).addClass("active");
		$("#div-scroll-alum").css("opacity","0");
		fill_alumns(respuesta, grupoMat.split('_')[0], grupoMat.split('_')[1]);
		$("#div-scroll-alum").css("opacity","1");
	});
}

function fill_alumns(respuesta, idGrupo, idMateria) {
	let arr2 = respuesta.arr2;

	let c = 1;
	for (let i of arr2) {
		if (i[c].idGrupAlum == idGrupo) {
			let div = $(`<div id='L${i[c].id_alumno}'></div>`);
			div.html(`${i[c].nomAlum}`);
			div.addClass("divalum");
			$("#div-scroll-alum").append(div);
			c++;
		}
	}

	if (c != 1) { 
		// ON CLICK de ALUMNOS
		$(document).on('click', '.divalum', function() {
			let idAlum = $(this).attr('id');
			$("#id_alumno").val(idAlum);
			remove_class("divalum");
			$(`#L${idAlum}`).addClass("active");
			$("#form-lista").css("display","grid");
			
			// TODO crear funcion para registrar asistencia
		});
	}
}

function remove_class(clas) {
	$(`.${clas}`).each((indx, elem) => {
		$(elem).removeClass("active");
	});
}