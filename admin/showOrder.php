<?php
/*
 * Strona zamówienia 
 * Ta strona ma pokazywać wszystkie informacje natemat zamówienia.
 * 
 * Strona musi przyjąć wszystkie informacje dotyczące zamówienia:
 * przedmioty i ich liczba, 
 * dane użytkownika (w tym adres do wysyłki),
 * całkowita kwota zamówienia,
 * informacje dotyczące płatności.
 */
require_once __DIR__ . '/../src/required.php';

//jeśli admin nie jest zalogowany to przekierowuję do logowania
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$errors = [];
// Jeżeli dostaliśmy poprawny orderId w adresie

if (isset($_GET['orderId']) && is_numeric($_GET['orderId'])) {
    $orderId = intval($_GET['orderId']);

    //Jeżeli zamówienie o tym orderId jest w bazie
    if ($order = Order::loadOrderById($conn, $orderId)) {
        $orderDate = $order->getCreationDate();
        $orderStatus = $order->getStatus();
        $orderPayment = $order->getPaymentMethod();
        $orderStreet = $order->getAdressStreet();
        $ordersLocalNo = $order->getAdressLocalNo();
        $ordersPostCode = $order->getPostalCode();
        $orderCity = $order->getAdressCity();
        $purchaser = User::loadUserById($conn, $order->getUserId());
        $purchaserName = $purchaser->getName();
        $purchaserSurname = $purchaser->getSurname();
    } else {
        $errors[] = 'Nie ma takiego zamówienia';
    }
} else {
    $errors[] = 'Grrr... coś kombinujesz z adresem url... Nieładnie!';
}
if (!empty($errors)) {
    printErrors($errors);
    die();
}
//sprawdzam czy został przesłanay nowy status
if (isset($_POST['status']) && $_POST['status'] > -1) {
    //zmieniam status
    if ($order->setStatus($_POST['status'])) {
        $errors[] = "Pomyślnie zmieniono status";
    } else {
        $errors[] = "Nie udało się zmienić statusu";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Order</title>
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
                <div class="col-sm-8 text-left"> 

                    <h3>Zamówienie nr <?php echo $orderId ?> z dnia <?php echo $orderDate ?></h3>
                    
                    <div class="col-sm-3 text-left">
                        
                    <form>
                        <label>Status: <?php echo $orderStatus ?></label>
                        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#change"
                                onclick="this.style.visibility = 'hidden';"
                                >Zmień status  </button>
                    </form>
                    </div>
                    <div id="change" class="col-sm-3 text-left collapse">
                        <form method="POST">
                        <select class="form-control"id="status" >
                            <option value="-1">Wybierz status</option>
                            <option value="0">niezłożone</option>
                            <option value="1">złożone</option>
                            <option value="2">opłacone</option>
                            <option value="3">zrealizowane</option>
                        </select>
                        <button type="submit" class="btn btn-info">Zmień</button> 
                        </form>
                    </div>
                    <!-Tutaj wyświetlam błędy-->
                    <?php printErrors($errors); ?>
                    <table class="table table-hover">
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
                            <tr>
                                <?php
                                $amount = Product::showAllProductsByOrderIdInTabRow($conn, $orderId);
                                ?>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Łącznie</strong></td>
                                <td><strong><?php echo $amount ?> PLN</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-sm-8 text-left"> 
                        <h4>Dane zamawiającego</h4>
                        <p><?php echo $purchaserName . " " . $purchaserSurname ?></p>
                        <p><?php echo  $orderStreet ." " . $ordersLocalNo ?></p>
                        <p><?php echo  $ordersPostCode ." " . $orderCity ?></p>
                        <hr>
                        <h4>Płatność</h4>
                        <p><?php echo $orderPayment ?></p>
                    </div>
                </div>
            </div>

        </div>


    </body>
</html>



