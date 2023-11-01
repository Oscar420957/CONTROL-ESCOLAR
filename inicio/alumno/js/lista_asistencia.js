let nav_mat = $('#nav-materias');
let info_asist = $('#info-asistencia');
let usuario = $('#user').val();

let ajaxLista = $.ajax({
	url: "./phps/lista-asistencia.php",
	method: "post",
	data: {"user": usuario},
	dataType: "json"
});

let arreglo_materias = [];
let info_pase_lista = {};

ajaxLista.done(function(respuesta) {
	let cont = 1;

	for (let i of respuesta) {
		let fila = JSON.parse(i[cont]);
		let materia = fila['materia'];

		if (!arreglo_materias.includes(materia)) {
			arreglo_materias.push(materia);
			info_pase_lista[materia] = [];
		}
		
		cont++;
	}

	llenar_lis(arreglo_materias); // Crea los elementos de la lista de materias

	for (let m = 0; m < arreglo_materias.length; m++) {
		let cont1 = 1;
		for (let s of respuesta) {
			let fila = JSON.parse(s[cont1]);
			let materia = fila['materia'];
			let fecha = fila['fecha'];
			let asistencia = fila['asistencia'] == 1 ? "Presente" : "Falta";

			if (materia == arreglo_materias[m]) {
				info_pase_lista[materia].push(fecha.substring(0,10), asistencia);
			}
			cont1++;
		}
	}

	for (let i of arreglo_materias) {
		$(`#${i.substring(0,2)}`).on('click', () => {
			$('#info-asistencia').empty();
			llenar_div(info_pase_lista, i);
		});
	}
	//console.log(arreglo_materias, info_pase_lista);
});

ajaxLista.fail(function(jqXHR, status) {
	console.log(jqXHR);
	console.log(status);
});

function llenar_lis(arreglo_mat) {
	for (let mat of arreglo_mat) {
		let li = $(`<li id='${mat.substring(0,2)}'></li>`);
		li.css("border","1px solid black");
		li.css("display","flex");
		li.css("align-items","center");
		li.css("height","100%");
		li.css("padding","0 1rem");
		li.css("cursor","pointer");
		li.html(mat);
		nav_mat.append(li);
	}
}

function llenar_div(obj, materia) {
	let div = $('<div></div>');
	div.css("background","lightgrey");
	div.css("border-radius","10px");
	div.css("padding","2rem");
	let texto = "";
	let contador = 0;
	for (let i = 0; i < obj[materia].length; i+=2) {
		texto += "Fecha: " + obj[materia][contador+0] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + obj[materia][contador+1] + "<br>";
		contador+=2;
	}
	div.html(texto);
	$('#info-asistencia').append(div);
}

