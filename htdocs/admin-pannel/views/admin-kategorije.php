

<?php 

    $query = $conn->prepare("SELECT * FROM kategorija");

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

    $kategorije = $result;

    $updateUrl = BASE_URL . 'admin-pannel/admin-index.php?admin-page=category-update&category_id=';
    $actionAddCateg = BASE_URL . "admin-pannel/admin-index.php?admin-page=post-category-insert";

 ?>

<div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>
                                    Categories</h3>
                            </div>
                            <div class="module-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php foreach ($kategorije as $kategorija): ?>
                                            <tr id="<?php echo 'kategorija-'.$kategorija['id_kategorija']; ?>">
                                                <td><?php echo $kategorija['id_kategorija'] ?></td>
                                                <td><?php echo $kategorija['naziv'] ?></td>
                                                <td><a href='<?php echo $updateUrl . $kategorija['id_kategorija'] ?>'>Update</a></td>
                                                <td>
                                                    <input  type="button" 
                                                            class=".btn .btn-primary" 
                                                            onclick='deleteCategory(<?php echo $kategorija['id_kategorija'];?>)'
                                                            value="Delete"
                                                    >
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </tbody>
                                    </table>
                            </div>
                            <!-- dodavanje nove kategorije-->
                                <div class="module-head">
                                    <h3>Add new category</h3>
                                </div>
                                <div class="module-body">
                                    
                                    <form id="formInsertArticle" class="form-horizontal row-fluid" method="POST" action="<?php echo $actionAddCateg ?>">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Name</label>
                                            <div class="controls">
                                                <input type="text" name="naziv-categ" id="nameInput" placeholder="Category name..." class="span8">
                                            </div>
                                        </div>
                                        
                                        <input type="submit" name="submit-new-category" value="Add category" class="btn btn-primary">
                                    </form>
                                    <div class="control-group">
                                            <?php if(isset($_GET['error'])): ?>
                                            <p class="article-insert-error"><?php echo $_GET['error']; ?></p>
                                            <?php endif; ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->