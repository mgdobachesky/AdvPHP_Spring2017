<?php
/**
 * DB class is used to connect to the database
 *
 * @author mike91doby
 */
class DB {

    //initialize class properties
    protected $db = null;
    private $dbConfig = array();

    // construct with the database configuration
    public function __construct($dbConfig) {
        $this->setDbConfig($dbConfig);
    }

    // get the database config
    private function getDbConfig() {
        return $this->dbConfig;
    }

    // set the database config with items passed through an array
    private function setDbConfig($dbConfig) {
      if(is_array($dbConfig)) {
        $this->dbConfig = $dbConfig;
      } else {
        throw new ArrayException('$dbConfig must be an Array.');
      }
    }

    // a public method to get the database connection
    public function getDB() {
        // if the connection already exists then return it
        if (null != $this->db) {
            return $this->db;
        }
        // try to open a new connection if one does not exist
        try {
            $config = $this->getDbConfig();
            $this->db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        } catch (Exception $ex) {
           $this->closeDB();
           throw new DBException($ex->getMessage());
        }
        return $this->db;
    }

    // a method to close the database connection
    public function closeDB() {
        $this->db = null;
    }

}
?>
