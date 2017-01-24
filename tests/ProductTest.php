<?php

require_once __DIR__ . '/../src/Product.php';


class ProductTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Product.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testIfLoadProducByIdWithCorrectId() {
        $product = Product::loadProductById(self::$mysqliConn, 1);
        $this->assertEquals(1, $product->getId());
    }

    public function testIfLoadAllProductsByGroupId() {
        $noProducts = count(Product::loadAllProductsByGroupId(self::$mysqliConn, 11));
        $this->assertEquals(2, $noProducts);
    }

    public function testIfGetProductsByGroupId() {
        $noProducts = count(Product::getAllProductsByGroupId(self::$mysqliConn, 10));
        $this->assertEquals(2, $noProducts);
    }

    public function testIfLoadAllProducts() {
        $noProducts = count(Product::loadAllProducts(self::$mysqliConn));
        $this->assertEquals(4, $noProducts);
    }

    public function testSaveWhenCreatingNewProduct() {

        $product = new Product();
        $product->setIdGroup(11);
        $product->setName("nowy dysk");
        $product->setPrice(100.25);
        $product->setDescription("najnowszy dysk");
        $product->setAvailability(20);
        $product->setDeleted(1);
        $this->assertTrue($product->saveToDB(self::$mysqliConn));
    }

    public function testLoadProductByIdIfIdIsNotInDB() {
        $this->assertNull(Product::loadProductById(self::$mysqliConn, 78));
    }

}
