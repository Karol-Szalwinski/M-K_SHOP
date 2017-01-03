<?php
require_once __DIR__ . '/../src/required.php';
//jeśli user jest zalogowany to przekierowuję na główną
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$errors = [];
//sprawdzam zdjęcie
$errors9 = [];

If ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
    if ($_FILES['fileToUpload']['size'] > 0) {
        $uploadFile = '../images/' . basename($_FILES['fileToUpload']['name']);
        echo "$uploadFile";
    } else {
        $errors9[] = "brak załadowanego zdjęcia";
    }
    if (empty($errors9)) {
        echo "Załadowano zdjęcie<br>";
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)) {
            // Zapis do tablicy sesyjnej
            $_SESSION['photo'][] = $uploadFile;
            var_dump($_SESSION['photo']);
            foreach ($_SESSION['photo'] as $picture) {
                echo '<img src="' . $picture . '" width="200px" height="150px" />';
            }
        }
    }
}
//sprawdzam czy zostały przesłane odpowiednie dane
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //sprawdzam przesłane id kategorii
    if (isset($_POST['category']) && is_numeric($_POST['category']) &&
            $_POST['category'] > 0) {
        $categoryId = intval($_POST['category']);
    } else {
        $errors[] = 'Nie wybrałeś kategorii';
    }
    //sprawdzam przesłaną nazwę produktu
    if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 0) {
        $name = substr(trim($_POST['name']), 0, 20);
    } else {
        $errors[] = 'Podałeś nieprawidłową nazwę';
    }
    //sprawdzam przesłany opis produktu
    if (isset($_POST['description']) && strlen(trim($_POST['description'])) > 20) {
        $description = trim($_POST['description']);
    } else {
        $errors[] = 'Podałeś za krótki opis. Napisz chociaż jedno zdanie';
    }
    //sprawdzam przesłaną ilość
    if (isset($_POST['quantity']) && is_numeric($_POST['quantity']) &&
            $_POST['quantity'] > 0) {
        $quantity = intval($_POST['quantity']);
    } else {
        $errors[] = 'Ilość musi być większa od 0';
    }
    //sprawdzam przesłaną cenę
    if (isset($_POST['price']) && is_numeric($_POST['price']) &&
            $_POST['price'] > 0) {
        $price = floatval($_POST['price']);
    } else {
        $errors[] = 'Cena musi być większa od 0';
    }
//Jeżeli wszystkie powyższe dane zwalidowały się poprawnie tworzymy nowy
//produkt i wracamy do listy produktów
    if (empty($errors)) {
        echo "Dane produktu są poprawne<br>";
        $newProduct = new Product();
        $newProduct->setIdGroup($categoryId)->setName($name)->setDescription($description)
                ->setAvailability($quantity)->setPrice($price)->saveToDB($conn);
// sprawdzić jak ma działać
        //$newProductId = $newProduct->insert_id;
        $last_id = $conn->insert_id;
        //var_dump($newProductId);
        //foreach tablica w sesji
        foreach ($_SESSION['photo'] as $value) {
            $newPhoto = new Photo();
            $newPhoto->setProductId($last_id);
            $newPhoto->setPath($value);
            $newPhoto->saveToDB($conn);
            var_dump($newPhoto);
        }
        //header("Location: products.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Add Product</title>
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
<?php
printErrors($errors);
printErrors($errors9)
?>
                <div class="col-sm-12 text-left">
                    <br>
                    <h3>Dodaj produkt</h3>
                </div>
                <div class="col-sm-6 text-left">

                    <form method="POST">
                        <div class="form-group">
                            <label for="category">Kategoria</label>
                            <select class="form-control" id="category" name="category">
                                <option value="0">Wybierz kategorię</option>
                                <?php
                                $allCategories = Group::loadAllGroups($conn);
                                foreach ($allCategories as $category) {
                                    echo "<option value='" . $category->getId() . "'>" . $category->getGroupName() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Nazwa produktu</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Podaj nazwę produktu">
                        </div>
                        <div class="form-group">
                            <label for="description">Opis produktu</label>
                            <textarea type="text" class="form-control" id="description" rows="10"
                                      name="description" placeholder="Opis produktu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Dostępna ilość</label>                           
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="1000" step="1" value="1">
                        </div>
                        <div class="form-group">
                            <label for="price">Cena sprzedaży</label>                           
                            <input type="number" class="form-control" id="price" name="price" min="1" step="0.01" value="1">
                        </div>
                        <button type="submit" class="btn btn-danger">Dodaj nowy produkt</button>
                    </form>
                </div>
                <div class="col-sm-6 text-left">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fileToUpload">Dodaj zdjęcie</label>
                            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload"><br>
                            <input class="btn btn-info" type="submit" value="Wgraj zdjęcie" name="submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </body>
</html>