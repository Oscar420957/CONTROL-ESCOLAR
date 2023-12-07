$(document).ready(() => {
	$("#ad-guardar").on('click', save_adm);
	$("#ad-clear").on('click', () => {
		$("#form-reg-adm input:not(input[type='button'])").each((indx, elem) => {
			$(elem).val("");
			to_normal();
		});
	});
	$("#ad-pass").on('input', to_normal);
	$("#ad-pass-conf").on('input', to_normal);
});

function save_adm() {
	if (no_blanks() == 0) {
		if (check_same_passII()) {
			let datos = $("#form-reg-adm").serialize();
			console.log(datos);
			ajax_register_adm(datos);
		}
	}
}

function no_blanks() {
	let cont = 0;
	$("#form-reg-adm input").each((indx, elem) => {
		if ($(elem).val().length == 0) {
			cont++;
		}
	});
	if (cont > 0) {
		alert(`Para registrar administrativo:\nLlene ${cont} campos vacios en el apartado 'Registrar Administrativo'`);
	}
	return cont;
}

function check_same_passII() {
	let status = true;
	let d_pass = $("#ad-pass").val();
	let d_pass_conf = $("#ad-pass-conf").val();
	if (d_pass_conf != d_pass) {
		$("#ad-pass").addClass("err");
		$("#ad-pass-conf").addClass("err");
		alert("No coinciden las contraseñas");
		status = false;
		return status;
	}
	return status;
}

function to_normal() {
	$("#ad-pass").removeClass("err");
	$("#ad-pass-conf").removeClass("err");
}

function ajax_register_adm(datos) {
	let ajax = $.ajax({
		url: "./phps/register-adm.php",
		method: "post",
		data: datos,
		dataType: "json"
	});

	ajax.done(function(respuesta) {
		if (respuesta.res != "fail") {
			$("#ad-clear").trigger("click");
			alert(`Administrativo registrado exitosamente!\nID ADMINISTRATIVO: ${respuesta.id}`);
		} else {
			alert("Fallo al registrar nuevo administrativo!");
		}
	});

	ajax.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}