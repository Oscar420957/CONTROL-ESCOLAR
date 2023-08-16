<?php 

session_start();

$user = $_POST['user'];
$pass = $_POST['password'];

$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");


$query = "select pswd from accesoAlumno where id_Alumno = $user";
$result = $conn->query($query);

while ($field = $result->fetch_object()) {
	if ($field->pswd == $pass) {
		$_SESSION['usersession'] = $user;
		echo json_encode(array("val" => "pass"));
	} else {
		echo json_encode(array("val" => "fail"));
	}
}

mysqli_close($conn);

?>