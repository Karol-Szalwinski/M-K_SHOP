<?php

require_once __DIR__ . '/../src/Message.php';

class AdminTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;
   
    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
 
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }
    
    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Message.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }
    //$mysqliConn->getConnection->query("set foreign_key_checks=0");
    
    public function testSaveWhenCreatingNewMessage() {
        
        $message = new Message();
        $message->setReceiverId(15);
        $message->setSenderId(2);
        $message->setTitle('zamowienie');
        $message->setTextMessage('zmowienie');
        $this->assertTrue($message->saveToDB(self::$mysqliConn->getConnection->query("set foreign_key_checks=0")));
    }
}
