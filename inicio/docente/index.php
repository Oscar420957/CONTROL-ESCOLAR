<?php 
	ini_set('session.gc_maxlifetime', 60); 
	ini_set('session.cookie_maxlifetime', 60); 

	session_start();

	if (!isset($_SESSION['usersession'])) {
		header('Location: ../../');
	}

	$user = $_SESSION['usersession'];

	#SELECT DATOS DE DOCENTE
	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	$query = "select d.id_docente, d.nombre as nomDoc, d.apellido_Pat, d.apellido_Mat, m.id_materia, m.nombre, m.nivel_educativo, c.nombre, m.cuatrimestre, m.creditos from docentes as d, materia as m, carrera as c, materia_docente as md where md.id_docente = d.id_docente and md.id_materia = m.id_materia and m.carrera = c.id_carrera and d.id_docente = ".$user;

	$result = $conn->query($query);

	while ($row = $result->fetch_object()) {
		$nom_Doc = $row->nomDoc;
		$ape_Pat = $row->apellido_Pat;
		$ape_Mat = $row->apellido_Mat;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/b32a76d93a.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css.css">
	<script type="text/javascript" src="../../jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
	<link rel="icon" href="../../img/CEUMHLOGOshort.png">
	<title>Docente | <?php echo $user ?></title>
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

		<div id="v-inicio">
			<div id="img-alu" style="background: url('./img/<?php echo $user.".jpg" ?>') no-repeat; background-size: cover;"></div>
			<div id="nom-alu">
				<div id="border-top"></div>
				<div id="datos">
					Bienvenido de nuevo: <?php echo $nom_Doc." ".$ape_Pat." ".$ape_Mat ?><br>
				</div>
			</div>
		</div>


		<div id="v-grupos" class="off">
			<div id="grid-grupos">
				
			</div>
		</div>

	</div>
	<script type="text/javascript" src="js.js"></script>
</body>
</html>