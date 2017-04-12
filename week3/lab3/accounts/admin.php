<?php
//start the session
session_start();

// include page that will only allow logged in users to continue
include './views/sessionAccess.html.php';

// add in ability to autoload classes
include './autoload.php';
// autoload required classes
$util = new Util();
$accounts = new Accounts();

// add in html header
include './views/header.html.php';

// process the page if the user clicked logout
if($util->isPostRequest()) {
  session_destroy();
  $util->redirect("login.php");
}

// include views after appropriate data has been processed
include './views/admin.html.php';

// add in html footer
include './views/footer.html.php';
?>
