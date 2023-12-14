<?php
	require "../../../db/db.php";

	$cuatri = $_POST['cuatri'];

	# QUERY QUE OBTIENE LOS ALUMNOS SIN UN GRUPO ASIGNADO
	$query_alu_wout_gru = "select a.id_alumno, concat(a.nombre,' ',a.apellido_pat,' ',a.apellido_mat) as nom, a.cuatrimestre, am.id_alum_materia from alumnos as a, alumno_materia as am where am.id_alum_materia not in (select gam.id_alum_materia from grupo_alumno_mat as gam) and am.id_alumno = a.id_alumno and a.cuatrimestre = $cuatri group by am.id_alum_materia";

	# QUERY QUE OBTIENE LOS GRUPOS 
	$query_grupos = "select g.id_grupo, g.cuatrimestre, g.grupo from grupo as g where g.id_carrera = 1 and g.cuatrimestre = $cuatri";

	$rs_alums = $conn->query($query_alu_wout_gru);
	$rs_grupos = $conn->query($query_grupos);

	$arr_alums = array();
	$arr_grupos = array();

	$cont_alu = 1;
	while (True) {
		$fil1 = $rs_alums->fetch_object();
		$fil2 = $rs_grupos->fetch_object();

		if (!($fil1 || $fil2)) {
			break;
		}

		if ($fil1) {
			$arr_alums[$fil1->id_alumno."-$cont_alu"] = $fil1->nom."-".$fil1->id_alum_materia;
			$cont_alu++;
		}

		if ($fil2) {
			$arr_grupos[$fil2->id_grupo] = $fil2->cuatrimestre."-".$fil2->grupo;
		}
	}

	echo json_encode(array($arr_alums, $arr_grupos));

	$conn->close();
?>