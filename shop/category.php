<?php
/*
 * Strona kategori
 * Wyświetla wszystkie towary z danej kategorii
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Category</title>
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

                <div class="col-sm-10 text-left"> 

                    <h3>Wszystkie towary z kategorii</h3>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Miniaturka</th>
                                <th>Nazwa towaru</th>
                                <th>Dostępna Ilość</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="product.php" target="_blank">1</a></td>                              
                                <td><a href="product.php" target="_blank"><img src="../images/image_1.jpg" width="100" height="100" border="0"></a></td>
                                <td><a href="product.php" target="_blank">Procesor I3-4160</a></td>
                                <td><a href="product.php" target="_blank">5</a></td>
                                <td><a href="product.php" target="_blank">590.50 PLN</a></td>                            
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_1.jpg" width="100" height="100" border="0"></a></td>
                                <td>Procesor I5-4460</td>
                                <td>5</td>
                                <td>750.99 PLN</td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_3.jpg" width="100" height="100" border="0"></a></td>                                
                                <td>Dysk Toshiba 4 Tb SSD</td>
                                <td>2</td>
                                <td>1055.50 PLN</td>

                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_4.jpg" width="100" height="100" border="0"></a></td>                                
                                <td>Karta graficzna GTX 1050</td>
                                <td>3</td>
                                <td>789.00 PLN</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>




