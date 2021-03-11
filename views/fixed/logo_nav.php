<!-- Start Main Top -->
<header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php?page=home"><img src="images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->
                <?php
                    $queryNav = $conn -> prepare("SELECT * FROM navigacija");
                    $queryNav-> execute();
                    $rezultat = $queryNav->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <?php foreach ($rezultat as $value): ?>
                            <li><a class="nav-link" href="<?php echo 'index.php?'.$value['href']; ?>"><?php echo $value["naziv"]; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul><?php

                        function cartHref() {
                            echo BASE_URL . "index.php?page=cart";
                        }

                        ?>
                        <li class="cart-icon">
							<a href="<?php cartHref(); ?>">
								<i class="fa fa-shopping-bag"></i>
								<span class="badge"><?php echo (!empty($_SESSION['quantity'])) ? $_SESSION['quantity'] : 0; ?></span>
								<p>My Cart</p>
							</a>
						</li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>