<?php

function lang($pharse)
{
    static $lang = array(
        "HOME_ADMIN" => "Home",
        "CATEGORIES" => "Categories",
        "ITEMS" => "Items",
        "MEMBERS" => "Users",
        "STATISTICS" => "Statistics",
        "LOGS" => "Logs",
    );
    return $lang[$pharse];
}
