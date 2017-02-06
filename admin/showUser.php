
<?php
/*
 * Panel użytkownika
 * Strona ta ma mieć informacje o użytkowniku, pokazywać wszystkie poprzednie zakupy tego użytkownika.
 */
require_once __DIR__ . '/../src/required.php';

//jeśli admin nie jest zalogowany to przekierowuję do logowania
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$errors = [];
// Jeżeli dostaliśmy poprawny userId w adresie

if (isset($_GET['userId']) && is_numeric($_GET['userId'])) {
    $userId = intval($_GET['userId']);

    //Jeżeli użytkownik o tym userId jest w bazie
    if ($loadedUser = User::loadUserById($conn, $userId)) {
        
        $userName = $loadedUser->getName();
        $userSurname = $loadedUser->getSurname();
        $userEmail = $loadedUser->getEmail();
        $userStreet = $loadedUser->getAdressStreet();
        $userNo = $loadedUser->getAdressLocalNo();
        $userPostcode = $loadedUser->getPostalCode();
        $userCity = $loadedUser->getAdressCity();
        
    } else {
        $errors[] = 'Nie ma takiego użytkownika';
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
        <title>M&K Shop - Admin Panel - User Account</title>
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
                <div class="col-sm-12 text-left"> 
                    <h3><?php echo $userName . " " . $userSurname ?> - Profil użytkownika</h3>
                    <hr>
                    <p>Id: <?php echo $userId ?></p>
                    <p>E-mail: <?php echo $userEmail ?></p>
                    <h4>Adres:</h4>
                    <p><?php echo $userStreet . " " . $userNo ?></p>
                    <p><?php echo $userPostcode . " " . $userCity ?></p>
                    <hr>
                    <h3>Zamówienia użytkownika</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nr Zamówienia</th>
                                <th>Data</th>
                                <th>Wartosc</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            //Wyświetlam wszystkie zamówienia użytkownika
                            $no = 0;
                            $amount = 0;
                            $allUserOrders = Order::loadAllOrdersByUserId($conn, $userId);
                            if (!empty($allUserOrders)) {
                                foreach ($allUserOrders as $order) {
                                    $amount += $order->getAmount();
                                    $no++;
                                    $order->showOrderInAdminTabRow($conn, $no);
                                }
                            } else {
                                echo "<h4>Użytkownik nie ma żadnych zamówień</h4>";
                                die();
                            }
                            ?>

                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Łączna kwota zamówień</strong></td>
                                <td><strong><?php echo showPrice($amount) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



