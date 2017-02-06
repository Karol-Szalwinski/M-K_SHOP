<?php
/*
 * Nagłówek dla usera
 * Używany tam gdzie chcemy mieć w pełni funkcjonalne menu
 */
$active = ["", "", "", "", ""];
$logged = $logoff = $productsInCart = $messagesCount = "";
//sprawdzam czy jest użytkownik zalogowany
if (isset($_SESSION['loggedUser'])) {
    //Jeśli tak to ustalam wartości dla liczników
    $productsInCart = "(" . Order::getCartByUser($conn, $_SESSION['loggedUser'])
                    ->countProductsInCart($conn) . ")";
    $messagesCount = "(" . User::loadUserById($conn, $_SESSION['loggedUser'])
                    ->countRecipientMessages($conn) . ")";
    //Ustalam też widoczne elementy menu
    $logoff = "hidden";
} else {
    $logged = "hidden";
}


//sprawdzamy zmienną globalną przechowującą nr aktywnej zakładki menu
if (isset($_SESSION['active-button'])) {
    $active[$_SESSION['active-button']] = "active ";
}
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">M&K SHOP</a>
        </div>
        <!-- Menu po lewej stronie -->
        <ul class="nav navbar-nav">
            <li class="<?php echo $active[0] ?>" ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Główna</a></li>
            <li class="<?php echo $active[1], $logged ?>" ><a href="user.php"><span class="glyphicon glyphicon-hand-right"></span> Moje konto</a></li>
            <li class="<?php echo $active[2], $logged ?>" ><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Mój koszyk <?php echo $productsInCart; ?></a></li>
            <li class="<?php echo $active[3], $logged ?>" ><a href="myMessages.php"><span class="glyphicon glyphicon-envelope"></span> Wiadomości <?php echo $messagesCount; ?></a></li>
            <li class="<?php echo $active[4] ?>" ><a href="aboutUs.php"><span class="glyphicon glyphicon-globe"></span> O nas</a></li>
        </ul>
        <!--Menu po prawej stronie-->
        <ul class="nav navbar-nav navbar-right">
            <li class="<?php echo $logged ?>"><a>Jesteś zalogowany jako  <?php echo $loggedUserName ?></a></li>
            <li class="<?php echo $logged ?>"><a href='logoutUser.php'><span class='glyphicon glyphicon-log-out'></span> Wyloguj</a></li>
            <li class="<?php echo $logoff ?>"><a href='registerUser.php'><span class='glyphicon glyphicon-user'></span> Zarejestruj się</a></li>
            <li class="<?php echo $logoff ?>"><a href='loginUser.php'><span class='glyphicon glyphicon-log-in'></span> Zaloguj</a></li>
        </ul>
    </div>
</nav>
