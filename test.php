<?php
require_once 'src/Product.php';
require_once 'src/connection.php';


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


