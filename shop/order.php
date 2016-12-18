<?php
/*
 * Strona zamówienia 
 * Ta strona ma pokazywać wszystkie informacje natemat zamówienia.
 * Użytkownik może widzieć tylko swoje zamówienia.
 * 
 * Strona musi przyjąć wszystkie informacje dotyczące zamówienia:
 * przedmioty i ich liczba, 
 * dane użytkownika (w tym adres do wysyłki),
 * całkowita kwota zamówienia,
 * informacje dotyczące płatności.
 */
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

                <div class="col-sm-8 text-left"> 

                    <h3>Zamówienie nr 1 z dnia 15.12.2016</h3>
                    <h4>Status: Opłacone</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nazwa towaru</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Procesor I3-4160</td>
                                <td>5</td>
                                <td>590.50</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Procesor I5-4460</td>
                                <td>5</td>
                                <td>750.99</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Dysk Toshiba 4 Tb SSD</td>
                                <td>2</td>
                                <td>1055.50</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Karta graficzna GTX 1050</td>
                                <td>3</td>
                                <td>789.00</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Łącznie</strong></td>
                                <td><strong>2789.00</strong></td>
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
                        <p>Przelew bankowy</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!—--------------Stopka------------------->
<?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>



