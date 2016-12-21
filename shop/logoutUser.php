<?php

/*
 * Strona wylogowania
 */

//require_once __DIR__ . '/../src/required.php';
session_start();
if (isset($_SESSION['loggedUser'])) {
    unset($_SESSION['loggedUser']);
}
header("Location: index.php");
