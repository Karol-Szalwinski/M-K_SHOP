<?php

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
        return $this;
    }

    public function setGroupName($newGroupName) {
        if (is_string($newGroupName)) {
            $this->groupName = $newGroupName;
        }
        return $this;
    }

    public function getGroupName() {
        return $this->groupName;
    }

    //Saving new Group to DB
    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

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
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    static public function loadAllGroups(mysqli $connection) {

        $sql = "SELECT * FROM Groups ORDER BY group_name ASC";
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

    // wyświetlanie kategorii wg id
    static public function loadCategoryById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Groups WHERE id=$id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedGroup = new Group();
            $loadedGroup->id = $row['id'];
            $loadedGroup->groupName = $row['group_name'];

            return $loadedGroup;
        }
        return null;
    }

    //Wyswietla kategorię w wierszu tabeli
    public function showCategoryInTabRow($conn, $no) {
        echo "<tr>";
        echo"<td>$no</td>";
        echo"<td>$this->groupName</td>";
        echo"<td>" . $this->countProductsInCategory($conn) . "</td>";
        echo"<td><form method='POST'><input type='hidden' name='category-id' value='$this->id'>";
        echo"<button type='submit' class='btn btn-danger'>Usuń</button></td></form>";
        echo"</tr>";
    }

    //wyswietla kategorię jako przycisk sidebara
    public function showCategoryInSidebar() {
        echo "<li>";
        echo "<a href='category.php?categoryId=$this->id'>";
        echo $this->groupName;
        echo"</a></li>";
    }

    //Usuwa kategorię po id
    static public function deleteCategoryById(mysqli $connection, $id) {

        if ($id > 0) {
            $sql = "DELETE FROM Groups WHERE id=$id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
            return false;
        }
        return true;
    }

    //Metoda zlicza produkty w kategorii
    public function countProductsInCategory(mysqli $connection) {
        $sql = "SELECT * FROM Product WHERE id_group=$this->id";
        $result = $connection->query($sql);
        return $result->num_rows;
    }

}
