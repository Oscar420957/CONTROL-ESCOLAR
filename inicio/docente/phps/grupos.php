<?php
	$id_docente = $_POST['id_docente'];

	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	# QUERY que obtiene los grupos a los que da materias el docente
	$query_grupos = "
	select g.id_grupo, g.grupo, m.id_materia, m.nombre from grupo_docente_mat gdm, grupo as g, materia as m, materia_docente as md, docentes as d where gdm.id_grupo = g.id_grupo and gdm.id_mat_docente = md.id_mat_doc and md.id_materia = m.id_materia and md.id_docente = d.id_docente and d.id_docente = ".$id_docente;

	$rs_grupos = $conn->query($query_grupos);

	# Array que guarda info de grupos del docente
	$grupos_docente = array();
	
	# Array que guarda info de alumnos de materias que da el docente
	$alumnos_mat = array();

	$c = 1;
	$cc = 1;
	while ($fg = $rs_grupos->fetch_object()) {
		$id_grupo = $fg->id_grupo;
		$grupo = $fg->grupo;
		$id_materia = $fg->id_materia;
		$materia = $fg->nombre;
		array_push($grupos_docente, ["$c" => array(
			"id_grupo" => $id_grupo,
			"grupo" => $grupo,
			"id_materia" => $id_materia,
			"materia" => $materia
		)]);

		# QUERY que obtiene los alumnos de las materias que da el docente
		$query_alumnos_mats = "
		select a.id_alumno, concat(a.nombre,' ',a.apellido_pat,' ',a.apellido_mat) as nom, m.nombre from alumno_materia as am, alumnos as a, grupo_alumno_mat as gam, grupo as g, materia as m where am.id_alumno = a.id_alumno and gam.id_alum_materia = am.id_alum_materia and am.id_materia = m.id_materia and gam.id_grupo = g.id_grupo and gam.id_grupo = ".$id_grupo." and m.id_materia = ".$id_materia;

		$rs_alum = $conn->query($query_alumnos_mats);

		while ($fa = $rs_alum->fetch_object()) {
			$id_alumno = $fa->id_alumno;
			$nomAlum = $fa->nom;
			$matAlum = $fa->nombre;
			array_push($alumnos_mat, ["$cc" => array(
				"id_alumno" => $id_alumno,
				"nomAlum" => $nomAlum,
				"matAlum" => $matAlum
			)]);
			$cc++;
		}

		$c++;
	}

	$arreglos = array("arr1"=>$grupos_docente,"arr2"=>$alumnos_mat);
	$json = json_encode($arreglos);
	echo $json;

	mysqli_close($conn);
?>