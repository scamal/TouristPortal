<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bootstrap Scrollspy 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">

</head>
<body class="text-center konj">
<div class="container p-4 text-center">
    <div class="div-style row p-3 rounded min-height-100 text-center">
<?php
session_start();


require('requires/db_config.php');

/*$sql = "SELECT * FROM workers
        WHERE name LIKE '%t_'";
*/
if (isset($_GET['location'])){
    $location_ID = $_GET['location'];
}
else echo "You haven't selected any location";
$sql = "SELECT * FROM location
        WHERE location_ID= $location_ID";

$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {
        if ($row['location_name']!=null){
            $img = $row['location_name'];
            echo "<div class='col-12'><h4 class='title-font white-text'>$img</h4></div>";
        }
        if ($row['location_picture']!=null){
            $img = $row['location_picture'];
            echo "<div class='col-1 col-md-2 '></div><img src=\"$img\" class='col-10 col-md-8'><div class='col-1 col-md-2 '></div><br><br>";
        }
        if ($row['location_description']!=null){
            $img = $row['location_description'];
            echo "<div class='col-12'><p>$img</p></div>";
        }
        if ($row['map_embed']!=null){
            $img = $row['map_embed'];
            $arr = explode(" ",$img);
           // var_dump($arr);
            $newArr = [];
            foreach ($arr as $word){
                //$word = "$word ";
                //echo "$word";

                //echo "asfdasdfadsf<br>";
                if (strpos($word,"width")===0){
                    $word = "width=\"100%\"";
                    //echo "sdfadsf";
                }
                if (strpos($word,"height")===0){
                    $word = "height=\"450\"";
                }
                //echo "$word".strpos($word,"width"). "<br>";
                $newArr[] = $word;
            }
            //var_dump($newArr);
            $img = implode(" ",$newArr);
            echo "<div class='col-12 text-center mt-4'>$img</div>";
        }




    }
    mysqli_free_result($result);
}

mysqli_close($connect);
?>
    </div>
</div>
</body>

</html>

