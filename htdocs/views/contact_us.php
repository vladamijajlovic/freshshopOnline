
<div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Contact Us</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <?php 
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) :
                    ?>

                        
                    <div class="contact-form-right">
                        <h2>GET IN TOUCH</h2>
                        <form id="contactForm" action="<?php echo BASE_URL . 'index.php?page=ContactProcess' ?>" method="POST" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo $_SESSION['ime'] ?>">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Your Email" id="email" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="msg_subject" name="subject" placeholder="Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" name="message" placeholder="Your Message" rows="4" data-error="Write your message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <!-- <button class="btn hvr-hover" id="submit" name="submitContactForm" value="submit" type="submit">Send Message</button> -->
                                        <input class="btn hvr-hover" type="submit" name="submitContactForm" value="Submit">
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="loginFormErrors" class="form-row">
                            <?php   if(isset($_GET['error'])) {
                                        echo $_GET['error'];
                                    } 
                                    if(isset($_GET['success'])) {
                                        echo $_GET['success'];
                                    }
                            ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="contact-form-right">
                        <h2>You must be logged in to contact us! Log in <span><a href="index.php?page=login">here</a>!</span></h2>
                    </div>
                        
                    <?php endif; ?>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CONTACT INFO</h2>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 9000 <br>Preston Street Wichita,<br> KS 87213 </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact -->