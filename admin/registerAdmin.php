<?php
/*
 * Strona rejestracji nowego admina
 */
require_once __DIR__ . '/../src/required.php';

//Ustalam aktywną zakładkę w menu
$_SESSION['active-button-admin-menu'] = 5;

//Ustalamy id i name zalogowanego admina
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}

$errors = [];

//sprawdzam co user wpisał w formularz
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //sprawdzam przesłany e-mail, jego długość po usunięciu białych znaków
    if (isset($_POST['email']) && strlen(trim($_POST['email'])) > 5) {
        $adminEmail = trim($_POST['email']);

        //sprawdzam czy mail jest już w bazie wbudowaną funkcją
        if (!Admin::emailIsAvailable($conn, $adminEmail)) {
            $errors[] = " Podany email " . $adminEmail . " jest już zajęty.";
        }
    } else {
        $errors[] = 'Podałeś nieprawidłowy e-mail';
    }
    //sprawdzam przesłane imię i trimuję
    if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 0) {
        $adminName = substr(trim($_POST['name']), 0, 20);
    } else {
        $errors[] = 'Podałeś nieprawidłowe imię użytkownika';
    }

    //sprawdzam hasło, jego długość, obcinam białe znaki
    if (isset($_POST['user-password']) && strlen(trim($_POST['user-password'])) >= 5) {
        $adminPassword = trim($_POST['user-password']);
        //sprawdzam czy hasło zgadza się w obydwu polach
        if (isset($_POST['user-confirm-password']) &&
                trim($_POST['user-confirm-password']) == $adminPassword) {
            $adminConfirmPassword = trim($_POST['user-confirm-password']);
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
        $newAdmin = new Admin;
        $newAdmin->setEmail($adminEmail)->setName($adminName);
        $newAdmin->setPassword($adminPassword)->saveToDB($conn);
        var_dump($newAdmin);
        //loguję użytkownika i przekiwrowuję
        $_SESSION['loggedAdmin'] = $newAdmin->getId();
        header("Location: index.php");
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Register New Admin</title>
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
            <div class="col-sm-5 text-left"> 
                <!-Tutaj wyświetlam błędy-->
                <?php printErrors($errors); ?>
                <h3>Zarejestruj nowego administratora</h3>
                <form action=# method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Podaj email">
                    </div>
                    <div class="form-group">
                        <label for="name">Imię: </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Podaj email">
                    </div>
                    <div class="form-group">
                        <label for="user-password">Hasło:</label>
                        <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Wprowadź hasło">
                    </div>
                    <div class="form-group">
                        <label for="password2">Powtórz hasło:</label>
                        <input type="password" class="form-control" id="user-confirm-password" name="user-confirm-password" placeholder="Wprowadź hasło ponownie">
                    </div>

                    <button type="submit" class="btn btn-info">Zarejestruj admina</button>
                    <hr>
                </form>
            </div>
        </div>
    </body>
</html>

