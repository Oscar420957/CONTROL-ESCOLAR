<?php

	require "../../../db/db.php";
	#$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");
	$user = $_POST['user'];
#Terminan las funciones
	$query_hor_mat = "select d.id_docente, m.nombre, h.dia_semana, h.horario from docentes as d, materia as m, materia_docente as md, horarios as h where md.id_docente = d.id_docente and md.id_materia = m.id_materia and h.id_materia = m.id_materia and d.id_docente = ".$user;

	$result_hor_mat = $conn->query($query_hor_mat);
	$arrayHorarios = array();
	$con = 1;
	while ($fill2 = $result_hor_mat->fetch_object()) 
	{
		array_push($arrayHorarios, ["$con" => json_encode(array("nombre" => $fill2->nombre, "dia_semana" => $fill2->dia_semana,"horario" => $fill2->horario))]);
		$con++;
	}

	echo json_encode($arrayHorarios);

#Funciones para el apartado de horario

	mysqli_close($conn);
?>