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
require_once "requires/db_config.php";
require_once "navbar.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $username = 1;
    $link = $link = "'".$_SERVER['HTTP_HOST'] . "/TouristPortal/verifyAccount.php?code=$code'";
    $sql = "select * from users where ver_link=$link";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
           $username=$row['username'];
        }
    }
    $sql = "update users set user_verified=1 where username='$username'  ";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    if (mysqli_affected_rows($connect)) {
        echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You have verified account.</p1>";
    }
    else {
        echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>Incorrect link.</p1>";
    }
}
else {
    echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>Please use the link we have sent to you to verify account.</p1>";
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
