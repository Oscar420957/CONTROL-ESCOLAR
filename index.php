<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tipo de Usuario</title>
	<link rel="stylesheet" type="text/css" href="./css/css-logins.css">
	<link rel="icon" href="./img/CEUMHLOGOshort.png">
	<script type="text/javascript" src="javascript.js"></script>
	<style>
		main {
			width: 50%;
			margin-left: 500px;
			flex-flow: row wrap;
		}

		#diseño {
			flex-flow: row wrap;
			align-content: space-between;
			padding: 1rem;
			max-height: 40%;
			margin: 0 100px;
		}

		#enter {
			width: 20rem;
			font-size: 1.7rem;
		}

		@media (max-width: 1800px) {
			main {
				margin-left: 25%;
			}

			h1 {
				text-align: center;
			}
		}

		@media (max-width: 739px) {
			#logo {
				width: 15%;
			}

			h1 {
				color: white;
				font-size: 1.8rem;
			}
		}
	</style>
</head>
<body>
		<header>
			<div id="head">
				CENTRO UNIVERSITARIO METROPOLITANO DE HIDALGO
			</div>
		</header>
	<div id="img1"></div>
	<main>
		<h1>Selecciona el tipo de usuario</h1>
		<img src="./img/CEUMHLOGOshort.png" id="logo">
		<div id="diseño">
			<input type="button" value="Alumno" id="enter" onclick="toAlumno()">
			<input type="button" value="Docente" id="enter" onclick="toDocente()">
			<input type="button" value="Administrador" id="enter" onclick="toAdmin()">
		</div>
	</main>
	<div id="img2"></div>
	<footer>
		<div id="derechos">
			2023 Derechos Reservados | Ser CEUMH es ser el mejor!
		</div>
	</footer>
</body>
</html>