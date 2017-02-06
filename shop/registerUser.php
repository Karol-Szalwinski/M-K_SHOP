<?php
/*
 * Strona rejestracji
 * Strona do rejestracji użytkownika. Ma pobierać wszystkie informacje o
 * użytkowniku.
 */
require_once __DIR__ . '/../src/required.php';
//jeśli user jest zalogowany to przekierowuję na główną
if (isset($_SESSION['loggedUser'])) {
    header("Location: index.php");
}
$errors = [];

//sprawdzam co user wpisał w formularz
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //sprawdzam przesłany e-mail, jego długość po usunięciu białych znaków
    if (isset($_POST['user-email']) && strlen(trim($_POST['user-email'])) > 5) {
        $userEmail = trim($_POST['user-email']);

        //sprawdzam czy mail jest już w bazie wbudowaną funkcją
        if (!User::emailIsAvailable($conn, $userEmail)) {
            $errors[] = " Podany email " . $userEmail . " jest już zajęty.";
        }
    } else {
        $errors[] = 'Podałeś nieprawidłowy e-mail';
    }
    //sprawdzam przesłane imię i trimuję
    if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 0) {
        $userName = substr(trim($_POST['name']), 0, 20);
    } else {
        $errors[] = 'Podałeś nieprawidłowe imię użytkownika';
    }
    //sprawdzam przesłane nazwisko i trimuję
    if (isset($_POST['surname']) && strlen(trim($_POST['surname'])) > 0) {
        $userSurname = substr(trim($_POST['surname']), 0, 20);
    } else {
        $errors[] = 'Podałeś nieprawidłowe nazwisko';
    }
    //sprawdzam przesłaną ulicę i trimuję
    if (isset($_POST['street']) && strlen(trim($_POST['street'])) > 0) {
        $userStreet = substr(trim($_POST['street']), 0, 20);
    } else {
        $errors[] = 'Podałeś nieprawidłową ulicę';
    }
    //sprawdzam przesłany numer domu/lokalu i trimuję
    if (isset($_POST['user-local-no']) && strlen(trim($_POST['user-local-no'])) > 0) {
        $userLocalNo = trim($_POST['user-local-no']);
    } else {
        $errors[] = 'Podałeś nieprawidłowy numer domu/lokalu';
    }
    //sprawdzam przesłany kod pocztowy i trimuję
    if (isset($_POST['postcode']) && strlen(trim($_POST['postcode'])) > 0) {
        $userPostcode = substr(trim($_POST['postcode']), 0, 6);
    } else {
        $errors[] = 'Podałeś nieprawidłowy kod pocztowy';
    }
    //sprawdzam przesłaną miejscowość i trimuję
    if (isset($_POST['city']) && strlen(trim($_POST['city'])) > 0) {
        $userCity = substr(trim($_POST['city']), 0, 30);
    } else {
        $errors[] = 'Podałeś nieprawidłowy miasto';
    }

    //sprawdzam hasło, jego długość, obcinam białe znaki
    if (isset($_POST['user-password']) && strlen(trim($_POST['user-password'])) >= 5) {
        $userPassword = trim($_POST['user-password']);
        //sprawdzam czy hasło zgadza się w obydwu polach
        if (isset($_POST['user-confirm-password']) &&
                trim($_POST['user-confirm-password']) == $userPassword) {
            $userConfirmPassword = trim($_POST['user-confirm-password']);
        } else {
            $errors[] = 'Podane hasła nie zgadzają się';
        }
    } else {
        $errors[] = 'Podane hasło musi mieć co najmniej 5 znaków';
    }
    //Jeżeli wszystkie powyższe dane zwalidowały się poprawnie tworzymy nowego
    //usera, logujemy go i przekierowywujemy na główną.
    if (empty($errors)) {
        echo "Dane rejestracji są poprawne<br>";
        
        $newUser = new User;
        $newUser->setEmail($userEmail)->setName($userName)->setSurname($userSurname);
        $newUser->setAdressStreet($userStreet)->setAdressLocalNo($userLocalNo);
        $newUser->setPostalCode($userPostcode)->setAdresscity($userCity);
        $newUser->setPassword($userPassword)->saveToDB($conn);
        
        //tworzę pusty koszyk dla użytkownika
        $newCart = new Order();
        $newUserId = $newUser->getId();
        $newCart->setUserId($newUserId)
                ->setStatus(0)
                ->setPaymentMethod("Cash")
                ->setAmount(0.00)->saveToDB($conn);
        
        //loguję użytkownika i przekiwrowuję
        $_SESSION['loggedUser'] = $newUser->getId();
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop Register</title>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" href = "../css/style.css" type = "text/css" />
    </head>
    <body>
        <!-----------Nagłówek z menu-------------->
        <header>
            <?php require_once __DIR__ . '/header.php'
            ?>
        </header>

        <!—-----------Główna treść --------------->

        <div class="container-fluid text-center">

            <div class="row content">

                <!—-----------Panel z kategoriami --------------->
                <?php require_once __DIR__ . '/sidebar.php' ?>

                <div class="col-sm-5 text-left">
                    <!-Tutaj wyświetlam błędy-->
                    <?php printErrors($errors); ?>

                    <h3>Załóż konto</h3>
                    <form action=# method="POST">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="user-email" name="user-email" placeholder="Podaj email">
                        </div>
                        <div class="form-group">
                            <label for="name">Imię:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Podaj imię">
                        </div>
                        <div class="form-group">
                            <label for="surname">Nazwisko:</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Podaj nazwisko">
                        </div>
                        <div class="form-group">
                            <label for="street">Ulica:</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="Podaj ulicę">
                        </div>
                        <div class="form-group">
                            <label for="user-local-no">Nr domu / lokalu:</label>
                            <input type="text" class="form-control" id="user-local-no" name="user-local-no" placeholder="Podaj nr domu / lokalu">
                        </div>
                        <div class="form-group">
                            <label for="postcode">Kod pocztowy:</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Podaj kod pocztowy">
                        </div>
                        <div class="form-group">
                            <label for="city">Miejscowość:</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Podaj miejscowość">
                        </div>
                        <div class="form-group">
                            <label for="user-password">Hasło:</label>
                            <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Wprowadź hasło">
                        </div>
                        <div class="form-group">
                            <label for="user-confirm-password">Powtórz hasło:</label>
                            <input type="password" class="form-control" id="user-confirm-password" name="user-confirm-password" placeholder="Wprowadź hasło ponownie">
                        </div>

                        <button type="submit" class="btn btn-info">Zarejestruj</button>
                        <hr>
                    </form>

                </div>
            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>




