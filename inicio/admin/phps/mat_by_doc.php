<?php
	require "../../../db/db.php";

	$id_doc = $_POST['doc-to-bind'];
	$id_mat = $_POST['mat-to-bind'];

	# AGREGA UN REGISTRO A LA TABLA materia_docente

	if ($conn->query("call sp_materia_by_docente($id_mat,$id_doc)")) {
		echo json_encode(array("res" => "success"));
	} else {
		echo json_encode(array("res" => "fail"));
	}

	$conn->close();
?>