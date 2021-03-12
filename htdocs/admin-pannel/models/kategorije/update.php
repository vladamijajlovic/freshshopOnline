<?php 
if(isset($_POST['updateCategory'])){
	$params = $_POST;

	$query = $conn->prepare("UPDATE kategorija SET 
								`naziv`=:naziv
							WHERE id_kategorija = :id"
						);

	$query->bindParam(":id", $params['id']);
    $query->bindParam(":naziv", $params['name']);

    try {
        $exec2 = $query->execute();

    } catch (PDOException $exception) {
    	$url = "location: " .BASE_URL."admin-pannel/admin-index.php?admin-page=category-update&error=Neuspesan update&category_id=".$params['id'];
        header($url);
    }

    $url = "location: " .BASE_URL."admin-pannel/admin-index.php?admin-page=kategorije&success=Uspesan update&category_id=".$params['id'];
    header($url);

}