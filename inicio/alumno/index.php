<?php 
	ini_set('session.gc_maxlifetime', 60); 
	ini_set('session.cookie_maxlifetime', 60); 

	session_start();

	if (!isset($_SESSION['usersession'])) {
		header('Location: ../../');
	}

	$user = $_SESSION['usersession'];

	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	$query = "select nombre from alumnos where id_alumno = ".$user;

	$result = $conn->query($query);

	while($row = $result->fetch_object()) {
		$nom_alu = $row->nombre;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>alumno</title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="icon" href="./img/logo_octagon_short.png">
	<script src="https://kit.fontawesome.com/b32a76d93a.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
	<div id="container">
		<nav id="menu">
			<ul>
				<li><i class="fa-solid fa-house" id="inicio"></i></li>
				<li><i class="fa-solid fa-book" id="califs"></i></li>
				<li><i class="fa-solid fa-check" id="lista"></i></li>
				<li><i class="fa-solid fa-clock" id="horario"></i></li>
				<li><i class="fas fa-sign-out-alt" id="salir"></i></li>
			</ul>
		</nav>


		<div id="v-inicio" class="app">
			<div id="img-alu"></div>
			<div id="nom-alu">
				<h2>Alumno: <?php echo $nom_alu ?></h2><br>
				<h2>Número de cuenta: <?php echo $user ?></h2>
			</div>
		</div>


		<div id="v-califs" class="off">calificaciones</div>


		<div id="v-lista" class="off">lista (asistencia)</div>


		<div id="v-horario" class="off">horarios</div>


	</div><script type="text/javascript" src="javascript.js"></script>
</body>
</html>