<?php
// create a Message class that uses the IMessage interface
class Message implements IMessage {

  // define class properties
  protected $messages = [];

  // method that allows object to add a message
  public function addMessage($key, $msg) {
    $this->messages[$key] = $msg;
  }

  // method that allows object to remove message
  public function removeMessage($key) {
    if(array_key_exists($key, $this->messages)) {
        unset($this->messages[$key]);
    }
  }

  // method that allows object to get all messages
  public function getAllMessages() {
    return $this->messages;
  }

}
?>
