<style>
    .navbar {
        color: #FFF;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">
            <?php echo lang("HOME_ADMIN") ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="category.php">
                        <?php echo lang("CATEGORIES") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <?php echo lang("ITEMS") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="users.php">
                        <?php echo lang("MEMBERS") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <?php echo lang("STATISTICS") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <?php echo lang("LOGS") ?>
                    </a>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-slider" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ahmed
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbar-slider">
                        <li><a class="dropdown-item" href="users.php?do=Edit&userid=<?php echo $_SESSION["ID"] ?>">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="logout.php">logout</a></li>
                    </ul>
                </li>
            </ul>


        </div>




    </div>
    </div>
</nav>