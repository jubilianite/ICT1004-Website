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
    } else {
        echo '<script>alert("Delete Record Failed.")</script>';
        echo '<script>history.back();</script>';
        //echo "Error deleting record: " . $conn->error;
    }
}
?>