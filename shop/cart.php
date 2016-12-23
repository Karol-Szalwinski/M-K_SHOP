<?php
/*
 * Strona koszyka
 * Na tej stronie powinny być następujące możliwości dotyczące przedmiotów
 *  znajdującychsię w koszyku:
 * - wyświetlenie wszystkich przedmiotów,
 * - zmiana liczby przedmiotów,
 * - całkowite usunięcie przedmiotów,
 * - wyświetlenie łącznej kwoty zamówienia.
 */
require_once __DIR__ . '/../src/required.php';
$errors = [];
//Ustalamy id i name zalogowanego usera
if ($loggedUser = isLoggedUser($conn)) {
    $loggedUserName = $loggedUser->getName();
    $loggedUserId = $loggedUser->getId();
    $myCart = Order::getCartByUser($conn, $loggedUserId);
    $myCartId = $myCart->getId();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-id'])) {
        if ($_POST['delete-id'] > 0) {
            if (Product::deleteProductFromCart($conn, $_POST['delete-id'])) {
                $errors[] = "Pomyślnie usunięto produkt z koszyka";
            }
        } else {
            $errors[] = "Nie udało się usuwanie produktu z koszyka";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Cart</title>
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

                    <h3>Twój koszyk</h3>

                    <table class="table table-hover">
                        <!-Tutaj wyświetlam błędy-->
                        <?php printErrors($errors); ?>
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nazwa towaru</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $amount = Product::showAllProductsByOrderIdInTabRow($conn, $myCartId);
                            ?>

                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Łącznie</strong></td>
                                <td><strong><?php echo $amount ?> PLN</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                
                    <form>
                        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#adress"
                                onclick="this.style.visibility= 'hidden';"
                                >  Złóż zamówienie na postawie koszyka  </button>
                    </form>

                    <div id="adress" class="col-sm-8 text-left collapse">

                        <h4>Sprawdź dane do wysyłki i wybierz formę płatności:</h4>
                        <form method="POST">
                            <div class="form-group">
                                <label for="street">Ulica:</label>
                                <input type="text" class="form-control" id="street" value="<?php echo $loggedUser->getAdressStreet() ?>">
                            </div>
                            <div class="form-group">
                                <label for="no">Nr domu / lokalu:</label>
                                <input type="text" class="form-control" id="no" value="<?php echo $loggedUser->getAdressLocalNo() ?>">
                            </div>
                            <div class="form-group">
                                <label for="postcode">Kod pocztowy:</label>
                                <input type="text" class="form-control" id="postcode" value="<?php echo $loggedUser->getPostalCode() ?>">
                            </div>
                            <div class="form-group">
                                <label for="city">Miejscowość:</label>
                                <input type="text" class="form-control" id="city" value="<?php echo $loggedUser->getAdressCity() ?>">
                            </div>
                            <div class="form-group">
                                <label for="payment">Płatność</label>
                                <select class="form-control"id="payment" >
                                    <option value="0">Wybierz metodę płatności</option>
                                    <option value="1">Gotówka pzy odbiorze</option>
                                    <option value="2">Przelew</option>
                                    <option value="3">Payu</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-lg btn-danger">Potwierdź zamówienie</button>   
                        </form>
                        <hr>
                    </div>


                </div>
            </div>
        </div>
            <!—--------------Stopka------------------->
            <?php //require_once __DIR__ . '/footer.php' ?>

    </body>
</html>



