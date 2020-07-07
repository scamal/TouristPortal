<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Locations | Belgrade</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>


    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>



    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <style>
        table{
            width: inherit;
        }
        caption{
            caption-side: top;
        }
        td{
            vertical-align: middle;
            padding: 20px 20px;
        }
        button{
            vertical-align: center;
        }
    </style>

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

?>
<div class="container-fluid">
    <table class="table-responsive-lg table">
        <tr>
            <th>Location</th>
            <th>description</th>
            <th>Picture</th>
            <th>View map</th>
            <th>More info</th>
        </tr>
<?php
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {
        $url = "http://localhost/TouristPortal/LocationInfo.php?location=";
        $url.= $row['location_ID'];
        $id = $row['location_ID'];
        $name = $row['location_name'];
        $desc = $row['location_description'];
        $img = $row['location_picture'];
        $lat = $row['lat'];
        $longt = $row['longt'];
        $ses = "<a href='$url' class='btn btn-primary' >Add location</a></div>";
        ?>
        <tr>
            <td style="vertical-align: middle">
                <?=$name?>
            </td>
            <td style="vertical-align: middle">
                <?=$desc?>
            </td>
            <td style="vertical-align: middle">
                <img src="<?=$img?>" width="200px">
            </td>
            <td style="vertical-align: middle">
                <button onclick='viewMap(<?=$lat?>,<?=$longt?>)' class="btn btn-primary" >Map</button>
            </td>
            <td style="vertical-align: middle">
                <a href="<?=$url?>" class="btn btn-primary" target="_blank">More info</a>
            </td>

        </tr>

        <?php
        //writeIfSession($ses);
    }
    mysqli_free_result($result);
}

?>
    </table>
    <div id="mapDiv" style="padding: 20px">
        <div id="map" style="width: 100%; height: 530px;"></div>
    </div>
</div>

<script src="js/ShowLoc.js"></script>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>


