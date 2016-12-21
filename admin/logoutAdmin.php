<?php

/*
 * Strona wylogowania
 */
session_start();
if (isset($_SESSION['loggedAdmin'])) {
    unset($_SESSION['loggedAdmin']);
}
header("Location: index.php");
