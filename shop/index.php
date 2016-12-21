<?php
/*
 * Strona główna naszego sklepu Ma mieć miejsce do zalogowania się,
 *  link do rejestracji, menu z wszystkimi grupami
 * przedmiotów i karuzelę z kilkoma wybranymi przedmiotami.
 */
require_once __DIR__ . '/../src/required.php';
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

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>