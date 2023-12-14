<?php
	require "../../../db/db.php";

	$num_alums = $_POST['num-to-add'];
	$data = json_decode($_POST['ids_am'], True);
	$id_grupo = $_POST['id_grupo'];

	# RECORRE EL ARREGLO DE ALUMNOS
	for ($i = 0; $i < $num_alums; $i++) {
		# TRATAMIENTO DE VARIOS id_alum_materia
		$tmp_ids_am = explode('-', $data[$i]);

		# AGREGA UN REGISTRO A LA TABLA grupo_alumno_mat
		foreach ($tmp_ids_am as $id_am) {
			$conn->query("call sp_bind_am_to_group($id_grupo,$id_am)");
		}
	}

	echo json_encode(array("res" => "success"));

	$conn->close();
?>