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
	$("#salir").on("click", () => window.location.assign("./phps/closeSession.php"));
});

let showInicio = () => {
	$("#v-inicio").css("display", "grid");
}
let showCalifs = () => {
	$("#v-califs").css("display", "grid");
}
let showLista = () => {
	$("#v-lista").css("display", "grid");
}
let showHorario = () => {
	$("#v-horario").css("display", "grid");
}

let offAll = () => {
	let divs = ["#v-inicio","#v-califs","#v-lista","#v-horario"];
	for (i of divs) {
		$(i).removeClass();
		$(i).css("display", "none");
	}
}

document.addEventListener("DOMContentLoaded", function () {
    const accordionItems = document.querySelectorAll(".accordion-item");

    accordionItems.forEach(function (item) {
        const header = item.querySelector(".accordion-header");

        header.addEventListener("click", function () {
            // Cierra todos los elementos del acordeón excepto el actual
            accordionItems.forEach(function (otherItem) {
                if (otherItem !== item) {
                    otherItem.classList.remove("active");
                }
            });
            item.classList.toggle("active");
        });
    });
});

