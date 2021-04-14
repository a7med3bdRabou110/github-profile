<?php

// Start The Session 
session_start();

// Unset The Session
session_unset();

// Destory The Session
session_destroy();

header("location:index.php");

exit();
