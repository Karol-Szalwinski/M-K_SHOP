<?php

/* 
 * Nagłówek dla usera
 * Używany tam gdzie chcemy mieć w pełni funkcjonalne menu
 */

//require_once __DIR__ . '/../src/required.php';
?>
<script>
    $(document).ready(function() {
        $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
    });
</script>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">M&K SHOP</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Główna</a></li>
   
      <li><a href="user.php"><span class="glyphicon glyphicon-hand-right"></span> Moje konto</a></li>
      <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Mój koszyk (10)</a></li>
      <li><a href="myMessages.php"><span class="glyphicon glyphicon-envelope"></span> Wiadomości (3)</a></li>
      <li><a href="aboutUs.php"><span class="glyphicon glyphicon-globe"></span> O nas</a></li>
      <li><a href="contact.php"><span class="glyphicon glyphicon-envelope"></span> Kontakt</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <!--Mechanizm wyswietlajacy inne menu w zależności czy jestesmy zalogowani-->
        <?php
            if (isset($_SESSION['loggedUser'])) {
                echo "<li><a>Jesteś zalogowany jako " . $loggedUserName ."</a></li>
                <li><a href='logoutUser.php'><span class='glyphicon glyphicon-log-out'></span> Wyloguj</a></li>";
              
            } else {
                echo "<li><a href='registerUser.php'><span class='glyphicon glyphicon-user'></span> Zarejestruj się</a></li>
                <li><a href='loginUser.php'><span class='glyphicon glyphicon-log-in'></span> Zaloguj</a></li>";
                
            }
        ?>
      
    </ul>
  </div>
</nav>
