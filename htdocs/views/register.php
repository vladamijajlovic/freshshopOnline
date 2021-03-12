<?php

?>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Register</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Register</li>
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
                <h3>Create New Account</h3>
            </div>
            <form class="mt-3 review-form-box" id="formRegister" method="POST" action="<?php echo BASE_URL . 'index.php?page=register-member' ?>" novalidate>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">First Name</label>
                        <input type="text" class="form-control" id="registerName" placeholder="First Name" name="firstName" value="<?php if(isset($_POST['fName'])) echo $_POST['fName'];?>"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputLastname" class="mb-0">Last Name</label>
                        <input type="text" class="form-control" id="registerLastName" placeholder="Last Name" name="lastName" value="<?php if(isset($_POST['lName'])) echo $_POST['lName'];?>"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" id="registerEmail" placeholder="Enter Email" name="regEmail" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputPassword1" class="mb-0">Password</label>
                        <input type="password" class="form-control" id="registerPassword" placeholder="Password" name="regPassword" value=""> </div>
                </div>
                <div id="registerFormErrors" class="form-row">
                    <?php 
                        if(isset($_REQUEST['error'])) {
                            echo "<p>". $_REQUEST['error'] . "</p>";
                        }
                     ?>
                </div>
                <input type="submit" value="Register" name="registerSubmit" class="btn hvr-hover">
<!--                <button type="submit" class="btn hvr-hover">Register</button>-->
            </form>
        </div>
    </div>
</div>