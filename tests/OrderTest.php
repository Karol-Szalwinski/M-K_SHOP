<?php

require_once __DIR__ . '/../src/Order.php';

class OrderTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Orders.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testSaveWhenCreatingNewOrder() {

        $order = new Order();
        $order->setUserId(4);
        $order->setStatus(2);
        $order->setPaymentMethod('cash');
        $order->setAmount(25);
        $order->setAdressStreet('Bema');
        $order->setAdressLocalNo('21a');
        $order->setPostalCode(01 - 200);
        $order->setAdresscity("Krakow");
        $this->assertTrue($order->saveToDB(self::$mysqliConn));
    }

    public function testIfDeleteOrder() {

        $order = new Order();
        $order->setUserId(2);
        $order->setStatus(2);
        $order->setPaymentMethod('cash');
        $order->setAmount(25);
        $order->setAdressStreet('Bema');
        $order->setAdressLocalNo('21a');
        $order->setPostalCode(01 - 200);
        $order->setAdresscity("Warszawa");
        $this->assertTrue($order->delete(self::$mysqliConn));
    }

    public function testLoadOrderByIdWithCorrectId() {
        $order = Order::loadOrderById(self::$mysqliConn, 4);
        $this->assertEquals(4, $order->getId());
    }

    public function testLoadAllOrdersByUserIdWithCorrectUserId() {
        $orders = count(Order::loadAllOrdersByUserId(self::$mysqliConn, 4));
        $this->assertEquals(2, $orders);
    }
    
    public function testLoadAllOrdersByStatusIdWithCorrectStatus() {
        $orders = count(Order::loadAllOrdersByStatus(self::$mysqliConn, 2));
        $this->assertEquals(2, $orders);
    }
    public function testIfLoadAllStatuses() {
        $noOrders = count(Order::loadAllOrders(self::$mysqliConn));
        $this->assertEquals($noOrders, 4);
    }    
    public function testGetCartByUserIdWithCorrectUserId() {
        $orders = count(Order::getCartByUser(self::$mysqliConn, 4));
        $this->assertEquals(0, $orders);
    }    
    
    public function testLoadOrderByIdIfIdIsNotInDB() {
        $this->assertNull(Order::loadOrderById(self::$mysqliConn, 32));
    }
}
