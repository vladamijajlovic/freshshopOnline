<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $url = "location: " . BASE_URL . "index.php?page=register";
    $errorMsg = [];
    
    $imeKorisnika = validate_input_text($_POST['firstName']);
    $prezimeKorisnika = validate_input_text($_POST['lastName']);
    $emailKorisnika = validate_input_email($_POST['regEmail']);


    $passwordKorisnika = $_POST['regPassword'];
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

    if ((empty($imeKorisnika)) && (empty($prezimeKorisnika)) && (empty($emailKorisnika))) {
        header($url . "&error=Fill the form correctly");
    } else {

        $hashedPass = password_hash($passwordKorisnika, PASSWORD_DEFAULT);
        $queryRegisterUser = $conn ->prepare("INSERT INTO `korisnik`(`ime`, `prezime`, `email`, `password`, `email_token`, `datum`) 
                                            VALUES (:ime, :prezime, :email, :password, :token, :datum)");   

        $queryRegisterUser -> bindParam(':ime', $imeKorisnika);
        $queryRegisterUser -> bindParam(':prezime', $prezimeKorisnika);
        $queryRegisterUser -> bindParam(':email', $emailKorisnika);
        $queryRegisterUser -> bindParam(':password', $hashedPass);
        $queryRegisterUser -> bindParam(':token', $token);
        $queryRegisterUser -> bindParam(':datum', $datum);
        try {

            $execInsert = $queryRegisterUser->execute();
            
        } catch (Exception $e) {
            $urlUpdate = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=user-update";
            header($urlUpdate . "&error=Neuspesan update&artikal_id=".$params['id']);
        }
        header("location: " . BASE_URL . "index.php?page=login");
    }
}
else {
    header('location: '.BASE_URL.'admin-pannel/admin-index.php?admin-page=korisnici&errorInsert=Neovlasceni pristup');
}


