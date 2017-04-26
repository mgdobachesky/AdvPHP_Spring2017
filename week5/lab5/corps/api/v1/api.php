<?php

include_once './autoload.php';

/**
 * The API handles user requests using the RestServer class
 */
$restServer = new RestServer();

try {
    // Set status to assume the call is OK
    $restServer->setStatus(200);
    
    // Get rest properties
    $resource = $restServer->getResource();
    $verb = $restServer->getVerb();
    $id = $restServer->getId();
    $serverData = $restServer->getServerData();
    
    // Format the resource name
    $resourceLower = strtolower($resource);
    $resourceFirstUpper = ucfirst($resourceLower);
    $resourceClassName = $resourceFirstUpper . 'Resource';
    
    // Try to instantiate the resource
    try {
        $resourceData = new $resourceClassName();
    } catch(InvalidArgumentException $e) {
        throw new APIException($resourceClassName . ' not found.');
    }
    
    // Handle GET requests
    if($verb === 'GET') {
        if($id === NULL) {
            $restServer->setData($resourceData->getAll());
        } else {
            $restServer->setData($resourceData->get($id));
        }
    }
    
    // Handle POST requests
    if($verb === 'POST') {
        if($resourceData->post($serverData)) {
            $restServer->setMessage($resourceFirstUpper . ' record successfully added.');
            $restServer->setStatus(201);
        } else {
            throw new APIException($resourceClassName . ' could not be added.');
        }
    }
    
    // Handle PUT requests
    if($verb === 'PUT') {
        if($id !== NULL) {
            if($resourceData->put($id, $serverData)) {
                $restServer->setMessage($resourceFirstUpper. ' record successfully updated.');
                $restServer->setStatus(202);
            } else {
                throw new APIException($resourceClassName . ' could not be updated.');
            } 
        } else {
            throw new APIException($resourceFirstUpper . ' ID ' . $id . ' was not found.');
        }
    }
    
    // Handle DELETE requests
    if($verb === 'DELETE') {
        if($id !== NULL) {
            if($resourceData->delete($id)) {
                $restServer->setMessage($resourceFirstUpper . ' record successfully deleted.');
                $restServer->setStatus(202);
            } else {
                throw new APIException($resourceClassName . ' could not be deleted.');
            } 
        } else {
            throw new APIException($resourceFirstUpper . ' ID ' . $id . ' was not found.');
        }
    }
    
} catch(APIException $e) {
    // Set 400 error if user sent something wrong
    $restServer->setStatus(400);
    $restServer->setErrors($e->getMessage());
} catch(Exception $e) {
    // Set 500 error for all other cases
    $restServer->setStatus(500);
    $restServer->setErrors($e->getMessage());
}

// Output response from RestServer and then exit
echo $restServer->getResponse();
exit();

?>

