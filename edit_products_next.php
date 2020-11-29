<?php include "if_admin.php"; ?>
<?php

$config = parse_ini_file('./../private/dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productID = "";
$productName = "";
$productPrice = "";
$description = "";
$success = True;

if (!empty($_POST['ProductID'])) {
    $productID = $_POST['ProductID'];
} else {
    echo '<script>alert("Product ID is not set!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}

if (!empty($_POST['ProductName'])) {
    $productName = $_POST['ProductName'];
} else {
    echo '<script>alert("Product Name is empty!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}
if (!empty($_POST['ProductPrice'])) {
    $productPrice = $_POST['ProductPrice'];
} else {
    echo '<script>alert("Product Price is empty!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}
if (!empty($_POST['ProductDescription'])) {
    $description = $_POST['ProductDescription'];
} else {
    echo '<script>alert("Product Description is empty!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}
if ($success == True) {
    //"UPDATE `best`.`products` SET `product_name` = '$productName' WHERE (`product_id` = '$productID')";
    //$sql1 = "UPDATE products SET product_name='$productName' ,product_price='$productPrice', description='$description' WHERE product_id='$productID'";
    $sql1 = "UPDATE products SET product_name='$productName' ,product_price='$productPrice', description='$description' WHERE product_id='$productID'";

    //echo $sql1;
    if ($conn->query($sql1) === true) {
        echo '<script>alert("Product/Service updated successfully. Redirecting you back...")</script>';
        //header('Location: products.php');
        header("refresh:0;url=products.php");

        //Logging
        date_default_timezone_set('Asia/Singapore');
        $date = date('Y-m-d H:i:s');
        $user = $_SESSION['username'];
        $data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully updated " . $_POST['ProductName'] . "'s details" . " [" . $_SERVER['REMOTE_ADDR'] . "]";
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