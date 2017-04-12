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
$validation = new Validation();

// get the items being posted to this index page
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

// set up model data for views to display
$errors = [];
$message = '';

// handle post requests
if($util->isPostRequest()) {

  // check to make sure data is valid
  if(!$validation->emailIsValid($email)) {
    $errors[] = 'Email is not valid!';
  }

  // check to make sure email is unique
  if($accounts->emailExists($email)) {
    $errors[] = 'Email already exists!';
  }

  // check to make sure password is valid
  if(!$validation->passwordIsValid($password)) {
    $errors[] = 'Password must start with a letter and be between 8 and 15 characters!';
  }

  // if there were no errors then move foward with the insert
  if(!count($errors)) {

    if($accounts->signup($email, $password)) {
      // set message to success
      $message = 'Signed up successfully!';
      // redirect to login page
      $util->redirect("login.php", array('email'=>$email, 'message'=>$message));
    } else {
      // add an error if the call to addAddress failed
      $errors[] = 'Account could not be created!';
    }

  }

}

// include views after appropriate data has been processed
include './views/errors.html.php';
include './views/messages.html.php';
include './views/signup.html.php';

// add in html footer
include './views/footer.html.php';
?>
