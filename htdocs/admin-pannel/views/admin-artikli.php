
<?php 

	$query = $conn->prepare("SELECT art.id_artikal as artId, art.naziv as nazivArt, art.opis as opis, art.cena as cena, art.promocije as promocije, art.brojcano_stanje as broj, kat.naziv as nazivKat 
							 FROM artikal art 
							 INNER JOIN kategorija kat 
							 ON kat.id_kategorija = art.kategorija_id 
							 ORDER BY art.id_artikal");

     try {
        $exec2 = $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
          	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikli&error=Nema artikala";
            header($url);
        }

    } catch (PDOException $exception) {
        var_dump($exception->getMessage()); die;
    }

    $artikli = $result;

    $updateUrl = BASE_URL . 'admin-pannel/admin-index.php?admin-page=artikal-update&artikal_id=';
 ?>


<div class="span9">
					<div class="content">

						<div class="btn-controls">
							<div class="module">
								<div class="module-head">
									<h3>Articles</h3>
								</div>

								<!-- ispis svih artikala -->
								<div class="module-body">
									
									<table class="table table-striped">
									<thead>
										<tr>
											<th>id</th>
											<th>Name</th>
											<th>Description</th>
											<th>Price</th>
											<th>Promotions</th>
											<th>Numerical State</th>
											<th>Category</th>
											<th>Update</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											foreach ($artikli as $artikal):
										 ?>
											<tr id="<?php echo 'artikal-'.$artikal['artId']; ?>">
												<td><?php echo $artikal['artId']; ?></td>
												<td><?php echo $artikal['nazivArt']; ?></td>
												<td><?php echo $artikal['opis']; ?></td>
												<td><?php echo '$ ' . $artikal['cena']; ?></td>
												<td><?php echo $artikal['promocije']; ?></td>
												<td><?php echo $artikal['broj']; ?></td>
												<td><?php echo $artikal['nazivKat']; ?></td>
												<td><a href='<?php echo $updateUrl . $artikal['artId'] ?>'>Update</a></td>
												<td>
													<input 	type="button" 
															class=".btn .btn-primary" 
															onclick='deleteArtikal(<?php echo $artikal['artId'];?>)'
															value="Delete"
													>
												</td>
											</tr>
										<?php 
											endforeach;
										 ?>
									</tbody>
									</table>
								</div>

								<?php
								
								$queryAdminCateg = $conn -> prepare("SELECT * FROM kategorija");
								try {
									$queryAdminCateg -> execute();
									$resultAdminCateg = $queryAdminCateg->fetchAll(PDO::FETCH_ASSOC);
								} catch(PDOException $exception) {

								}

								$categories = $resultAdminCateg;
								$actionAddArt = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-artikal-insert";
								?>

								<!-- dodavanje novog artikla -->
								<div class="module-head">
									<h3>Add new article</h3>
								</div>
								<div class="module-body">
									
									<form id="formInsertArticle" 
										  class="form-horizontal row-fluid" 
										  method="POST" 
										  action="<?php echo $actionAddArt ?>" 
										  enctype='multipart/form-data'
									>
										<div class="control-group">
											<label class="control-label" for="basicinput">Name</label>
											<div class="controls">
												<input type="text" name="naziv-art" id="nameInput" placeholder="Article..." class="span8">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Description</label>
											<div class="controls">
												<input type="text" name="desc-art" id="descInput" placeholder="Type something here..." class="span8">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Price</label>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on">$</span><input type="text" name="price-art" id="priceInput" placeholder="Price..." class="span8">
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Promotions</label>
											<div class="controls">
												<input type="text" name="promo-art" id="promoInput" placeholder="Promotions..." class="span8">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Numerical State</label>
											<div class="controls">
												<input type="text" name="num-art" id="numInput" placeholder="Number..." class="span8">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Category</label>
											<div class="controls">
												<select id="categDdl" name="category"> 
													<option value="0">Select category...</option>
													<?php foreach ($categories as $category): ?>
												  		<option value='<?php echo $category['id_kategorija'] ?>' > 
												  			<?php echo $category['naziv']; ?>	
												  		</option>
												  	<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Image</label>
											<div class="controls">
												<input type='file' name='file' id="file" class="span8">
											</div>
										</div>

										<input type="submit" name="submit-new-article" value="Add article" class="btn btn-primary">
									</form>
									<div class="control-group">
											<?php if(isset($_GET['error'])): ?>
											<p class="article-insert-error"><?php echo $_GET['error']; ?></p>
											<?php endif; ?>
									</div>
								</div>
							</div>
						</div><!--/.btn-controls-->
					</div><!--/.content-->
				</div><!--/.span9-->