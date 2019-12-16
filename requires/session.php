<?php
session_start();
function sesUser ($user){
    $_SESSION["user"]=$user;
}
