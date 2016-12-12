<?php

/*
 * Strona wylogowania
 */

require_once __DIR__ . '/../src/required.php';
if (isset($_SESSION['loggedUserId'])) {
    unset($_SESSION['loggedUserId']);
}
header("Location: index.php");
