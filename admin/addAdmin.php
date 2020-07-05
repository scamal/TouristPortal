<?php
require_once "../requires/db_config.php";
if (isset($_POST['user'])){
    $user = $_POST['user'];
    $sql = "UPDATE users SET admin=1 WHERE username='$user'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if (mysqli_affected_rows($connect)>0){
        echo "You have added $user as admin";
    }
    else {
        echo "There is problem with database try later, or contact developer.";
    }
}
