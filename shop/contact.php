

<?php
/*
 * Strona kontaktu z administracja naszego sklepu
 */
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
                    <h3>Drogi kliencie!</h3>
                    <p>Jesteś dla nas najważniejszy. Dlatego w przypadku chęci kontaktu proszę pisać na maila kissmyass@haha.com .</p>
                    <p>Wszystkie maile są czytane raz w roku przez 10minut.</p>
                    <p>Na wszystkie przeczytane przez nas maile odpowiemy niezwłocznie w następnym roku kalendarzowym.</p>
                    <hr>
                    
                </div>
                
            </div>
        </div>
        
        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>