<?php

$noNavbar = "";
$pageTitle = "Login";
session_start();
if (isset($_SESSION["Username"])) {
    header("Location:dashboard.php");
}
include "./init.php";
include $tps . "header.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["user"];
    $password = $_POST["pass"];
    $shaledPass = sha1($password);

    // Check if User exist in database
    $stmt = $conn->prepare("SELECT UserID , Username, Password FROM `USER` WHERE Username = ? AND Password = ? AND GroupID = 1 LIMIT 1");
    $stmt->execute(array($Username, $shaledPass));
    $row  = $stmt->fetch();
    $count = $stmt->rowCount();

    // If count > 0 this mean the database contain record about the username
    if ($count > 0) {
        $_SESSION["Username"] = $Username;
        $_SESSION["ID"] = $row["UserID"];
        header("Location:dashboard.php");
        exit();
    }
}

?>

<form class="login" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
    <h4 class="text-center">Admin Login</h4>
    <input type='text' placeholder="Username" class="form-control" autocomplete="off" name="user">
    <input type="password" placeholder="password" class="form-control" autocomplete="new-password" name="pass" />
    <div class="d-grid">
        <button class="btn btn-primary" type="submit">
            Login
        </button>
    </div>
</form>


<?php include $tps . "footer.php" ?>