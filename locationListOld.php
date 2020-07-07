<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Location info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">

</head>
<body class="text-center">

<?php
require_once "navbar.php";
//require_once "requires/session.php";
require_once "requires/db_config.php";
$sql = "SELECT * FROM location";

$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$background = "style='background-color: #0c5460'";
$class = "col-6 col-md-4 col-lg-3 my-auto";

$noDisplay = "d-none d-md-block";
$class3 = "d-none d-lg-block col-lg-3";
$class2 = "$noDisplay col-md-4 col-lg-3";
$url = "http://localhost/TouristPortal/LocationInfo.php?location=";
echo "<div class='container'><div class='row'><div class='$class'>Location</div><div class='$class3'>Description</div><div class='$class2'>Photo</div><div class='$class'>Info</div>";
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {
        $url.= $row['location_ID'];
        $ses = "<div class='$class'><a href='#'>Add location</a></div>";
        echo "<div class='$class '>".$row['location_name']."</div><div class='$class3'>".$row['location_description']."</div><div class='$class2'>
            <img class='img-fluid' src='".$row['location_picture']."'/></div>
            <div class='$class'><a href='$url'>More info</a></div>
        ";
        //writeIfSession($ses);
    }
    mysqli_free_result($result);
}
echo "</div></div>";
function writeIfSession($ses){
    require_once "requires/session.php";
    if (isset($_SESSION['username'])){
        echo $ses;
    }
}
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
