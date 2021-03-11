<?php 

	
	// if(isset($_GET['error'])) {
	// 	$_GET['error'];
	// }
	
	$artikalId = $_GET['category_id'];


	$query = $conn->prepare("SELECT * FROM kategorija WHERE id_kategorija = :id");
    $query->bindParam(":id", $artikalId);

     try {
        $exec2 = $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
          	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=category-update&error=Empty category";
            header($url);
        }

    } catch (PDOException $exception) {
        var_dump($exception->getMessage()); die;
    }

    $kategorija = (object)$result[0];


    $actionForm = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-category-update";
 ?>

<div class="span9">
	<div class="content">

		<div class="btn-controls">
			<div class="module">

				<div class="module-body">

					<form class="form-horizontal row-fluid" action='<?php echo $actionForm ?>' method="POST">
						<input type="hidden" name="id" id="basicinput" placeholder="Category..." class="span8" value='<?php echo $kategorija->id_kategorija ?>'>
						<div class="control-group">
							<label class="control-label" for="basicinput">Name</label>
							<div class="controls">
								<input type="text" name="name" id="basicinput" placeholder="Category..." class="span8" value='<?php echo $kategorija->naziv ?>'>
							</div>
						</div>
						
						<input type="submit" name="updateCategory" value="Update" class="btn btn-primary">
					</form>

				</div>
			</div>
		</div>
	</div>
</div>