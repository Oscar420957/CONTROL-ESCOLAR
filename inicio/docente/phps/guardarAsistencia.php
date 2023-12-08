<?php
	$id_alumno = $_POST['id_alumno'];
	$id_materia = $_POST['id_materia'];
	$asistencia = $_POST['asistencia'];
	$fecha = $_POST['fecha'];

	require "../../../db/db.php";
	#$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	# QUERY para obtener el id de alumno_materia
	$query_id_am = "select id_alum_materia from alumno_materia where id_alumno = ".$id_alumno." and id_materia = ".$id_materia;

	$rs_id_am = $conn->query($query_id_am);
	while ($fila = $rs_id_am->fetch_object()) {
		$id_alum_mat = $fila->id_alum_materia;
	}


	$temp_as = $asistencia == 'Presente' ? 1 : 0;
	$temp_fecha = explode("-", $fecha);
	$fecha = $temp_fecha[0] . $temp_fecha[1] . $temp_fecha[2];
	#QUERY para ingresar asistencia a la tabla alum_mat_asistencia
	$query_as = "insert into alum_mat_asistencia (id_alum_materia, fecha, asistencia) values (".$id_alum_mat.",".$fecha.",".$temp_as.")";

	if ($conn->query($query_as) == true) {
		echo json_encode(array("res" => "guardado"));
	} else {
		echo json_encode(array("res" => "noguardado"));
	}

	$conn->close();

?>