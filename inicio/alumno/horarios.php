<?php

	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");
	$user = $_POST['user'];
#Terminan las funciones
	$query_hor_mat = "select a.id_alumno, m.nombre, h.dia_semana, h.horario from alumnos as a, materia as m, alumno_materia as am, horarios as h where am.id_alumno = a.id_alumno and am.id_materia = m.id_materia and h.id_materia = m.id_materia and a.id_alumno = " .= $user;

	$result_hor_mat = $conn->query($query_hor_mat);
	$arrayHorarios = array();
	$con = 0;
	while ($fill2 = $result_hor_mat->fetch_object()) 
	{
		array_push($arrayHorarios, "$con" => array("nombre" => $fill2->nombre,"dia_semana" => $fill2->dia_semana,"horario" => $fill2->horario));
		$con++;
	}

	echo json_encode($arrayHorarios);

#Funciones para el apartado de horario

	mysql_close($conn);
?>