<?php
	require "../../../db/db.php";

	$id_mat_doc = $_POST['doc-to-bind-g'];
	$id_grupo = $_POST['gru-to-bind'];

	# TRATAMIENTO DE VARIOS id_Mat_Doc
	$arr_ids_md = explode('-', $id_mat_doc);

	$cont = 0;
	$arr_results = array();
	# AGREGA UN REGISTRO A LA TABLA grupo_docente_mat
	foreach ($arr_ids_md as $id_md) {
		$result = $conn->query("call sp_bind_md_to_group($id_grupo,$id_md)");
		array_push($arr_results, $result);
		$cont++;
	}

	if ($cont == count($arr_results)) {
		echo json_encode(array("res" => "success"));
	} else {
		echo json_encode(array("res" => "fail", "errors" => $arr_results));
	}
?>