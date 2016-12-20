<?php
/*
 * Lista produktów
 * Możemy dodać i usunąć dowolny
 * 
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Products</title>
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
                <div class="col-sm-6 text-left">
                    <form>
                        <button type="submit" class="btn btn-info">Dodaj nowy produkt</button>
                    </form>
                </div>

                <div class="col-sm-8 text-left">
                    <br>
                    <hr>
                    <h4>Lista kategorii</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Miniaturka</th>
                                <th>Nazwa towaru</th>
                                <th>Dostępna ilość</th>
                                <th>Cena</th>
                                <th>Kategoria</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_1.jpg" width="100" height="100" border="0"></a></td>
                                <td>Procesor I3-4160</td>
                                <td>5</td>
                                <td>590.50</td>
                                <td>Procesory</td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_1.jpg" width="100" height="100" border="0"></a></td>
                                <td>Procesor I5-4460</td>
                                <td>5</td>
                                <td>750.99</td>
                                <td>Procesory</td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_3.jpg" width="100" height="100" border="0"></a></td> 
                                <td>Dysk Toshiba 4 Tb SSD</td>
                                <td>2</td>
                                <td>1055.50</td>
                                <td>Dyski HDD</td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="product.php" target="_blank"><img src="../images/image_4.jpg" width="100" height="100" border="0"></a></td>
                                <td>Karta graficzna GTX 1050</td>
                                <td>3</td>
                                <td>789.00</td>
                                <td>Karty graficzne</td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                        </tbody>
                </div>
            </div>
        </div>

    </body>
</html>