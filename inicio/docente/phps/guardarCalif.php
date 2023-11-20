<?php 

	$idTabla = $_POST['id_tabla'];
	$calif = $_POST['calif'];

	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	#QUERY para modificar calificación
	$query_calif = "update alumno_materia_calif_cuatri set calificacion =".$calif." where id_alum_mat_calif = ".$idTabla;

	if($conn->query($query_calif) == true)
	{
		echo json_encode(array("res" => "La Calificación Ha Sido Modificada"));
	}
	else
	{
		echo json_encode(array("res" => "Se Produjo Un Error"));
	}
?>