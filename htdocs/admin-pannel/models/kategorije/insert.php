<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit-new-category']){

	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=kategorije";
	
	$nazivCateg = $_POST['naziv-categ'];

	if (empty($nazivCateg)) {
		header($url . "&error=Fill the form correctly");
	} else {

		$queryCategInsert = $conn ->prepare("INSERT INTO kategorija(naziv) 
		 								   VALUES(:naziv)");	

		$queryCategInsert -> bindParam(':naziv', $nazivCateg);
		try {

			$execInsert = $queryCategInsert->execute();
			
		} catch (Exception $e) {
			
		}

		
	    header($url . "&success=Insert uccessfully executed");


    }
}
else {
	header('location: '.BASE_URL.'admin-pannel/admin-index.php?admin-page=kategorije&errorInsert=Neovlasceni pristup');
}