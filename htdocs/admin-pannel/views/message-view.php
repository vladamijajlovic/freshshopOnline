


<?php 

	
	if(isset($_GET['message_id'])) {

		$messageId = $_GET['message_id'];

		$query = $conn->prepare("SELECT * FROM kontakt WHERE id = :id");
	    $query->bindParam(":id", $messageId);

	     try {
	        $exec2 = $query->execute();
	        $result = $query->fetchAll(PDO::FETCH_ASSOC);

	        if (empty($result)) {
	          	$url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=message-view&error=No messages";
	            header($url);
	        }

	    } catch (PDOException $exception) {
	        var_dump($exception->getMessage()); die;
	    }

	    $message = (object)$result[0];

	    $actionForm = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-user-update";
	}
	
	
 ?>

<div class="span9">
	<div class="content">

		<div class="btn-controls">
			<div class="module">

				<div class="module-body">

					<form class="form-horizontal row-fluid" action='' method="POST">
										<input type="hidden" name="id" id="basicinput" placeholder="Article..." class="span8" value='<?php echo $message->id ?>'>
										<div class="control-group">
                                            <label class="control-label">Name</label>
                                            <div class="controls">
                                            	<p><?php echo $message->ime_prezime ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                            	<p><?php echo $message->email ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Subject</label>
                                            <div class="controls">
                                            	<p><?php echo $message->naslov ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Message</label>
                                            <div class="controls">
                                            	<p><?php echo $message->poruka ?></p>
                                            </div>
                                        </div>
                                        <a href="<?php echo BASE_URL . 'admin-pannel/admin-index.php?admin-page=received-messages' ?>">GO BACK</a>  
					</form>

				</div>
			</div>
		</div>
	</div>
</div>