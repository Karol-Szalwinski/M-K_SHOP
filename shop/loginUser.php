<?php
/*
 * Strona logowania użytkownika - ma się różnić od strony logowania admina
 */
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

                    <h3>Zaloguj się</h3>
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Podaj email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Hasło:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Wprowadź hasło">
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
