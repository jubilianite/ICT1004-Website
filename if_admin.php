<?php

session_start();

if (!(isset($_SESSION['logged_in']))) {
    header('Location: index.php');
    session_unset();
    session_destroy();
    $_SESSION = array();
    //If not logged in, redirect to index.php
} else if ($_SESSION['role'] == "admin") {
    //If admin, allow access
} else {
    header('Location: index.php');
    //If logged in but not admin, redirect to index.php
}
?>