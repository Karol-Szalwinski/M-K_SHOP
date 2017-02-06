<?php
/*
 * plik główny panelu administratora
 * 
 */
require_once __DIR__ . '/../src/required.php';

//Ustalam aktywną zakładkę w menu
$_SESSION['active-button-admin-menu'] = 0;

//Ustalamy id i name zalogowanego admina
if (!isLoggedAdmin($conn)) {
    header("Location: loginAdmin.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel</title>
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
                <div class="col-sm-2 text-left">

                </div>

                <div class="col-sm-10 text-left"> 
                    <h2>Witamy w panelu administracyjnym M&K SHOP</h2>
                    <br><br>
                    <p> Możesz zarządzać z tego miejsca kategoriami, produktami, użytkownikami i zamówieniami</p>
                    <hr>

                </div>

            </div>
        </div>

    </body>
</html>