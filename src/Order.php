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
    private $adressStreet;
    private $adressLocalNo;
    private $postalCode;
    private $adressCity;

    //private $idProduct;
    //private $quantity;
    //private $idOrders;

    public function __construct() {
        $this->id = -1;
        $this->idUser = 0;
        $this->status = 0;
        $this->creationDate = "";
        $this->paymentMethod = "";
        $this->amount = 0.00;
        //$this->idProduct = 0;
        //$this->quantity = 0;
        //$this->idOrders = 0;
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

    public function getUserId() {
        return $this->idUser;
    }

    public function setUserId($newUserId) {
        if (is_numeric($newUserId)) {
            $this->idUser = $newUserId;
        }
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($newStatus) {
        if (is_numeric($newStatus)) {
            $this->status = $newStatus;
        }
        return $this;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($newCreationDate) {
        if (is_integer($newCreationDate)) {
            $this->creationDate = $newCreationDate;
        }
        return $this;
    }

    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($newPaymentMethod) {
        if (is_string($newPaymentMethod)) {
            $this->paymentMethod = $newPaymentMethod;
        }
        return $this;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($newAmount) {
        if (is_numeric($newAmount)) {
            $this->amount = $newAmount;
        }
        return $this;
    }

    /*
      public function getProductId() {
      return $this->idProduct;
      }

      public function setProductId($newProductId) {
      if (is_numeric($newProductId)) {
      $this->idProduct = $newProductId;
      }
      return $this;
      }

      public function getQuantity() {
      return $this->quantity;
      }

      public function setQuantity($newQuantity) {
      if (is_numeric($newQuantity)) {
      $this->quantity = $newQuantity;
      }
      return $this;
      }

      public function getOrderId() {
      return $this->idOrders;
      }

      public function setOrderId($newOrderId) {
      if (is_numeric($newOrderId)) {
      $this->idOrders = $newOrderId;
      }
      return $this;
      }
     */

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //zapisywanie zamówienia do bazy danych

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

// wyświetlanie zamówień wg id zamówienia
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

// wyświetlanie wszystkich zamówień wg id użytkownika
    static public function loadAllOrdersByUserId(mysqli $connection, $userId) {

        $sql = "SELECT * FROM Orders WHERE id_user=$userId ORDER BY status DESC";
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

// wyświetlanie wszystkich zamówień w bazie
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

// wyświetlanie koszyka wg numeru koszyka - pytanie czy potrzebujemy takiej metody ?
    static public function loadCartById(mysqli $connection, $id) {

        $sql = "SELECT * FROM product_orders WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedCart = new Cart();
            $loadedCart->id = $row['id'];
            $loadedCart->idOrders = $row['id_orders'];
            $loadedCart->idProduct = $row['id_product'];
            $loadedCart->quantity = $row['quantity'];
            $loadedCart->amount = $row['amount'];

            return $loadedCart;
        }

        return null;
    }

    // wyświetlanie koszyka wg numeru zamówienia - order
    static public function loadAllProductsByOrderId(mysqli $connection, $idOrder) {

        $sql = "SELECT * FROM product_orders WHERE id_orders=$idOrder ORDER BY amount DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedCart = new Cart();
                $loadedCart->id = $row['id'];
                $loadedCart->idOrders = $row['id_orders'];
                $loadedCart->idProduct = $row['id_product'];
                $loadedCart->quantity = $row['quantity'];
                $loadedCart->amount = $row['amount'];
                $ret[] = $loadedCart;
            }

            return $ret;
        }
    }

    public function saveToCart(mysqli $connection) {

        if ($this->id == -1) {

            //dodawanie produktu do koszyka i zapisywanie nowego koszyka do bazy danych, skąd weźmiemy zmienną id_orders i id_product ?

            $sql = "INSERT INTO Product_orders(id_orders, id_product,  quantity, amount)
               VALUES ('$this->idOrders','$this->idProduct', '$this->quantity', '$this->amount' )";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                return false;
            }
        } else { //aktualizacja koszyka
            $sql = "UPDATE Product_orders SET id_orders='$this->idOrders', id_product='$this->idProduct', 
                    quantity='$this->quantity', amount='$this->amount'
                 WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function getCartByUser(mysqli $connection, $userId) {
        $sql = "SELECT * FROM Orders WHERE id_user=$userId AND status=0";
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

}
