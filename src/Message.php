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
    private $idReceiver;
    private $idSender;
    private $textMessage;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->idReceiver = 0;
        $this->idSender = 0;
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
            $this->idReceiver = $newReceiverId;
        }
    }

    public function getReceiverId() {
        return $this->idReceiver;
    }

    public function setSenderId($newSenderId) {
        if (is_numeric($newSenderId)) {
            $this->idSender = $newSenderId;
        }
    }

    public function getSenderId() {
        return $this->idSender;
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

            $sql = "INSERT INTO Messages(id_receiver, id_sender, text_message)
                   VALUES ('$this->idReceiver', '$this->idSender', '$this->textMessage')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        }
    }

    static public function loadMessagesByReceiverId(mysqli $connection, $idReceiver) {

        $sql = "SELECT * FROM Messages WHERE receiver_id=$idReceiver";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->idReceiver = $row['id_receiver'];
            $loadedMessage->idSender = $row['id_sender'];
            $loadedMessage->textMessage = $row['text_message'];
            $loadedMessage->creationDate = $row['creation_date'];


            return $loadedMessage;
        }

        return null;
    }

    static public function loadMessagesBySenderId(mysqli $connection, $idSender) {

        $sql = "SELECT * FROM Messages WHERE sender_id=$idSender";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->idReceiver = $row['id_receiver'];
            $loadedMessage->idSender = $row['id_sender'];
            $loadedMessage->textMessage = $row['text_message'];
            $loadedMessage->creationDate = $row['creation_date'];


            return $loadedMessage;
        }

        return null;
    }

}
