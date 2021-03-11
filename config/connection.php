<?php

require_once "config.php";

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo $conn ? 'connected' : 'not connected';
}catch (PDOException $exception) {
    echo $exception -> getMessage();
}

if (!function_exists('executeQuery')) {
    function executeQuery($upit) {
        global $conn;
//    return $conn->query($upit)->fetchAll();
        $stmt = $conn->prepare($upit);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}





