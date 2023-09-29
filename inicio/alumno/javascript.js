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
	$("#v-inicio").css("display", "grid");
}
let showCalifs = () => {
	$("#v-califs").css("display", "grid");
	/*let usuario = $("#user").val();
	$.ajax({
		url: "consultaCalifs.php",
		method: "post",
		data: {"user": usuario}, 
		dataType: "json"
	});
	ajax.done(function(respuesta)
		{
			let acor = $("#acordeon");
			for(let i in respuesta)
			{
				let contenido = "<div class="accordion-item"><div class="accordion-header">Título 1</div><div id="parciales"><div class="accordion-content" id="FP">Primer parcial</div><div class="accordion-content" id="SP">Segundo parcial</div><div class="accordion-content" id="TP">Tercer parcial</div></div>";
				let div = $("<div> </div>").
			}
		});
	console.log(user);*/
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

