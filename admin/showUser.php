
<?php
/*
 * Panel użytkownika
 * Strona ta ma mieć informacje o użytkowniku, pokazywać wszystkie poprzednie zakupy tego użytkownika.
 
 */
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

                <div class="col-sm-8 text-left"> 

                    <h3>Jan Kowalski - Profil użytkownika</h3>
                    <hr>
                    <p>Id: 102</p>
                    <p>E-mail: kowalski@wal.pl</p>
                    <h4>Adress</h4>
                    <p>Kwiatowa 10</p>
                    <p>99-458 Krakow</p>
                    <hr>
                    <h4>Zamówienia użytkownika</h4>
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
                            <tr>
                                <td>1</td>
                                <td>Zamówienie nr 1</td>
                                <td>01 grudzień 2018</td>
                                <td>1590.50</td>
                                <td>Opłacone</td>
                                <td><button type="button" class="btn btn-danger" onclick="location.href = 'showOrder.php';">Pokaż</button></td>
                            </tr>

                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Łączna kwota zamówień</strong></td>
                                <td><strong>2789.00</strong></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</body>
</html>



