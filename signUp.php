<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <!-- Latest compiled and minified JavaScript -->
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script-->

    <link rel="stylesheet" href="css/index.css" type="text/css" >
    <link rel="stylesheet" href="css/style.css" type="text/css" >

</head>
<body>
<script src="js/jquery.js"></script>
<div class="container-fluid" id="container">
    <div class="row ">
        <div class="col-md-3"></div>
        <div  class="jumbotron col-md-6 div-style" id="sign">
            <h1 class="text-center" id="title">Sign up</h1>
            <form action="index2.php" method="get"> <!--onsubmit="return submit_function(this)"-->
                <label for="name" >Name:</label><br><input type="text" id="Name" name="Name" class="textInput"placeholder="required"onblur="check(this)"><div id="Namediv"></div><br><br>
                <label for="Last_name" >Last name:</label><br><input type="text" id="Last_name" name="Last_name" class="textInput"placeholder="required" onblur="check(this)"><div id="Last_namediv"></div><br><br>
                <label for="Mail" >E-mail:</label><br><input type="email" id="Mail" name="Mail" class="textInput"placeholder="required"onblur="check(this)"><div id="Maildiv"></div><br><br>

                <label for="Username" >Username: </label><br><input type="text" id="Username" name="Username" class="textInput optional"  placeholder="required"onblur="check(this)"><div id="Usernamediv"></div><br><br>
                <label for="Password" >Password: </label><br><input type="password" id="Password" name="Password" class="textInput" placeholder="required"onblur="check(this)"><div id="Passworddiv"><h4 id="PassH">8 letters<br>at least 1 number</h4></div><br><br>
                <!--label for="User_photo" >Photo: </label><br><input type="file" id="User_photo" name="User_photo" class="image"><br-->
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="LogIn.php" class="btn btn-primary">Log in</a>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<script src="js/SignUp.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
