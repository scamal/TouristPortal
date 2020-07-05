<?php
require_once "../requires/db_config.php";
if (isset($_POST['user'])){
    $user = $_POST['user'];
    $sql = "DELETE FROM users WHERE username='$user'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if (mysqli_affected_rows($connect)>0){
        echo "You have deleted $user from database";
    }
    else {
        echo "There is problem with database try later, or contact developer.";
    }
}