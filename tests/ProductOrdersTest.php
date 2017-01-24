<?php

require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/Order.php';

class ProductOrdersTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Product_orders.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testIfAddProductToCart() {
        $product = Product::loadProductById(self::$mysqliConn, 1);
        $this->assertTrue($product->addProductToCart(self::$mysqliConn, 3, 2));
    }

    public function testIfChangeQuantityProductInCart() {
        $product = Product::changeQuantityProductInCart(self::$mysqliConn, 3, 5);
        $this->assertTrue($product);
    }

    public function testIfDeleteProductFromCart() {
        $product = Product::deleteProductFromCart(self::$mysqliConn, 4);
        $this->assertTrue($product);
    }

    public function testIfDeleteAllProductFromCart() {
        $this->markTestSkipped();
        //$product = Product::deleteAllProductFromCart(self::$mysqliConn, 1);
        //$this->assertTrue($product);
    }
    
    public function testIfShowAllProductsByCartId() {
        $product = count(Product::showAllProductsByOrderIdInTabRow(self::$mysqliConn, 1));
        $this->assertEquals(2, $product);
    }

}
