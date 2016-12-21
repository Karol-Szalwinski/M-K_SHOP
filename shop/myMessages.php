<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../src/required.php';
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

                <div class="col-sm-10 text-left"> 
                 
                    <h3>Otrzymane wiadomości</h3>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Data</th>
                                <th>Tytuł</th>
                                <th>Treść</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>05 styczen 2017</td>
                                <td>Zamówienie nr 3</td>
                                <td>Paczka została spakowana</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>06 styczen 2017</td>
                                <td>Zamówienie nr 3</td>
                                <td>Paczka została wysłana</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>07 styczen 2017</td>
                                <td>Zamówienie nr 5</td>
                                <td>Zamówienie zostało przyjęte</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>08 styczen 2017</td>
                                <td>Zamówienie nr 5</td>
                                <td>Wpłyneła należność</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>



