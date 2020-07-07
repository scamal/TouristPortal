<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>

    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Latest compiled and minified JavaScript -->



    <link rel="stylesheet" href="css/index.css" type="text/css" >
    <link rel="stylesheet" href="css/style.css" type="text/css" >

</head>
<body>
<?php
require_once "navbar.php";
?>
<div class="container-fluid konj" id="container">
    <div class="row ">
        <div class="col-lg-3"></div>
        <div  class="jumbotron col-lg-6 div-style" id="sign">
            <h1 class="text-center" id="title">Sign up</h1>
            <form action="index2.php" method="post"> <!--onsubmit="return submit_function(this)"-->
                <label for="name" >Name:</label><br><input type="text" id="Name" name="Name" class="textInput"placeholder="required"onblur="check(this)"><div id="Namediv"></div><br><br>
                <label for="Last_name" >Last name:</label><br><input type="text" id="Last_name" name="Last_name" class="textInput"placeholder="required" onblur="check(this)"><div id="Last_namediv"></div><br><br>
                <label for="Mail" >E-mail:</label><br><input type="email" id="Mail" name="Mail" class="textInput"placeholder="required"onblur="check(this)"><div id="Maildiv"></div><br><br>

                <label for="Username" >Username: </label><br><input type="text" id="Username" name="Username" class="textInput optional"  placeholder="required"onblur="check(this)"><div id="Usernamediv"></div><br><br>
                <label for="Password" >Password: </label><br><input type="password" id="Password" name="Password" class="textInput" placeholder="required"onblur="check(this)"><div id="Passworddiv"><h4 id="PassH">8 letters<br>at least 1 number</h4></div><br><br>
                <!--label for="User_photo" >Photo: </label><br><input type="file" id="User_photo" name="User_photo" class="image"><br-->
                <!--button type="submit" class="btn btn-primary">Submit</button-->
                <div class="g-recaptcha" data-sitekey="6LcjlNAUAAAAAJdgon_r__43fFYPMRHEpBG11Z7z"></div>
                <br>
                <input type="submit" name="Submit" value="Submit" class="btn btn-primary">

                <a href="LogIn.php" class="btn btn-primary">Log in</a>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/simpleWeather.js"></script>

<script src="js/SignUp.js"></script>
//captcha
<script src="https://www.google.com/recaptcha/api.js" async defer></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
