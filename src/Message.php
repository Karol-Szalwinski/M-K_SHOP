<?php
/**
 * klasa wiadomosci:
 * - możliwość przesyłania wiadomosci do użytkownika
 * - możliwość wyświetlania otrzymanych wiadomości u użytkownika
 * - możliwość wyświetlania wysłanych wiadomości u administratora
 * coś jeszcze ?
 */


class Message {

    private $id;
    private $receiverId;
    private $senderId;
    private $textMessage;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->receiverId = 0;
        $this->senderId = 0;
        $this->textMessage = "";
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

    public function setReceiverId($newReceiverId) {
        if (is_numeric($newReceiverId)) {
            $this->receiverId = $newReceiverId;
        }
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function setSenderId($newSenderId) {
        if (is_numeric($newSenderId)) {
            $this->senderId = $newSenderId;
        }
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function setTextMessage($newTextMessage) {
        if (is_string($newTextMessage)) {
            $this->textMessage = $newTextMessage;
        }
    }

    public function getTextMessage() {
        return $this->textMessage;
    }

    public function setCreationDate($newCreationDate) {
        if (is_integer($newCreationDate)) {
            $this->creationDate = $newCreationDate;
        }
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new Message to DB

            $sql = "INSERT INTO Messages(receiver_id, sender_id, text_message)
                   VALUES ('$this->receiverId', '$this->senderId', '$this->textMessage')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        }
    }

    static public function loadMessagesByReceiverId(mysqli $connection, $receiverId) {

        $sql = "SELECT * FROM Messages WHERE receiver_id=$receiverId";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->receiverId = $row['receiver_id'];
            $loadedMessage->senderId = $row['sender_id'];
            $loadedMessage->textMessage = $row['text_message'];
            $loadedMessage->creationDate = $row['creation_date'];


            return $loadedMessage;
        }

        return null;
    }

    static public function loadMessagesBySenderId(mysqli $connection, $senderId) {

        $sql = "SELECT * FROM Messages WHERE sender_id=$senderId";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->receiverId = $row['receiver_id'];
            $loadedMessage->senderId = $row['sender_id'];
            $loadedMessage->textMessage = $row['text_message'];
            $loadedMessage->creationDate = $row['creation_date'];


            return $loadedMessage;
        }

        return null;
    }

}
