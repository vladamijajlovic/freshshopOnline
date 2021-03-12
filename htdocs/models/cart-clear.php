<?php 
session_start();
$msg = $_POST['cartMsg'];
if(isset($msg)){
	unset($_SESSION['artikli']);
	unset($_SESSION['quantity']);

echo json_encode([
        'message' => $msg
    ]);
}

	


