
<?php 

    $queryMessage = $conn->prepare("SELECT * FROM kontakt");

     try {
        $queryMessage->execute();
        $resultMessage = $queryMessage->fetchAll(PDO::FETCH_ASSOC);
        if (empty($resultMessage)) {
            $url = "location: " . BASE_URL . "admin-pannel/admin-index.php?admin-page=received-messages&error=Nema artikala";
            header($url);
        }

    } catch (PDOException $exception) {
        var_dump($exception->getMessage()); die;
    }

    $messages = $resultMessage;

    $updateUrl = BASE_URL . 'admin-pannel/admin-index.php?admin-page=message-view&message_id=';
    $actionAddUser = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-user-insert";

 ?>

<div class="span9">
					<div class="content">

						<div class="module">

							<div class="module-head">
                                <h3>
                                    Messages</h3>
                            </div>
                            <div class="module-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Subject</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php foreach ($messages as $message): ?>

                                            <tr id="<?php echo 'message-'.$message['id']; ?>">
                                                <td><?php echo $message['id'] ?></td>
                                                <td><?php echo $message['ime_prezime'] ?></td>
                                                <td><?php echo $message['email'] ?></td>
                                                <td><?php echo $message['naslov'] ?></td>
                                                <td><a href='<?php echo $updateUrl . $message['id'] ?>'>View</a></td>
                                                <td>
                                                    <input  type="button" 
                                                            class=".btn .btn-primary" 
                                                            onclick='deleteMessage(<?php echo $message['id'];?>)'
                                                            value="Delete"
                                                    >
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </tbody>
                                    </table>
                            </div>
                           
                            


                            <!-- ============================================================================================================================== -->
                            
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->