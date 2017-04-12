<?php

// a method to add address data to the database
function addAddress($fullName, $email, $addressLine1, $city, $state, $zip, $birthday) {

  // open database connection
  $db = dbconnect();

  // write sql statement
  $statement = $db->prepare("INSERT INTO address SET fullname = :fullName, email = :email, addressline1 = :addressLine1, city = :city, state = :state, zip = :zip, birthday = :birthday");

  // bind the prepared statement arguments
  $binds = array(
    ":fullName" => $fullName,
    ":email" => $email,
    ":addressLine1" => $addressLine1,
    ":city" => $city,
    ":state" => $state,
    ":zip" => $zip,
    ":birthday" => $birthday
  );

  // return true if the statement successfully executed
  if($statement->execute($binds) && $statement->rowCount() > 0) {
    return true;
  }

  // return false by default
  return false;

}


// a method to get all address data
function getAllAddress() {

  //initialize an array to hold the results
  $results = array();

  // open database connection
  $db = dbconnect();

  // write sql statement
  $statement = $db->prepare("SELECT * FROM address");

  // store sql select results if the command was successfull
  if($statement->execute() && $statement->rowCount() > 0) {
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  // return results reguardless of its contents
  return $results;

}
