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
        <?php include './templates/header.html.php'; ?>

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
