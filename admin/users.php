<?php
/*
 * lista użytkownikow z mozliwoscia wyslania wiadomosci
 * 
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Products</title>
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
                <div class="col-sm-12 text-left">
                    <h3>Lista użytkowników</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>E-mail</th>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>Ulica</th>
                                <th>Nr</th>
                                <th>Kod pocztowy</th>
                                <th>Miejscowość</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Wyświetlam wszystkie zamówienia
                            $no = 0;
                            $allUsers = User::loadAllUsers($conn);
                            foreach ($allUsers as $user) {

                                $no++;
                                $user->showUserInAdminTabRow($no);
                            }
                            ?>>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>