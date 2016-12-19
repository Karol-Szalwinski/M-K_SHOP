<?php

/*
 * klasa grupy produktów:
 * -możliwość edycji i zapsu grup produktów (relacja jedna grupa - wiele produktów)
 * -możliwość wyświetlania produktów z danej grupy (już jest w klasie Product !!)
 * -możliwość wyświetlania wszytskich grup
 */

class Group {

    private $id;
    private $groupName;

    public function __construct() {
        $this->id = -1;
        $this->groupName = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function setGroupName($newGroupName) {
        if (is_string($newGroupName)) {
            $this->groupName = $newGroupName;
        }
    }

    public function getGroupName() {
        return $this->groupName;
    }
    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new Group to DB

            $sql = "INSERT INTO Groups(group_name)
                   VALUES ('$this->groupName')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE Groups SET group_name='$this->groupName'  
                    WHERE id=$this->id";

            $result = $connection->query($sql);
            if($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }
    
        static public function loadAllGroups(mysqli $connection) {

        $sql = "SELECT * FROM Groups ORDER BY group_name DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedGroup = new Group();
                $loadedGroup->id = $row['id'];
                $loadedGroup->groupName = $row['group_name'];
                

                $ret[] = $loadedGroup;
            }
        }

        return $ret;
    }

    
}
