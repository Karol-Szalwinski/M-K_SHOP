<?php

/* 
 * Nagłówek dla usera
 * Używany tam gdzie chcemy mieć w pełni funkcjonalne menu
 */

require_once __DIR__ . '/../src/required.php';
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">M&K SHOP</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Główna</a></li>
      <!--li><a href="#"><span class="glyphicon glyphicon-hand-right"></span> Nowe produkty</a></li-->
      <li><a href="user.php"><span class="glyphicon glyphicon-hand-right"></span> Moje konto</a></li>
      <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Mój koszyk (10)</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-globe"></span> O nas</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Kontakt</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="registerUser.php"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>
      <li><a href="loginUser.php"><span class="glyphicon glyphicon-log-in"></span> Zaloguj</a></li>
    </ul>
  </div>
</nav>
