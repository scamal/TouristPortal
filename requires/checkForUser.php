<?php
function checkUser($username,$connect){

    $sql = "select username from users where username=$username";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {
        //mysqli_close($connect);
        return true;
    }




}
function checkAdmin($connect){
    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "select username,admin from users where username='$username' and admin=1";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (mysqli_num_rows($result) > 0) {
            //mysqli_close($connect);
            $_SESSION['admin']="daAdminje";
        }
        else {
            $_SESSION['admin']=false;
        }
    }
}

