<?php
	require "../../../db/db.php";

	$carr = $_POST['carrera'];

	# QUERY QUE SELECCIONA DOCENTES SIN GRUPO ASIGNADO
	$query_doc_wout_gru = "select md.id_docente, concat(d.nombre,' ',d.apellido_pat,' ',d.apellido_mat) as nom_docente, md.id_mat_doc from materia_docente as md, docentes as d where md.id_mat_doc not in (select gdm.id_mat_docente from grupo_docente_mat as gdm) and md.id_docente = d.id_docente group by md.id_mat_doc";

	# QUERY QUE SELECCIONA GRUPOS SIN DOCENTE_MATERIA ASIGNADO
	$query_mat_wout_doc = "select g.id_grupo, g.cuatrimestre, g.grupo from grupo as g where g.id_grupo not in (select gdm.id_grupo from grupo_docente_mat as gdm) and g.id_carrera = $carr group by g.id_grupo";


	$rs_docs = $conn->query($query_doc_wout_gru);
	$rs_grupos = $conn->query($query_mat_wout_doc);

	$arr_docs = array();
	$arr_grupos = array();

	while (True) {
		$fil1 = $rs_docs->fetch_object();
		$fil2 = $rs_grupos->fetch_object();

		if (!($fil1 || $fil2)) {
			break;
		}

		if ($fil1) {
			$arr_docs[$fil1->id_docente] = $fil1->nom_docente."-".$fil1->id_mat_doc;
		}

		if ($fil2) {
			$arr_grupos[$fil2->id_grupo] = $fil2->cuatrimestre."-".$fil2->grupo;
		}
	}

	echo json_encode(array($arr_docs, $arr_grupos));

	$conn->close();

?>