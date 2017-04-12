<?php
// create interface for message classes
interface IMessage {
  public function addMessage($key, $msg);
  public function removeMessage($key);
  public function getAllMessages();
}
?>
