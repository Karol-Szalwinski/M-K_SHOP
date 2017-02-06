<?php
/*
 * Lista kategorii w korej mozemy dodac i usunac dowolna z nich
 */
require_once __DIR__ . '/../src/required.php';

//Ustalam aktywną zakładkę w menu
$_SESSION['active-button-admin-menu'] = 1;

//jeśli admin jest zalogowany to przekierowuję na główną
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$errors = [];

//sprawdzam czy została przesłana odpowiednia kategoria do dodania
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category'])) {
    if (strlen(trim($_POST['category'])) > 4) {
        $newCategory = $_POST['category'];
        $category = new Group();
        $category->setGroupName($newCategory);
        if ($category->saveToDB($conn)) {
            $errors[] = "Dodano nową kategorię";
        } else {
            $errors[] = "Nie udało się dodać kategorii";
        }
    } else {
        $errors[] = "Podana kategoria jest za krotka";
    }
}
//sprawdzam czy została przesłana odpowiednia kategoria do usunięcia
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category-id']) &&
        $_POST['category-id'] > 0 ) {
    if (Group::loadCategoryById($conn, $_POST['category-id'])->countProductsInCategory($conn) == 0) {
        if(Group::deleteCategoryById($conn, $_POST['category-id'])) {
            $errors[] = "Pomyślnie usunięto kategorię";
        } 
        
    } else {
        $errors[] = "Nie można usunąć kategorii ponieważ istnieją produkty z nią powiązane";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Category</title>
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
                    <form action=# method="POST">
                        <div class="form-group">
                            <label for="category"><h4>Dodaj kategorię:</h4></label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Wprowadź nowa kategorię">
                        </div>
                        <button type="submit" class="btn btn-info">Dodaj kategorię</button>
                    </form>
                </div>

                <div class="col-sm-8 text-left">
                    <br>
                    <hr>
                    <h4>Lista kategorii</h4>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nazwa kategorii</th>
                                <th>Ilość towarów</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Wyświetlam wszystkie kategorie
                            $no = 0;
                            $allCategories = Group::loadAllGroups($conn);
                            foreach ($allCategories as $category) {
                                
                                $no++;
                                $category->showCategoryInTabRow($conn, $no);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>