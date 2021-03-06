<?php

/* 
 * Potrzebne pliki i funkcje
 * Tutaj startujemy sesję i dołączamy pliki niezbędne na każdej podstronie.
*/
session_start();

require_once __DIR__. '/bootstrap.html';
require_once '../src/User.php';
require_once '../src/Admin.php';
require_once '../src/Group.php';
require_once '../src/Product.php';
require_once '../src/Order.php';
require_once '../src/Photo.php';
require_once '../src/Status.php';
require_once '../src/Message.php';
require_once __DIR__. '/connection.php';
require_once __DIR__. '/myFunctions.php';