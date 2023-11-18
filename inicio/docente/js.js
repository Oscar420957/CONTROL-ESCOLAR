$(document).ready(() => {
	$("#inicio").on("click", () => {
		offAll();
		showInicio();
	});
	$("#iconos i").each((indx, elem) => {
		let nom = ["inicio","califs","lista","horario","salir"];
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