<?php

//Funkcja sprawdza czy jestesmy zalogowani, jeśli nie to nas przekierowuje do logowania
//Zwraca też obiekt User
function isLoggedUser($conn) {
    if (!isset($_SESSION['loggedUser'])) {
        return null;
    }
    return User::loadUserById($conn, $_SESSION['loggedUser']);
}
//Funkcja sprawdza czy jestesmy zalogowani jako admin, jeśli nie to nas przekierowuje do logowania
//Zwraca też obiekt Admin
function isLoggedAdmin($conn) {
    if (!isset($_SESSION['loggedAdmin'])) {
        return null;
    }
    return Admin::loadAdminById($conn, $_SESSION['loggedAdmin']);
}

//Funkcja wyświetla kod html do wyświetlenia errorów w wybranym miejscu strony
//Zbieram błędy z całej strony, a potem wyświetlam tam gdzie chcę
function printErrors($errorsArray) {
    foreach ($errorsArray as $error) {
        echo "<div class='alert alert-danger'>" . $error . "</div>";
    }
    if (empty($errorsArray)) {
        return false;
    }
    return true;
}

//Zamienia wartość ułamkową na cenę w formacie PLN
function showPrice($value) {
    return number_format($value, 2, ","," ") . " PLN";
    
}