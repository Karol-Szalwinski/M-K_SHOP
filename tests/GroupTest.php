<?php

require_once __DIR__ . '/../src/Group.php';

class GroupTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Groups.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testSaveWhenCreatingNewGroup() {
        $group = new Group();
        $group->setGroupName('testGroup');
        $this->assertTrue($group->saveToDB(self::$mysqliConn));
    }

    public function testIfLoadAllGroups() {
        $noGroups = count(Group::loadAllGroups(self::$mysqliConn));
        $this->assertEquals($noGroups, 2);
    }

    public function testLoadGroupByIdIfIdIsNotInDB() {
        $this->assertNull(Group::loadCategoryById(self::$mysqliConn, 45));
    }

    public function testLoadGroupByIdWithCorrectId() {
        $group = Group::loadCategoryById(self::$mysqliConn, 10);
        $this->assertEquals(10, $group->getId());
    }

    public function testIfDeleteCategoryById() {
        $group = Group::deleteCategoryById(self::$mysqliConn, 1);
        $this->assertTrue($group);
    }

}
