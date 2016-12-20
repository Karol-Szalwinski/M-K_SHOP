<?php
/*
 * Strona logowania admina - ma się różnić od strony logowania usera
 */
require_once __DIR__ . '/../src/required.php';
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
                    <h3>Zaloguj się jako administrator</h3>
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Podaj email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Hasło:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Wprowadź hasło">
                        </div>

                        <button type="submit" class="btn btn-danger">Zaloguj</button>
                    </form>
                </div>

            </div>
        </div>

    </body>
</html>