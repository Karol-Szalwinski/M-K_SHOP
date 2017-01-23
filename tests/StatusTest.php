<?php

require_once __DIR__ . '/../src/Status.php';

class StatusTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Status.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testSaveWhenCreatingNewStatus() {

        $status = new Status();
        $status->setStatusName('zlozony');
        $this->assertTrue($status->saveToDB(self::$mysqliConn));
    }

    public function testUpdateStatus() {

        $status = new Status();
        $status->setId(2);
        $status->setStatusName('potwierdzony');
        $this->assertTrue($status->saveToDB(self::$mysqliConn));
    }

    public function testIfLoadAllStatuses() {
        $noStatuses = count(Status::loadAllStatuses(self::$mysqliConn));
        $this->assertEquals($noStatuses, 2);
    }

    public function testLoadStatusByIdWithCorrectId() {
        $status = Status::loadStatusById(self::$mysqliConn, 3);
        $this->assertEquals(3, $status->getId());
    }

    public function testLoadStatusByIdIfIdIsNotInDB() {
        $this->assertNull(Status::loadStatusById(self::$mysqliConn, 32));
    }

}
