<?php

require_once __DIR__ . '/../src/Admin.php';

class AdminTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Admin.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testSaveWhenCreatingNewAdmin() {

        $admin = new Admin();
        $admin->setName('testName');
        $admin->setEmail('adminTest@email.pl');
        $admin->setPassword('12345');
        $this->assertTrue($admin->saveToDB(self::$mysqliConn));
    }

    public function testLoadAdminByIdIfIdIsNotInDB() {
        $this->assertNull(Admin::loadAdminById(self::$mysqliConn, 50));
    }

    public function testLoadAdminByIdWithCorrectId() {
        $admin = Admin::loadAdminById(self::$mysqliConn, 5);
        $this->assertEquals(5, $admin->getId());
    }

    public function testLoadAdminByEmailWithCorrectEmail() {
        $admin = Admin::loadAdminByEmail(self::$mysqliConn, 'admin1@admin.pl');
        $this->assertEquals(5, $admin->getId());
    }

    public function testIfLoginReturnsAdminId() {
        $this->assertEquals(5, Admin::loginAdmin(self::$mysqliConn, 'admin1@admin.pl', '12345'));
    }

    public function testIfEmailIsAvailable() {
        $admin = Admin::emailIsAvailable(self::$mysqliConn, 'admin5@admin5.pl');
        $this->assertEquals($admin, true);
    }

}
