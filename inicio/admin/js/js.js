$(document).ready(() => {
	check_super_admin();
	$("#inicio").on("click", () => {
		offAll();
		showInicio();
	});
	$("#iconos i").each((indx, elem) => {
		let nom = ["inicio","alumnos","docentes","admins"/*,"materias"*/,"salir"];
		$(elem).on("mouseover", () => {
			$(`#t-${nom[indx]}`).css({
				"opacity":"1",
				"visibility":"visible"
			});
		});
		$(elem).on("mouseout", () => {
			$(`#t-${nom[indx]}`).css({
				"opacity":"0",
				"visibility":"hidden"
			});	
		});
	});
	$("#alumnos").on("click", () => {
		offAll();
		showAlumnos();
	});
	$("#docentes").on("click", () => {
		offAll();
		showDocentes();
	});
	$("#admins").on("click", () => {
		offAll();
		showAdmins();
	});
	/*$("#horario").on("click", () => {
		offAll();
		showMaterias();
	});*/
	$("#salir").on("click", () => window.location.assign("./phps/closeSession.php"));
});

let showInicio = () => {
	$("#v-inicio").css("display", "grid");
}
let showAlumnos = () => {
	$("#v-alumnos").css("display", "grid");
}
let showDocentes = () => {
	$("#v-docentes").css("display", "grid");
}
let showAdmins = () => {
	$("#v-admins").css("display", "grid");
}
/*let showMaterias = () => {
	$("#v-materias").css("display", "grid");
}*/
let showHorario = () => {
	$("#v-horario").css("display", "grid");
}

let offAll = () => {
	let divs = ["#v-inicio","#v-alumnos","#v-docentes","#v-admins"/*,"#v-materias"*/];
	for (i of divs) {
		$(i).removeClass();
		$(i).css("display", "none");
	}
}

function check_super_admin() {
	if ($("#super").val() == 0) {
		$("#admins").css("display","none");
		$("#t-inicio").css("top","7% !important");
		$("#t-alumnos").css("top","33% !important");
		$("#t-docentes").css("top","60% !important");
		$("#t-salir").css("top","87% !important");
	}
}