<?php

/**
 * Function to establish a database connection
 *
 * @return PDO Object
 */

// function used to connect to the database
function dbconnect() {
    // create an array holding information used to connect to database
    $config = array(
        'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2017',
        'DB_USER' => 'root',
        'DB_PASSWORD' => ''
    );

    // try connect to the database
    try {
        // save db connection in variable and set attributes
        $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //catch errors in connecting to database
    } catch (Exception $ex) {
        // set variable to null if connection fails
        $db = null;
        // set message to be the error message
        $message = $ex->getMessage();
        // dump the message to output and exit
        var_dump($message);
        exit();
    }

    // return database connection object
    return $db;
}
