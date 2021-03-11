<?php 

	$params = $_POST;
	$noviPassword = $params['password-korisnika'];
	$hashedPass = password_hash($noviPassword, PASSWORD_DEFAULT);
	$datum = date("Y-m-d H:i:s");

	$query = $conn->prepare("UPDATE korisnik SET 
								`ime`=:ime,
								`prezime`=:prezime,
								`email`=:email,
								`password`=:password,
								`isVerified`=:isVerified,
								`datum`=:datum,
								`uloga_id`=:id_uloge 
							WHERE id_korisnik = :id"
						);

	$query->bindParam(":id", $params['id']);
    $query->bindParam(":ime", $params['ime-korisnika']);
    $query->bindParam(":prezime", $params['prezime-korisnika']);
    $query->bindParam(":email", $params['email-korisnika']);
    $query->bindParam(":password", $hashedPass);
    $query->bindParam(":isVerified", $params['isVerified']);
    $query->bindParam(":datum", $datum);
    $query->bindParam(":id_uloge", $params['uloga']);

     try {
        $exec2 = $query->execute();

    } catch (PDOException $exception) {
    	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=user-update&error=Update failed&artikal_id=".$params['id'];
        header($url);
    }

    $url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=korisnici&success=User updated successfully&artikal_id=".$params['id'];
    header($url);

 ?>