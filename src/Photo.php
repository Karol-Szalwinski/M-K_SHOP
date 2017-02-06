<?php

class Photo {

    private $id;
    private $idProduct;
    private $path;

    public function __construct() {
        $this->id = -1;
        $this->idProduct = 0;
        $this->path = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function getProductId() {
        return $this->idProduct;
    }

    public function setProductId($newProductId) {
        if (is_numeric($newProductId)) {
            $this->idProduct = $newProductId;
        }
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($newPath) {
        if (is_string($newPath)) {
            $this->path = $newPath;
        }
    }

//zapisywanie zdjęcia (jego ścieżki do bazy danych - modyfikacja
    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {
            $sql = "INSERT INTO Photos(id_product, path)
                   VALUES ('$this->idProduct', '$this->path')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE Photos SET id_product='$this->idProduct', path='$this->path'                     
                    WHERE id=$this->id";

            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    //wyświetlanie zdjęcia wg id danego zdjecia
    static public function loadPhotoById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Photos WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedPhoto = new Photo();
            $loadedPhoto->id = $row['id'];
            $loadedPhoto->idProduct = $row['id_product'];
            $loadedPhoto->path = $row['path'];

            return $loadedPhoto;
        }

        return null;
    }

//wyświetlanie zdjęć danego produktu wg id tego produktu    
    static public function loadAllPhotosByProductId(mysqli $connection, $productId) {

        $sql = "SELECT * FROM Photos WHERE id_product=$productId ORDER BY id DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedPhoto = new Photo();
                $loadedPhoto->id = $row['id'];
                $loadedPhoto->path = $row['path'];

                $ret[] = $loadedPhoto;
            }

            return $ret;
        }
    }

    //wyświetlanie zdjęć danego produktu wg id tego produktu  - do    
    static public function loadOnePhotoByProductID(mysqli $connection, $productId) {

        $sql = "SELECT * FROM Photos WHERE id_product=$productId LIMIT 1";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedPath = $row['path'];

            return $loadedPath;
        }

        return null;
    }

    //wyświetlanie zdjęć wszystkich produktów   
    static public function loadAllPhotos(mysqli $connection) {

        $sql = "SELECT * FROM Photos ORDER BY id DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedPhoto = new Photo();
                $loadedPhoto->id = $row['id'];
                $loadedPhoto->idProduct = $row['id_product'];
                $loadedPhoto->path = $row['path'];

                $ret[] = $loadedPhoto;
            }
        }
        return $ret;
    }

}
