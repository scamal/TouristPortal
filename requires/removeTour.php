<?php
require_once "db_config.php";
if (isset($_POST['tour_ID'])){
    $tourID = $_POST['tour_ID'];
    $sql = "DELETE FROM user_tour WHERE user_tour_ID=$tourID";

    if ($result = mysqli_query($connect, $sql) or die(mysqli_error($connect))){
        echo "You have removed tour.";
    }
    else {
        echo "Error with removing tour. Try again later.";
    }
}

