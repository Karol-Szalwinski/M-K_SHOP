<?php

/**
 * klasa przedmiotu:
 * - możliwość wyświetlania również przedmiotu dla danej grupy
 * - możliwość wyświetlania wszytskich przedmiotów
 * - możliwość wprowadzania nowego przedmiotu do sklepu i usuwania go
 * coś jeszcze?
 */
class Product {

    private $id;
    private $idGroup;
    private $name;
    private $price;
    private $description;
    private $availability;
    private $deleted;

    public function __construct() {

        $this->id = -1;
        $this->idGroup = -1;
        $this->name = "";
        $this->price = 0;
        $this->description = "";
        $this->availability = 0;
        $this->deleted = 0;
    }

    public function setId($newId) {
        if (is_integer($newId)) {
            $this->id = $newId;
        }
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($newName) {
        if (is_string($newName)) {
            $this->name = $newName;
        }
        return $this;
    }

    public function setIdGroup($newIdGroup) {
        if (is_integer($newIdGroup)) {
            $this->idGroup = $newIdGroup;
        }
        return $this;
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
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setDescription($newDescription) {
        if (is_string($newDescription)) {
            $this->description = $newDescription;
        } return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setAvailability($newAvailability) {
        $this->availability = $newAvailability;
        return $this;
    }

    public function getAvailability() {
        return $this->availability;
    }

    public function setDeleted() {
        $this->deleted = 1;
        return $this;
    }

    public function getDeleted() {
        return $this->deleted;
    }

// wyświetlanie produktu wg id
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
            $loadedProduct->deleted = $row['deleted'];
            return $loadedProduct;
        }

        return null;
    }

// wyświetlanie produktu wg nr grupy
    static public function loadAllProductsByGroupId(mysqli $connection, $idGroup) {

        $sql = "SELECT * FROM Product WHERE id_group=$idGroup AND deleted=0 ORDER BY name DESC";
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
                $loadedProduct->deleted = $row['deleted'];
                $ret[] = $loadedProduct;
            }

            return $ret;
        }
        return $ret;
    }

    static public function getAllProductsByGroupId(mysqli $connection, $idGroup) {

        $sql = "SELECT * FROM Product WHERE id_group=$idGroup";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedProduct = new Product();
                $loadedProduct->idGroup = $row['id_group'];
                $ret[] = count($loadedProduct);
            }

            return $ret;
        }
        return $ret;
    }

// wyświetlanie wszytskich produktów w bazie
    static public function loadAllProducts(mysqli $connection) {

        $sql = "SELECT * FROM Product WHERE deleted=0 ORDER BY name DESC";
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
                $loadedProduct->deleted = $row['deleted'];
                $ret[] = $loadedProduct;
            }
            return $ret;
        }

        return $ret;
    }

