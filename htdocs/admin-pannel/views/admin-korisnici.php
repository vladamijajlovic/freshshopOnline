
<?php 

    $query = $conn->prepare("SELECT id_korisnik, ime, prezime, email, DATE_FORMAT(datum,'%Y-%m-%d') AS datum_logovanja, DATE_FORMAT(datum,'%h-%i-%s') AS vreme_logovanja, u.naziv AS naziv_uloge
    						 FROM uloga u 
    						 INNER JOIN korisnik k 
    						 ON u.id_uloga = k.uloga_id");

     try {
        $execCateg = $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            $url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=artikli&error=Nema artikala";
            header($url);
        }

    } catch (PDOException $exception) {
        var_dump($exception->getMessage()); die;
    }

    $korisnici = $result;

    $updateUrl = BASE_URL . 'admin-pannel/admin-index.php?admin-page=user-update&user_id=';
    $actionAddUser = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-user-insert";

 ?>

<div class="span9">
					<div class="content">

						<div class="module">

							<div class="module-head">
                                <h3>
                                    Users</h3>
                            </div>
                            <div class="module-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>E-mail</th>
                                            <th>Register Date</th>
                                            <th>Register Time</th>
                                            <th>Role</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php foreach ($korisnici as $korisnik): ?>

                                            <tr id="<?php echo 'korisnik-'.$korisnik['id_korisnik']; ?>">
                                                <td><?php echo $korisnik['id_korisnik'] ?></td>
                                                <td><?php echo $korisnik['ime'] ?></td>
                                                <td><?php echo $korisnik['prezime'] ?></td>
                                                <td><?php echo $korisnik['email'] ?></td>
                                                <td><?php echo $korisnik['datum_logovanja'] ?></td>
                                                <td><?php echo $korisnik['vreme_logovanja'] ?></td>
                                                <td><?php echo $korisnik['naziv_uloge'] ?></td>
                                                <td><a href='<?php echo $updateUrl . $korisnik['id_korisnik'] ?>'>Update</a></td>
                                                <td>
                                                    <input  type="button" 
                                                            class=".btn .btn-primary" 
                                                            onclick='deleteUser(<?php echo $korisnik['id_korisnik'];?>)'
                                                            value="Delete"
                                                    >
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </tbody>
                                    </table>
                            </div>
                            <?php

								$queryUloga = $conn -> prepare("SELECT * FROM uloga");
								try {
									$queryUloga -> execute();
									$resultUloga = $queryUloga->fetchAll(PDO::FETCH_ASSOC);
								} catch(PDOException $exception) {

								}

								$uloge = $resultUloga;
								$actionAddArt = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-artikal-insert";
                             ?>
                            <!-- dodavanje novog korisnika -->
                                <div class="module-head">
                                    <h3>Add new user</h3>
                                </div>
                                <div class="module-body">
                                    
                                    <form id="formInsertUser" class="form-horizontal row-fluid" method="POST" action="<?php echo $actionAddUser ?>">
                                        <div class="control-group">
                                            <label class="control-label">Name</label>
                                            <div class="controls">
                                                <input type="text" name="ime-korisnika" id="nameInput" placeholder="User name..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Last Name</label>
                                            <div class="controls">
                                                <input type="text" name="prezime-korisnika" id="nameInput" placeholder="User last name..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">E-mail</label>
                                            <div class="controls">
                                                <input type="text" name="email-korisnika" id="nameInput" placeholder="User e-mail..." class="span8">
                                                <span class="help-inline">E-mail format: example@gmail.com</span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Password</label>
                                            <div class="controls">
                                                <input type="password" name="password-korisnika" id="nameInput" placeholder="User password..." class="span8">
                                                <span class="help-inline">Password format: Qwer92</span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Role</label>
											<div class="controls">
												<select id="categDdl" name="uloga"> 
													<option value="0">Select User Role...</option>
													<?php foreach ($uloge as $uloga): ?>
													  	<option value='<?php echo $uloga['id_uloga'] ?>' > 
													  		<?php echo $uloga['naziv']; ?>	
													  	</option>
													  <?php endforeach; ?>
												</select>
											</div>
                                        </div>
                                        
                                        <input type="submit" name="submit-new-user" value="Add user" class="btn btn-primary">
                                    </form>
                                    
                                    <div class="control-group">
                                            <?php if(isset($_GET['error'])): ?>
                                            <br />
                                            <div class="alert alert-error">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>Oh snap!</strong> <?php echo $_GET['error']; ?>
											</div>
                                            <?php endif; ?>
                                            <?php if(isset($_GET['success'])): ?>
                                            	<br />
                                            	<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert">×</button>
													<strong>Cool!</strong> <?php echo $_GET['success']; ?>
												</div>
                                            <?php endif; ?>
                                    </div>
                                </div>


                            <!-- ============================================================================================================================== -->
                            
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->