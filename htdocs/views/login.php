<?php

include 'config/connection.php';

?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Login</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Login</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<div class="container">
    <div class="row new-account-login">
        <div class="col-sm-6 col-lg-6 mb-3">
            <div class="title-left">
                <h3>Account Login</h3>
            </div>
            <form class="review-form-box" id="formLogin" method="POST" action="index.php?page=login" novalidate>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputEmail" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" id="loginEmail" name="emailLogin" placeholder="Enter Email"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputPassword" class="mb-0">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="passwordLogin" placeholder="Password"> </div>
                </div>
                <div id="loginFormErrors" class="form-row">
                    <?php if(isset($_GET['error'])) {
                        echo $_GET['error'];
                    } ?>
                </div>
                <input type="submit" value="Login" name="loginSubmit" class="btn hvr-hover">
            </form>
        </div>
    </div>
</div>