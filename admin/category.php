<?php
/*
 * Lista kategorii w korej mozemy dodac i usunac dowolna z nich
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Category</title>
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
                <div class="col-sm-6 text-left">
                    <form>
                        <div class="form-group">
                            <label for="category"><h4>Dodaj kategorię:</h4></label>
                            <input type="text" class="form-control" id="category" placeholder="Wprowadź nowa kategorię">
                        </div>
                        <button type="submit" class="btn btn-info">Dodaj kategorię</button>
                    </form>
                </div>

                <div class="col-sm-8 text-left">
                    <br>
                    <hr>
                    <h4>Lista kategorii</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nazwa kategorii</th>
                                <th>Ilość towarów</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Procesory</td>
                                <td>10</td>
                                <td><button type="button" class="btn btn-warning" onclick="location.href = 'product.php';">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Płyty główne</td>
                                <td>25</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Dyski HDD</td>
                                <td>2</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Karty graficzne</td>
                                <td>3</td>
                                <td><button type="button" class="btn btn-warning">Zmień</button></td>
                                <td><button type="button" class="btn btn-danger">Usuń</button></td>
                            </tr>
                        </tbody>
                    </table>


                </div>

            </div>
        </div>

    </body>
</html>