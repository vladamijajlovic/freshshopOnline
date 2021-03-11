<?php 
	require_once "../../../config/config.php";
	require_once "../../../config/connection.php";

	$idMessage = $_POST['id_message'];

	$queryDelete = $conn->prepare("DELETE FROM kontakt WHERE id = :id");	
	$queryDelete->bindParam(":id", $idMessage);

	
	try {
		$execDelete = $queryDelete->execute();
	} catch (Exception $e) {
		var_dump($e->getMessage());die;
	}

	echo json_encode(['status' => 'success', 'message' => 'Message deleted.', 'id' => $idMessage]);
 ?>