<?php
/*
 * Strona rejestracji nowego admina
 */
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
            <div class="col-sm-4 text-left"> 

                <h3>Zarejestruj nowego administratora</h3>
                <form>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Podaj email">
                    </div>
                    <div class="form-group">
                        <label for="password1">Hasło:</label>
                        <input type="password" class="form-control" id="password1" placeholder="Wprowadź hasło">
                    </div>
                    <div class="form-group">
                        <label for="password2">Powtórz hasło:</label>
                        <input type="password" class="form-control" id="password2" placeholder="Wprowadź hasło ponownie">
                    </div>

                    <button type="submit" class="btn btn-info">Zarejestruj administratora</button>
                    <hr>
                </form>

            </div>

        </div>

    </body>
</html>

