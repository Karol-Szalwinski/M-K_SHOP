<?php

/* klasa status:
 * zmiana nazwy statusu dla zamówienia
 */

class Status {

    private $id;
    private $statusName;

    public function __construct() {
        $this->id = -1;
        $this->statusName = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function setStatusName($newStatusName) {
        if (is_string($newStatusName)) {
            $this->statusName = $newStatusName;
        }
    }

    public function getStatusName() {
        return $this->statusName;
    }

    //zapisywanie statusu do bazy danych i jego aktualizacja
    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {


            $sql = "INSERT INTO Statuses(status_name)
                   VALUES ('$this->statusName')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE Statuses SET status_name='$this->statusName'  
                    WHERE id=$this->id";

            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    // wyświetlanie wszystkich statusów   
    static public function loadAllStatuses(mysqli $connection) {

        $sql = "SELECT * FROM Statuses ORDER BY status_name DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedStatus = new Status();
                $loadedStatus->id = $row['id'];
                $loadedStatus->statusName = $row['status_name'];


                $ret[] = $loadedStatus;
            }
        }

        return $ret;
    }

    static public function loadStatusById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Statuses WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedStatus = new Status();
            $loadedStatus->id = $row['id'];
            $loadedStatus->statusName = $row['status_name'];


            return $loadedStatus;
        }

        return null;
    }

}
