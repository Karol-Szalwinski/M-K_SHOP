
<?php
/*
 * Strona opisująca właściciela sklepu
 */
require_once __DIR__ . '/../src/required.php';

//Ustalamy aktywną zakładkę
$_SESSION['active-button'] = 4;
//Ustalamy id i name zalogowanego usera
if ($loggedUser = isLoggedUser($conn)) {
    $loggedUserName = $loggedUser->getName();
    $loggedUserId = $loggedUser->getId();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
    </head>
    <body>
        <!-----------Nagłówek z menu-------------->
        <header>
            <?php require_once __DIR__ . '/header.php' ?>
        </header>

        <!—-----------Główna treść --------------->

        <div class="container-fluid text-center">

            <div class="row content">

                <!—-----------Panel z kategoriami --------------->
                <?php require_once __DIR__ . '/sidebar.php' ?>

                <div class="col-sm-8 text-left"> 
                    <h1>Witamy w M&K SHOP</h1>
                    <hr>
                    <h3>O firmie M&K SHOP</h3>
                    <p>Od początku naszej działalności, czyli od roku 2004, marzyliśmy o stworzeniu miejsca dla przyjemnych, bezpiecznych i prostych zakupów w internecie.</p>
                    <p>Obecnie jesteśmy najczęściej ocenianym sklepem internetowym w Polsce i zdobywcą licznych branżowych nagród.</p>
                    <p>Zatrudniamy kilkuset pracowników, mamy placówki odbioru osobistego (netpunkty) w 18 miastach a naszą stronę odwiedza 1,5 mln osób miesięcznie.</p>
                    <hr>         
                </div>
            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>
