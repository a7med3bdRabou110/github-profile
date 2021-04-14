<?php
session_start();
if (isset($_SESSION["Username"])) {
    $pageTitle = "Categories";
    include "init.php";

    $cat = "";
    if (isset($_GET["cat"])) {
        $cat = $_GET["cat"];
    } else {
        $cat = "Manage";
    }
    

    include $tps."footer.php";
    else{
        echo "You are Hacker Kawal";
    }