<?php
require_once "config/config.php";
require_once "config/connection.php";
require_once "models/helper.php";


if(isset($_POST['registerSubmit'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require('models/register-process.php');
    }
}

if(isset($_POST['loginSubmit'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require('models/login-process.php');
    }
}


include "views/fixed/head.php";
include "views/fixed/header.php";
include "views/fixed/logo_nav.php";
include "views/fixed/top_search.php";

    if(!isset($_GET['page'])){
        include "views/home.php";
    }
    else {
        switch ($_GET['page']){
            case "home":
                include "views/home.php";
                break;
            //-----------//
            case "about":
                include "views/about.php";
                break;
            //-----------//
            case "shop":
                include "views/shop.php";
                break;
            //-----------//
            case "shop_detail":
                include "views/shop_detail.php";
                break;
            //-----------//
            case "cart":
                include "views/cart.php";
                break;
            //-----------//
            case "wishlist":
                include "views/wishlist.php";
                break;
            //-----------//
            case "contact_us":
                include "views/contact_us.php";
                break;
            //-----------//
            case "login":
                include "views/login.php";
                break;
            //-----------//
            case "register":
                include "views/register.php";
                break;
            //-----------//
            case 'profile':
                require_once "views/profile.php";
                break;
            
            //-----------//
            case "register-member":
                require_once "models/register-process.php";
                break;
            //-----------//
            case 'ContactProcess':
                require_once "models/contact-proces.php";
                break;
            //-----------//
            
            case "verifyEmail":
                require_once "models/verify-email.php";
                break;

            //-----------//
            case "update-profile":
                require_once "models/update-profile.php";
                break;
            
            //-----------//
            default:
                include "views/home.php";
        }
    }


include "views/fixed/footer.php";





