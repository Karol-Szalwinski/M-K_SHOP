<?php
/*
 * Strona logowania użytkownika - ma się różnić od strony logowania admina
 */
require_once __DIR__ . '/../src/required.php';

//jeśli user jest zalogowany to przekierowuję na główną
if (isset($_SESSION['loggedUser'])) {
    header("Location: index.php");
}
$errors = [];

//sprawdzam czy został przesłany e-mail i hasło
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //logowanie przesłanym mailem i hasłem
        if ($userId = User::loginUser($conn, $email, $password)) {
            $_SESSION['loggedUser'] = $userId;
            header("Location: index.php");
        } else {
            $errors[] = 'Niepoprawne dane logowania';
        }
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop Login</title>
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

                <div class="col-sm-5 text-left"> 
                    <!-Tutaj wyświetlam błędy-->
                    <?php printErrors($errors); ?>
                    <h3>Zaloguj się</h3>
                    <form  action=# method="POST">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj email">
                        </div>
                        <div class="form-group">
                            <label for="password">Hasło:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Wprowadź hasło">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> Pamiętaj mnie</label>
                        </div>
                        <button type="submit" class="btn btn-info">Zaloguj</button>
                    </form>

                </div>
            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>
