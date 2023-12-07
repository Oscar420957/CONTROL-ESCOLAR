$(document).ready(() => {
	$("#al-guardar").on('click', save_alu);
	$("#al-clear").on('click', () => {
		$("#form-reg-alu input:not(input[type='button'],input[value='Universidad'])").each((indx, elem) => {
			$(elem).val("");
			back_to_normal();
		});
	});
	$("#al-pass").on('input', back_to_normal);
	$("#al-pass-conf").on('input', back_to_normal);
});

function save_alu() {
	if (verify_no_blanks() == 0) {
		if (check_same_passTwo()) {
			let datos = $("#form-reg-alu").serialize();
			datos += `&al-niv-e=${$("#al-niv-e").attr("data-val")}`;
			ajax_register_alu(datos);
		}
	}
}

function verify_no_blanks() {
	let cont = 0;
	$("#form-reg-alu input").each((indx, elem) => {
		if ($(elem).val().length == 0) {
			cont++;
		}
	});
	if (cont > 0) {
		alert(`Para registrar alumno:\nLlene ${cont} campos vacios en el apartado 'Registrar Alumno'`);
	}
	return cont;
}

function check_same_passTwo() {
	let status = true;
	let d_pass = $("#al-pass").val();
	let d_pass_conf = $("#al-pass-conf").val();
	if (d_pass_conf != d_pass) {
		$("#al-pass").addClass("err");
		$("#al-pass-conf").addClass("err");
		alert("No coinciden las contraseñas");
		status = false;
		return status;
	}
	return status;
}

function back_to_normal() {
	$("#al-pass").removeClass("err");
	$("#al-pass-conf").removeClass("err");
}

function ajax_register_alu(datos) {
	let ajax = $.ajax({
		url: "./phps/register-alu.php",
		method: "post",
		data: datos,
		dataType: "json"
	});

	ajax.done(function(respuesta) {
		if (respuesta.res != "fail") {
			$("#al-clear").trigger("click");
			alert(`Alumno registrado exitosamente!\nID ALUMNO: ${respuesta.id}`);
		} else {
			alert("Fallo al registrar nuevo alumno!");
		}
	});

	ajax.fail(function(jqXHR, status, error) {
		console.log(jqXHR, status, error);
	});
}