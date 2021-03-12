<?php
session_start();

require_once "../config/config.php";
require_once "../config/connection.php";

require_once "../models/helper.php";

include "views/fixed/admin-head.php";
include "views/fixed/admin-nav.php";

$isEmpty = empty($_SESSION['loggedin']);

if ($isEmpty) {
    header("location: " . BASE_URL . "index.php");
} elseif ($_SESSION['uloga'] != 1) {
    header("location: " . BASE_URL . "index.php");
}


if(!isset($_GET['admin-page'])) {
    include "views/admin-home.php";
} else {
    switch ($_GET['admin-page']) {
        

        case "artikli":
            include "views/admin-artikli.php";
            break;

        //----------------//

        case "kategorije":
            include "views/admin-kategorije.php";
            break;

        //----------------//

        case "korisnici":
            include "views/admin-korisnici.php";
            break;

        //----------------//

        case "received-messages":
            include "views/admin-messages.php";
            break;

        //-------ARTIKAL UPDATE/INSERT/DELETE---------//

        case "artikal-update":
            include "views/artikal-update.php";
            break;


        case "post-artikal-update":
            include "models/artikli/update.php";
            break;


        case "post-artikal-delete":
            include "models/artikli/delete.php";
            break;


        case "post-artikal-insert":
            include "models/artikli/insert.php";
            break;

        //--------CATEGORY UPDATE/INSERT/DELETE--------//

        case "post-category-insert":
            include "models/kategorije/insert.php";
            break;


        case "category-update":
            include "views/kategorija-update.php";
            break;


        case "post-category-update":
            include "models/kategorije/update.php";
            break;

        //---------USER UPDATE/INSERT/DELETE-------//

        case "post-user-insert":
            include "models/korisnici/insert.php";
            break;

        case "user-update":
            include "views/user-update.php";
            break;

        case "post-user-update":
            include "models/korisnici/update.php";
            break;
        //----------------//

        case "message-view":
            include "views/message-view.php";
            break;

        //----------------//
        default:
            include "views/admin-artikli.php";
    }
}


include "views/fixed/admin-footer.php";
        
                    
