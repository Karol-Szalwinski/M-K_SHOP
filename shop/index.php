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

        <div class="container-fluid">

            <div class="row content">

                <!—-----------Panel z kategoriami --------------->
                <?php require_once __DIR__ . '/sidebar.php' ?>

                <div class="col-sm-10 text-center"> 
                    <div>
                        <h1>Witamy w M&K SHOP</h1>
                        <p>Sklep M&K powstał z potrzeby dostarczenia wysokiej jakości produktów naszym wymagającym klientom w całej Polsce.</p>
                        <p>Jako profesjonaliści w branży E-Commerce dostarczamy nowoczesne i innowacyjne produkty, których na próżno szukać u naszej konkurencji.</p>
                        <p>W trosce o wysoki komfort procesu zakupowego zapewniamy profesjonalną pomoc na każdym etapie składania zamówienia,
                            jak również przykładamy ogromną wagę do utrzymania długofalowej relacji z naszymi klientami.</p>
                        <p>Dziękujemy że jesteście z nami !</p>
                        <hr>
                    </div>
                    <h3>Zobacz nasze Produkty</h3>
                    <p>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner " role="listbox">
                            <?php
                            $photoPath = Photo::loadAllPhotos($conn);
                            $max = count($photoPath) - 1;

                            $photoOne = $photoPath[rand(0, $max)]->getPath();
                            $photoSecond = $photoPath[rand(0, $max)]->getPath();
                            $photoThird = $photoPath[rand(0, $max)]->getPath();
                            $photoFourth = $photoPath[rand(0, $max)]->getPath();

                            echo "<div class='item text-center active'><img src=" . $photoOne . " width='460' height='345' style='display:block;margin:auto' >
                                </div>";
                            echo "<div class='item text-center'><img src=" . $photoSecond . " width='460' height='345' style='display:block;margin:auto'>
                                </div>";
                            echo "<div class='item text-center'><img src=" . $photoThird . " width='460' height='345' style='display:block;margin:auto'>
                                </div>";
                            echo "<div class='item text-center'><img src=" . $photoFourth . " width='460' height='345' style='display:block;margin:auto'>
                                </div>";
                            ?>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>                        
                </div>
            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>