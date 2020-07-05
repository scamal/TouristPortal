<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



    <link rel="stylesheet" href="../css/index.css" type="text/css" >
    <link rel="stylesheet" href="../css/style.css" type="text/css" >

</head>
<body>
<?php
require_once "../requires/db_config.php";
require_once "navbar.php";
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==="daAdminje"){
        echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>Welcome to administrator page.</p1>";
    }
    else {
        echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You must be administrator to access this page.</p1>";
    }
}
else {
    echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You must be administrator to access this page.</p1>";
}
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>