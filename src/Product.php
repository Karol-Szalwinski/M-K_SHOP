<?php

class Product {

    private $id;
    private $idGroup;
    private $name;
    private $price;
    private $description;
    private $availability;

    public function __construct() {

        $this->id = -1;
        $this->idGroup = -1;
        $this->name = "";
        $this->price = 0;
        $this->description = "";
        $this->availability = 0;
    }

    public function setId($newId) {
        if (is_integer($newId)) {
            $this->id = $newId;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setName($newName) {
        if (is_string($newName)) {
            $this->name = $newName;
        }
    }

    public function setIdGroup($newIdGroup) {
        if (is_integer($newIdGroup)) {
            $this->idGroup = $newIdGroup;
        }
    }

    public function getIdGroup() {
        return $this->idGroup;
    }

    public function getName() {
        return $this->name;
    }

    public function setPrice($newPrice) {
        if (is_numeric($newPrice)) {
            $this->price = $newPrice;
        }
    }

    public function getPrice() {
        return $this->price;
    }

    public function setDescription($newDescription) {
        if (is_string($newDescription)) {
            $this->description = $newDescription;
        }
    }

    public function getDescription() {
        return $this->description;
    }

    public function setAvailability($newAvailability) {
        $this->availability = $newAvailability;
    }

    public function getAvailability() {
        return $this->availability;
    }

    static public function loadProductById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Product WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedProduct = new Product();
            $loadedProduct->id = $row['id'];
            $loadedProduct->idGroup = $row['id_group'];
            $loadedProduct->name = $row['name'];
            $loadedProduct->price = $row['price'];
            $loadedProduct->description = $row['description'];
            $loadedProduct->availability = $row['availability'];

            return $loadedProduct;
        }

        return null;
    }

    static public function loadAllProductsByGroupId(mysqli $connection, $idGroup) {

        $sql = "SELECT * FROM Product WHERE id_group=$idGroup ORDER BY name DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedProduct = new Product();
                $loadedProduct->id = $row['id'];
                $loadedProduct->idGroup = $row['id_group'];
                $loadedProduct->name = $row['name'];
                $loadedProduct->price = $row['price'];
                $loadedProduct->description = $row['description'];
                $loadedProduct->availability = $row['availability'];
                $ret[] = $loadedProduct;
            }

            return $ret;
        }
    }

    static public function loadAllProducts(mysqli $connection) {

        $sql = "SELECT * FROM Product ORDER BY name DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedProduct = new Product();
                $loadedProduct->id = $row['id'];
                $loadedProduct->idGroup = $row['id_group'];
                $loadedProduct->name = $row['name'];
                $loadedProduct->price = $row['price'];
                $loadedProduct->description = $row['description'];
                $loadedProduct->availability = $row['availability'];

                $ret[] = $loadedProduct;
            }
        }

        return $ret;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new product to DB

            $sql = "INSERT INTO Product(id_group, name, price, description, availability)
               VALUES ('$this->idGroup','$this->name', '$this->price', '$this->description', '$this->availability' )";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE Product SET id_group='$this->idGroup', name='$this->name', price='$this->price',
               description='$this->description',availability='$this->availability'  WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }

        return false;
    }

}