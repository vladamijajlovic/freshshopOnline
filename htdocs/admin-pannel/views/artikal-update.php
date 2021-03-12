

<?php 

	
	// if(isset($_GET['error'])) {
	// 	$_GET['error'];
	// }
	
	$artikalId = $_GET['artikal_id'];

	$query = $conn->prepare("SELECT * FROM artikal WHERE id_artikal = :id");
    $query->bindParam(":id", $artikalId);

     try {
        $exec2 = $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
          	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikal-update&error=Artikal ne postoji";
            header($url);
        }

    } catch (PDOException $exception) {
        var_dump($exception->getMessage()); die;
    }

    $artikal = (object)$result[0];

    $query = $conn->prepare("SELECT * FROM kategorija");

    try {
        $exec2 = $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
        if (empty($result)) {
          	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikal-update&error=Ne postoje";
            header($url);
        }

    } catch (PDOException $exception) {
        var_dump($exception->getMessage()); die;
    }

    $kategorije = $result;

    $actionForm = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-artikal-update";
 ?>
<div class="span9">
	<div class="content">

		<div class="btn-controls">
			<div class="module">

				<div class="module-body">

					<form class="form-horizontal row-fluid" action='<?php echo $actionForm ?>' method="POST">
						<input type="hidden" name="id" id="basicinput" placeholder="Article..." class="span8" value='<?php echo $artikal->id_artikal ?>'>
						<div class="control-group">
							<label class="control-label" for="basicinput">Name</label>
							<div class="controls">
								<input type="text" name="name" id="basicinput" placeholder="Article..." class="span8" value='<?php echo $artikal->naziv ?>'>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Description</label>
							<div class="controls">
								<input type="text" name="desc" id="basicinput" placeholder="Type something here..." class="span8" value="<?php echo $artikal->opis ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Price</label>
							<div class="controls">
								<input type="text" name="price" id="basicinput" placeholder="Price..." class="span8" value="<?php echo $artikal->cena ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Promotions</label>
							<div class="controls">
								<input type="text" name="promotions" id="basicinput" placeholder="Promotions..." class="span8" value="<?php echo $artikal->promocije ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Numerical State</label>
							<div class="controls">
								<input type="text" name="num" id="basicinput" placeholder="Number..." class="span8" value="<?php echo $artikal->brojcano_stanje ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Category</label>
							<div class="controls">
								<div class="dropdown">
									<select id="cars" name="category">
										<?php foreach ($kategorije as $kategorija): ?>
									  		<option 
									  			value='<?php echo $kategorija['id_kategorija'] ?>' 
									  			<?php if ($kategorija['id_kategorija'] == $artikal->kategorija_id) echo "selected"; ?> 
									  		> 
									  			<?php echo $kategorija['naziv']; ?>	
									  		</option>
									  	<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<input type="submit" value="submit" class="btn btn-primary">
					</form>

				</div>
			</div>
		</div>
	</div>
</div>