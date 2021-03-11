<?php
session_start();
unset($_SESSION["uloga"]);
unset($_SESSION["loggedin"]);
unset($_SESSION["id_korisnik"]);
unset($_SESSION["ime"]);
unset($_SESSION["email"]);
header('Location: ../index.php?page=home');