<?php

/* 
 * lista zamowien z mozliwoscia wiadomosci
 * 
 */
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
                            <tr>
                                <td>1</td>
                                <td>Zamówienie nr 1</td>
                                <td>01 grudzień 2018</td>
                                <td>1050</td>
                                <td>1590.50</td>
                                <td>Opłacone</td>
                                <td><button type="button" class="btn btn-info" onclick="location.href = 'showOrder.php';">Pokaż</button></td>
                                <td><button type="button" class="btn btn-warning" onclick="location.href='sendMessage.php';">Wyślij wiadomość</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Zamówienie nr 2</td>
                                <td>03 grudzień 2018</td>
                                <td>1051</td>
                                <td>155.50</td>
                                <td>Zrealizowane</td>
                                <td><button type="button" class="btn btn-info" onclick="location.href = 'showOrder.php';">Pokaż</button></td>
                                <td><button type="button" class="btn btn-warning" onclick="location.href='sendMessage.php';">Wyślij wiadomość</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>