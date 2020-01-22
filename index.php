<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Belgrade</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">

</head>
<body>
<?php
require_once "navbar.php";
//print_r($_SESSION);

?>

<div class="container-fluid">

    <div class="row align-items-center">

        <div class="col-12 title align-middle">
            <h1 class="title-font white-text" style="position: absolute;
right: 0;
bottom: 30%;">BEOGRAD</h1>

        </div>
        <div class="content col-12 row">
        <div class="col-12 col-md-4 p-3 ">
            <div class="w-100 div-style uniform-height p-3 ">
                <img src="img/street-3043895_640.jpg" class="img-fluid">
                <br><br>
                <p class="text-center">
                    Beograd je glavni i najnaseljeniji grad Republike Srbije i privredno, kulturno i obrazovno središte zemlje. Grad leži na ušću Save u Dunav, gde se Panonska nizija spaja sa Balkanskim poluostrvom.
                </p>


            </div>
        </div>
            <div class="col-12 col-md-4 p-3 ">
                <div class="w-100 div-style uniform-height p-3 ">
                    <img src="img/panorama-4569756_640.jpg" class="img-fluid">
                    <br><br>
                    <p class="text-center">
                        Jedan je od starijih gradova u Evropi. Prva naselja na teritoriji Beograda datiraju iz praistorijske Vinče, 4.800. godina pre nove ere. Sam grad su osnovali Kelti u 3. veku pre n. e, pre nego što je postao rimsko naselje Singidunum. Beograd je glavni grad Srbije od 1405. godine.
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4 p-3 ">

                <div class="w-100 div-style uniform-height p-3 ">
                    <img src="img/belgrade-466173_640.jpg" class="img-fluid">
                    <br><br>
                    <p class="text-center">
                        Beograd se nalazi na 116,75 metara nadmorske visine, na koordinatama 44°49'14" severno i 20°27'44" istočno. Istorijsko jezgro Beograda (današnja Beogradska tvrđava) nalazi se na desnoj obali Save.
                    </p>

                </div>
            </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
