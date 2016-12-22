<?php
/*
 * Lista produktów
 * Możemy dodać i usunąć dowolny
 * 
 */
require_once __DIR__ . '/../src/required.php';
//jeśli admin jest zalogowany to przekierowuję na główną
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
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
                        <button type="button" class="btn btn-info"
                                onclick="location.href = 'addProduct.php';">Dodaj nowy produkt</button>
                    </form>
                </div>

                <div class="col-sm-12 text-left">
                    <br>
                    <hr>
                    <h3>Lista produktów</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Miniaturka</th>
                                <th>Nazwa towaru</th>
                                <th>Dostępna ilość</th>
                                <th>Cena</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Wyświetlam wszystkie produkty
                            $no = 0;
                            $allProducts = Product::loadAllProducts($conn);
                            foreach ($allProducts as $product) {
                                $no++;
                                $product->showProductInAdminTabRow($conn, $no);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>