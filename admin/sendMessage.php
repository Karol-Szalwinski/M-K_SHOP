<?php
/*
 * strona wysłania wiadomości do użytkownika
 * 
 */


require_once __DIR__ . '/../src/required.php';

//jeśli admin nie jest zalogowany to przekierowuję do logowania
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$adminId = isLoggedAdmin($conn)->getId();
$errors = [];

// Jeżeli dostaliśmy poprawny orderId w adresie
if (isset($_GET['orderId']) && is_numeric($_GET['orderId'])) {
    $orderId = intval($_GET['orderId']);

    //Jeżeli zamówienie o tym orderId jest w bazie
    if ($order = Order::loadOrderById($conn, $orderId)) {

        $purchaser = User::loadUserById($conn, $order->getUserId());
        $purchaserName = $purchaser->getName();
        $purchaserSurname = $purchaser->getSurname();
        $purchaserId = $purchaser->getId();
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

//sprawdzam czy została przesłana wiadomość
if (isset($_POST['title']) && strlen($_POST['title']) > 0 &&
        isset($_POST['message']) && strlen($_POST['message']) > 0) {
    //zmieniam status
    $title = trim($_POST['title']);
    $messageText = trim($_POST['message']);
    $message = new Message();
    $message->setReceiverId($purchaserId)->setSenderId($adminId)->setTitle($title)
            ->setTextMessage($messageText)->saveToDB($conn);
    $errors[] = "Pomyślnie wysłano wiadomość";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Send Message</title>
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
                <br><br>
                <div class="col-sm-3 text-left">

                </div>
                <div class="col-sm-6 text-left panel panel-default panel-body"> 
                    <!-Tutaj wyświetlam błędy-->
                    <?php printErrors($errors); ?>
                    <h3>Wyślij wiadomość do <?php echo $purchaserName . " " . $purchaserSurname ?></h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" class="form-control" id="title" name="title" value="Zamówienie nr <?php echo $orderId ?>">
                        </div>
                        <div class="form-group">
                            <label for="message">Wiadomość:</label>
                            <textarea type="text" class="form-control" id="message" rows="7"
                                      name="message" autofocus></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Wyślij wiadomość</button>
                        <hr>
                    </form>

                </div>
            </div>
        </div>

    </body>
</html>