<?php
/*
 * Panel użytkownika
 * Strona ta ma mieć informacje o użytkowniku, dawać opcje zmiany tych 
 * informacji, pokazywać wszystkie poprzednie zakupy tego użytkownika.
 * Użytkownik może zobaczyć tylko swój panel.
 */
require_once __DIR__ . '/../src/required.php';

//Ustalamy aktywną zakładkę
$_SESSION['active-button'] = 1;

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
    $errors1 = $errors2 = $errors3 = [];
} else {
    header("location: index.php");
}

//sprawdzam co user wpisał w formularzu pierwszym z danymi 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {

    //sprawdzam przesłany e-mail, jego długość po usunięciu białych znaków
    if (isset($_POST['email']) && strlen(trim($_POST['email'])) > 5) {
        $userEmail = trim($_POST['email']);
        //sprawdzam czy mail jest już w bazie wbudowaną funkcją
        if (!User::emailIsAvailable($conn, $userEmail) && $userEmail != $loggedUserEmail) {
            $errors[] = " Podany email " . $userEmail . " jest już zajęty.";
        }
    } else {
        $errors1[] = 'Podałeś nieprawidłowy e-mail';
    }

    //sprawdzam przesłane imię i trimuję
    if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 0) {
        $userName = trim($_POST['name']);
    } else {
        $errors1[] = 'Podałeś nieprawidłowe imię użytkownika';
    }

    //sprawdzam przesłane nazwisko i trimuję
    if (isset($_POST['surname']) && strlen(trim($_POST['surname'])) > 0) {
        $userSurname = trim($_POST['surname']);
    } else {
        $errors1[] = 'Podałeś nieprawidłowe nazwisko użytkownika';
    }

    //Jeżeli nie ma błędów to zapisuję do bazy i generuję komunikat
    if (empty($errors1)) {
        $errors1[] = "Dane osobowe zostały pomyślnie zmienione";
        $loggedUser->setEmail($userEmail)->setName($userName)->setSurname($userSurname)->saveToDB($conn);
        //uaktualniam też zmienne wyświetlane
        $loggedUserName = $loggedUser->getName();
        $loggedUserSurname = $loggedUser->getSurname();
        $loggedUserEmail = $loggedUser->getEmail();
    }
}

//sprawdzam co user wpisał w formularzu drugim z adresem
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['street'])) {

    //sprawdzam przesłaną ulicę trimuję
    if (isset($_POST['street']) && strlen(trim($_POST['street'])) > 1) {
        $userStreet = trim($_POST['street']);
    } else {
        $errors2[] = 'Podana nazwa ulicy jest za krótka - nie ma nawet dwóch znaków';
    }

    //sprawdzam przesłany numer domu/mieszkania
    if (isset($_POST['no']) && strlen(trim($_POST['no'])) > 1) {
        $userLocalNo = trim($_POST['no']);
    } else {
        $errors2[] = 'Podana numer jest za krótki';
    }

    //sprawdzam przesłany kod pocztowy i trimuję
    if (isset($_POST['postcode']) && strlen(trim($_POST['postcode'])) > 1) {
        $userPostcode = trim($_POST['postcode']);
    } else {
        $errors2[] = 'Podana kod pocztowy jest za krótki';
    }

    //sprawdzam przesłane miasto/miejscowość
    if (isset($_POST['city']) && strlen(trim($_POST['city'])) > 1) {
        $userCity = trim($_POST['city']);
    } else {
        $errors2[] = 'Podana nazwa miasta jest za krótka';
    }


    //Jeżeli nie ma błędów to zapisuję do bazy i generuję komunikat
    if (empty($errors2)) {
        $errors2[] = "Dane adresowe zostały pomyślnie zmienione";
        $loggedUser->setAdressStreet($userStreet)->setAdressLocalNo($userLocalNo)
                ->setPostalCode($userPostcode)->setAdresscity($userCity)->saveToDB($conn);
        //uaktualniam też zmienne wyświetlane
        $loggedUserStreet = $loggedUser->getAdressStreet();
        $loggedUserNo = $loggedUser->getAdressLocalNo();
        $loggedUserPostcode = $loggedUser->getPostalCode();
        $loggedUserCity = $loggedUser->getAdressCity();
    }
}

