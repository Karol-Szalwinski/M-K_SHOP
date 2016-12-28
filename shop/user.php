<?php
/*
 * Panel użytkownika
 * Strona ta ma mieć informacje o użytkowniku, dawać opcje zmiany tych 
 * informacji, pokazywać wszystkie poprzednie zakupy tego użytkownika.
 * Użytkownik może zobaczyć tylko swój panel.
 */
require_once __DIR__ . '/../src/required.php';
//Ustalamy id i name zalogowanego usera
if ($loggedUser = isLoggedUser($conn)) {
    $loggedUserName = $loggedUser->getName();
    $loggedUserId = $loggedUser->getId();
    $loggedUserSurname = $loggedUser->getSurname();
    $loggedUserEmail = $loggedUser->getEmail();
    $loggedUserStreet = $loggedUser->getAdressStreet();
    $loggedUserNo = $loggedUser->getAdressLocalNo();
    $loggedUserPostcode = $loggedUser->getPostalCode();
    $loggedUserCity = $loggedUser->getAdressCity();
} else {
    header("location: index.php");
}
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

                <div class="col-sm-7 text-left"> 

                    <h3><?php echo $loggedUserName . " " . $loggedUserSurname ?>  - Mój profil</h3>
                    <hr>
                    <!-- Zakładki -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a href="#1kartajust" role="tab" data-toggle="tab"><h4>Moje zamówienia</h4></a></li>
                        <li><a href="#2kartajust" role="tab" data-toggle="tab"><h4>Moje dane</h4></a></li>
                    </ul>
                    <!-- Zawartość zakładek -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="1kartajust">
                            <div class="col-sm-12 text-left">
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
                                        <?php
                                        //Wyświetlam wszystkie zamówienia użytkownika
                                        $no = 0;
                                        $allUserOrders = Order::loadAllOrdersByUserId($conn, $loggedUserId);
                                        if (!empty($allUserOrders)) {
                                            foreach ($allUserOrders as $order) {

                                                $no++;
                                                $order->showOrderInUserTabRow($conn, $no);
                                            }
                                        } else {
                                            echo "<h4>Użytkownik nie ma żadnych zamówień</h4>";
                                            die();
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td><strong>Łączna kwota zamówień</strong></td>
                                            <td><strong>2789.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="tab-pane" id="2kartajust">
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
                            <h4>Mój adres</h4>
                            <form>
                                <div class="form-group">
                                    <label for="street">Ulica:</label>
                                    <input type="text" class="form-control" id="street" value="Ogrodowa">
                                </div>
                                <div class="form-group">
                                    <label for="no">Nr domu / lokalu:</label>
                                    <input type="text" class="form-control" id="no" value="998c">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Kod pocztowy:</label>
                                    <input type="text" class="form-control" id="postcode" value="96-987">
                                </div>
                                <div class="form-group">
                                    <label for="city">Miejscowość:</label>
                                    <input type="text" class="form-control" id="city" value="Zadupie głębokie">
                                </div>
                                <button type="submit" class="btn btn-info">Popraw dane adresowe</button>   
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
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>



