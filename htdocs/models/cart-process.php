<?php

header('Content-type: application/json');
$idArtikla = $_REQUEST['idArtikla'];

if(isset($idArtikla)) {
    require_once "../config/connection.php";
    session_start();

    $queryCart = $conn -> prepare('SELECT id_artikal, naziv, opis, cena, promocije, brojcano_stanje, kategorija_id, s.id_slika, s.putanja, s.alt 
                                FROM artikal a INNER JOIN slika_artikal sa 
                                ON a.id_artikal = sa.artikal_id INNER JOIN slika s 
                                ON s.id_slika = sa.slika_id
                                WHERE id_artikal = :idArtikal');
    $queryCart->bindParam(":idArtikal", $idArtikla);

    if(!isset($_SESSION['artikli'])) {
        $_SESSION['artikli'] = array();    
    }
    
    try {
        $queryCart->execute();
        $resultCart = $queryCart->fetchAll(PDO::FETCH_ASSOC)[0];

        //prvo pronalazimo artikal u sesiji ako artikli postoje
        if(!empty($_SESSION['artikli'])) {

            $exists = false;
            foreach ($_SESSION['artikli'] as $key => $artikal) {
                if ($artikal['id_artikal'] == $idArtikla) {
                    $exists = true;
                    $_SESSION['artikli'][$key]['kolicina'] = $artikal['kolicina'] + 1;
                } 
            }

            if (!$exists) {
               $resultCart['kolicina'] = 1;
               array_push($_SESSION['artikli'], $resultCart);   
            }
        } else {
            $resultCart['kolicina'] = 1;
            array_push($_SESSION['artikli'], $resultCart);
        }

    } catch (PDOException $exception) {
        echo json_encode(['error' => $exception->getMessage()]);
    }

    $quantity = 0;
    foreach ($_SESSION['artikli'] as $artikal) {
        $quantity = $quantity + $artikal['kolicina'];
    }

    $_SESSION['quantity'] = $quantity;

    //treba da nam vrati koliko imamo ukupno artikala u sesiji.
    echo json_encode([
        'message' => 'success',
        'quantity' => $quantity
    ]);
}




