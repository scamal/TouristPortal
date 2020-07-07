<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Stats | Admin | Belgrade</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->



    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>

    <!--MapQuestAPI-->
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css">

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/tourList.css">
    <link type="text/css" rel="stylesheet" href="admin.css">
    <style>
        table{
            width: 100%;
        }
        caption{
            caption-side: top;
        }


    </style>

</head>
<body>
<?php

require_once "navbar.php";
if (isset($_SESSION['filter'])){
    $_SESSION['filter'] = [];
}
if (isset($_SESSION['admin'])) {
if ($_SESSION['admin'] === "daAdminje") {
require_once "../requires/db_config.php";
$sql = "select * from location";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
?>
<div class="container-fluid">
    <?php
        require_once "../requires/db_config.php";
    $sql = 'SHOW COLUMNS FROM scan_stats';
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $columns = [];
    $thCols = [];
    $values = [];
    while($row = $result->fetch_assoc()){
        $col = str_replace("_"," ",$row['Field']);
        $col = ucfirst($col);
        $columns[] = $row['Field'];
        $thCols[] = $col;
        $values[$row['Field']]=[];
    }
    $sql = 'select * from scan_stats';
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {
        ?>
    <div class='container-fluid' id="mainContainer"><div class='table-responsive-lg table-striped'><table>
    <?php
        foreach ($thCols as $colName){
            echo "<th>$colName</th>";
        }
        echo "</tr><tr>";
    foreach ($columns as $colName){
        echo "<td ><select id='$colName' onchange='filterStats(\"$colName\")'> <option value='*'>All</option></select></td>";
    }

    echo "</tr>";
    ?>
                <tbody id="contTable">
                <?php
                $counter = 0;
                while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    echo "<tr>";
                    foreach ($columns as $colName){
                        if (!(in_array($row[$colName],$values["$colName"]))){
                            echo array_search("$row[$colName]",$values["$colName"]);
                            $values[$colName][]=$row[$colName];
                        }
                        echo "<td>".$row[$colName]."</td>";
                    }
                    echo "</tr>";

                }
        }


?>
                </tbody></table></div>
    </div>
</div>

    <script>
<?php
    $script = "function statsJs(){";

    foreach ($columns as $col ){
        $innerHTML = "<option>*</option>";
        foreach ($values[$col] as $opt){
            $innerHTML.="<option>$opt</option>";
        }
        echo "select = document.getElementById('$col');
        select.innerHTML = '$innerHTML';";
        $script.= "select = document.getElementById('$col');
        select.innerHTML = '$innerHTML';";
    }
    $script.="}";
    file_put_contents('stats.js',$script);
}
}
    ?>
</script>
<script src="stats.js"></script>
<script src="admin.js"></script>
<script src="../search/search.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8rxbHWZvXHRRk9NZFAiZ2DMNl9_kBsEk&callback=initMap"
        async defer></script>

</body>
</html>

