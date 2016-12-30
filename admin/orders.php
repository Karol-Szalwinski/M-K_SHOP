<?php
/*
 * lista zamowien z mozliwoscia wiadomosci
 * 
 */
require_once __DIR__ . '/../src/required.php';

//Ustalam aktywną zakładkę w menu
$_SESSION['active-button-admin-menu'] = 4;

//jeśli admin jest zalogowany to przekierowuję na główną
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
$errors = [];


?>
<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Orders</title>
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
                    <br>
                    <hr>
                    <h3>Lista zamówień</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nr Zamówienia</th>
                                <th>Data</th>
                                <th>Id zamawiającego</th>
                                <th>Wartosc</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Wyświetlam wszystkie zamówienia
                            $no = 0;
                            $allOrders = Order::loadAllOrders($conn);
                            foreach ($allOrders as $order) {

                                $no++;
                                $order->showOrderInAdminTabRow($conn, $no);
                            }
                            ?>>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>