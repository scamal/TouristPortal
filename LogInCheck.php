<?php

//session_start();

include_once "requires/db_config.php";
require_once "requires/session.php";

//$_SESSION['logged'] = "false";

$username = $password = "";

if(isset($_POST['Username']))
    $username = mysqli_real_escape_string($connect, $_POST['Username']);

if(isset($_POST['Password']))
    $password =  mysqli_real_escape_string($connect, $_POST['Password']);

/*
$SALT="aSD2213qse21ewdqwQWEQDWQWE13";
$pass1 = md5($password);
$password = $SALT.$pass1.$SALT;
*/

$check_username = 0;
if(strlen($username) < 1)
    echo "Enter username ! <br>";
else
    $check_username = 1;

$check_pass = 0;
if(strlen($password) < 1)
    echo "Enter password ! <br>";
else
    $check_pass = 1;

if($check_pass == 1 AND $check_username == 1) {

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    /*$username = mysqli_real_escape_string($connect,$_POST['username']);
        $password = mysqli_real_escape_string($connect,$_POST['password']);

        $sql = "SELECT * FROM user WHERE username = '$username';";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);


        if(!password_verify($password,$row['password']) or $count < 1) {
            header('Location: ../login.php?error=true');
            exit;

        }*/
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result)) {
            $pass = $record['password'];
            if(password_verify($password,$pass)){
                echo "Succesfull !";
                sesUser($password);
            }

            else echo "Incorrect username or password !";
        }
    } else {

        echo "Incorrect username or password !";
    }

}
else
{
    echo "Enter text in fields ! <br>";
}