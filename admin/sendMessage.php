<?php
/*
 * strona wysłania wiadomości do użytkownika
 * 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Send Message</title>
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
                <br><br>
                <div class="col-sm-3 text-left">

                </div>
                <div class="col-sm-6 text-left panel panel-default panel-body"> 

                    <h3>Wyślij wiadomość do Karol</h3>
                    <form>
                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" class="form-control" id="title" name="title" value="Zamówienie nr 1">
                        </div>
                        <div class="form-group">
                            <label for="message">Wiadomość:</label>
                            <textarea type="text" class="form-control" id="message" rows="7"
                                      name="message" placeholder="Wprowadź wiadomość">Witam,</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Wyślij wiadomość</button>
                        <hr>
                    </form>

                </div>
            </div>
        </div>

    </body>
</html>