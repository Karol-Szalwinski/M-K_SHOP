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
//Ustalamy aktywną zakładkę
$_SESSION['active-button'] = 2;

$errors = [];
//Ustalamy id i name zalogowanego usera
if ($loggedUser = isLoggedUser($conn)) {
    $loggedUserName = $loggedUser->getName();
    $loggedUserId = intval($loggedUser->getId());
    $myCart = Order::getCartByUser($conn, $loggedUserId);
    $myCartId = $myCart->getId();
    //Jeżeli ktoś usuwa produkt z koszyka
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-id'])) {
        if ($_POST['delete-id'] > 0) {
            if (Product::deleteProductFromCart($conn, $_POST['delete-id'])) {
                $errors[] = "Pomyślnie usunięto produkt z koszyka";
            }
        } else {
            $errors[] = "Nie udało się usuwanie produktu z koszyka";
        }
    }
    //Jeżeli ktoś zmienia ilość w koszyku
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-id'])) {
        echo "Teraz mogę zmienić ilość " . $_POST['change-id'];
        Product::changeQuantityProductInCart($conn, $_POST['change-id'], $_POST['quantity']);
        $errors[] = "Pomyślnie zmieniono ilość produktów w koszyku";
    }

    //Jeżeli ktoś zatwierdza koszyk
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['street'])) {
        //sprawdzam przesłaną ulicę i trimuję
        if (isset($_POST['street']) && strlen(trim($_POST['street'])) > 0) {
            $userStreet = substr(trim($_POST['street']), 0, 20);
        } else {
            $errors[] = 'Podałeś nieprawidłową ulicę';
        }
        //sprawdzam przesłany numer domu/lokalu i trimuję
        if (isset($_POST['user-local-no']) && strlen(trim($_POST['user-local-no'])) > 0) {
            $userLocalNo = trim($_POST['user-local-no']);
        } else {
            $errors[] = 'Podałeś nieprawidłowy numer domu/lokalu';
        }
        //sprawdzam przesłany kod pocztowy i trimuję
        if (isset($_POST['postcode']) && strlen(trim($_POST['postcode'])) > 0) {
            $userPostcode = substr(trim($_POST['postcode']), 0, 6);
        } else {
            $errors[] = 'Podałeś nieprawidłowy kod pocztowy';
        }
        //sprawdzam przesłaną miejscowość i trimuję
        if (isset($_POST['city']) && strlen(trim($_POST['city'])) > 0) {
            $userCity = substr(trim($_POST['city']), 0, 30);
        } else {
            $errors[] = 'Podałeś nieprawidłowy miasto';
        }
        //sprawdzam czy wybrał płatność
        if (isset($_POST['payment']) && $_POST['payment'] > 0) {
            $paymentMethod = $_POST['payment'];
        } else {
            $errors[] = 'Nie wybrałeś płatności';
        }
        //sprawdzam czy jest coś w koszyku
        if ($myCart->countProductsInCart($conn) == 0) {
            $errors[] = 'Nie można zrobić zamówienia z pustego koszyka';
        }

        //Jeżeli wszystkie powyższe dane zwalidowały się poprawnie tworzymy zamówienie
        if (empty($errors)) {
            $myCart->setAdressStreet($userStreet)->setAdressLocalNo($userLocalNo)
                    ->setPostalCode($userPostcode)->setAdresscity($userCity)
                    ->setPaymentMethod($paymentMethod)->setStatus(1);
            if ($myCart->saveToDB($conn)) {
                //Tworzymy też pusty koszyk
                $newCart = new Order();
                $newCart->setUserId($loggedUserId)
                        ->setStatus(0)
                        ->setPaymentMethod(0)
                        ->setAmount(0.00)->saveToDB($conn);

                //Przekierowywujemy na stronę zamówienia
                header("Location: order.php?orderId=$myCartId");
            } else {
                echo "Błąd zapisu koszyka do bazy";
            }
        }
    }
} else {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Cart</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
        <script>
            $(document).ready(function () {
                $(".default").click(function () {
                    $(".edit").show();
                    $(".default").hide();
                });
            });
        </script>
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
                                <th>Wartość</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $amount = Product::showAllProductsByCartIdInTabRow($conn, $myCartId);
                            ?>

                            <tr>
                                <td colspan="3"></td>
                                <td><strong>Łącznie</strong></td>
                                <td><strong><?php echo showPrice($amount) ?></strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <form>
                        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#adress"
                                onclick="this.style.visibility = 'hidden';"
                                >  Złóż zamówienie na postawie koszyka  </button>
                    </form>

                    <div id="adress" class="col-sm-8 text-left collapse">

                        <h4>Sprawdź dane do wysyłki i wybierz formę płatności:</h4>
                        <form method="POST">
                            <div class="form-group">
                                <label for="street">Ulica:</label>
                                <input type="text" class="form-control" id="street" name="street" value="<?php echo $loggedUser->getAdressStreet() ?>">
                            </div>
                            <div class="form-group">
                                <label for="user-local-no">Nr domu / lokalu:</label>
                                <input type="text" class="form-control" id="user-local-no" name="user-local-no" value="<?php echo $loggedUser->getAdressLocalNo() ?>">
                            </div>
                            <div class="form-group">
                                <label for="postcode">Kod pocztowy:</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $loggedUser->getPostalCode() ?>">
                            </div>
                            <div class="form-group">
                                <label for="city">Miejscowość:</label>
                                <input type="text" class="form-control" id="city" name="city" value="<?php echo $loggedUser->getAdressCity() ?>">
                            </div>
                            <div class="form-group">
                                <label for="payment">Płatność</label>
                                <select class="form-control" id="payment" name="payment" >
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
        <?php //require_once __DIR__ . '/footer.php'   ?>

    </body>
</html>


