<?php
	$nom = $_POST['ad-nom'];
	$aPat = $_POST['ad-ap-pat'];
	$aMat = $_POST['ad-ap-mat'];
	$pass = $_POST['ad-pass-conf'];

	$conn = mysqli_connect("74.208.191.226","gamanto","Serial3/0","ceumh");

	# PPREPARED STATEMENT
	$ps = $conn->prepare("call sp_registrar_admin(?,?,?,?,@idAd)");

	# EXECUTE THE STATEMENT
	if (!$ps->execute(array($nom,$aPat,$aMat,$pass))) {
		echo json_encode(array("res" => "fail"));
	} else {
		$rs = $conn->query("select @idAd as id_adm");
		$fil = $rs->fetch_object();
		echo json_encode(array("res" => "success", "id" => $fil->id_adm));
	}

	$conn->close();
?>