<?php


require (ABSOLUTE_PATH . 'models/helper.php');

$error = array();

if(isset($_POST['registerSubmit'])){

    $firstName = validate_input_text($_POST['fName']);
    if(empty($firstName)) {
        $error[] = "You forgot to enter your first name";
    }
    else {
        //Provera preko regExp-a
    }

    $lastName = validate_input_text($_POST['lName']);
    if(empty($lastName)) {
        $error[] = "You forgot to enter your last name";
    }
    else {
        //Provera preko regExp-a
    }

    $email = validate_input_email($_POST['email']);
    if(empty($email)) {
        $error[] = "You forgot to enter your email";
    }
    else {
        //Provera preko regExp-a
    }

    $password = validate_input_text($_POST['password']);
    if(empty($password)) {
        $error[] = "You forgot to enter your password";
    }
    else {
        //Provera preko regExp-a
    }


//    if (!empty($query)) {
//        //ako korisnik sa ovim mejlom postoji u bazi, treba vratiti gresku.
//    }
    if(empty($error))
    {
        //PROVERA ZA UNIQUE EMAIL PRI REGISTRACIJI
        $query2 = $conn -> prepare("SELECT * FROM korisnik WHERE email = :email");
        $query2->bindParam(":email", $email);

        try {

            $exec2 = $query2->execute();
            $rezult = $query2->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($rezult)) {
                 header('location: index.php?page=register&error=Email vec postoji');
            }

        } catch (PDOException $exception) {
            var_dump($exception->getMessage()); die;
        }

        //ONDA OVDE U KOLIKO UNETI EMAIL NE POSTOJI U BAZI, UNETI KORISNIKA U BAZU
        //register a new user
        $datum = date("Y-m-d H:i:s");
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        // $length = 50;    
        $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
        $uloga = [1, 2];

        //make query
        $query = $conn->prepare("INSERT INTO korisnik(ime, prezime, email, password, email_token, datum, uloga_id) VALUES(:ime, :prezime, :email, :password, :token, :datum, :uloga_id)");

        //bindovanje placeholdera iz upita
        $query->bindParam(':ime', $firstName);
        $query->bindParam(':prezime', $lastName);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashedPass);
        $query->bindParam(':token', $token);
        $query->bindParam(':datum', $datum);
        $query->bindParam(':uloga_id', $uloga[1]);

        try {
            $exec = $query->execute();

            // $message = "Molimo kliknite na link da verifikujete email: <a href='http://localhost/freshshopNovi/freshshop01/index.php?page=verifyEmail&token=".$token."'>verifikovanje email-a</a>";
            // $to      = $email;
            // $subject = 'Email verification';
            // $message = $message;

            // $headers = 'From: webmaster@example.com' . "\r\n" .
            //             'Reply-To: webmaster@example.com' . "\r\n" .
            //             'X-Mailer: PHP/' . phpversion();

            try {
                // mail($to, $subject, $message, $headers); 
                header('location: index.php?page=login');
            } catch (Exception $e) {
                header('location: index.php?page=login');    
            }
            

        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            header('location: index.php?page=register&error=Greska pri registraciji');
        }

    } else {
        header('Location: index.php?page=register$error=Register error, double check data you just entered!');
    }
}
