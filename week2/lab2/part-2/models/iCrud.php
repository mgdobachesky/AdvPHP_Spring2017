<?php
/**
 * Interface for objects that can do crud operations
 *
 * @author mike91doby
 */
interface iCrud {
    public function create($fullName, $email, $addressLine1, $city, $state, $zip, $birthday);
    public function read();
    public function readAll();
    public function update();
    public function delete();
}

?>