//Sprawdzam co user podał w trzecim formularzu z hasłem
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password1'])) {

    //sprawdzam hasło, jego długość, obcinam białe znaki
    if (isset($_POST['password1']) && strlen(trim($_POST['password1'])) >= 5) {
        $userPassword = trim($_POST['password1']);

        //sprawdzam czy hasło zgadza się w obydwu polach
        if (isset($_POST['password2']) && trim($_POST['password2']) == $userPassword) {
            $userConfirmPassword = trim($_POST['password2']);
        } else {
            $errors3[] = 'Podane hasła nie zgadzają się';
        }
    } else {
        $errors3[] = 'Podane hasło musi mieć co najmniej 5 znaków';
    }

    //Sprawdzam poprawność starego hasła
    if (!isset($_POST['old-password']) ||
            !User::loginUser($conn, $loggedUserEmail, $_POST['old-password'])) {
        $errors3[] = 'Podałeś złe hasło potwierdzające';
    }

    //Jeżeli wszystkie powyższe dane zwalidowały się poprawnie poprawiamy je w bazie
    if (empty($errors3)) {
        $errors3[] = 'Hasło zostało pomyślnie zmienione';
        $loggedUser->setPassword($userPassword)->saveToDB($conn);
    }
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

                <div class="col-sm-10 text-left"> 

                    <h3><?php echo $loggedUserName . " " . $loggedUserSurname ?>  - Mój profil</h3>
                    <hr>
                    <!-- Zakładki -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li><a href="#1kartajust" role="tab" data-toggle="tab"><h4>Moje zamówienia</h4></a></li>
                        <li class="active"><a href="#2kartajust" role="tab" data-toggle="tab"><h4>Moje dane</h4></a></li>
                    </ul>
                    <!-- Zawartość zakładek -->
                    <div class="tab-content">
                        <div class="tab-pane" id="1kartajust">
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
                                        $amount = 0;
                                        $allUserOrders = Order::loadAllOrdersByUserId($conn, $loggedUserId);
                                        if (!empty($allUserOrders)) {

                                            foreach ($allUserOrders as $order) {
                                                $amount += $order->getAmount();
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
                                            <td><strong><?php echo $amount ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="tab-pane active" id="2kartajust">
                            <h4>Moje dane osobowe</h4>
                            <!-Tutaj wyświetlam błędy związane z tym formularzem-->
                            <?php printErrors($errors1); ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $loggedUserEmail ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Imię:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $loggedUserName ?>">
                                </div>
                                <div class="form-group">
                                    <label for="surname">Nazwisko:</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $loggedUserSurname ?>">
                                </div>
                                <button type="submit" class="btn btn-info">Popraw dane</button>
                            </form>
                            <hr>
                            <h4>Mój adres</h4>
                            <!-Tutaj wyświetlam błędy związane z tym formularzem-->
                            <?php printErrors($errors2); ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="street">Ulica:</label>
                                    <input type="text" class="form-control" id="street" name="street" value="<?php echo $loggedUserStreet ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no">Nr domu / lokalu:</label>
                                    <input type="text" class="form-control" id="no" name="no" value="<?php echo $loggedUserNo ?>">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Kod pocztowy:</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $loggedUserPostcode ?>">
                                </div>
                                <div class="form-group">
                                    <label for="city">Miejscowość:</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $loggedUserCity ?>">
                                </div>
                                <button type="submit" class="btn btn-info">Popraw dane adresowe</button>   
                            </form>
                            <hr>
                            <h4>Zmień hasło</h4>
                            <!-Tutaj wyświetlam błędy związane z tym formularzem-->
                            <?php printErrors($errors3); ?>
                            <form method="POST">      
                                <div class="form-group">
                                    <label for="password1">Hasło:</label>
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Wprowadź nowe hasło">
                                </div>
                                <div class="form-group">
                                    <label for="password2">Powtórz hasło:</label>
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Wprowadź nowe hasło ponownie">
                                </div>
                                <div class="form-group">
                                    <label for="old-password">Hasło:</label>
                                    <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Wprowadź stare hasło">
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



