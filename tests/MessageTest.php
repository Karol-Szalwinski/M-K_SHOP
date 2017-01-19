<?php

require_once __DIR__ . '/../src/Message.php';

class MessageTest extends PHPUnit_Extensions_Database_TestCase {

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
        $this->markTestIncomplete();
        //$message = new Message();
        //$message->setReceiverId(4);
        //$message->setSenderId(2);
        //$message->setTitle('zamowienie');
        //$message->setTextMessage('zmowienie');
        //$this->assertTrue($message->saveToDB(self::$mysqliConn));
    }
    
    public function testLoadMessageByReceiverIdWithCorrectReceiverId() {
        $message = Message::loadMessagesByReceiverId(self::$mysqliConn, 13);
        $this->assertEquals(6, $message->getId());
    }
        public function testLoadMessageBySenderIdWithCorrectSenderId() {
        $message = Message::loadMessagesBySenderIdId(self::$mysqliConn, 3);
        $this->assertEquals(6, $message->getId());
    }
}
