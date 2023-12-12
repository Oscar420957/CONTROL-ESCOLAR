<?php
	require "../../../db/db.php";

	# QUERY QUE SELECCIONA DOCENTES SIN MATERIAS ASIGNADAS
	$query_doc_wout_mat = "select d.id_docente, concat(d.nombre,' ',d.apellido_pat,' ',d.apellido_mat) as nom from docentes as d where d.id_docente not in (select md.id_docente from materia_docente as md) group by d.id_docente";

	# QUERY QUE SELECCIONA MATERIAS SIN DOCENTE ASIGNADO
	$query_mat_wout_doc = "select m.id_materia, m.nombre from materia as m where m.id_materia not in (select md.id_materia from materia_docente as md)";


	$rs_docs = $conn->query($query_doc_wout_mat);
	$rs_mats = $conn->query($query_mat_wout_doc);

	$arr_docs = array();
	$arr_mats = array();

	while (True) {
		$fil1 = $rs_docs->fetch_object();
		$fil2 = $rs_mats->fetch_object();

		if (!($fil1 || $fil2)) {
			break;
		}

		if ($fil1) {
			$arr_docs[$fil1->id_docente] = $fil1->nom;
		}

		if ($fil2) {
			$arr_mats[$fil2->id_materia] = $fil2->nombre;
		}
	}

	echo json_encode(array($arr_docs, $arr_mats));

	$conn->close();

?>