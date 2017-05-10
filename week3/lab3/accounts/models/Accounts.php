<?php

/**
 * A crud accounts that does operations through the database
 * 
 * @author mike91doby
 */
class Accounts extends DB {

    /**
     * Construct this class with the parent classes constructor
     */
    public function __construct() {
        $dbConfig = array(
            "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2017',
            "DB_USER" => 'root',
            "DB_PASSWORD" => ''
        );
        parent::__construct($dbConfig);
    }

    /**
     * A method that allows a user to sign up
     * 
     * @param type $email
     * @param type $password
     * @return boolean
     */
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
        if ($statement->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }

        // return false by default
        return false;
    }

    /**
     *  A method that allows a user to login
     * 
     * @param type $email
     * @param type $password
     * @return int
     */
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
        if ($statement->execute($binds) && $statement->rowCount() > 0) {
            $results = $statement->fetch(PDO::FETCH_ASSOC);

            //return the user id if the password matches the requested email
            if (password_verify($password, $results['password'])) {
                return $results['user_id'];
            }
        }

        return 0;
    }

    /**
     * A method to get a user by an id
     * 
     * @param type $id
     * @return array[]
     */
    public function getUserById($id) {
        // open database connection
        $db = $this->getDB();

        // write sql statement
        $statement = $db->prepare("SELECT * FROM users WHERE user_id = :id LIMIT 1");

        // bind the prepared statement arguments
        $binds = array(
            ":id" => $id
        );

        // return data if a user account exists
        if ($statement->execute($binds) && $statement->rowCount() > 0) {
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            
            return $results;
        }
        
        return [];
    }
    
    /**
     * A method to get a user by an id
     * 
     * @param type $id
     * @return array[]
     */
    public function emailExists($email) {
        // open database connection
        $db = $this->getDB();

        // write sql statement
        $statement = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

        // bind the prepared statement arguments
        $binds = array(
            ":email" => $email
        );

        // return data if a user account exists
        if ($statement->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }
        
        return false;
    }

}

?>
