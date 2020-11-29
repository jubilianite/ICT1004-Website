<?php
echo '<script>alert("Payment Cancelled!")</script>';
header( "refresh:0;url=\index.php" );
?>
<?php
//Logging
date_default_timezone_set('Asia/Singapore');
$date = date('Y-m-d H:i:s');
$user = $_SESSION['username'];
$item_name = $_SESSION['product_name'];
$data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has failed to make a purchase for " . $item_name . " [" . $_SERVER['REMOTE_ADDR'] . "]";
error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/transaction.log");
?>