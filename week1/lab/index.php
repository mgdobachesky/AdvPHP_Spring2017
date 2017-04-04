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
        require_once './models/addressCrud.php';

        // get addresses after data has been inserted
        $addresses = getAllAddress();

        // include view of all addresses
        include './templates/view-address.html.php';
        ?>
        </div>
      </div>
    </body>
</html>
