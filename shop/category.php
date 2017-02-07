<?php
/*
 * Strona kategori
 * Wyświetla wszystkie towary z danej kategorii
 */
require_once __DIR__ . '/../src/required.php';
//Ustalamy id i name zalogowanego usera
if ($loggedUser = isLoggedUser($conn)) {
    $loggedUserName = $loggedUser->getName();
    $loggedUserId = $loggedUser->getId();
}
// Jeżeli dostaliśmy poprawny categoryId w adresie
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['categoryId']) && is_numeric($_GET['categoryId'])) {
        $categoryId = $_GET['categoryId'];

        //Ustalamy czy wyswietlamy wszystkie, czy konkretna kategorię
        if ($categoryId == 0) {
            $allProducts = Product::loadAllProducts($conn);
            $title = "Wszystkie produkty w sklepie";
        } else {
            $allProducts = Product::loadAllProductsByGroupId($conn, $categoryId);

            //Jeżeli kategoria o tym Id jest w bazie i ma produkty to dostosuwujemy tytuł
            if (!empty($allProducts && $categoryId > 0)) {
                $title = "Wszystkie towary z kategorii " . Group::loadGroupById($conn, $categoryId)->getGroupName();
            } else {
                $title = 'Nie ma produktów w tej kategorii.';
            }
        }
    } else {
        $errors[] = 'Grrr... coś kombinujesz z adresem url... Nieładnie!';
    }
    if (!empty($errors)) {
        printErrors($errors);
        die();
    }
}
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

                    <h3><?php echo $title ?></h3>

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
                            <?php
                            //Wyświetlam wszystkie produkty
                            $no = 0;
                            foreach ($allProducts as $product) {

                                $no++;
                                $product->showProductInTabRow($conn, $no);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>




