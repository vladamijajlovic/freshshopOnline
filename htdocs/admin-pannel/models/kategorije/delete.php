<?php 
	require_once "../../../config/config.php";
	require_once "../../../config/connection.php";

	$idKategorije = $_POST['id_kategorije'];

	$queryDelete = $conn->prepare("DELETE FROM kategorija WHERE id_kategorija = :id");	
	$queryDelete->bindParam(":id", $idKategorije);

	
	try {
		$execDelete = $queryDelete->execute();
	} catch (Exception $e) {
		var_dump($e->getMessage());die;
	}

	echo json_encode(['status' => 'success', 'message' => 'Category deleted.', 'id' => $idKategorije]);
 ?>