$(document).ready(() => {
	$("#d-guardar").on('click', save_doc);
	$("#clear").on('click', () => {
		$("#form-reg-doc input:not(input[type='button'])").each((indx, elem) => {
			$(elem).val("");
			retun_to_normal();
		});
	});
	$("#d-pass").on('input', retun_to_normal);
	$("#d-pass-conf").on('input', retun_to_normal);
});

function save_doc() {
	if (check_no_blanks() == 0) {
		if (check_same_pass2()) {
			let datos = $("#form-reg-doc").serialize();
			ajax_register_doc(datos);
		}
	}
}

function check_no_blanks() {
	let cont = 0;
	$("#form-reg-doc input").each((indx, elem) => {
		if ($(elem).val().length == 0) {
			cont++;
		}
	});
	if (cont > 0) {
		alert(`Para registrar docente:\nLlene ${cont} campos vacios en el apartado 'Registrar Docente'`);
	}
	return cont;
}

function check_same_pass2() {
	let status = true;
	let d_pass = $("#d-pass").val();
	let d_pass_conf = $("#d-pass-conf").val();
	if (d_pass_conf != d_pass) {
		$("#d-pass").addClass("err");
		$("#d-pass-conf").addClass("err");
		alert("No coinciden las contraseñas");
		status = false;
		return status;
	}
	return status;
}

function retun_to_normal() {
	$("#d-pass").removeClass("err");
	$("#d-pass-conf").removeClass("err");
}

function ajax_register_doc(datos) {
	let ajax = $.ajax({
		url: "./phps/register-doc.php",
		method: "post",
		data: datos,
		dataType: "json"
	});

	ajax.done(function(respuesta) {
		if (respuesta.res != "fail") {
			$("#clear").trigger("click");
			alert(`Docente registrado exitosamente!\nID DOCENTE: ${respuesta.id}`);
		} else {
			alert("Fallo al registrar nuevo docente!");
		}
	});

	ajax.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}