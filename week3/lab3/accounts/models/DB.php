<?php

/**
 * DB class is used to connect to the database
 *
 * @author mike91doby
 */
class DB {

    // Initialize class properties
    protected $db = null;
    private $dbConfig = array();

    /**
     * Construct with the database configuration
     * 
     * @param type $dbConfig
     */
    public function __construct($dbConfig) {
        $this->setDbConfig($dbConfig);
    }

    /**
     * Get the database config
     * 
     * @return type
     */
    private function getDbConfig() {
        return $this->dbConfig;
    }

    /**
     * Set the database config with items passed through an array
     * 
     * @param type $dbConfig
     * @throws ArrayException
     */
    private function setDbConfig($dbConfig) {
        if (is_array($dbConfig)) {
            $this->dbConfig = $dbConfig;
        } else {
            throw new ArrayException('$dbConfig must be an Array.');
        }
    }

    /**
     * A public method to get the database connection
     * 
     * @return type
     * @throws DBException
     */
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

    /**
     * A method to close the database connection
     */
    public function closeDB() {
        $this->db = null;
    }

}

?>
