<?php
/*
 * Nagłówek dla usera
 * Używany tam gdzie chcemy mieć w pełni funkcjonalne menu
 */

//require_once __DIR__ . '/../src/required.php';
if (isset($_SESSION['loggedUser'])) {
    $productsInCart = "(" . Order::getCartByUser($conn, $_SESSION['loggedUser'])
                    ->countProductsInCart($conn) . ")";
    $messagesCount = "(" . User::loadUserById($conn, $_SESSION['loggedUser'])
                    ->countRecipientMessages($conn) . ")";
} else {
    $productsInCart = $messagesCount = "";
}
$active = ["", "", "", "", ""];

//sprawdzamy zmienną globalną przechowującą nr aktywnej zakładki menu
if (isset($_SESSION['active-button'])) {
    $active[$_SESSION['active-button']] = "class='active'";
}
?>
<script>
    $(document).ready(function () {
        $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
    });
</script>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">M&K SHOP</a>
        </div>
        <ul class="nav navbar-nav">
            <li <?php echo $active[0] ?> ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Główna</a></li>
            <li <?php echo $active[1] ?> ><a href="user.php"><span class="glyphicon glyphicon-hand-right"></span> Moje konto</a></li>
            <li <?php echo $active[2] ?> ><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Mój koszyk <?php echo $productsInCart; ?></a></li>
            <li <?php echo $active[3] ?> ><a href="myMessages.php"><span class="glyphicon glyphicon-envelope"></span> Wiadomości <?php echo $messagesCount; ?></a></li>
            <li <?php echo $active[4] ?> ><a href="aboutUs.php"><span class="glyphicon glyphicon-globe"></span> O nas</a></li>
            <!--li><a href="contact.php"><span class="glyphicon glyphicon-envelope"></span> Kontakt</a></li-->
        </ul>
        <!--Mechanizm wyswietlajacy inne menu w zależności czy jestesmy zalogowani-->
        <ul class="nav navbar-nav navbar-right">

            <?php
            if (isset($_SESSION['loggedUser'])) {
                echo "<li><a>Jesteś zalogowany jako " . $loggedUserName . "</a></li>
                <li><a href='logoutUser.php'><span class='glyphicon glyphicon-log-out'></span> Wyloguj</a></li>";
            } else {
                echo "<li><a href='registerUser.php'><span class='glyphicon glyphicon-user'></span> Zarejestruj się</a></li>
                <li><a href='loginUser.php'><span class='glyphicon glyphicon-log-in'></span> Zaloguj</a></li>";
            }
            ?>

        </ul>
    </div>
</nav>
