

<?php

    if(isset($_GET['id'])):
        $getId = $_GET['id'];

        $query = $conn -> prepare('SELECT * FROM artikal a INNER JOIN slika_artikal sa ON a.id_artikal = sa.artikal_id INNER JOIN slika s ON s.id_slika = sa.slika_id WHERE id_artikal = :id');
        $query->bindParam(":id", $getId);
        try {
            $query->execute();
            $rezultat = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo 'Greska: ', $exception->getMessage(), "\n";
        }

?>

<!-- Start All Title Box -->
<div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">

            <!-- product info! div -->
            <?php foreach ($rezultat as $value): ?>
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="<?php echo 'images/artikli/' . $value['putanja'] ?>" alt="First slide"> </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2><?php echo $value['naziv']?></h2>
                        <h5><?php echo '$ ' . $value['cena']?></h5>

                        <?php
                        if($value['brojcano_stanje'] > 20):
                        ?>
                        <p class="available-stock"><span> More than <b>20</b> available</span><p>
                        <?php else: ?>
                        <p class="available-stock"><span> We have <b><?php echo $value['brojcano_stanje'] ?></b> left available</span><p>
                        <?php endif; ?>

						<h4>Short Description:</h4>
						<p> <?php echo $value['opis']?> </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
    <!-- End shop detail -->

    <?php else: ?>
    <?php
        http_response_code(404);
        include('my404.php');
        die();
    ?>

<?php endif; ?>