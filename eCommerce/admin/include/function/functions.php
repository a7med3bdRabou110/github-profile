<?php
//! tITLE OF PAGE
function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'Default';
    }
}


//!REDIRECTATION V 1.0.0
/*
function redirectHome($errorMsg, $seconds = 3)
{
    echo "<div class='alert alert-dark'>$errorMsg</div>";
    echo "<div class='alert alert-info'>You Will be redirected to Homepage After $seconds seconds</div>";
    header("refresh:$seconds;url=index.php");
    exit();
}
*/

//! Check Item function
// ? Function to check from database [Function Accept Parameters]
//* $select = The Item Selected  [Example : user , item , category]
// *TODO $form = The table of select Item from [Example : users , items , categories]
//! $value = The value of select [Example : ahmed , box, ELectronics]

function checkUesr($select, $from, $value)
{
    global $conn;
    $statement = $conn->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}


//! Update the redirect function
//* Home Redirect v2.0.0 
//*TODO This function Accept Parameters
//? $theMsg = Echo the Message [Error | Success | warning]
//! url= The Lik you are want to redirect to
//? $seconds = Seconds before redirecting

function redirectHome($theMsg, $url = null, $seconds = 3)
{
    if ($url === null) {
        $url = "index.php";
        $link = "HomePage";
    } else {
        if (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] !== "") {
            $url = $_SERVER["HTTP_REFERER"];
            $link = "Previous Page";
        } else {
            $url = "index.php";
            $link = "HomePage";
        }
    }
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
        '<strong>' . $theMsg . '</strong>' .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
        '</div>';
    echo "<div class='alert alert-info'>You Will be redirect to $link After $seconds Seconds</div>";
    header("refresh:$seconds;url=$url");
    exit();
}

//! Count Number of items function v 1.0.0
//? Function to count numbers of items Rows
//* $items = The item to count
//*todo $table = The table to choose form

function countItems($Items, $Table)
{
    global $conn;
    $stmt  = $conn->prepare("SELECT COUNT($Items) FROM $Table");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
}

//! Count Number of Viewers Function v 1.0.0
//? Function to count number of viewer of website

function viewer()
{
    if (empty($_SESSION["counter"])) {
        $views = $_SESSION["counter"] = 1;
    } else {
        $views = $_SESSION["counter"]++;
    }
    return $views;
}

//! Count number of items function v 1.0.1
//? Function to count the number of Pending users
//* $item = The item to count 
//*TODO $table = The table to choose form

function countPendingItems($Items, $Table)
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT($Items) FROM $Table WHERE $Items = 0");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
}

//! Get The Latest Records Function V 1.0.0
//? Function To Get Latest items From database [User , Items , Comments]
//* $select = Feild to Select
//*TODO $table = The Table To Choose From
//! $limit = Number of records To Get

function getLatest($Select, $Table, $Order, $Limit)
{
    global $conn;
    $stmt = $conn->prepare("SELECT $Select FROM $Table ORDER BY $Order DESC LIMIT $Limit");
    $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
}
