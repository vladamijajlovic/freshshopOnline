<?php 
	require_once "../../../config/config.php";
	require_once "../../../config/connection.php";

	$idKorisnika = $_POST['id_korisnika'];

	$queryDelete = $conn->prepare("DELETE FROM korisnik WHERE id_korisnik = :id");	
	$queryDelete->bindParam(":id", $idKorisnika);

	
	try {
		$execDelete = $queryDelete->execute();
	} catch (Exception $e) {
		var_dump($e->getMessage());die;
	}

	echo json_encode(['status' => 'success', 'message' => 'Category deleted.', 'id' => $idKorisnika]);
 ?>