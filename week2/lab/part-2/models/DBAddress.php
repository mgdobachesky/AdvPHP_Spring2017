<?php

 /**
  * Class for interacting with address data
  *
  * @author mike91doby
  */
class DBAddress extends DB {

    // call the parent constructor to establish a database connection upon class creation
    function __construct() {
        parent::__construct('mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2017', 'root', '');
    }


    /**
     * A method to add address data to the database
     *
     * @param {String} [$fullName] - full name
     * @param {String} [$email] - email address
     * @param {String} [$addressLine1] - street address
     * @param {String} [$city] - city
     * @param {String} [$state] - state
     * @param {String} [$zip] - zip code
     * @param {String} [$birthday] - birthday
     *
     * @return boolean
     */
    public function addAddress($fullName, $email, $addressLine1, $city, $state, $zip, $birthday) {

      // open database connection
      $db = $this->getDb();

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


    /**
     * A method to get all address data
     *
     * @return array
     */
    public function getAllAddress() {

      //initialize an array to hold the results
      $results = array();

      // open database connection
      $db = $this->getDb();

      // write sql statement
      $statement = $db->prepare("SELECT * FROM address");

      // store sql select results if the command was successfull
      if($statement->execute() && $statement->rowCount() > 0) {
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      // return results reguardless of its contents
      return $results;
    }

}

?>
