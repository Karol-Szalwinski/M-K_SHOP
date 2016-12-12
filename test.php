<?php
require_once 'src/Product.php';
require_once 'src/connection.php';
require_once 'src/User.php';

/**
$produkt1 = new Product();
//$produkt1->setId(1);
$produkt1->setIdGroup(2);
$produkt1->setName('krzesło');
$produkt1->setPrice(453.90);
$produkt1->setDescription('nowe ładne krzesło');
$produkt1->setAvailability(19);

//var_dump($produkt1);

//$produkt1->saveToDB($conn);


$produkt2 = Product::loadAllProducts($conn);
var_dump($produkt2);
**/

$user1 = new User();

$user1->setEmail('jan@mail.com');
$user1->setName('jan');
$user1->setId(1);
$user1->setPassword('haslo2');
$user1->setSurname('xxxxxx');

//var_dump($user1);

$user1->saveToDB($conn);



$user2 = User::load($conn, 1);

var_dump($user2);