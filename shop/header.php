<?php

/* 
 * Nagłówek dla usera
 * Używany tam gdzie chcemy mieć w pełni funkcjonalne menu
 */

require_once __DIR__ . '/../src/required.php';
?>
<head>
   <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style> 
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">M&K SHOP</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Główna</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-hand-right"></span> Nowe produkty</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-hand-right"></span> Moje konto</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Mój koszyk</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-globe"></span> O nas</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Kontakt</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Zaloguj</a></li>
    </ul>
  </div>
</nav>
