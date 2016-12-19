<?php

/*
 * klasa zamówienia:
 * - składanie nowych zamówień/ edycja zamówienia
 * - wyświetlanie zamównia wg użytkownika/ wszystkich zamówień
 *  co jeszcze ?
 */

class Order {

    private $id;
    private $idUser;
    private $status;
    private $creationDate;
    private $paymentMethod;
    private $amount;

    public function __consruct() {
        $this->id = -1;
        $this->idUser = 0;
        $this->status = "";
        $this->creationDate = "";
        $this->paymentMethod = "";
        $this->amount = 0;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function getUserId() {
        return $this->idUser;
    }

    public function setUserId($newUserId) {
        if (is_numeric($newUserId)) {
            $this->idUser = $newUserId;
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($newStatus) {
        if (is_string($newStatus)) {
            $this->status = $newStatus;
        }
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($newCreationDate) {
        if (is_integer($newCreationDate)) {
            $this->creationDate = $newCreationDate;
        }
    }

    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($newPaymentMethod) {
        if (is_string($newPaymentMethod)) {
            $this->paymentMethod = $newPaymentMethod;
        }
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($newAmount) {
        if (is_numeric($newAmount)) {
            $this->amount = $newAmount;
        }
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new Order to DB

            $sql = "INSERT INTO Orders(id_user, status,  payment_method, amount)
               VALUES ('$this->idUser','$this->status', '$this->paymentMethod', '$this->amount' )";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE Orders SET status='$this->status', payment_method='$this->paymentMethod', amount='$this->amount'
                 WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }

        return false;
    }

    static public function loadOrderById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Orders WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedOrder = new Order();
            $loadedOrder->id = $row['id'];
            $loadedOrder->idUser = $row['id_user'];
            $loadedOrder->status = $row['status'];
            $loadedOrder->creationDate = $row['creation_date'];
            $loadedOrder->paymentMethod = $row['payment_method'];
            $loadedOrder->amount = $row['amount'];

            return $loadedOrder;
        }

        return null;
    }

    static public function loadAllOrdersByUserId(mysqli $connection, $userId) {

        $sql = "SELECT * FROM Orders WHERE id_user=$userId ORDER BY name DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedOrder = new Order();
                $loadedOrder->id = $row['id'];
                $loadedOrder->status = $row['status'];
                $loadedOrder->creationDate = $row['creation_date'];
                $loadedOrder->paymentMethod = $row['payment_method'];
                $loadedOrder->amount = $row['amount'];
                $ret[] = $loadedOrder;
            }

            return $ret;
        }
    }

    static public function loadAllOrders(mysqli $connection) {

        $sql = "SELECT * FROM Orders ORDER BY status DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {


                $loadedOrder = new Order();
                $loadedOrder->id = $row['id'];
                $loadedOrder->idUser = $row['id_user'];
                $loadedOrder->status = $row['status'];
                $loadedOrder->creationDate = $row['creation_date'];
                $loadedOrder->paymentMethod = $row['payment_method'];
                $loadedOrder->amount = $row['amount'];

                $ret[] = $loadedOrder;
            }
        }

        return $ret;
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



            return $loadedCart;
        }

        return null;
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
                $ret[] = $loadedCart;
            }

            return $ret;
        }
    }
    
    
    
}
