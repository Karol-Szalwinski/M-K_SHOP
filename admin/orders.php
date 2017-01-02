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
                    <h3>Lista zamówień</h3>
                    <!-- Zakładki -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a href="#1kartajust" role="tab" data-toggle="tab"><h4>Złożone</h4></a></li>
                        <li><a href="#2kartajust" role="tab" data-toggle="tab"><h4>Opłacone</h4></a></li>
                        <li><a href="#3kartajust" role="tab" data-toggle="tab"><h4>Zrealizowane</h4></a></li>
                    </ul>
                    <!-- Zawartość zakładek -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="1kartajust">
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
                                    //Wyświetlam wszystkie zamówienia z tym statusem
                                    $no = 0;
                                    if ($allOrders = Order::loadAllOrdersByStatus($conn, 1)) {
                                        foreach ($allOrders as $order) {

                                            $no++;
                                            $order->showOrderInAdminTabRow($conn, $no);
                                        }
                                    } else printErrors(["Brak zamówień z tym statusem"]);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="2kartajust">
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
                                    //Wyświetlam wszystkie zamówienia z tym statusem
                                    $no = 0;
                                    if ($allOrders = Order::loadAllOrdersByStatus($conn, 2)) {
                                        foreach ($allOrders as $order) {

                                            $no++;
                                            $order->showOrderInAdminTabRow($conn, $no);
                                        }
                                    } else printErrors(["Brak zamówień z tym statusem"]);
                                    ?>
                                </tbody>
                            </table>   
                        </div>
                        <div class="tab-pane" id="3kartajust">
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
                                    //Wyświetlam wszystkie zamówienia z tym statusem
                                    $no = 0;
                                    if ($allOrders = Order::loadAllOrdersByStatus($conn, 3)) {
                                        foreach ($allOrders as $order) {

                                            $no++;
                                            $order->showOrderInAdminTabRow($conn, $no);
                                        }
                                    } else printErrors(["Brak zamówień z tym statusem"]);
                                    ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>