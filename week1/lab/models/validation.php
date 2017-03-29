<?php

// method to check if zip codes are valid
function zipIsValid($zip) {

  //create regex to make sure zip is five numbers
  $zipRegex = '/^[0-9]{5}$/';

  //if the zip matches
  if(preg_match($zipRegex, $zip)) {
    return true;
  }

  //return false by default
  return false;

}


// method to check if date is valid
function dateIsValid($date) {
  // return bool representing if the string to date conversion was successfull
  return (bool)strtotime($date);
}
