<?php

/* 
 * Strona rejestracji
 * Strona do rejestracji użytkownika. Ma pobierać wszystkie informacje o
 * użytkowniku.
 */
?>



<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop Register</title>
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

                    <h3>Załóż konto</h3>
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" placeholder="Podaj email">
                        </div>
                        <div class="form-group">
                            <label for="name">Imię:</label>
                            <input type="text" class="form-control" id="name" placeholder="Podaj imię">
                        </div>
                        <div class="form-group">
                            <label for="surname">Nazwisko:</label>
                            <input type="email" class="form-control" id="surname" placeholder="Podaj nazwisko">
                        </div>
                        <div class="form-group">
                            <label for="password1">Hasło:</label>
                            <input type="password" class="form-control" id="password1" placeholder="Wprowadź hasło">
                        </div>
                        <div class="form-group">
                            <label for="password2">Powtórz hasło:</label>
                            <input type="password" class="form-control" id="password2" placeholder="Wprowadź hasło ponownie">
                        </div>

                        <button type="submit" class="btn btn-info">Zarejestruj</button>
                    </form>

                </div>
            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>
