$(document).ready(() => {
	$("#inicio").on("click", () => {
		offAll();
		showInicio();
	});
	$("#califs").on("click", () => {
		offAll();
		showCalifs();
	});
	$("#lista").on("click", () => {
		offAll();
		showLista();
	});
	$("#horario").on("click", () => {
		offAll();
		showHorario();
	});
	$("#salir").on("click", () => window.location.assign("closeSession.php"));
});

let showInicio = () => {
	$("#v-inicio").removeClass("off");
	$("#v-inicio").addClass("app");
}
let showCalifs = () => {
	$("#v-califs").removeClass("off");
	$("#v-califs").addClass("app");
}
let showLista = () => {
	$("#v-lista").removeClass("off");
	$("#v-lista").addClass("app");
}
let showHorario = () => {
	$("#v-horario").removeClass("off");
	$("#v-horario").addClass("app");
}

let offAll = () => {
	let divs = ["#v-inicio","#v-califs","#v-lista","#v-horario"];
	for (i of divs) {
		$(i).removeClass();
		$(i).addClass("off");
	}
}