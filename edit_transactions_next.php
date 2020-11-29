<?php include "if_admin.php"; ?>
<?php

$config = parse_ini_file('./../private/dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $success = False;
}
$transaction_id = $_POST['transaction_id'];
$status = $_POST['status'];

if (!empty($_POST['transaction_id'])) {
    $success = True;
} else {
    $success = False;
}

if ($success == True) {
    $sql1 = "UPDATE transaction_history SET status='$status' WHERE transaction_id='$transaction_id'";

    //echo $sql1;
    if ($conn->query($sql1) === true) {
        echo '<script>alert("Transaction updated successfully. Redirecting you back...")</script>';
        header("refresh:0;url=transactions.php");

        //Logging
        date_default_timezone_set('Asia/Singapore');
        $date = date('Y-m-d H:i:s');
        $user = $_SESSION['username'];
        $data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully edited TRANSACTION " . $transaction_id . "'s status" . " [" . $_SERVER['REMOTE_ADDR'] . "]";
        error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/admin_edit.log");
    } else {
        echo '<script>alert("A Database Error occured.")</script>';
        echo '<script>history.back();</script>';
        //echo "Error updating record: " . $conn->error;
    }
} else {
    echo '<script>alert("A Database Error occured.")</script>';
    echo '<script>history.back();</script>';
}
?>