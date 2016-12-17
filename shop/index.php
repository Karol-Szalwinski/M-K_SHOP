<?php

/* 
 * Strona główna naszego sklepu Ma mieć miejsce do zalogowania się,
 *  link do rejestracji, menu z wszystkimi grupami
 * przedmiotów i karuzelę z kilkoma wybranymi przedmiotami.
 */

require_once __DIR__ . '/header.php';
?>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Kategoria 1</a></p>
      <p><a href="#">Kategoria 2</a></p>
      <p><a href="#">Kategoria 3</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Witamy w M&K SHOP</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>
      <h3>Test</h3>
      <p>Tutaj Karuzela z produktami</p>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Okienko logowania może tu być</p>
      </div>
      <div class="well">
        <p>Tu jakaś reklama</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Michał & Karol Shop &copy; 2017 Powered by CodersLab </p>
</footer>
</body>