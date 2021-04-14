<?php
$do = "";
if (isset($_GET["do"])) {
    $do = $_GET["do"];
} else {
    $do = "Manage";
}

if ($do == "Manage") {
    echo "Welcome , You are in Manage Category page";
} elseif ($do == "Add") {
    echo "Welcome , You are in Add Category page";
} elseif ($do == "Insert") {
    echo "Welcome , You are in Insert Category page";
} else {
    echo "Error , No File Exists with this name";
}
