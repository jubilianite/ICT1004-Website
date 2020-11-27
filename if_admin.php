<?php

session_start();

if (!(isset($_SESSION['logged_in']))) {
    header('Location: index.php');
    session_unset();
    session_destroy();
    $_SESSION = array();
    //If not logged in, redirect to index.php
} else if ($_SESSION['role'] == "Admin") {
    //If admin, allow access
} else if ($_SESSION['role'] == "Banned") {
    echo '<script>alert("You have been banned by the administrator of BEST. For more information, please contact the administrator through our contact form.")</script>';
    echo '<script>history.back();</script>';
    header("refresh:0;url=index.php");
} else {
    header('Location: index.php');
    //If logged in but not admin, redirect to index.php
}
?>