<?php
/*
 * lista użytkownikow z mozliwoscia wyslania wiadomosci
 * 
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Products</title>
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
                    <h3>Lista użytkowników</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>E-mail</th>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>Ulica</th>
                                <th>Nr</th>
                                <th>Kod pocztowy</th>
                                <th>Miejscowość</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>michal@bor.pl</td>
                                <td>Michał</td>
                                <td>Borowiecki</td>
                                <td>Mazowiecka</td>
                                <td>5</td>
                                <td>00-090</td>
                                <td>Warszawa</td>
                                <td><button type="button" class="btn btn-info" onclick="location.href = 'showUser.php';">Pokaż</button></td>
                                <td><button type="button" class="btn btn-warning" onclick="location.href='sendMessage.php';">Wyślij wiadomość</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>karol@killer.pl</td>
                                <td>Karol</td>
                                <td>Szałwiński</td>
                                <td>Polesie</td>
                                <td>789</td>
                                <td>90-090</td>
                                <td>Łowicz</td>
                                <td><button type="button" class="btn btn-info" onclick="location.href = 'showUser.php';">Pokaż</button></td>
                                <td><button type="button" class="btn btn-warning" onclick="location.href='sendMessage.php';">Wyślij wiadomość</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>kami@spo.pl</td>
                                <td>Kamila</td>
                                <td>Fajna</td>
                                <td>Małą</td>
                                <td>98</td>
                                <td>00-090</td>
                                <td>Warszawa</td>
                                <td><button type="button" class="btn btn-info" onclick="location.href = 'showUser.php';">Pokaż</button></td>
                                <td><button type="button" class="btn btn-warning" onclick="location.href='sendMessage.php';">Wyślij wiadomość</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>eliza@wp.pl</td>
                                <td>Eliza</td>
                                <td>Mała</td>
                                <td>Piękna</td>
                                <td>5</td>
                                <td>70-090</td>
                                <td>Poznań</td>
                                <td><button type="button" class="btn btn-info" onclick="location.href = 'showUser.php';">Pokaż</button></td>
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