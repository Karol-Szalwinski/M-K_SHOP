<?php
/*
 * Strona przedmiotu
 * Na tej stronie wyświetla się opis przedmiotu oraz jego zdjęcia w postaci
 * karuzeli.
 */
require_once __DIR__ . '/../src/required.php';

//jeśli user nie jest zalogowany to przekierowuję do logowania
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$errors = [];
// Jeżeli dostaliśmy poprawny productId w adresie
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['productId']) && is_numeric($_GET['productId'])) {
        $productId = $_GET['productId'];

        //Jeżeli produkt o tym productId jest w bazie
        if ($product = Product::loadProductById($conn, $productId)) {
            $productname = $product->getName();
            $category = $product->getIdGroup();
            $description = $product->getDescription();
            $availability = $product->getAvailability();
            $price = $product->getPrice();
        } else {
            $errors[] = 'Nie ma takiego towaru w bazie.';
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
        <title>M&K Shop - Cart</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
        <style>
            .carousel-inner > .item > img,
            .carousel-inner > .item > a > img {
                width: 60%;
                margin: auto;
                padding: 30px;
            }
        </style>
    </head>
    <body>
        <!-----------Nagłówek z menu-------------->
        <header>
            <?php require_once __DIR__ . '/header.php' ?>
        </header>

        <!—-----------Główna treść --------------->

        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-12 text-left"> 
                    <h3><?php echo $productname ?></h3>
                    <h4>Kategoria: <?php echo Group::loadCategoryById($conn, $category)->getGroupName() ?></h4>
                    <hr>
                    <div class="col-sm-6 text-left"> 

                        <h4>Galeria zdjęć</h4>
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <?php
                                $arraySize = count(Photo::loadAllPhotosByProductId($conn, $productId));
                                for ($i = 1; $i < $arraySize; $i++) {
                                    echo "<li data-target='#myCarousel' data-slide-to='" . $i . "'></li>";
                                }
                                ?>

                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php
                                $photoPath = Photo::loadAllPhotosByProductId($conn, $productId);
                                $isActive = 'active';

                                foreach ($photoPath as $path) {
                                    echo "<div class='item " . $isActive . "'>
                                    <img src=" . $path->getPath() . " width='460' height='245'>
                                </div>";
                                    $isActive = '';
                                }
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
                    <div class="col-sm-3 text-left"> 
                        <h4>Opis przedmiotu</h4>
                        <p><?php echo $description ?> </p>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="text-right panel panel-default panel-body">
                            <br>
                            <h3> Cena</h3>
                            <h3> <?php echo $price ?> PLN</h3>
                            <br><br>
                            <h3> Dostępnych</h3>
                            <h3> <?php echo $availability ?> Sztuk</h3>
                            <br><br>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!—--------------Stopka------------------->
    <?php //require_once __DIR__ . '/footer.php'  ?>

</body>
</html>




