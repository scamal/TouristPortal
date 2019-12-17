<?php
//if (defined('SECRET') AND SECRET == '@3eweHjdsdfuihjhjhj#VGVgggg!') {
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", ""); // "" default for localhost
define("DATABASE", "beograd");

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);


mysqli_query($connect, "SET NAMES utf8") or die (mysqli_error($connection));
mysqli_query($connect, "SET CHARACTER SET utf8") or die (mysqli_error($connection));
mysqli_query($connect, "SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

// http://php.net/manual/en/book.mysqli.php
//}
?>