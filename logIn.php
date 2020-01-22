<?php

//session_start();
include "requires/db_config.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--script src="js/index.js"></script-->
    <script src="js/login.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script-->
    <link rel="stylesheet" href="css/index.css" type="text/css" >
    <link rel="stylesheet" href="css/style.css" type="text/css" >

    <script src="js/LogIn.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/simpleWeather.js"></script>





    <script src="https://www.google.com/recaptcha/api.js" async defer></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
</head>
<body class="konj">
<?php
require_once "navbar.php";
?>
<div class="container-fluid" id="log_container">
    <div class="col-md-4"></div>
    <div  class="jumbotron col-md-4 div-style " id="log">
        <h1 class="text-center" id="title">Sign in</h1>
        <form id="form" action="ts" method="post" onsubmit="return false">
            <label for="Username" >Username: </label><br><input type="text" id="Username" name="Username" class="textInput" placeholder="required" onblur="check(this)"><div id="Usernamediv"></div><br><br>
            <label for="Password" >Password: </label><br><input type="password" id="Password" name="Password" class="textInput" placeholder="required" onblur="check(this)"><div id="Passworddiv"></div><br><br>
        <!--label for="User_photo" >Photo: </label><br><input type="file" id="User_photo" name="User_photo" class="image"><br-->
            <div class="g-recaptcha" data-sitekey="6LcjlNAUAAAAAJdgon_r__43fFYPMRHEpBG11Z7z" id="captcha"></div><br><br>
            <input type="submit" id="signin" name="Submit" value="Sign in" class="btn btn-primary" onclick="SignIn(Event)">
        <!--button id="signin" onclick="SignIn()" type="button" class="btn btn-primary">Sign in</button-->
            <br><br>
            <a id="Reg" href="SignUp.html">Register now !</a>
            <br><br>
            <p id="error_mess"></p>
        </form>
    </div>

</div>


</body>
</html>
