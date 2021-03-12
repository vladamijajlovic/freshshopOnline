<?php 

	$params = $_POST;

	$query = $conn->prepare("UPDATE artikal SET 
								`naziv`=:naziv,
								`opis`=:opis,
								`cena`=:cena,
								`promocije`=:promocije,
								`brojcano_stanje`=:stanje,
								`kategorija_id`=:id_kategorije 
							WHERE id_artikal = :id"
						);

	$query->bindParam(":id", $params['id']);
    $query->bindParam(":naziv", $params['name']);
    $query->bindParam(":opis", $params['desc']);
    $query->bindParam(":cena", $params['price']);
    $query->bindParam(":promocije", $params['promotions']);
    $query->bindParam(":stanje", $params['num']);
    $query->bindParam(":id_kategorije", $params['category']);

     try {
        $exec2 = $query->execute();

    } catch (PDOException $exception) {
    	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikal-update&error=Neuspesan update&artikal_id=".$params['id'];
        header($url);
    }

    $url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikli&success=Uspesan update&artikal_id=".$params['id'];
    header($url);

 ?>