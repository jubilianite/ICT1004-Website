<?php include "if_admin.php"; ?>
<?php

$config = parse_ini_file('./../private/dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {

    $id = $_POST['delete'];

    $mysql = "DELETE FROM products WHERE product_id='$id'";
    //echo $mysql;
    if ($conn->query($mysql) === true) {
        echo '<script>alert("Product Deleted")</script>';
        echo '<script>history.back();</script>';

        //Logging
        date_default_timezone_set('Asia/Singapore');
        $date = date('Y-m-d H:i:s');
        $user = $_SESSION['username'];
        $data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully deleted Product (ID:" . $id . ")" . " [" . $_SERVER['REMOTE_ADDR'] . "]";
        error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/admin_edit.log");
    } else {
        echo '<script>alert("Delete Record Failed.")</script>';
        echo '<script>history.back();</script>';
        //echo "Error deleting record: " . $conn->error;
    }
}
?>