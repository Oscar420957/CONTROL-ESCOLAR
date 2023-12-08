<?php

	$id_alumno = $_POST['id_alumno'];
	$id_materia = $_POST['id_materia'];

	require "../../../db/db.php";
	#$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	# QUERY que obtiene el id_alum_materia
	$query_am = "select id_alum_materia from alumno_materia where id_alumno = ".$id_alumno." and id_materia = ".$id_materia;

	$rsAM = $conn->query($query_am);

	while ($fAM = $rsAM->fetch_object()) {
		$id_am = $fAM->id_alum_materia;
	}


	# QUERY que muestra las calificaciones del id_alumno de la materia id_materia
	$query_califs = "select amcc.id_alum_mat_calif as id, amcc.calificacion, amcc.parcial from alumno_materia_calif_cuatri as amcc, alumnos as a, alumno_materia as am, materia as m where am.id_alumno = a.id_alumno and am.id_materia = m.id_materia and amcc.id_alumno_materia = am.id_alum_materia and amcc.id_alumno_materia = ".$id_am;

	$rsCalifs = $conn->query($query_califs);

	# Array que guarda califs del alumno por parciales
	$califsParciales = array();

	while ($fCal = $rsCalifs->fetch_object()) {
		array_push($califsParciales,
			$fCal->id,
			$fCal->calificacion,
			$fCal->parcial
		);
	}

	mysqli_close($conn);

	echo json_encode($califsParciales);
?>