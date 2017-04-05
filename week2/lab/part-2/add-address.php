<?php

// add in html header
include './templates/header.html.php';

// add in ability to autoload classes
require_once './autoload.php';

// create instances of required classes
$dbAddress = new DBAddress();
$utilities = new Utilities();
$validation = new Validation();

// get the items being posted to this index page
$fullName = filter_input(INPUT_POST, 'fullName');
$email = filter_input(INPUT_POST, 'email');
$addressLine1 = filter_input(INPUT_POST, 'addressLine1');
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$zip = filter_input(INPUT_POST, 'zip');
$birthday = filter_input(INPUT_POST, 'birthday');

// set up model data for views to display
$states = $utilities->getStates();
$errors = [];
$message = '';

// handle post requests
if($utilities->isPostRequest()) {

  // check to make sure data is valid
  if(empty($fullName)) {
    $errors[] = 'Full name is not valid!';
  }

  if(!$validation->emailIsValid($email)) {
    $errors[] = 'Email is not valid!';
  }

  if(empty($addressLine1)) {
    $errors[] = 'Address Line 1 is not valid!';
  }

  if(empty($city)) {
    $errors[] = 'City is not valid!';
  }

  if(empty($state)) {
    $errors[] = 'State is not valid!';
  }

  if(!$validation->zipIsValid($zip)) {
    $errors[] = 'Zip is not valid!';
  }

  if(!$validation->dateIsValid($birthday)) {
    $errors[] = 'Birthday is not valid!';
  }

  // if there were no errors then move foward with the insert
  if(!count($errors)) {

    // try to add the address
    if($dbAddress->addAddress($fullName, $email, $addressLine1, $city, $state, $zip, $birthday)) {
      // set message to success
      $message = 'Address added!';

      // clear form fields
      $fullName = '';
      $email = '';
      $addressLine1 = '';
      $city = '';
      $state = '';
      $zip = '';
      $birthday = '';

    } else {
      // add an error if the call to addAddress failed
      $errors[] = 'Address could not be added!';
    }

  }

}

// include required views
include './templates/errors.html.php';
include './templates/messages.html.php';
include './templates/add-address.html.php';

// add in html footer
include './templates/footer.html.php';

?>
