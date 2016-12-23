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
                    <h4>Status: <?php echo $orderStatus ?></h4>
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
                        <p>Jan Kowalski</p>
                        <p>Ogrodowa 5</p>
                        <p>99-999 Warszawa</p>
                        <hr>
                        <h4>Płatność</h4>
                        <p><?php echo $orderPayment ?></p>
                    </div>
                </div>
            </div>

        </div>


    </body>
</html>



