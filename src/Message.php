<?php

//klasa wiadomości

class Message {

    private $id;
    private $textMessage;
    private $receiverId;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->textMessage = "";
        $this->receiverId = 0;
        $this->creationDate = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function setTextMessage($newTextMessage) {
        if (is_string($newTextMessage)) {
            $this->textMessage = $newTextMessage;
        }
    }

    public function getTextMessage() {
        return $this->textMessage;
    }

    public function setReceiverId($newReceiverId) {
        if (is_numeric($newReceiverId)) {
            $this->receiverId = $newReceiverId;
        }
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function setCreationDate($newCreationDate) {
        if (is_string($newCreationDate)) {
            $this->creationDate = $newCreationDate;
        }
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

}
