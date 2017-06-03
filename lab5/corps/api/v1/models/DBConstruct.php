<?php
/**
 * This class extends the DB connection and allows for 
 * classes to easily construct without having to type this 
 * information in each time
 */
class DBConstruct extends DB {
    
    public function __construct() {
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2017',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        parent::__construct($dbConfig);
    }
    
}

?>

