<?php

require_once __DIR__ . '/../src/Product.php';

class ProductsTest extends PHPUnit_Framework_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXMLDataSet(__DIR__ . '/datasets/Product.xml');
    }

    static public function setUpConn() {
        $servername = "localhost";
        $username = "root";
        $password = "Coderslab";
        $basename = "M_K-SHOP_TEST";
        self::$mysqliConn = new mysqli($servername, $username, $password, $basename);
        if (self::$mysqliConn->connect_error) {
            die("DB connection error: " . self::$mysqliConn->connect_error);
        }
    }

    static public function closeConn() {
        self::$mysqliConn->close();
        self::$mysqliConn = null;
    }
    
    /*
     * public function testIfReturnNullWhenLoadedProductDoesNotExist(){
    
        
        $this->assertNull(Product::loadProductById(self::$mysqliConn, 53230));
    }
    */
    public function testConstructor() {
        $product = new Product();
        $this->assertEquals(10, 10);
        $this->assertEquals(-1, $product->getId());
    }
}
/*
public function __construct() {

        $this->id = -1;
        $this->idGroup = -1;
        $this->name = "";
        $this->price = 0;
        $this->description = "";
        $this->availability = 0;
        $this->deleted = 0;
    }
 * 
 * */
 