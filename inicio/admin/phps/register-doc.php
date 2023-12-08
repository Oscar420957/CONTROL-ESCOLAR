<?php
	$nom = $_POST['d-nom'];
	$aPat = $_POST['d-ap-pat'];
	$aMat = $_POST['d-ap-mat'];
	$hXd = $_POST['hXd'];
	$pass = $_POST['d-pass-conf'];

	require "../../../db/db.php";
	#$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	# PPREPARED STATEMENT
	$ps = $conn->prepare("call sp_registrar_docente(?,?,?,?,?,@id)");

	# EXECUTE THE STATEMENT
	if (!$ps->execute(array($nom,$aPat,$aMat,$hXd,$pass))) {
		echo json_encode(array("res" => "fail"));
	} else {
		$rs = $conn->query("select @id as id_doc");
		$fil = $rs->fetch_object();
		echo json_encode(array("res" => "success", "id" => $fil->id_doc));
	}

	$conn->close();
?>