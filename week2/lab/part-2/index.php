<?php

// add in html header
include './templates/header.html.php';

// add in ability to autoload classes
require_once './autoload.php';

// create instances of required classes
$dbAddress = new DBAddress();

// get addresses from database
$addresses = $dbAddress->getAllAddress();

// add in required views
include './templates/view-address.html.php';

// add in html footer
include './templates/footer.html.php';

?>
