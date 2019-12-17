<?php

session_start();
include "requires/db_config.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log</title>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="js/index.js"></script>
    <script src="js/login.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css" type="text/css" >
    <link rel="stylesheet" href="css/style.css" type="text/css" >
</head>
<body class="konj">
<div class="container-fluid" id="log_container">
    <div class="col-md-4"></div>
    <div  class="jumbotron col-md-4 div-style " id="log">
        <h1 class="text-center" id="title">Sign in</h1>
        <label for="Username" >Username: </label><br><input type="text" id="Username" name="Username" class="textInput" placeholder="required"><br><br>
        <label for="Password" >Password: </label><br><input type="password" id="Password" name="Password" class="textInput" placeholder="required"><br><br>
        <!--label for="User_photo" >Photo: </label><br><input type="file" id="User_photo" name="User_photo" class="image"><br-->
        <button id="signin" onclick="SignIn()" type="button" class="btn btn-primary">Sign in</button>
        <br><br>
        <a id="Reg" href="SignUp.html">Register now !</a>
        <br><br>
        <p id="error_mess"></p>
    </div>

</div>
