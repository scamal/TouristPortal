<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();


}
if (!isset($_SESSION['filter'])){
    $_SESSION['filter'] = [];
}
if (isset($_POST['key'])){

}
if (isset($_POST['value'])){
    $_SESSION['filter'][] = [$_POST['key']=>$_POST['value']];
    #array_push($_SESSION['filter'],[$_SESSION['filter'][$_POST['key']]=>$_POST['value']]);
        #$_SESSION['filter'][0][$_POST['key']] = $_POST['value'];
}
$sqlWhere = "";
$allKeys=$_SESSION['filter'];
foreach ($allKeys as $allKey){
    foreach ($allKey as $key=>$val){
        $sqlWhere.= "$key = \"$val\" and ";
    }
}

if ($sqlWhere!=''){
    $sqlW = "select * from scan_stats where $sqlWhere";
    $sqlW = substr($sqlW,0,-4);
}

?>



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
    $result = mysqli_query($connect, $sqlW) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {
    ?>
<div class='table-responsive-lg table-striped'><table>
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
<p>*Refresh page to restart filter.</p>