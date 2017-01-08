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
                            <div class="carousel-inner" role="listbox">
                                <?php
                                $photoPath = Photo::loadAllPhotos($conn);
                                var_dump($photoPath);
                                $randomPhoto = array_rand($photoPath, 4);
                                var_dump($randomPhoto);
                                $photoOne = $randomPhoto[0]->getPath();
                                $photoSecond = Photo::loadPhotoById($conn, $randomPhoto[1]);
                                $photoThird = Photo::loadPhotoById($conn, $randomPhoto[2]);
                                $photoFourth = Photo::loadPhotoById($conn, $randomPhoto[3]);
                                
                                
                                echo "<div class='item active'>
                                    <img src=".$photoOne." width='460' height='245'>
                                </div>";
                                echo "<div class='item'>
                                    <img src=".$photoSecond->getPath()." width='460' height='245'>
                                </div>";
                                echo "<div class='item'>
                                    <img src=".$photoThird->getPath()." width='460' height='245'>
                                </div>";
                                echo "<div class='item'>
                                    <img src=".$photoFourth->getPath()." width='460' height='245'>
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
                        
                        
                        
                        
                    </p>
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