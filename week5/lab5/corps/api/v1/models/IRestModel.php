<?php

/**
 * An Interface for rest services
 * 
 * @author mike91doby
 */
interface IRestModel {
    function get($id);
    function getAll();
    function post($serverData);
    function put($id, $serverData);
    function delete($id);
}

?>
