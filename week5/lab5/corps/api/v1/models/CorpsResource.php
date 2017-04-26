<?php

/**
 * Implement REST CRUD for corps data using an API
 */
class CorpsResource extends DBConstruct implements IRestModel {
   /**
    * Mehod used to get a specific row
    * 
    * @param type $id
    */
   public function get($id) {
       $statement = $this->getDB()->prepare("SELECT * FROM corps WHERE id = :id;");
       $binds = array(":id"=>$id);
       
       $results = array();
       if($statement->execute($binds) && $statement->rowCount() > 0) {
           $results = $statement->fetchAll(PDO::FETCH_ASSOC);
       }
       return $results;
   }
    
   /**
    * Method used to get all rows
    */
    public function getAll() {
       $statement = $this->getDB()->prepare("SELECT * FROM corps;");
       
       $results = array();
       if($statement->execute() && $statement->rowCount() > 0) {
           $results = $statement->fetchAll(PDO::FETCH_ASSOC);
       }
       return $results;
    }
    
    /**
     * Method used to post data to the table
     * 
     * @param type $serverData
     */
    public function post($serverData) {
        $statement = $this->getDB()->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location;");
        $binds = array(
            ":corp"=>$serverData['corp'],
            ":incorp_dt"=>$serverData['incorp_dt'],
            ":email"=>$serverData['email'],
            ":owner"=>$serverData['owner'],
            ":phone"=>$serverData['phone'],
            ":location"=>$serverData['location']
        );
        
        if($statement->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Method used to update data in the table
     * 
     * @param type $id
     */
    public function put($id, $serverData) {
        $statement = $this->getDB()->prepare("UPDATE corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location WHERE id = :id;");
        $binds = array(
            ":corp"=>$serverData['corp'],
            ":incorp_dt"=>$serverData['incorp_dt'],
            ":email"=>$serverData['email'],
            ":owner"=>$serverData['owner'],
            ":phone"=>$serverData['phone'],
            ":location"=>$serverData['location'],
            ":id"=>$id
        );
        
        if($statement->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Method used to delete data from the table
     * 
     * @param type $id
     */
    public function delete($id) {
        $statement = $this->getDB()->prepare("DELETE FROM corps WHERE id = :id;");
        $binds = array(
            ":id"=>$id
        );
        
        if($statement->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
}

?>