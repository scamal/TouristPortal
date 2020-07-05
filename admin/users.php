<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Location info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->



    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>

    <!--MapQuestAPI-->
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/tourList.css">
    <style>
        table{
            width: 100%
        }
        caption{
            caption-side: top;
        }
        td{
            padding: 20px 20px;
        }
    </style>

</head>
<body class="text-center">
<?php
require_once "navbar.php";
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] === "daAdminje") {
        require_once "../requires/db_config.php";
        $sql = "select * from users";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='container-fluid'><table class='table-responsive-lg table-striped'><tr><th>Username</th><th>Name</th><th>Last name</th><th>E-mail</th><th>Administrator</th><th>Add administrator</th><th>Delete user</th></tr>";
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
            {
                $name = $row['name'];
                $username = $row['username'];
                $lastName = $row['last_name'];
                $adm = $row['admin'];
                $mail = $row['email'];
                echo "<tr><td>$username</td><td>$name</td><td>$lastName</td><td>$mail</td>";
                if ($adm ==1){
                    echo "<td>YES</td>";
                }
                else {
                    echo "<td>NO</td>";
                }
                echo "<td><button class='btn btn-primary' onclick='addAdmin(\"$username\")'>Add administrator</button></td><td><button class='btn btn-primary' onclick='deleteUser(\"$username\")'>Delete user</button></td></tr>";
            }

        }
    }
    else {
        echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You must be administrator to access this page.</p1>";
    }
}
else {
    echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You must be administrator to access this page.</p1>";
}
?>
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