// zapisywanie produktu do bazy danych
    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {


            $sql = "INSERT INTO Product(id_group, name, price, description, availability, deleted)
               VALUES ('$this->idGroup','$this->name', '$this->price', '$this->description', '$this->availability', '$this->deleted' )";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE Product SET id_group='$this->idGroup', name='$this->name', price='$this->price',
               description='$this->description',availability='$this->availability', deleted='$this->deleted'  WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }

        return false;
    }

    //Dodawanie produktu do koszyka/zamówienia
    public function addProductToCart($conn, $orderId, $quantity) {
        $sql = "INSERT INTO Product_orders(id_orders, id_product, quantity, real_price)
                   VALUES ('$orderId', '$this->id', '$quantity', '$this->price')";
        $result = $conn->query($sql);
        if ($result == true) {
            //Pomniejszam dostępną ilosć i zapisuję do bazy
            $this->setAvailability($this->availability -= $quantity)->saveToDB($conn);
            //Podnoszę wartość koszyka
            $order = Order::loadOrderById($conn, $orderId);
            $amount = $order->getAmount() + $quantity * $this->price;

            $order->setAmount($amount)->saveToDB($conn);
            return true;
        } else {
            return false;
        }
    }

    //Zmiana ilości w koszyku
    static public function changeQuantityProductInCart($conn, $productOrderId, $newQuantity) {
        //Pobieram poprzednią ilosć z bazy
        $sql = "SELECT * FROM Product_orders WHERE id=$productOrderId";
        $result = $conn->query($sql);
        
        if ($result == true) {
            $row = $result->fetch_assoc();
            $oldQuantity = $row['quantity'];
            //ustawiam nową ilość
            $sql = "UPDATE Product_orders SET quantity='$newQuantity'  
                    WHERE id=$productOrderId";
            $result = $conn->query($sql);
            if ($result == true) {
                //Pobieram produkt z bazy
                $product = Product::loadProductById($conn, $row['id_product']);
                //Uaktualniam dostępną ilosć i zapisuję do bazy
                $actualAvailability = $product->getAvailability();
                $product->setAvailability($actualAvailability -= $newQuantity - $oldQuantity)->saveToDB($conn);
                //Podnoszę wartość koszyka
                $order = Order::loadOrderById($conn, $row['id_orders']);
                $amount = $order->getAmount() + ($newQuantity - $oldQuantity) * $row['real_price'] ;

                $order->setAmount($amount)->saveToDB($conn);
                return true;
            } else {
                return false;
            }
        }
    }

    //Usuwanie produktu z koszyka
    static public function deleteProductFromCart($conn, $productOrderId) {
        $sql = "SELECT * FROM Product_orders 
                WHERE id=$productOrderId";

        $result = $conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //Powiększam dostępną ilosć i zapisuję do bazy
            $productToChangeAvailability = Product::loadProductById($conn, $row['id_product']);
            $productToChangeAvailability->setAvailability($productToChangeAvailability
                    ->availability += $row['quantity'])->saveToDB($conn);
            //Obniżam wartość koszyka
            $order = Order::loadOrderById($conn, $row['id_orders']);
            $amount = $order->getAmount() - $row['quantity'] * $row['real_price'];
            $order->setAmount($amount)->saveToDB($conn);
            //Usuwam z bazy wpis
            $sql = "DELETE FROM Product_orders 
                WHERE id=$productOrderId";
            $result = $conn->query($sql);
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Usuwanie wszystkich produktów z koszyka -> nie testowane
    static public function deleteAllProductFromCart($conn, $orderId) {
        $sql = "SELECT * FROM Product_orders 
                WHERE id_orders=$orderId";
        $result = $conn->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $productOrderId = $row['id'];
                Product::deleteProductFromCart($conn, $productOrderId);
            }
        } else {
            return false;
        }
    }

    //ładujemy wszystkie produkty z koszyka / zamówienia
    static public function showAllProductsByCartIdInTabRow(mysqli $connection, $orderId) {

        $sql = "SELECT * FROM Product
                INNER JOIN Product_orders ON Product_orders.id_product=Product.id
                 WHERE id_orders=$orderId ";

        $result = $connection->query($sql);
        $no = 0;
        $amount = 0;
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $amount += $row['real_price'] * $row['quantity'];
                echo "<tr  data-toggle='tooltip' title='Kliknij, żeby zmienić ilość'>";
                echo "<td>" . ++$no . "</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td><div class='default' >{$row['quantity']}</div>";
                //Ustalam maksymalną dozwoloną ilość do zamówienia
                $availability = Product::loadProductById($connection, $row['id_product'])->getAvailability() + $row['quantity'];
                Product::makeFormToChangeQuantity($row['quantity'], $availability, $row['id']);
                echo "</td>";
                echo "<td>" . showPrice($row['real_price']) . "</td>";

                echo "<td>" . showPrice($row['quantity'] * $row['real_price']) . "</td>";
                echo "<td><form method='POST'><input type='hidden' name='delete-id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-danger'>Usuń</button></td></form>";
                echo "</tr>";
            }

            return $amount;
        }
        return $amount;
    }

    //Tworzy formularz w komórce do zmiany ilości
    static public function makeFormToChangeQuantity($setQuantity, $maxQuantity, $idOrderProduct) {
        echo "<div style='display: none' class='edit'><form method='POST'>";
        echo "<input type='number' class='input-sm' name='quantity' min='1' max='$maxQuantity' step='1' value='$setQuantity'>";
        echo "<input type='hidden' name='change-id' value='$idOrderProduct'>";
        echo "<input type='submit' class='btn btn-danger btn-sm' value='Zmień'>";
        echo "</form></div>";
    }

    //ładujemy wszystkie produkty z koszyka / zamówienia
    static public function showAllProductsByOrderIdInTabRow(mysqli $connection, $orderId) {

        $sql = "SELECT * FROM Product
                INNER JOIN Product_orders ON Product_orders.id_product=Product.id
                 WHERE id_orders=$orderId ";

        $result = $connection->query($sql);
        $no = 0;
        $amount = 0;
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $amount += $row['real_price'] * $row['quantity'];
                echo "<tr>";
                echo "<td>" . ++$no . "</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['quantity']}</td>";
                echo "<td>" . showPrice($row['real_price']) . "</td>";
                echo "<td>" . showPrice($row['quantity'] * $row['real_price']) . "</td>";
                echo "</tr>";
            }

            return $amount;
        }
        return $amount;
    }

    //Wyswietla produkt w wierszu tabeli
    public function showProductInTabRow($conn, $no) {
        echo '<tr onclick="location.href=';
        echo "'product.php?productId=";
        echo $this->getId();
        echo "'" . '">';
        echo "<td>" . $no . "</td>";
        echo "<td><img src='../images/image_1.jpg' width='100'"
        . " height='100'></td>";
        //echo "<td><img src='" . $mojaSciezka . "' width='100'"
        //. " height='100'></td>";
        echo "<td>" . $this->getName() . "</td>";
        echo "<td>" . $this->getAvailability() . "</td>";
        echo "<td>" . showPrice($this->getPrice()) . "</td>";
        echo "</tr>";
        //$mojaSciezka = Photo::loadAllPhotosByProductId($conn, $this->getId());
    }

    //Wyswietla produkt w wierszu tabeli
    public function showProductInAdminTabRow($conn, $no) {
        echo '<tr onclick="location.href=';
        echo "'showProduct.php?productId=";
        echo $this->getId();
        echo "'" . '">';
        echo "<td>" . $no . "</td>";
        echo "<td><img src='../images/image_1.jpg' width='100'"
        . " height='100'></td>";
        echo "<td>" . $this->getName() . "</td>";
        echo "<td>" . $this->getAvailability() . "</td>";
        echo "<td>" . showPrice($this->getPrice()) . "</td>";
        echo "<td><button type='button' class='btn btn-info'>Podgląd produktu</button></td>";
        echo"<td><form method='POST'><input type='hidden' name='product-id' value='$this->id'>";
        echo"<button type='submit' class='btn btn-danger'>Usuń</button></form></td>";
        echo "</tr>";
    }

}
