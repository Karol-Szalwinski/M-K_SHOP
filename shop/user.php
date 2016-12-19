<?php
/*
 * Panel użytkownika
 * Strona ta ma mieć informacje o użytkowniku, dawać opcje zmiany tych 
 * informacji, pokazywać wszystkie poprzednie zakupy tego użytkownika.
 * Użytkownik może zobaczyć tylko swój panel.
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - My account</title>
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

                    <h3>Jan Kowalski - Mój profil</h3>
                    <hr>
                    <h4>Moje dane</h4>
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" value="jan@kowalski.pl">
                        </div>
                        <div class="form-group">
                            <label for="name">Imię:</label>
                            <input type="text" class="form-control" id="name" value="Jan">
                        </div>
                        <div class="form-group">
                            <label for="surname">Nazwisko:</label>
                            <input type="text" class="form-control" id="surname" value="Kowalski">
                        </div>
                        <button type="submit" class="btn btn-info">Popraw dane</button>
                    </form>
                    <hr>
                    <h4>Zmień hasło</h4>
                    <form>      
                        <div class="form-group">
                            <label for="password1">Hasło:</label>
                            <input type="password" class="form-control" id="password1" placeholder="Wprowadź nowe hasło">
                        </div>
                        <div class="form-group">
                            <label for="password2">Powtórz hasło:</label>
                            <input type="password" class="form-control" id="password2" placeholder="Wprowadź nowe hasło ponownie">
                        </div>
                        <div class="form-group">
                            <label for="password1">Hasło:</label>
                            <input type="password" class="form-control" id="password1" placeholder="Wprowadź stare hasło">
                        </div>

                        <button type="submit" class="btn btn-info">Zmień hasło</button>
                    </form>
                    <hr>

                    <h4>Moje dotychczasowe zamówienia</h4>
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
                                <td><button type="button" class="btn btn-danger" onclick="location.href='order.php';">Pokaż</button></td>

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

    <!—--------------Stopka------------------->
<?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>



