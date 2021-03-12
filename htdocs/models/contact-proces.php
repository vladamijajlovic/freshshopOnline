<?php 
    
        

        $imePrezime = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $validateName = "/^[A-Z][a-z]{2,30}$/";
        $validateEmail = "/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i";
        $validateSubject = "/^[A-Z][a-z]{0,30}$/";

        $isOk = false;

        if(preg_match($validateName, $imePrezime)) {
            $isOk = true;
        }

        if(preg_match($validateEmail, $email)) {
            $isOk = true;
        }

        if(preg_match($validateSubject, $subject)) {
            $isOk = true;
        }

        if(!empty($message)) {
            $isOk = true;
        }

        if($isOk) {
            $query = $conn->prepare("INSERT INTO kontakt(ime_prezime, email, naslov, poruka) VALUES(:ime_prezime, :email, :naslov, :poruka)");

            //bindovanje placeholdera iz upita
            $query->bindParam(':ime_prezime', $imePrezime);
            $query->bindParam(':email', $email);
            $query->bindParam(':naslov', $subject);
            $query->bindParam(':poruka', $message);

            try {
                $exec = $query->execute();

                if (headers_sent()) {
                    die("Message is successfully sent, but redirect failed. Please click on this link: <a href='index.php?page=contact_us'>Here</a>");
                }
                else{
                    exit(header("Location: ".BASE_URL."index.php?page=contact_us"));
                }

            } catch (PDOException $exception) {
                header('location: index.php?page=contact_us&error=Not able to send message!');
            }

        }

        
    

	

