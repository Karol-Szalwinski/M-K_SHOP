<?php
/*
 * Nagłówek dla admina
 * Używany tam gdzie chcemy mieć w pełni funkcjonalne menu
 */
require_once __DIR__ . '/../src/required.php';
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Panel Administratora</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Główna</a></li>
            <li><a href="category.php"><span class="glyphicon glyphicon-th-list"></span> Kategorie</a></li>
            <li><a href="products.php"><span class="glyphicon glyphicon-shopping-cart"></span> Produkty</a></li>
            <li><a href="users.php"><span class="glyphicon glyphicon-user"></span> Użytkownicy</a></li>
            <li><a href="orders.php"><span class="glyphicon glyphicon-list-alt"></span> Zamówienia</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="registerAdmin.php"><span class="glyphicon glyphicon-user"></span> Zarejestruj Administratora</a></li>
            <li><a href="logoutAdmin.php"><span class="glyphicon glyphicon-log-out"></span> Wyloguj</a></li>
        </ul>
    </div>
</nav>
