<?php 

session_start();

$user = $_POST['user'];
$pass = $_POST['password'];

$conn = mysqli_connect("127.0.0.1","root","31delfinZYTO!","ceumh");


$query = "select pswd from accesoalumno where idAlumno = $user";
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