<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit-new-user']){
	
	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=korisnici";
	$urlError = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=korisnici&error=";
	$errorMsg = [];
	
	$imeKorisnika = validate_input_text($_POST['ime-korisnika']);
	$prezimeKorisnika = validate_input_text($_POST['prezime-korisnika']);
	$emailKorisnika = validate_input_email($_POST['email-korisnika']);

	$ulogaKorisnika = $_POST['uloga'];

	$passwordKorisnika = $_POST['password-korisnika'];
	$datum = date("Y-m-d H:i:s");
	$token = 123;
	$isVerified = "";

	$regIme = "/^[A-Z][a-z]{2,30}$/";
	$regPrezime = "/^[A-Z][a-z]{2,30}$/";

	//PROVERA ZA PRAZNA POLJA
	if(empty($imeKorisnika) && empty($prezimeKorisnika) && empty($emailKorisnika) && empty($passwordKorisnika)) {
		array_push($errorMsg, "No empty fields alowed!");
	}
	//PROVERA IMENA
	if(!preg_match($regIme, $imeKorisnika)) {
		array_push($errorMsg, "Name is not in a good format! Example: Pera");
	}
	//PROVERA PREZIMENA
	if(!preg_match($regPrezime, $prezimeKorisnika)) {
		array_push($errorMsg, "Last name is not in a good format! Example: Peric");
	}
	//PROVERA E-MAIL-A
	if (!filter_var($emailKorisnika, FILTER_VALIDATE_EMAIL)) {
		array_push($errorMsg, "Email is not in a good format!");
	}
	//PROVERA ULOGE
	if($ulogaKorisnika == 0) {
        array_push($errorMsg, "User role has to be selected!");
	}

	// if(!empty($errorMsg)) {
	// 	//var_dump($errorMsg);
	// }
	// else {
	// 	//var_dump($_POST);
	// }

	if ((empty($imeKorisnika)) && (empty($prezimeKorisnika)) && (empty($emailKorisnika))) {
		header($url . "&error=Fill the form correctly");
	} else {

		$hashedPass = password_hash($passwordKorisnika, PASSWORD_DEFAULT);
		$queryUserInsert = $conn ->prepare("INSERT INTO `korisnik`(`ime`, `prezime`, `email`, `password`, `email_token`, `datum`, `uloga_id`) 
											VALUES (:ime, :prezime, :email, :password, :token, :datum, :uloga)");	

		$queryUserInsert -> bindParam(':ime', $imeKorisnika);
		$queryUserInsert -> bindParam(':prezime', $prezimeKorisnika);
		$queryUserInsert -> bindParam(':email', $emailKorisnika);
		$queryUserInsert -> bindParam(':password', $hashedPass);
		$queryUserInsert -> bindParam(':token', $token);
		$queryUserInsert -> bindParam(':datum', $datum);
		$queryUserInsert -> bindParam(':uloga', $ulogaKorisnika);
		try {

			$execInsert = $queryUserInsert->execute();
			
		} catch (Exception $e) {
			$urlUpdate = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=user-update";
	        header($urlUpdate . "&error=Neuspesan update&artikal_id=".$params['id']);
		}
	    header($url . "&success=Insert successfully executed");
    }
}
else {
	header('location: '.BASE_URL.'admin-pannel/admin-index.php?admin-page=korisnici&errorInsert=Neovlasceni pristup');
}