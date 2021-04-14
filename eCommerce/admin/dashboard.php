<?php

session_start();


if (isset($_SESSION["Username"])) {
    $pageTitle = "dashboard";
    include "init.php"; ?>
    <!-- start the dashboard Page-->

    <div class="home-stats">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-3">
                    <div class="stats st-numbers">
                        Total Numbers
                        <span>
                            <a href="users.php">
                                <?php echo countItems("UserID", "USER"); ?>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="stats st-pending">
                        Pending Numbers
                        <span>
                            <a href="users.php?do=Manage&page=Pending">
                                <?php echo countPendingItems("RegStatus", "USER") ?>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="stats st-items">
                        Total Items
                        <span>1500</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="stats st-comments">
                        Total Comments
                        <span>3500</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="latest">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <?php $LatestUser = 5;  ?>
                                <h5 class="modal-title">
                                    <i class="fa fa-users"></i>
                                    Latest <?php echo $LatestUser; ?> Registerd Users
                                </h5>

                            </div>
                            <div class="modal-body">
                                <ul class="list-unstyled latest-list">
                                    <?php
                                    foreach (getLatest("*", "USER", "UserID", $LatestUser) as $user) { ?>

                                        <li>
                                            <?php echo  $user["Username"] ?>
                                            <a href="users.php?do=Edit&userid=<?php echo $user["UserID"] ?>" class="btn btn-success pull-right">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>

                                            <?php
                                            if ($user["RegStatus"] == 0) { ?>
                                                <a href="users.php?do=Activate&userid=<?php echo $user["UserID"] ?>" class="btn btn-info pull-right">
                                                    <i class="fa fa-check-circle"></i>
                                                    Activate
                                                </a>
                                            <?php }
                                            ?>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-5">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fa fa-tag"></i>
                                    Latest Items
                                </h5>

                            </div>
                            <div class="modal-body">
                                <p>Test</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-2">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="model-title">
                                    <i class="fa fa-eye"></i>
                                    Viewers
                                </h5>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <?php echo viewer(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    //! End the dashboard Page
    include $tps . "footer.php";
} else {
    header("Location:index.php");
    exit();
}
