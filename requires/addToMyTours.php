<?php
session_start();
require_once "db_config.php";
require_once "checkForUser.php";
//
if (isset($_SESSION['username']) && isset($_POST['tour_ID'])){
    $username = "'".$_SESSION['username']."'";

    if (checkUser($username,$connect)){
        $tour_ID = $_POST['tour_ID'];
        $sqlCheck = "select * from user_tour where username = $username and tour_ID = $tour_ID";
        $check =  mysqli_query($connect, $sqlCheck) or die(mysqli_connect_error());
        if (!(mysqli_num_rows($check) > 0)) {
            //mysqli_close($connect);


            $sql = "INSERT INTO user_tour (username, tour_ID)
VALUES ($username,$tour_ID);";
            //echo "It is done";
            //var_dump($connect);
            $result = mysqli_query($connect, $sql) or die(mysqli_connect_error());

            if (mysqli_affected_rows($connect)) {
                $mes ['message']= "Tour is added!";
                exit(json_encode($mes));
            }

            mysqli_close($connect);
        }
        else {
            $mes ['message']= "Tour is already added!";
            exit(json_encode($mes));

        }
    }
}