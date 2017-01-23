<?php

require_once __DIR__ . '/../src/Photo.php';

class PhotoTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $mysqliConn;

    public function getConnection() {
        $conn = new PDO(
                $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/datasets/Photos.xml');
    }

    static public function setUpBeforeClass() {
        self::$mysqliConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
    }

    public function testSaveWhenCreatingNewPhoto() {

        $photo = new Photo();
        $photo->setProductId(5);
        $photo->setPath('../images/coders_lab_notebook.jpg');
        $this->assertTrue($photo->saveToDB(self::$mysqliConn));
    }

    public function testLoadPhotoByIdWithCorrectId() {
        $photo = Photo::loadPhotoById(self::$mysqliConn, 4);
        $this->assertEquals(4, $photo->getId());
    }

    public function testLoadAllPhotosByProductIdWithCorrectProductId() {
        $photos = count(Photo::loadAllPhotosByProductId(self::$mysqliConn, 1));
        $this->assertEquals(2, $photos);
    }

    public function testLoadOnePhotoByProductIdWithCorrectProductId() {
        $photo = count(Photo::loadOnePhotoByProductID(self::$mysqliConn, 1));
        $this->assertEquals(1, $photo);
    }

    public function testLoadAllPhotosFromDB() {
        $photos = count(Photo::loadAllPhotos(self::$mysqliConn));
        $this->assertEquals(4, $photos);
    }

    public function testLoadOnePhotoByProductIdIfProductIdIsNotInDB() {
        $this->assertNull(Photo::loadOnePhotoByProductID(self::$mysqliConn, 35));
    }

}
