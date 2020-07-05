<?php
require_once "../requires/db_config.php";
$sql=$sTerm=null;
if (isset($_POST['sTerm'])){
    $sTerm = $_POST['sTerm'];
}
if (isset($_POST['sql'])){
    $sql = $_POST['sql'];
}
if ($sql!=null and $sTerm!=null){
    $newSql = $sql;
    if (isset($_POST['sqlC'])){
        $sqlC = $_POST['sqlC'];
        $newSql.=$sqlC;
    }
    $IDArr = [];
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    #echo "<table><tr><th>Tour name</th><th>Tour description</th><th>Locations</th><th>View map</th></tr>";
    $i =0;
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $txt = "";
        foreach ($row as $item){
            $txt.=$item;
        }
        if (strpos($txt, $sTerm) !== false) {
            $IDArr[] = "\"$row[0]\"";
            $colName = mysqli_fetch_field_direct($result, 0)->name;
            $val = $row[0];
            if ($i ==0){
                $newSql.="$colName in ($val";

            }
            else {
                $newSql.=",$val";
            }
            $i++;
        }

    }
    if ($i>0){
        $newSql.=")";
    }
    if (isset($_POST['afterSql'])){
        $afterSql=$_POST['afterSql'];
        $newSql.=" $afterSql";
    }
    echo $newSql;
}
