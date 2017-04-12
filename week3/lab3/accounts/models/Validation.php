<?php

 /**
 * Class used for Validation
 *
 * @author mike91doby
 */
class Validation {

     /**
      * A method that checks if an email is valid
      *
      * @param {String} [$email] - must be a valid email
      *
      * @return booleam
      */
    public function emailIsValid($email) {
        return (is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
    }


    /**
     * A method to check if a phone number is valid.
     *
     * @param {String} [$phone] - must be a valid phone number
     *
     * @return boolean
     */
    public function phoneIsValid($phone) {
        return ( preg_match("/^\(?([2-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $phone) );
    }


    /**
     * A method to check if a zip code is valid
     *
     * @param {String} [$zip] - must be a valid zip code
     *
     *@return boolean
     */
    public function zipIsValid($zip) {

      // create regex for validating zip codes
      $zipRegex = '/^[0-9]{5}$/';

      // test regex and return true if it passes
      if(preg_match($zipRegex, $zip)) {
        return true;
      }

      // return false by default
      return false;
    }


    /**
     * A method to check if a date is valid
     *
     * @param {String} [$date] - must be a valid Database
     *
     * @return boolean
     */
    public function dateIsValid($date) {
      // if it is possible to convert the string to a date return true
      return (bool)strtotime($date);
    }

    /**
     * A method to check if a password is valid.
     *
     * @param {String} [$password] - must be a valid password
     *
     * @return boolean
     */
    public function passwordIsValid($password) {
        return (preg_match("/^[a-zA-Z]\w{7,14}$/", $password));
    }

}

?>
