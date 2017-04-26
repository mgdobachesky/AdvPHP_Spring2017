<?php
/**
 * RestServer class for interacting with data
 * 
 * @author mike91doby
 */
class RestServer {
    
    // Class properties
    private $status = 200;
    private $status_codes = array(
        200=>'OK',
        201=>'Created',
        202=>'Accepted',
        400=>'Bad Request',
        401=>'Unauthorized',
        403=>'Access Forbidden',
        404=>'Not Found',
        409=>'Conflict',
        500=>'Internal Server Error'
    );
    private $response = array(
        "message"=>NULL,
        "errors"=>NULL,
        "data"=>NULL
    );
    private $resource;
    private $id;
    private $verb;
    private $serverData;
    
    /**
     * Set display content for server API
     */
    public function __construct() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, UPDATE, DELETE");
        header("Content-Type: application/json; charset=utf8");
        
        $this->getRestArgs();
        $this->setVerb();
        $this->setServerData();
    }
    
    /**
     * Get resource and ID from URL if they exist
     */
    private function getRestArgs() {
        $endpoint = filter_input(INPUT_GET, 'endpoint');
        $restArgs = explode('/', rtrim($endpoint, '/'));
        $this->resource = array_shift($restArgs);
        $this->id = NULL;
        
        if(isset($restArgs[0]) && is_numeric($restArgs[0])) {
            $this->id = intval($restArgs[0]);
        }
    }
    
    /**
     * A method that sets the verb and throws an exception
     * if the verb is not allowed
     * 
     * @throws RestException
     */
    private function setVerb() {
        $this->verb = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $verbs_allowed = array('GET', 'POST', 'PUT', 'DELETE');
        
        if(!in_array($this->verb, $verbs_allowed)) {
            throw new RestException("Unexpected Header Requested " . $this->verb);
        }
    }
    
    /**
     * Method that sets and request data from client
     * 
     * @throws RestException
     */
    private function setServerData() {
        if(strpos(filter_input(INPUT_SERVER, 'CONTENT_TYPE'), "application/json") !== false) {
            $this->serverData = json_decode(trim(file_get_contents('php://input')), true);
            
            switch(json_last_error()) {
                case JSON_ERROR_NONE: {
                    // Data UTF-8 compliant
                    // Tell client to recieve JSON data and send
                    }
                    break;
                case JSON_ERROR_SYNTAX:
                case JSON_ERROR_UTF8:
                case JSON_ERROR_DEPTH:
                case JSON_STATE_MISMATCH:
                case JSON_ERROR_CTRL_CHAR:
                    throw new RestException(json_last_error_msg());
                    break;
                default:
                    throw new RestException('JSON encode error Unknown error');
                    break;
            }
        }
    }
    
    /**
     * Method that gets server data
     * 
     * @return $serverData
     */
    public function getServerData() {
        return $this->serverData;
    }
    
    /**
     * Method that gets resource
     * 
     * @return $resource
     */
    public function getResource() {
        return $this->resource;
    }
    
    /**
     * Method that gets id
     * 
     * @return $id
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Method that gets status
     * 
     * @return $status
     */
    public function getStatus() {
        return $this->status;
    }
    
    /**
     * Method that gets verb
     * 
     * @return $verb
     */
    public function getVerb() {
        return $this->verb;
    }
    
    /**
     * Method that sets the correct header and 
     * gets JSON to be sent
     * 
     * @return JSON
     */
    public function getResponse() {
        header("HTTP/1.1 " . $this->getStatus() . " " . $this->status_codes[$this->getStatus()]);
        return json_encode($this->response, JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }
    
    /**
     * Method that sets message
     */
    public function setMessage($message) {
        $this->response["message"] = $message;
    }
    
    /**
     * Method that sets errors
     */
    public function setErrors($errors) {
        $this->response["errors"] = $errors;
    }
    
    /**
     * Method that sets data
     */
    public function setData($data) {
        $this->response["data"] = $data;
    }
    
    /**
     * Method that sets status
     * if it exists as an allowed status code
     */
    public function setStatus($status) {
        if(!array_key_exists($status, $this->status_codes)) {
            throw new RestException("Unexpected status code" . $status);
        }
        $this->status = $status;
    }
}

?>

