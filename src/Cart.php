<?php

/*
 * klasa koszyka:
 * -dodawanie/usuwanie produktów w koszyku
 * -wyświetlanie produktów w koszyku
 */
/**
class Cart {

    private $id;
    private $idProduct;
    private $idOrder;
    private $quantity;

    public function __construct() {
        $this->id = -1;
        $this->idProduct = 0;
        $this->idOrder = 0;
        $this->quantity = 0;
    }

    public function getId() {
        return $this->id;
    }

    public function SetId($newId) {
        if (is_integer($newId)) {
            $this->id = $newId;
        }
    }

    public function getIdProduct() {
        return $this->idProduct;
    }

    public function SetIdProduct($newIdProduct) {
        if (is_integer($newIdProduct)) {
            $this->idProduct = $newIdProduct;
        }
    }

    public function getIdOrder() {
        return $this->idOrder;
    }

    public function SetIdOrder($newIdOrder) {
        if (is_integer($newIdOrder)) {
            $this->idOrder = $newIdOrder;
        }
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function SetQuantity($newQuantity) {
        if (is_integer($newQuantity)) {
            $this->quantity = $newQuantity;
        }
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new cart to DB

            $sql = "INSERT INTO product_orders(id_orders, id_product, quantity)
                   VALUES ('$this->idOrder', '$this->idProduct', '$this->quantity')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE product_orders SET id_orders='$this->idOrder', id_product='$this->idProduct',
                    quantity='$this->quantity',
                    WHERE id=$this->id";

            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    static public function loadCartById(mysqli $connection, $id) {

        $sql = "SELECT * FROM product_orders WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedCart = new Cart();
            $loadedCart->id = $row['id'];
            $loadedCart->idOrder = $row['id_orders'];
            $loadedCart->idProduct = $row['id_product'];
            $loadedCart->quantity = $row['quantity'];


            return $loadedCart;
        }

        return null;
    }

    static public function loadAllCarts(mysqli $connection) {

        $sql = "SELECT * FROM product_orders ORDER BY id DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedCart = new Cart();
                $loadedCart->id = $row['id'];
                $loadedCart->idOrder = $row['id_orders'];
                $loadedCart->idProduct = $row['id_product'];
                $loadedCart->quantity = $row['quantity'];

                $ret[] = $loadedCart;
            }
        }

        return $ret;
    }
    
        static public function loadAllProductsByOrderId(mysqli $connection, $idOrder) {

        $sql = "SELECT * FROM product_orders WHERE id_orders=$idOrder ORDER BY name DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedCart = new Cart();
                $loadedCart->id = $row['id'];
                $loadedCart->idOrder = $row['id_orders'];
                $loadedCart->idProduct = $row['id_product'];
                $loadedCart->quantity = $row['quantity'];
                $ret[] = $loadedCart;
            }

            return $ret;
        }
    }

}
 * 
 */
