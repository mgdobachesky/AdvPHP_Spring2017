<?php
// a crud accounts that does operations through the database
class Accounts extends DB{

  // construct this class with the parent classes constructor
  public function __construct() {
    $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2017',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
    );
    parent::__construct($dbConfig);
  }

  // a method that allows a user to sign up
  public function signup($email, $password) {
      // open database connection
      $db = $this->getDB();

      // write sql statement
      $statement = $db->prepare("INSERT INTO users SET email = :email, password = :password, created = NOW()");

      // bind the prepared statement arguments
      $binds = array(
        ":email" => $email,
        ":password" => password_hash($password, PASSWORD_DEFAULT)
      );

      // return true if the statement successfully executed
      if($statement->execute($binds) && $statement->rowCount() > 0) {
        return true;
      }

      // return false by default
      return false;
  }

  // a method that allows a user to login
  public function login($email, $password) {
    // open database connection
    $db = $this->getDB();

    // write sql statement
    $statement = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

    // bind the prepared statement arguments
    $binds = array(
      ":email" => $email
    );

    // return true if the statement successfully executed
    if($statement->execute($binds) && $statement->rowCount() > 0) {
      $results = $statement->fetch(PDO::FETCH_ASSOC);

      //return the user id if the password matches the requested email
      if(password_verify($password, $results['password'])) {
        return $results['user_id'];
      }

    }

    return 0;
  }

  // a method to check if an email address exists
  public function emailExists($email) {
    // open database connection
    $db = $this->getDB();

    // write sql statement
    $statement = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

    // bind the prepared statement arguments
    $binds = array(
      ":email" => $email
    );

    // return true if a user account exists
    if($statement->execute($binds) && $statement->rowCount() > 0) {
      return true;
    }

    // return false by default
    return false;
  }

}
?>
