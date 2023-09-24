<?php 

session_start();

$user = $_POST['user'];
$pass = $_POST['password'];
$userType = $_POST['user-type'];

$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

switch ($userType) {
	case 'alumno':
		$query = "select password from acceso_alumno where id_Alumno = $user";
		break;
	case 'docente':
		$query = "select password from acceso_docente where id_Docente = $user";
		break;
	case 'admin':
		$query = "select password from acceso_admin where id_Admin = $user";
		break;
}

$result = $conn->query($query);
$encontrado = false;

while ($field = $result->fetch_object()) {
	$encontrado = true;
	if ($field->password == $pass) {
		$_SESSION['usersession'] = $user;
		echo json_encode(array("val" => "pass"));
	} else {
		echo json_encode(array("val" => "fail"));
	}
}

if ($encontrado == false) {
	echo json_encode(array("val" => "notfound"));
}

mysqli_close($conn);

?>