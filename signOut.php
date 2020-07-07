<?php
session_start();
session_destroy();
//print_r($_SESSION);
require_once "navbar.php";
require_once "requires/PreviousPage.php";
header("Location: index.php");