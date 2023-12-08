<?php
	$user = $_POST['user'];

	require "../../../db/db.php";
	#$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");


	$query = "select ama.fecha, ama.asistencia, a.id_alumno, am.id_materia, m.nombre from alum_mat_asistencia as ama, alumnos as a, alumno_materia as am, materia as m where am.id_alumno = a.id_alumno and am.id_materia = m.id_materia and ama.id_alum_materia = am.id_alum_materia and am.id_alumno = ".$user." order by m.nombre";

	$result = $conn->query($query);
	$asistencias = array();
	$i = 1;

	while($fila = $result->fetch_object()) {
		array_push($asistencias, ["$i" => json_encode(array(
			"fecha" => $fila->fecha,
			"asistencia" => $fila->asistencia,
			"id_alumno" => $fila->id_alumno,
			"materia" => $fila->nombre
		))]);
		$i++;
	}

	echo json_encode($asistencias);

	mysqli_close($conn);
?>