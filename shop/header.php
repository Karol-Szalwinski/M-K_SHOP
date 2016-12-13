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
      <li class="active"><a href="#">Główna</a></li>
      <li><a href="#">Kategoria 1</a></li>
      <li><a href="#">Kategoria 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Zaloguj</a></li>
    </ul>
  </div>
</nav>