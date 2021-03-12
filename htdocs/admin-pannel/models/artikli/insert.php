<?php 
 

 //TEST-----------------------------------

	// $queryArtikalId = $conn -> prepare("SELECT id_artikal FROM artikal ORDER BY id_artikal DESC LIMIT 1");
	// $queryArtikalId -> execute();
	// $resultArtikalId = $queryArtikalId-> fetchAll(PDO::FETCH_ASSOC);
	// $resultToObj = (object)$resultArtikalId[0];
	// $idPoslednjegArtikla = $resultToObj -> id_artikal;

	// var_dump($idPoslednjegArtikla);die;

 //TEST-----------------------------------

  $name = $_FILES['file']['name'];

  $target_dir = "../images/artikli/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
    $queryImageInsert = $conn->prepare("INSERT INTO slika(putanja, alt) VALUES (:putanja, :alt)");
    $queryImageInsert->bindParam(':putanja', $name);
    $queryImageInsert->bindParam(':alt', $name);
  	
  	$queryImageInsert->execute();

  	//Imas sliku. Vratis id ove slike iz baze. $id 
  	//SELECT LIMIT 1 FROM slika ORDER BY id DESC

  	//ID POSLEDNJE DODATE SLIKE
  	$querySlikaId = $conn -> prepare("SELECT id_slika FROM slika ORDER BY id_slika DESC LIMIT 1");
  	$querySlikaId -> execute();
  	$resultSlikaId = $querySlikaId-> fetchAll(PDO::FETCH_ASSOC);
  	$resultToObj = (object)$resultSlikaId[0];
  	$idPoslednjeSlike = $resultToObj -> id_slika;

     // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

  }
  // var_dump(123);die;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit-new-article']){

	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikli";
	
	$nazivArt = $_POST['naziv-art'];
	$descArt = $_POST['desc-art'];
	$priceArt = $_POST['price-art'];
	$promoArt = $_POST['promo-art'];
	$numStateArt = $_POST['num-art'];
	$selectedCateg = $_POST['category'];

	if (empty($nazivArt)&&empty($descArt)&&empty($priceArt)&&empty($numStateArt)&&empty($selectedCateg)) {
		header($url . "&error=Fill the form correctly");
	} else {

		$queryArtInsert = $conn ->prepare("INSERT INTO artikal(naziv, opis, cena, promocije, brojcano_stanje, kategorija_id) 
		 								   VALUES(:naziv, :opis, :cena, :promocije, :broj, :kat_id)");	

		$queryArtInsert -> bindParam(':naziv', $nazivArt);
		$queryArtInsert -> bindParam(':opis', $descArt);
		$queryArtInsert -> bindParam(':cena', $priceArt);
		$queryArtInsert -> bindParam(':promocije', $promoArt);
		$queryArtInsert -> bindParam(':broj', $numStateArt);
		$queryArtInsert -> bindParam(':kat_id', $selectedCateg);

		try {

			$execInsert = $queryArtInsert->execute();

			//ID POSLEDNJEG DODATOG ARTIKLA
		  	$queryArtikalId = $conn -> prepare("SELECT id_artikal FROM artikal ORDER BY id_artikal DESC LIMIT 1");
		  	$queryArtikalId -> execute();
		  	$resultArtikalId = $queryArtikalId-> fetchAll(PDO::FETCH_ASSOC);
		  	$resultToObj = (object)$resultArtikalId[0];
		  	$idPoslednjegArtikla = $resultToObj -> id_artikal;

			//Povezes Sliku i Artikal u bazi.

			//Napravis insert nad tabelom slika_artikal
			//artikal_id = $id_artikla - slika_id = $id_slike
			
			$queryImageInsert = $conn->prepare("INSERT INTO slika_artikal(artikal_id, slika_id) VALUES (:lastArtikalId, :lastSlikaId)");
    		$queryImageInsert->bindParam(':lastArtikalId', $idPoslednjegArtikla);
    		$queryImageInsert->bindParam(':lastSlikaId', $idPoslednjeSlike);
    		$queryImageInsert->execute();

			
		} catch (Exception $e) {
			
		}

		
	    header($url . "&success=Insert successfully executed");


    }








    // POSLEDNJI DODATI ARTIKAL PA NJEGOV ID I POSLEDNJA DODATA SLIKA PA NJEN ID -> TA DVA ID-A INSERTOVATI U VEZNU TABELU SLIKA_ARTIKAL I TO JE TO?












	// header('Content-type: application/json');

	// $name = $_POST['articleName'];
	// $desc = $_POST['articleDesc'];
	// $price = $_POST['articlePrice'];
	// $promo = $_POST['articlePromo'];
	// $num = $_POST['articleNum'];
	// $categ = $_POST['articleCateg'];

	// $queryArtInsert = $conn ->prepare("INSERT INTO artikal(naziv, opis, cena, promocije, brojcano_stanje, kategorija_id) 
	// 									VALUES(:naziv, :opis, :cena, :promocije, :broj, :kat_id)");	

	// $queryArtInsert -> bindParam(':naziv', $name);
	// $queryArtInsert -> bindParam(':opis', $desc);
	// $queryArtInsert -> bindParam(':cena', $price);
	// $queryArtInsert -> bindParam(':promocije', $promo);
	// $queryArtInsert -> bindParam(':broj', $num);
	// $queryArtInsert -> bindParam(':kat_id', $categ);

	// try {
	// 	$queryArtInsert->execute();
	// 	echo json_encode(['insertSuccess' => 'Successfully added new article']);
	// } catch (Exception $e) {
	// 	header("location:".BASE_URL . "admin-pannel/admin-index.php?admin-page=artikli&errorInsert=Error with inserting new article");
	// }


} else {
	header('location: '.BASE_URL.'admin-pannel/admin-index.php?admin-page=artikli&errorInsert=Neovlasceni pristup');
}