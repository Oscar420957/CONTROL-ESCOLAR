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

	$query = "select d.id_docente, concat(d.nombre,' ',d.apellido_Pat,' ',d.apellido_Mat) as nombre from docentes as d where d.id_docente = ".$user;

	$result = $conn->query($query);

	while ($row = $result->fetch_object()) {
		$id = $row->id_docente;
		$nom = $row->nombre;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/b32a76d93a.js" crossorigin="anonymous" defer></script>
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="../../css/css-menu.css">
	<script type="text/javascript" src="../../jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
	<link rel="icon" href="../../img/CEUMHLOGOshort.png">
	<title>Docente | <?php echo $user ?></title>
</head>
<body>
	<div id="container">
		<nav id="menu">
			<div id="iconos">
				<i class="fa-solid fa-house" id="inicio"></i>
				<div id="t-inicio">Inicio</div>
				<i class="fa-solid fa-book" id="califs"></i>
				<div id="t-califs">Calificaciones</div>
				<i class="fa-solid fa-check" id="lista"></i>
				<div id="t-lista">Asistencia</div>
				<i class="fa-solid fa-clock" id="horario"></i>
				<div id="t-horario">Horarios</div>
				<i class="fas fa-sign-out-alt" id="salir"></i>
				<div id="t-salir">Cerrar Sesión</div>
			</div>
		</nav>

		<div id="v-inicio" style="background: url('../../img/b-1.jpg'); background-size: 100% 100%">
			<div id="img-alu" style="background: url('./img/<?php echo $user.".jpg" ?>') no-repeat; background-size: cover;"></div>
			<div id="nom-alu">
				<div id="border-top"></div>
				<div id="datos">
					<h2>Bienvenido de nuevo</h2><br>
					Docente: <?php echo $nom ?><br>
					Id Docente: <?php echo $id ?>
				</div>
			</div>
		</div>


		<div id="v-grupos" class="off">
			<input type="hidden" value=<?php echo $user ?> id="id_docente">
			<div id="grid-grupos">
				<div id="materias" class="div-grup-mat">
					<div id="titulo-materias" class="div-title">Grupos</div>
					<div id="grupo-mat" class="div-scroll-g-m"></div>
				</div>
				<div id="alumnos" class="div-alum">
					<div id="titulo-alu" class="div-title">Alumnos</div>
					<div id="alums" class="div-scroll-alum"></div>
				</div>
				<div id="cals" class="div-califs">
					<div id="titulo-cali" class="div-title">Calificación</div>
					<div id="calfs" class="div-scroll-califs">
						<form id="form-califs" class="form">
							<input type="hidden" name="id_alumno" value="" id="id_alumno">
							<input id="rP1" type="radio" name="parcial" value="1" class="radio">
							<label id="P1" for="iC1">Primer Parcial</label>
							<input id="iC1" type="number" name="califiacion" required step=".01">
							<input id="rP2" type="radio" name="parcial" value="2" class="radio">
							<label id="P2" for="iC2">Segundo Parcial</label>
							<input id="iC2" type="number" name="califiacion" required step=".01">
							<input id="rP3" type="radio" name="parcial" value="3" class="radio">
							<label id="P3" for="iC3">Tercer Parcial</label>
							<input id="iC3" type="number" name="califiacion" required step=".01">
							<input id="guardar" class="save_btn" type="button" name="guardar" value="Guardar">
						</form>
						<script type="text/javascript" src="./js/save_calif.js"></script>
					</div>
				</div>
			</div>
			<script src="./js/grupos.js"></script>
		</div>


		<div id="v-lista" class="off">
			<div id="grid-lista" class="grupos-lista">
				<div id="div-g-m" class="div-grup-mat">
					<div id="t-grupo" class="div-title">Grupos</div>
					<div id="div-scroll-g-m" class="div-scroll-g-m"></div>
				</div>
				<div id="div-alum" class="div-alum">
					<div id="t-alum" class="div-title">Alumnos</div>
					<div id="div-scroll-alum"></div>
				</div>
			</div>
			<script type="text/javascript" src="./js/asisGrupos.js"></script>
		</div>


		<div id="v-horario" class="off">
			<script src="./js/horario.js"></script>
				<table id="horario">
					<thead>
						<th colspan="6"><b>HORARIO</b></th>
						<tr>
							<td id="hora">Hora</td>
							<td>Lunes</td>
							<td>Martes</td>
							<td>Miercoles</td>
							<td>Jueves</td>
							<td>Viernes</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>07:00-08:00</td>
							<td id="L07"></td>
							<td id="M07"></td>
							<td id="X07"></td>
							<td id="J07"></td>
							<td id="V07"></td>
						</tr>
						<tr>
							<td>08:00-09:00</td>
							<td id="L08"></td>
							<td id="M08"></td>
							<td id="X08"></td>
							<td id="J08"></td>
							<td id="V08"></td>
						</tr>
						<tr>
							<td>09:00-10:00</td>
							<td id="L09"></td>
							<td id="M09"></td>
							<td id="X09"></td>
							<td id="J09"></td>
							<td id="V09"></td>
						</tr>
						<tr>
							<td>10:00-11:00</td>
							<td id="L10"></td>
							<td id="M10"></td>
							<td id="X10"></td>
							<td id="J10"></td>
							<td id="V10"></td>
						</tr>
						<tr>
							<td>11:00-12:00</td>
							<td id="L11"></td>
							<td id="M11"></td>
							<td id="X11"></td>
							<td id="J11"></td>
							<td id="V11"></td>
						</tr>
						<tr>
							<td>12:00-13:00</td>
							<td id="L12"></td>
							<td id="M12"></td>
							<td id="X12"></td>
							<td id="J12"></td>
							<td id="V12"></td>
						</tr>
						<tr>
							<td>13:00-14:00</td>
							<td id="L13"></td>
							<td id="M13"></td>
							<td id="X13"></td>
							<td id="J13"></td>
							<td id="V13"></td>
						</tr>
						<tr>
							<td>14:00-15:00</td>
							<td id="L14"></td>
							<td id="M14"></td>
							<td id="X14"></td>
							<td id="J14"></td>
							<td id="V14"></td>
						</tr>
						<tr>
							<td>15:00-16:00</td>
							<td id="L15"></td>
							<td id="M15"></td>
							<td id="X15"></td>
							<td id="J15"></td>
							<td id="V15"></td>
						</tr>
						<tr>
							<td>16:00-17:00</td>
							<td id="L16"></td>
							<td id="M16"></td>
							<td id="X16"></td>
							<td id="J16"></td>
							<td id="V16"></td>
						</tr>
						<tr>
							<td>17:00-18:00</td>
							<td id="L17"></td>
							<td id="M17"></td>
							<td id="X17"></td>
							<td id="J17"></td>
							<td id="V17"></td>
						</tr>
						<tr>
							<td>18:00-19:00</td>
							<td id="L18"></td>
							<td id="M18"></td>
							<td id="X18"></td>
							<td id="J18"></td>
							<td id="V18"></td>
						</tr>
						<tr>
							<td>19:00-20:00</td>
							<td id="L19"></td>
							<td id="M19"></td>
							<td id="X19"></td>
							<td id="J19"></td>
							<td id="V19"></td>
						</tr>
					</tbody>
				</table>
		</div>

	</div>
	<script type="text/javascript" src="js.js"></script>
</body>
</html>