<?php
/*
 * Lista produktów
 * Możemy dodać i usunąć dowolny
 * 
 */
require_once __DIR__ . '/../src/required.php';

//Ustalam aktywną zakładkę w menu
$_SESSION['active-button-admin-menu'] = 2;

//Czyścimy zmienną sesyjną
$_SESSION['photo'] = [];

$errors = [];

//jeśli admin jest zalogowany to przekierowuję na główną
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}

//sprawdzam czy została przesłany odpowiednie id produktu do usunięcia
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product-id']) &&
        $_POST['product-id'] > 0) {

    if ($productToDel = Product::loadProductById($conn, $_POST['product-id'])) {
        $productToDel->setDeleted()->setAvailability(0)->saveToDB($conn);
        $errors[] = "Pomyślnie usunięto produkt z ofery sprzedaży";
    }
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
                <!-Tutaj wyświetlam błędy-->
                <?php printErrors($errors); ?>
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