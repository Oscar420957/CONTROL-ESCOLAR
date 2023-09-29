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

	$result_dat_mat = $conn->query($query_dat_mat);

	$arreglo_divs_mat = array();
	while($fil = $result_dat_mat->fetch_object()) {
		$idMateria = $fil->id_Materia;
		$materia = $fil->nombre;

		$div = "
			<div class='accordion-item'>
				<div class='accordion-header'>$materia<i class='fa-solid fa-angle-down'></i></div>
	        	<div class='parciales'>
	           		<div class='accordion-content FP'>Primer parcial</div>
	           		<div class='accordion-content SP'>Segundo parcial</div>
	           		<div class='accordion-content TP'>Tercer parcial</div>
	       		</div>
	       	</div>
		";
		array_push($arreglo_divs_mat, $div);
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
			<div id="title"><h1>Calificaciones por materia</h1></div>
			<div id="tab-calif">
				<div class="accordion" id="acordeon">
        			<!--div class="accordion-item">
            			<div class="accordion-header">Título 1</div>
            			<div id="parciales">
            				<div class="accordion-content" id="FP">Primer parcial</div>
            				<div class="accordion-content" id="SP">Segundo parcial</div>
            				<div class="accordion-content" id="TP">Tercer parcial</div>
            			</div>
        			</div-->
        			<?php 
            			foreach ($arreglo_divs_mat as $i) {
            				echo $i;
            			}
            		?>
    			</div>
			</div>
		</div>


		<div id="v-lista" class="off">lista (asistencia)</div>


		<div id="v-horario" class="off">horarios</div>


	</div><script type="text/javascript" src="javascript.js"></script>
</body>
</html>