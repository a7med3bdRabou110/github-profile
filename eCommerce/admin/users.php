<?php
session_start();
$pageTitle = "Users";
if (isset($_SESSION["Username"])) {
    include "init.php";
    $do = "";
    if (isset($_GET["do"])) {
        $do = $_GET["do"];
    } else {
        $do = "Manage";
    }



    if ($do == "Manage") {

        $query = "";

        if (isset($_GET["page"]) && $_GET["page"] === "Pending") {
            $query = "AND RegStatus = 0";
        }

        $stmt = $conn->prepare("SELECT * FROM USER WHERE GroupID !=1 $query");
        $stmt->execute();
        $rows = $stmt->fetchAll();

?>

        <h1 class="text-center">
            Manage users
        </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                    <tr>
                        <td>
                            #ID
                        </td>
                        <td>
                            Username
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            Full Name
                        </td>
                        <td>
                            Registered Date
                        </td>
                        <td>
                            Control
                        </td>
                    </tr>

                    <?php
                    foreach ($rows as $row) {
                    ?>


                        <tr>
                            <td><?php echo $row["UserID"] ?></td>
                            <td><?php echo $row["Username"] ?></td>
                            <td><?php echo $row["Email"] ?></td>
                            <td><?php echo $row["FullName"] ?></td>
                            <td><?php echo $row["Date"] ?></td>
                            <td>
                                <a href="users.php?do=Edit&userid=<?php echo $row["UserID"]; ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                <a href="users.php?do=Delete&userid=<?php echo $row["UserID"]; ?>" class="confirm btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                <?php
                                if ($row["RegStatus"] == 0) { ?>
                                    <a href="users.php?do=Activate&userid=<?php echo $row["UserID"]; ?>" class="btn btn-success">
                                        <i class="fa fa-check-circle"></i>
                                        Activate
                                    </a>
                                <?php }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                </table>
            </div>

            <a href='?do=Add' class="btn btn-primary"><i class="fa fa-plus"></i> Add new Member</a>
        </div>
        <?php

    }

    if ($do == "Edit") {

        $userid = isset($_GET["userid"]) && is_numeric($_GET["userid"]) ? $_GET["userid"] : 0;
        $stmt = $conn->prepare("SELECT * FROM USER WHERE UserID = ? LIMIT 1");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {

        ?>
            <h1 class="text-center">Edit Users</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <!-- start Username Feild-->
                    <input type="hidden" name="userid" value="<?php echo $userid ?>">
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" autocomplete="off" class="form-control" value="<?php echo $row["Username"] ?>" required="required">
                        </div>
                    </div>
                    <!-- End Username Feild-->
                    <!-- start Password Feild-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="oldPassword" value="<?php echo $row["Password"] ?>">
                            <input type="password" name="newPassword" autocomplete="new-password" class="form-control" placeholder="Leave this Blank if You don't want to change password">
                        </div>
                    </div>
                    <!-- End Password Feild-->
                    <!-- start Email Feild-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" autocomplete="off" class="form-control" value="<?php echo $row["Email"] ?>" required="required">
                        </div>
                    </div>
                    <!-- End Email Feild-->
                    <!-- start Fullname Feild-->
                    <div class=" form-group form-group-lg">
                        <label class="col-sm-2 control-label">Fullname</label>
                        <div class="col-sm-10">
                            <input type="text" name="fullname" autocomplete="off" class="form-control" value="<?php echo $row["FullName"] ?>" required="required">
                        </div>
                    </div><br>
                    <!-- End Fullname Feild-->
                    <!-- start submit Feild-->
                    <div class=" form-group">

                        <div class="col-offset-2 col-sm-10">
                            <input type="submit" value="Save" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <!-- End Username Feild-->
                </form>
            </div>

        <?php
        } else {
            $theMsg = "There's Not Such Id ";
            redirectHome($theMsg);
        }
    } elseif ($do == "Add") { ?>

        <h1 class="text-center">Add New Users</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <!-- start Username Feild-->

                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username To Login Into Shop" required="required">

                    </div>
                </div>
                <!-- End Username Feild-->
                <!-- start Password Feild-->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">

                        <input type="password" name="password" autocomplete="new-password" class="password form-control" placeholder="Password Must be Hard & Complex" required="required">
                        <i class="show-pass fa fa-eye fa-2x"></i>
                    </div>
                </div>
                <!-- End Password Feild-->
                <!-- start Email Feild-->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Email Must be valid" required="required">
                    </div>
                </div>
                <!-- End Email Feild-->
                <!-- start Fullname Feild-->
                <div class=" form-group form-group-lg">
                    <label class="col-sm-2 control-label">Fullname</label>
                    <div class="col-sm-10">
                        <input type="text" name="fullname" autocomplete="off" class="form-control" placeholder="Full Name Appear in Your profile Page" required="required">
                    </div>
                </div><br>
                <!-- End Fullname Feild-->
                <!-- start submit Feild-->
                <div class=" form-group">

                    <div class="col-offset-2 col-sm-10">
                        <input type="submit" value="Add New Member" class="btn btn-danger btn-lg">
                    </div>
                </div>
                <!-- End Username Feild-->
            </form>
        </div>

        <?php
    } elseif ($do == "Delete") {
        echo '<h1 class="text-center">Delete Users</h1>';
        echo '<div class="container">';
        $userid = isset($_GET["userid"]) && is_numeric($_GET["userid"]) ? $_GET["userid"] : 0;
        $stmt = $conn->prepare("SELECT * FROM USER WHERE UserID = ? LIMIT 1");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $stmt = $conn->prepare("DELETE FROM USER WHERE UserID = :zuser");
            $stmt->bindParam(":zuser", $userid);
            $stmt->execute(); ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $count; ?></strong> Deleted Recorded
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
        <?php
        }
    } elseif ($do == "Insert") {
        //Insert Page
        echo "<h1 class='text-center'>Insert Users' Data</h1>";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["username"];
            $pass = $_POST["password"];
            $email = $_POST["email"];
            $name = $_POST["fullname"];
            $shaledPass = sha1($pass);
            echo "<div class='container'>";
            $formErrors = array();
            if (strlen($user) < 4) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Less than 4 Character </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }
            if (strlen($user) > 20) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be More than 20 Character </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }
            if (empty($user)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Username Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";;
            }
            if (empty($pass)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Password Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";;
            }
            if (empty($email)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }
            if (empty($name)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }

            foreach ($formErrors as $err) {

                echo $err;
            }

            if (empty($formErrors)) {
                // Insert data into the Database

                //! check if users Exist or Not
                $check = checkUesr("Username", "USER", $user);
                if ($check == 1) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' .
                        '<strong> sorry  , This Username is Exists 😿  </strong> ' .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                        '</div>';
                } else {

                    $stmt = $conn->prepare("INSERT INTO USER (Username,Password,Email,FullName,RegStatus,Date) VALUES (:zuser , :zpass , :zemail , :zname,1,now())");
                    $stmt->execute(array(
                        "zuser" => $user,
                        "zpass" => $shaledPass,
                        "zemail" => $email,
                        "zname" => $name,

                    ));
                    $count = $stmt->rowCount();

                    $theMsg = $count . " Recorded Inserted";


                    redirectHome($theMsg, "back");
                }
            } ?>
            </div>
            <?php
        } else {
            $errorMsg = "you can't reach to this page directly";
            redirectHome($errorMsg, 5);
        }
    } elseif ($do == "Update") {
        echo "<h1 class='text-center'>Update Users</h1>";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["userid"];
            $user = $_POST["username"];
            $email = $_POST["email"];
            $name = $_POST["fullname"];
            $pass = empty($_POST["newPassword"]) ? $_POST['oldPassword'] : sha1($_POST["newPassword"]);
            echo "<div class='container'>";
            $formErrors = array();
            if (strlen($user) < 4) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Less than 4 Character </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }
            if (strlen($user) > 20) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be More than 20 Character </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }
            if (empty($user)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";;
            }
            if (empty($email)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }
            if (empty($name)) {
                $formErrors[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' .
                    "<strong>Useranme Can't be Empty </strong>" .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                    "</div>";
            }

            foreach ($formErrors as $err) {

                echo $err;
            }

            if (empty($formErrors)) {
                // Update the Database
                $stmt = $conn->prepare("UPDATE USER SET Username =? , Email= ? , FullName =? , Password=? WHERE UserID = ?");
                $stmt->execute(array($user, $email, $name, $pass, $id));
                $count = $stmt->rowCount();



            ?>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $count; ?></strong> Record Updated
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php

            } ?>
            </div>
        <?php
        } else {
            $theMsg = "you can't reach to this page directly";
            redirectHome($theMsg, 5);
        }
    } elseif ($do = "Activate") {

        echo '<div class="container">';
        $userid = isset($_GET["userid"]) && is_numeric($_GET["userid"]) ? $_GET["userid"] : 0;
        $stmt = $conn->prepare("SELECT * FROM USER WHERE UserID = ? LIMIT 1");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $stmt = $conn->prepare("UPDATE USER SET RegStatus =1 WHERE UserID =?");
            $stmt->execute(array($userid));
            $theMsg = $count . " Updated Recorded";
        ?>


            <?php redirectHome($theMsg); ?>
            </div>
<?php

        }
    }
    include $tps . "footer.php";
} else {
    header("Location:index.php");
    exit();
}
