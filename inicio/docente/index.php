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
			<input type="hidden" value=<?php echo $user ?> id="id_docente">
			<div id="grid-grupos">
				<div id="materias">
					<div id="titulo-materias">Grupos</div>
					<div id="grupo-mat"></div>
				</div>
				<div id="alumnos">
					<div id="titulo-alu">Alumnos</div>
					<div id="alums"></div>
				</div>
				<div id="califs">
					<div id="titulo-cali">Califiación</div>
					<div id="calfs">
						<form id="form-califs">
							<input type="hidden" name="id_alumno" value="" id="id_alumno">
							<input id="rP1" type="radio" name="parcial" value="1">
							<label id="P1" for="iC1">Primer Parcial</label>
							<input id="iC1" type="number" name="califiacion" required step=".01">
							<input id="rP2" type="radio" name="parcial" value="2">
							<label id="P2" for="iC2">Segundo Parcial</label>
							<input id="iC2" type="number" name="califiacion" required step=".01">
							<input id="rP3" type="radio" name="parcial" value="3">
							<label id="P3" for="iC3">Tercer Parcial</label>
							<input id="iC3" type="number" name="califiacion" required step=".01">
							<input id="guardar" type="button" name="guardar" value="Guardar">
							<input id="modificar" type="button" name="modificar" value="Modificar">
						</form>
					</div>
				</div>
			</div>
			<script src="./js/grupos.js"></script>
		</div>

	</div>
	<script type="text/javascript" src="js.js"></script>
</body>
</html>