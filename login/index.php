<?php
	$userType = $_POST['user-type'];

	if (!isset($userType)) {
		echo "<script>alert('Seleccione un tipo de usuario');</script>";
		header('Location: ../');
	} /*else {
		echo "<script>alert('Clickeaste en $userType');</script>";
	}*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio de Sesión | <?php echo ucfirst($userType) ?></title>
	<link rel="stylesheet" type="text/css" href="../css/css-logins.css">
	<link rel="icon" href="../img/CEUMHLOGOshort.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
	<script type="text/javascript" src="../jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
		<header>
			<div id="head">
				CENTRO UNIVERSITARIO METROPOLITANO DE HIDALGO
			</div>
		</header>
	<div id="img1"></div>
	<main>
		<img src="../img/CEUMHLOGOshort.png" id="logo">
		<div id="diseño">
		<form method="post" action="../inicio/" id="form-log">
			<i class="fi fi-sr-user" id="userI"></i>
			<input type="text" name="user" id="user" placeholder="User">
			<i class="fi fi-sr-lock" id="passI"></i>
			<input type="password" name="password" id="password" placeholder="Password">
			<input type="text" name="user-type" style="display: none" value=<?php echo $userType; ?>>
			<input type="button" value="Ingresar" id="enter">
		</form>
		</div>
		<script src="index.js"></script>
	</main>
	<div id="img2"></div>
	<footer>
		<div id="derechos">
			2023 Derechos Reservados | Ser CEUMH es ser el mejor!
		</div>
	</footer>
</body>
</html>