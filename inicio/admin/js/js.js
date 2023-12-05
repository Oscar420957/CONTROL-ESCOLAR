$(document).ready(() => {
	$("#inicio").on("click", () => {
		offAll();
		showInicio();
	});
	$("#iconos i").each((indx, elem) => {
		let nom = ["inicio","alumnos","docentes","admins","materias","salir"];
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
	$("#horario").on("click", () => {
		offAll();
		showMaterias();
	});
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
let showMaterias = () => {
	$("#v-materias").css("display", "grid");
}
let showHorario = () => {
	$("#v-horario").css("display", "grid");
}

let offAll = () => {
	let divs = ["#v-inicio","#v-alumnos","#v-docentes","#v-admins","#v-materias"];
	for (i of divs) {
		$(i).removeClass();
		$(i).css("display", "none");
		$("#alums").empty();
		$("#div-scroll-alum").empty();
		$("#alums").css("opacity","0");
		$("#div-scroll-alum").css("opacity","0");
		$("#form-califs").css("display","none");
		$(".divgrupo").each((i,e)=>{$(e).removeClass("active")});
		$(".divgrupos").each((i,e)=>{$(e).removeClass("active")});
	}
}