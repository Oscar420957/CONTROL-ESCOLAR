<?php
	$nom = $_POST['al-nom'];
	$aPat = $_POST['al-ap-pat'];
	$aMat = $_POST['al-ap-mat'];
	$nivEd = $_POST['al-niv-e'];
	$car = $_POST['al-car'];
	$ctr = $_POST['al-ctr'];
	$group = $_POST['al-gru'];
	$pass = $_POST['al-pass-conf'];

	require "../../../db/db.php";
	#$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	# PPREPARED STATEMENT
	$ps = $conn->prepare("call sp_registrar_alumno(?,?,?,?,?,?,?,?,@idAl)");

	# EXECUTE THE STATEMENT
	if (!$ps->execute(array($nom,$aPat,$aMat,$nivEd,$car,$ctr,$group,$pass))) {
		echo json_encode(array("res" => "fail"));
	} else {
		$rs = $conn->query("select @idAl as id_alu");
		$fil = $rs->fetch_object();
		echo json_encode(array("res" => "success", "id" => $fil->id_alu));
	}

	$conn->close();
?>