<?php 

header('Content-type: application/json');
$idKategorije = $_REQUEST['idKategorije'];

if(isset($idKategorije)) {
	require_once "../config/connection.php";
	session_start();

	$query = $conn -> prepare("SELECT id_kategorija, k.naziv AS naziv_kategorije, id_artikal, a.naziv AS naziv_artikla, opis, cena, promocije, brojcano_stanje FROM kategorija k INNER JOIN artikal a ON k.id_kategorija = a.kategorija_id WHERE k.id_kategorija = :idKategorije");
	$query->bindParam(":idKategorije", $idKategorije);
	$query->execute();
	$artikli = $query -> fetchAll(PDO::FETCH_ASSOC);
	

	echo json_encode([
	        'message' => 'success',
	        'artikli' => $artikli
    	]);

}



