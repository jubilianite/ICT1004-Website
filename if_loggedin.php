<?php

session_start();

if (!(isset($_SESSION['logged_in']))) {
    session_unset();
    session_destroy();
    $_SESSION = array();
    header('Location: login.php');
} else if ($_SESSION['role'] == "Banned") {
    echo '<script>alert("You have been banned by the administrator of BEST. For more information, please contact the administrator through our contact form.")</script>';
    echo '<script>history.back();</script>';
    header("refresh:0;url=index.php");
    
}
?>