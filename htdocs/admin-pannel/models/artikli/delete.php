<?php 
	


	require_once "../../../config/config.php";
	require_once "../../../config/connection.php";

	

	$idArtikla = $_POST['id_artikla'];

	$queryDelPic1 = $conn->prepare("SELECT slika_id FROM slika_artikal WHERE artikal_id = :id_artikal");	
	$queryDelPic1->bindParam(":id_artikal", $idArtikla);
	$queryDelPic1->execute();
	$result1 = $queryDelPic1->fetchAll(PDO::FETCH_ASSOC);
	$result1ToObj = (object)$result1[0];
	$idSlike = $result1ToObj -> slika_id;

	//asdsadas
	$queryDelPic3 = $conn->prepare("SELECT putanja FROM slika WHERE id_slika = :idSlike");	
	$queryDelPic3->bindParam(":idSlike", $idSlike);
	$queryDelPic3->execute();
	$result2 = $queryDelPic3->fetchAll(PDO::FETCH_ASSOC);
	$result2ToObj = (object)$result2[0];
	$putanjaSlike = $result2ToObj -> putanja;
	unlink(ABSOLUTE_PATH . "images/artikli/" . $putanjaSlike);

	//asdasdas

	$queryDelete = $conn->prepare("DELETE FROM artikal WHERE id_artikal = :id");	
	$queryDelete->bindParam(":id", $idArtikla);
	
	try {
		$queryDelete->execute();


		$queryDelPic1 = $conn->prepare("DELETE FROM slika WHERE id_slika = :idSlike");	
		$queryDelPic1->bindParam(":idSlike", $idSlike);
		$queryDelPic1->execute();

		$queryDelPic2 = $conn->prepare("DELETE FROM slika_artikal WHERE slika_id = :idSlike");	
		$queryDelPic2->bindParam(":idSlike", $idSlike);
		$queryDelPic2->execute();

		
	} catch (Exception $e) {
		var_dump($e->getMessage());die;
	}

	echo json_encode(['status' => 'success', 'message' => 'Artikal deleted.', 'id' => $idArtikla]);
 ?>