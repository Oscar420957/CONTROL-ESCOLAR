<?php
	
ini_set('session.gc_maxlifetime', 60); 


ini_set('session.cookie_maxlifetime', 60); 

session_start();
	if (!isset($_SESSION['usersession'])) {
		header('Location: ../../');
	}

	$user = $_SESSION['usersession']; 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $user ?></title>
</head>
<body>
	<?php echo ini_get('session.gc_maxlifetime'); ?>
	<p id="pp"></p>
	<script type="text/javascript">
		let sopas = document.getElementById("pp");
		let contador = 0;
		let id = setInterval(() => { sopas.innerHTML = (contador+1); contador++;
			if(contador == 60)
			{
				clearInterval(id);
			}
			}, 1000);
	</script>
	<a href="closeSession.php" id="close">Cerrar sesion</a>
</body>
</html>