<?php
/*
 * Strona logowania admina - ma się różnić od strony logowania usera
 */
require_once __DIR__ . '/../src/required.php';

//jeśli user jest zalogowany to przekierowuję na główną
if (isset($_SESSION['loggedAdmin'])) {
    header("Location: index.php");
}
$errors = [];

//sprawdzam czy został przesłany e-mail i hasło
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //logowanie przesłanym mailem i hasłem
        if ($userId = Admin::loginAdmin($conn, $email, $password)) {
            $_SESSION['loggedAdmin'] = $userId;
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
        <title>M&K Shop - Admin Panel - Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
    </head>
    <body>
        <div class="container-fluid text-center ">
            <div class="row content">
                <br><br>
                <div class="col-sm-4 text-left">
                </div>
                <div class="col-sm-4 text-left panel panel-default panel-body">
                    <!-Tutaj wyświetlam błędy-->
                    <?php printErrors($errors); ?>
                    <h3>Zaloguj się jako administrator</h3>
                    <form action=# method="POST">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj email">
                        </div>
                        <div class="form-group">
                            <label for="password">Hasło:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Wprowadź hasło">
                        </div>

                        <button type="submit" class="btn btn-danger">Zaloguj</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>