<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>M&K Shop - Admin Panel - Add Product</title>
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

                    <h3>Dodaj produkt</h3>
                </div>
                <div class="col-sm-6 text-left">

                    <form>
                        <div class="form-group">
                            <label for="category">Kategoria</label>
                            <select class="form-control" id="category" name="category">
                                <option value="1">Wybierz kategorię</option>
                                <option value="2">Kategoria 1</option>
                                <option value="3">Kategoria 2</option>
                                <option value="4">Kategoria 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Nazwa produktu</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Podaj nazwę produktu">
                        </div>
                        <div class="form-group">
                            <label for="description">Opis produktu</label>
                            <textarea type="text" class="form-control" id="description" rows="10"
                                      name="description" placeholder="Opis produktu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Dostępna ilość</label>                           
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="10" step="1" value="1">
                        </div>
                        <button type="submit" class="btn btn-danger">Dodaj nowy produkt</button>
                    </form>
                </div>
                <div class="col-sm-6 text-left">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fileToUpload">Dodaj zdjęcie</label>
                            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload"><br>
                            <input class="btn btn-info" type="submit" value="Wgraj zdjęcie" name="submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </body>
</html>