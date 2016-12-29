<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../src/required.php';
//Ustalamy id i name zalogowanego usera
if ($loggedUser = isLoggedUser($conn)) {
    $loggedUserName = $loggedUser->getName();
    $loggedUserId = $loggedUser->getId();
} else {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Cart</title>
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

                <div class="col-sm-10 text-left"> 

                    <h3>Otrzymane wiadomości</h3>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Data i godzina</th>
                                <th>Tytuł</th>
                                <th>Treść</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Wyświetlam wszystkie wiadomości
                            $no = 0;
                            $allMessages = Message::loadMessagesByReceiverId($conn, $loggedUserId);
                            if (!empty($allMessages)) {

                                foreach ($allMessages as $message) {
                                    $no++;
                                    $message->showMessageInUserTabRow($no);
                                }
                            } else {
                                echo "<h4>Użytkownik nie ma żadnych wiadomości/h4>";
                                die();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!—--------------Stopka------------------->
        <?php require_once __DIR__ . '/footer.php' ?>

    </body>
</html>



