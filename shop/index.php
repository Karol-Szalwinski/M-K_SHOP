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

//Ustalamy aktywną zakładkę
$_SESSION['active-button'] = 0;
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
                    <p>Sklep M&K powstał z potrzeby dostarczenia wysokiej jakości produktów naszym wymagającym klientom w całej Polsce. Jako profesjonaliści w branży E-Commerce dostarczamy nowoczesne i innowacyjne produkty, których na próżno szukać u naszej konkurencji. W trosce o wysoki komfort procesu zakupowego zapewniamy profesjonalną pomoc na każdym etapie składania zamówienia, jak również przykładamy ogromną wagę do utrzymania długofalowej relacji z naszymi klientami. Dziękujemy że jesteście z nami !</p>
                    <hr>
                    <h3>Zobacz nasze Produkty</h3>
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