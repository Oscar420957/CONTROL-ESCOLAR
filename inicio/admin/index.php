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
	<link rel="stylesheet" type="text/css" href="../../css/css-menu-admin.css">
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
				<i class="fa-solid fa-people-line" id="alumnos"></i>
				<div id="t-alumnos">Alumnos</div>
				<i class="fa-solid fa-people-group" id="docentes"></i>
				<div id="t-docentes">Docentes</div>
				<i class="fa-solid fa-people-roof" id="admins"></i>
				<div id="t-admins">Administrativos</div>
				<!--i class="fa-solid fa-clock" id="materias"></i>
				<div id="t-materias">Horarios</div-->
				<i class="fas fa-sign-out-alt" id="salir"></i>
				<div id="t-salir">Cerrar Sesión</div>
			</div>
		</nav>


		<div id="v-inicio">
			<input type="hidden" name="super" id="super" value=<?php echo $super?>>
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


		<div id="v-alumnos" class="off">
			<div id="grid-alu">
				<div id="reg-alu" class="v-divs">
					<div class="div-title">Registrar Alumno</div>
					<div id="datos-alu" class="div-grey">
						<form id="form-reg-alu" class="form-reg">
							<label>
								Nombre(s):<br>
								<input type="text" name="al-nom" id="al-nom" placeholder="Nombre(s)" class="inputs">
							</label>
							<label>
								Apellido paterno:<br>
								<input type="text" name="al-ap-pat" id="al-ap-pat" placeholder="Apellido paterno" class="inputs">
							</label>
							<label>
								Apellido materno:<br>
								<input type="text" name="al-ap-mat" id="al-ap-mat" placeholder="Apellido materno" class="inputs">
							</label>
							<label>
								Nivel educativo:<br>
								<input type="text" name="al-ne" id="al-niv-e" value="Universidad" data-val="3" class="inputs readonly" readonly>
							</label>
							<label>
								Carrera:<br>
								<select id="carreras" name="al-car" class="inputs" style="font-size: 0.9rem;">
									<option value="1">Ciencias Computacionales</option>
									<option value="2">otra</option>
								</select>
							</label>
							<label>
								Cuatrimestre:<br>
								<input type="number" name="al-ctr" id="al-ctr" placeholder="Cuatrimestre (1-9)" class="inputs" min="1" max="9">
							</label>
							<label>
								Grupo:<br>
								<input type="number" name="al-gru" id="al-gru" placeholder="Grupo en número (1-2)" class="inputs" min="1" max="2">
							</label>
							<label for="al-pass">
								Contraseña alumno:<br>
								<input type="text" name="al-pass" id="al-pass" placeholder="Contraseña" minlength="8" maxlength="16" class="inputs">
							</label>
							<label for="al-pass-conf">
								Confirme la contraseña:<br>
								<input type="password" name="al-pass-conf" id="al-pass-conf" placeholder="Repita constraseña" minlength="8" maxlength="16" class="inputs">
							</label>
							<input type="button" name="al-guardar" id="al-guardar" value="Registrar" class="inputs button">
							<input type="button" name="clear" id="al-clear" value="Limpiar" class="inputs button">
						</form>
						<script type="text/javascript" src="./js/register-alu.js"></script>
					</div>
				</div>

				<div id="create-group" class="v-divs">
					<div class="div-title">Crear Grupo</div>
					<div id="alus-grup" class="div-grey">
					</div>
				</div>
			</div>
		</div>


		<div id="v-docentes" class="off">
			<div id="grid-doc">
				<div id="reg-doc" class="v-divs">
					<div class="div-title">Registrar Docente</div>
					<div id="datos-doc" class="div-grey">
						<form id="form-reg-doc" class="form-reg">
							<label for="d-nom">
								Nombre(s):<br>
								<input type="text" name="d-nom" id="d-nom" placeholder="Nombre(s)" class="inputs">
							</label>
							<label for="d-ap-pat">
								Apellido paterno:<br>
								<input type="text" name="d-ap-pat" id="d-ap-pat" placeholder="Apellido paterno" class="inputs">
							</label>
							<label for="d-ap-mat">
								Apellido materno:<br>
								<input type="text" name="d-ap-mat" id="d-ap-mat" placeholder="Apellido materno" class="inputs">
							</label>
							<label for="hXd">
								Horas por día:<br>
								<input type="number" name="hXd" id="hXd" placeholder="Horas por día" min="2" max="8" class="inputs">
							</label>
							<label for="d-pass">
								Contraseña para el nuevo docente:<br>
								<input type="text" name="d-pass" id="d-pass" placeholder="Contraseña" minlength="8" maxlength="16" class="inputs">
							</label>
							<label for="d-pass-conf">
								Confirme la contraseña:<br>
								<input type="password" name="d-pass-conf" id="d-pass-conf" placeholder="Repita constraseña" minlength="8" maxlength="16" class="inputs">
							</label>
							<input type="button" name="d-guardar" id="d-guardar" value="Registrar" class="inputs button">
							<input type="button" name="clear" id="clear" value="Limpiar" class="inputs button">
						</form>
						<script type="text/javascript" src="./js/register-doc.js"></script>
					</div>
				</div>

				<div id="bind-doc-matgroup" class="v-divs">
					<div class="div-title">Materias | Grupos</div>
					<div id="mats-groups" class="div-grey">
						<form id="matgroup-by-docente" class="form-reg">
							<label for="doc-to-bind">
								Seleccione docente:<br>
								<select name="doc-to-bind" id="doc-to-bind" class="inputs"></select>
							</label>
							<label for="mat-to-bind">
								Materia por asignar al docente:<br>
								<select name="mat-to-bind" id="mat-to-bind" class="inputs"></select>
							</label>
							<label for="gru-to-bind">
								Grupo por asignar al docente:<br>
								<select name="gru-to-bind" id="gru-to-bind" class="inputs"></select>
							</label>
							<input type="button" name="mat-by-doc-sav" id="mat-by-doc-sav" value="Asignar" class="inputs button">
						</form>
					</div>
				</div>


				<div id="rmv-doc-mg" class="v-divs">
					<div class="div-title">Cambio Materia | Grupo</div>
					<div id="rmv-mats-groups" class="div-grey">
						
					</div>
				</div>
			</div>
		</div>


		<div id="v-admins" class="off">
			<div id="grid-admin">
				<div id="reg-admin" class="v-divs" style="grid-column: 1;">
					<div class="div-title">Registrar Administrativo</div>
					<div id="datos-admin" class="div-grey">
						<form id="form-reg-adm" class="form-reg">
							<label>
								Nombre(s):<br>
								<input type="text" name="ad-nom" id="ad-nom" placeholder="Nombre(s)" class="inputs">
							</label>
							<label>
								Apellido paterno:<br>
								<input type="text" name="ad-ap-pat" id="ad-ap-pat" placeholder="Apellido paterno" class="inputs">
							</label>
							<label>
								Apellido materno:<br>
								<input type="text" name="ad-ap-mat" id="ad-ap-mat" placeholder="Apellido materno" class="inputs">
							</label>
							<label for="d-pass">
								Contraseña para el nuevo administrativo:<br>
								<input type="text" name="ad-pass" id="ad-pass" placeholder="Contraseña" minlength="8" maxlength="16" class="inputs">
							</label>
							<label for="ad-pass-conf">
								Confirme la contraseña:<br>
								<input type="password" name="ad-pass-conf" id="ad-pass-conf" placeholder="Repita constraseña" minlength="8" maxlength="16" class="inputs">
							</label>
							<input type="button" name="ad-guardar" id="ad-guardar" value="Registrar" class="inputs button">
							<input type="button" name="clear" id="ad-clear" value="Limpiar" class="inputs button">
						</form>
						<script type="text/javascript" src="./js/register-adm.js"></script>
					</div>
				</div>
			</div>
		</div>


		<!--div id="v-materias" class="off"></div-->

	</div>
	<script type="text/javascript" src="./js/js.js"></script>
</body>
</html>