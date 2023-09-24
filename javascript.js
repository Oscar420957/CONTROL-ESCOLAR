let userType = $("#user-type");
let form = $("form");

function toAlumno() {
	userType.val("alumno");
	form.submit();
}

function toDocente() {
	userType.val("docente");
	form.submit();
}

function toAdmin() {
	userType.val("admin");
	form.submit();
}