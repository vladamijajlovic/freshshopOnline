

<?php 

	
	if(isset($_GET['user_id'])) {

		$userlId = $_GET['user_id'];

		$query = $conn->prepare("SELECT * FROM uloga u INNER JOIN korisnik k ON u.id_uloga = k.uloga_id 
								 WHERE id_korisnik = :id");
	    $query->bindParam(":id", $userlId);

	     try {
	        $exec2 = $query->execute();
	        $result = $query->fetchAll(PDO::FETCH_ASSOC);

	        if (empty($result)) {
	          	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=user-update&error=Korisnik ne postoji";
	            header($url);
	        }

	    } catch (PDOException $exception) {
	        var_dump($exception->getMessage()); die;
	    }

	    $korisnik = (object)$result[0];

	    $hashedPassword = $korisnik -> password;

	    $actionForm = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-user-update";
	}
	
	
 ?>
<div class="span9">
	<div class="content">

		<div class="btn-controls">
			<div class="module">

				<div class="module-body">

					<form class="form-horizontal row-fluid" action='<?php echo $actionForm ?>' method="POST">
										<input type="hidden" name="id" id="basicinput" placeholder="Article..." class="span8" value='<?php echo $korisnik->id_korisnik ?>'>
										<div class="control-group">
                                            <label class="control-label">Name</label>
                                            <div class="controls">
                                                <input type="text" name="ime-korisnika" id="nameInput" placeholder="User name..." class="span8" value='<?php echo $korisnik->ime ?>'>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Last Name</label>
                                            <div class="controls">
                                                <input type="text" name="prezime-korisnika" id="nameInput" placeholder="User last name..." class="span8" value='<?php echo $korisnik->prezime ?>'>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">E-mail</label>
                                            <div class="controls">
                                                <input type="text" name="email-korisnika" id="nameInput" placeholder="User e-mail..." class="span8" value='<?php echo $korisnik->email ?>'>
                                                <span class="help-inline">E-mail format: example@gmail.com</span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Password</label>
                                            <div class="controls">
                                                <input type="password" name="password-korisnika" id="nameInput" placeholder="User's new password..." class="span8">
                                                <span class="help-inline">Password format: Qwer92</span>
                                            </div>
                                        </div>
                                        <?php $verificationStatuses = ["Verified", "Not Verified"]; ?>
                                        <div class="control-group">
                                            <label class="control-label">Is verified</label>
											<div class="controls">
												<select id="categDdl" name="isVerified"> 
													<option value="0">User's verification status...</option>
														<?php if($korisnik->isVerified == 2): ?>
															<option value="1"><?php echo $verificationStatuses[0]; ?></option>
															<option value="2" selected><?php echo $verificationStatuses[1]; ?></option>
															<?php else: ?>
															<option value="1" selected><?php echo $verificationStatuses[0]; ?></option>
															<option value="2"><?php echo $verificationStatuses[1]; ?></option>
														<?php endif; ?>
													
												</select>
											</div>
                                        </div>

                                        <?php

                                        $queryUloga = $conn->prepare("SELECT * FROM uloga");
                                        $queryUloga->execute();
                                        $resultUloge = $queryUloga->fetchAll(PDO::FETCH_ASSOC);
                                         ?>

                                        <div class="control-group">
                                            <label class="control-label">Role</label>
											<div class="controls">
												<select id="categDdl" name="uloga"> 
													<option value="0">Select User Role...</option>
													<?php foreach ($resultUloge as $resultUloga): ?>
													  	<option value='<?php echo $resultUloga['id_uloga'] ?>' 

													  		<?php if ($resultUloga['id_uloga'] == $korisnik->uloga_id) echo "selected"; ?> 

													  		> 
													  		<?php echo $resultUloga['naziv']; ?>	
													  	</option>
													  <?php endforeach; ?>
												</select>
											</div>
                                        </div>
						<input type="submit" value="Update User" class="btn btn-primary">
					</form>

				</div>
			</div>
		</div>
	</div>
</div>