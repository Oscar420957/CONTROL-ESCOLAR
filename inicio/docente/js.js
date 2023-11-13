$(document).ready(() => {
	$("#inicio").on("click", () => {
		offAll();
		showInicio();
	});
	$("#califs").on("click", () => {
		offAll();
		showGrupos();
	});
	$("#lista").on("click", () => {
		offAll();
		showLista();
	});
	$("#horario").on("click", () => {
		offAll();
		showHorario();
	});
	$("#salir").on("click", () => window.location.assign("./phps/closeSession.php"));
});

let showInicio = () => {
	$("#v-inicio").css("display", "grid");
}
let showGrupos = () => {
	$("#v-grupos").css("display", "grid");
}
let showLista = () => {
	$("#v-lista").css("display", "grid");
}
let showHorario = () => {
	$("#v-horario").css("display", "grid");
}

let offAll = () => {
	let divs = ["#v-inicio","#v-grupos","#v-lista","#v-horario"];
	for (i of divs) {
		$(i).removeClass();
		$(i).css("display", "none");
		$("#alums").empty();
	}
}