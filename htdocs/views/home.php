

<?php  

$querySlider = $conn -> prepare("SELECT * FROM slider");
$querySlider->execute();
$result = $querySlider->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <?php foreach ($result as $value): ?>
            <li class="text-center">
                <img src="<?php echo BASE_URL . 'images/slider/' . $value['src']; ?>" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <?php

    $queryCheapestProducts = $conn -> prepare("SELECT * FROM artikal a INNER JOIN slika_artikal sa ON a.id_artikal = sa.artikal_id INNER JOIN slika s ON s.id_slika = sa.slika_id ORDER BY a.cena ASC LIMIT 3 ");
    $queryCheapestProducts-> execute();
    $cheapestResults = $queryCheapestProducts->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row container-fluid">
                <h1>Cheapest products from our offer!</h1>
            </div><br/><br/>
            <div class="row">
                <?php foreach ($cheapestResults as $cheapestResult): ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="<?php echo 'images/artikli/' . $cheapestResult['putanja'] ?>" alt="<?php echo $cheapestResult['alt'] ?>" />
                        <a class="btn hvr-hover" href="<?php echo BASE_URL . 'index.php?page=shop_detail&id=' . $cheapestResult['id_artikal']; ?>"><?php echo $cheapestResult['naziv'] ?></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- End Categories -->
	
	

    

   