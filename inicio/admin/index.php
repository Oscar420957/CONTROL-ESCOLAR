<?php 
	ini_set('session.gc_maxlifetime', 60); 
	ini_set('session.cookie_maxlifetime', 60); 

	session_start();

	if (!isset($_SESSION['usersession'])) {
		header('Location: ../../');
	}

	$user = $_SESSION['usersession'];


	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");
	
	#SELECT DATOS DE ADMIN
	$query = "select id_admin, concat(nombre,' ',apellido_pat,' ',apellido_mat) as nom, top_level_acc as super from administrativo where id_admin = $user";

	$result = $conn->query($query);

	while ($row = $result->fetch_object()) {
		$id = $row->id_admin;
		$nom = $row->nom;
		$super = $row->super;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrativo | <?php echo $user;?></title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="../../css/css-menu.css">
	<link rel="icon" href="../../img/CEUMHLOGOshort.png">
	<script src="https://kit.fontawesome.com/b32a76d93a.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<script type="text/javascript" src="../../jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
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


		<div id="v-inicio">
			<div id="img-admi" style="background: url('./img/<?php echo $user.".jpg" ?>') no-repeat; background-size: cover;"></div>
			<div id="nom-admi">
				<div id="border-top"></div>
				<div id="datos">
					<h2>Bienvenido de nuevo</h2><br>
					Administrativo: <?php echo $nom ?><br>
					Id Admin: <?php echo $id ?><br>
					Permisos de: <?php echo $super == 1 ? "Super Usuario" : "Administrativo" ?>
				</div>
			</div>
		</div>



	</div>
</body>
</html>