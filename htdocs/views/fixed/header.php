<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="our-link">
                        <ul>
                            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                            <li><a href="index.php?page=profile"><i class="fa fa-user s_color"></i> My profile</a></li>
                            <li><a href="models/logout.php"><i class="fa fa-user s_color"></i> Log out</a></li>
                                <?php if(isset($_SESSION['uloga']) && $_SESSION['uloga'] == 1) : ?>
                                <li><a href="admin-pannel/admin-index.php?admin-page=home"><i class="fa fa-user s_color"></i> Admin Panel</a></li>
                                <?php endif; ?>
                            <?php else: ?>
                            <li><a href="index.php?page=register"><i class="fa fa-user s_color"></i> Register</a></li>
                            <li><a href="index.php?page=login"><i class="fas fa-location-arrow"></i> Log in</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo BASE_URL . "Documentation.pdf"; ?>"><i class="fa fa-user s_color"></i> Documentation</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="text-slid-box">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->