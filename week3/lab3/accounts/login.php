<?php

// start the session
session_start();

// add in html header
include './views/header.html.php';

// add in ability to autoload classes
include './autoload.php';
// autoload required classes
$util = new Util();
$accounts = new Accounts();

// set up model data for views to display
$errors = [];
$message = '';

// get GET values
$email = $util->getUrlParam('email');
$message = $util->getUrlParam('message');

// process the credentials if the user just submitted the form
if ($util->isPostRequest()) {
    // get the email and password typed in by user
    $postArray = $util->getPostValues();
    $email = $postArray['email'];
    $password = $postArray['password'];

    $loginInfo = $accounts->login($email, $password);

    if ($loginInfo > 0) {
        $message = "Successfully logged in!";
        $_SESSION['user_id'] = $loginInfo;
        $_SESSION['email'] = $email;

        // redirect to the admin page
        $util->redirect("admin.php");
    } else {
        $errors[] = "Wrong username or password!";
    }
}

// include views after appropriate data has been processed
include './views/errors.html.php';
include './views/messages.html.php';
include './views/login.html.php';

// add in html footer
include './views/footer.html.php';
?>
