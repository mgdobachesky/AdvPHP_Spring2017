<?php

 /**
 * Class for connecting to the database
 *
 * @author mike91doby
 */
class DB {

    // declare class properties
    protected $db = null;
    protected $dns;
    protected $user;
    protected $password;

    // add a constructor method
    function __construct($dns, $user, $password) {
        $this->dns = $dns;
        $this->user = $user;
        $this->password = $password;
    }


    /**
     * A method to allow object to get DB connection
     *
     * @return object
     */
    protected function getDb() {

        // if a connection already exists, return that instead
        if ( null != $this->db ) {
            return $this->db;
        }

        // try to make a new connection
        try {
            // create a connection and save it in a variable
            $this->db = new PDO($this->dns, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
            // if the connection fails the close it
            $this->closeDB();
            throw new Exception($ex->getMessage());

        }

        // return the database connection
        return $this->db;
    }


    /**
     * A method for closing the database
     *
     * @return void
     */
    private function closeDB() {
        $this->db = null;
    }


}

?>
