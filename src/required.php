<?php

/* 
 * Potrzebne pliki i funkcje
 * Tutaj startujemy sesję i dołączamy pliki niezbędne na każdej podstronie.
*/
session_start();

require_once __DIR__. '/bootstrap.html';
require_once '../src/User.php';
require_once __DIR__. '/connection.php';