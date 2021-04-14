<?php

include "connect.php";
//Routes 
$tps = "include/Templates/"; // Templates Route
$CSS = "layout/CSS/"; // CSS Route
$JS = "layout/JS/"; // JS Route
$lang = "include/languages/"; // Function Route
$func = "include/function/"; // Function Route
include $func . "functions.php";
include $lang . "english.php";
include $tps . "header.php";

if (!isset($noNavbar)) {
    include $tps . "navbar.php";
}
