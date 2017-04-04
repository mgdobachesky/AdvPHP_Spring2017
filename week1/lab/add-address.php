<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Michael Dobachesky - Lab 1</title>
        <!-- Bootswatch theme -->
        <link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css">
    </head>
    <body>
      <div class="container-fluid">
        <div class="col-md-12">
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="./index.php">Michael Dobachesky - Lab 1</a>
              </div>
              <ul class="nav navbar-nav">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./add-address.php">Add Address</a></li>
              </ul>
            </div>
          </nav>
        </div>

        <div class="col-md-10 col-md-offset-1">
        <?php

        // add in required model files
        require_once './models/dbconnect.php';
        require_once './models/util.php';
        require_once './models/validation.php';
        require_once './models/addressCrud.php';

        // get the items being posted to this index page
        $fullName = filter_input(INPUT_POST, 'fullName');
        $email = filter_input(INPUT_POST, 'email');
        $addressLine1 = filter_input(INPUT_POST, 'addressLine1');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $birthday = filter_input(INPUT_POST, 'birthday');

        // set up model data for views to display
        $states = getStates();
        $errors = [];
        $message = '';

        // handle post requests
        if(isPostRequest()) {

          // check to make sure data is valid
          if(empty($fullName)) {
            $errors[] = 'Full name is not valid!';
          }

          if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

          if(!zipIsValid($zip)) {
            $errors[] = 'Zip is not valid!';
          }

          if(!dateIsValid($birthday)) {
            $errors[] = 'Birthday is not valid!';
          }

          // if there were no errors then move foward with the insert
          if(!count($errors)) {

            // try to add the address
            if(addAddress($fullName, $email, $addressLine1, $city, $state, $zip, $birthday)) {

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

        ?>
        </div>
      </div>
    </body>
</html>
