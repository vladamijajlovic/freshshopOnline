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
								`datum`=:datum
							WHERE id_korisnik = :id"
						);

	$query->bindParam(":id", $params['id']);
    $query->bindParam(":ime", $params['ime-korisnika']);
    $query->bindParam(":prezime", $params['prezime-korisnika']);
    $query->bindParam(":email", $params['email-korisnika']);
    $query->bindParam(":password", $hashedPass);
    $query->bindParam(":datum", $datum);

   
	   	try {
	        $exec2 = $query->execute();
	        	
	    } catch (PDOException $exception) {
	    	$url ="location: " . BASE_URL . "index.php?page=update-profile&error=Update failed&artikal_id=".$params['id'];
		    header($url);
	    }

		if (headers_sent()) {
			die("Update is successfull, but redirect failed. Please click on this link: <a href='index.php'>Here</a>");
		}
		else{
    		exit(header("Location: ".BASE_URL."index.php?page=update-profile"));
		}

 