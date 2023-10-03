<?php 
	ini_set('session.gc_maxlifetime', 60); 
	ini_set('session.cookie_maxlifetime', 60); 

	session_start();

	if (!isset($_SESSION['usersession'])) {
		header('Location: ../../');
	}

	$user = $_SESSION['usersession'];

	# SELECT DATOS DE ALUMNO
	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	$query = "select nombre, cuatrimestre, grupo from alumnos where id_alumno = ".$user;

	$result = $conn->query($query);

	while($row = $result->fetch_object()) {
		$nom_alu = $row->nombre;
		$cua_alu = $row->cuatrimestre;
		$gru_alu = $row->grupo;
	}


	# SELECT DE DATOS DE MATERIA POR ID_ALUMNO
	$query_dat_mat = "select m.id_Materia, m.nombre from alumnos as a, materia as m, alumno_materia as am where am.id_materia = m.id_materia and am.id_alumno = a.id_alumno and a.id_alumno = ".$user;
	
	# SELECT DE CALIFICACIONES POR PARCIAL DE MATERIA
	$query_cal_parc = "select m.nombre as materia, amc4.parcial, amc4.calificacion from alumnos as a, alumno_materia as am, materia as m, alumno_materia_calif_cuatri as amc4 where am.id_alumno = a.id_alumno and am.id_materia = m.id_materia and amc4.id_Alumno_materia = am.id_Alum_materia and a.id_alumno = ".$user;

	$result_dat_mat = $conn->query($query_dat_mat);
	$result_cal_parc = $conn->query($query_cal_parc);

	$arreglo_divs_mat = array();
	$cont = 0;

	#Funciones para el apartado de califs
	while($fil = $result_dat_mat->fetch_object()) {
		$materia = $fil->nombre;

		$div = "
			<div class='accordion-item'>
				<div class='accordion-header'>$materia<i class='fa-solid fa-angle-down'></i></div>
	        	<div class='parciales'>
		";

		while ($filCal = $result_cal_parc->fetch_object()) {
			$num_parcial = $filCal->parcial;
			$calif = $filCal->calificacion;
			$materiaCalif = $filCal->materia;

			if ($materia == $materiaCalif) {
				switch ($num_parcial) {
					case 1:
						$div.="<div class='accordion-content FP'><b>Primer Parcial</b><br>Calificación: $calif</div>";
						break;
					case 2:
						$div.="<div class='accordion-content SP'><b>Segundo Parcial</b><br>Calificación: $calif</div>";
						break;
					case 3:
						$div.="<div class='accordion-content TP'><b>Tercer Parcial</b><br>Calificación: $calif</div>";
						break;
				}
			}

			$cont++;
			if ($cont == 3) {
				$cont = 0;
				break;
			}
		}

		$div.="	</div>
	     	</div>";

		array_push($arreglo_divs_mat, $div);
	}


	function write_to_console($elem) {
		$console = $elem;
		if (is_array($console)) {
			$console = implode(',', $console);
		}
		echo "<script>console.log($console);</script>";
	}

	mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $user;?></title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="icon" href="./img/logo_octagon_short.png">
	<script src="https://kit.fontawesome.com/b32a76d93a.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<script type="text/javascript" src="./jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body class="prev">
	<script type="text/javascript">
		setTimeout(() => {document.body.className = ""}, 1000);
	</script>
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
			<div id="img-alu"></div>
			<div id="nom-alu">
				<div id="border-top"></div>
				<div id="datos">Alumno: <?php echo $nom_alu ?><br>
				Número de cuenta: <?php echo $user ?><br>
				Cuatrimestre: <?php echo $cua_alu ?><br>
				Grupo: <?php echo $gru_alu ?></div>
			</div>
		</div>


		<div id="v-califs" class="off">
			<input type="text" name="user" id="user" value=<?php echo $user; ?> style="display: none;">
			<div id="title"><h1>Calificaciones Por Materia</h1></div>
			<div id="tab-calif">
				<div class="accordion" id="acordeon">
        			<?php 
            			foreach ($arreglo_divs_mat as $i) {
            				echo $i;
            			}
            		?>
    			</div>
			</div>
		</div>


		<div id="v-lista" class="off">lista (asistencia)</div>


		<div id="v-horario" class="off">
			<input style="display: none;" type="text" name="user" id="user" value=<?php echo $user ?>>
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
							<td id="L7"></td>
							<td id="M7"></td>
							<td id="X7"></td>
							<td id="J7"></td>
							<td id="V7"></td>
						</tr>
						<tr>
							<td>08:00-09:00</td>
							<td id="L8"></td>
							<td id="M8"></td>
							<td id="X8"></td>
							<td id="J8"></td>
							<td id="V8"></td>
						</tr>
						<tr>
							<td>09:00-10:00</td>
							<td id="L9"></td>
							<td id="M9"></td>
							<td id="X9"></td>
							<td id="J9"></td>
							<td id="V9"></td>
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


	</div><script type="text/javascript" src="javascript.js"></script>
</body>
</html>