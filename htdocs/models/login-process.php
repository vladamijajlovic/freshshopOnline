<?php

session_start();
$error = array();

//FORM DATA
$email = validate_input_email($_POST['emailLogin']);
if(empty($email)) {
    $error[] = "You forgot to enter your email";
}
else {
    $odgovor = ['message' => 'Your email is gud'];
    echo $email.'<br>';
}

$password = validate_input_text($_POST['passwordLogin']);
if(empty($password)) {
    $error[] = "You forgot to enter your password";
}
else {
    $odgovor = ['message' => 'Your password is gud'];
    echo $password.'<br>';
}

$pas = $_POST['passwordLogin'];


if(isset($_POST['loginSubmit'])){

    if(empty($error)){
        //sql query1

        $query = $conn->prepare("SELECT id_korisnik, ime, prezime, email, password, uloga_id FROM korisnik WHERE email=:email");

        //bind
        $query->bindParam(':email', $email);

        try {
            $exec = $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if($exec) {

                if(!empty($result)){
                    var_dump($password);
                    if(password_verify($password, $result['password'])){
                        $getUloga = $result['uloga_id'];
                        $_SESSION['uloga'] = $getUloga;
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id_korisnik'] = $result['id_korisnik'];
                        $_SESSION['ime'] = $result['ime'];
                        $_SESSION['email'] = $result['email'];
                        header('Location: index.php?page=home');
                        exit();
                    }else {
                        $_SESSION['loggedin'] = false;
                        echo "Email or password is not ok";
                        header('location: index.php?page=login&error=Email or password is not ok!');
                        exit();
                    }
                } else {
                    header('location: index.php?page=login&error=You are not a member, please register!');
                }
            } else {
                header('location: index.php?page=login&error=You are not logged in!');
            }
        } catch (PDOException $exception) {

        }
    } else {
        header('location: index.php?page=login&error=Please fill out email and password to login!');
    }
}
