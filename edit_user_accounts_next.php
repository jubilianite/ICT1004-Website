<?php include "if_admin.php"; ?>
<?php

$config = parse_ini_file('./../private/dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = "";
$username = "";
$first_name = $_POST['first_name'];
$last_name = "";
$email = "";
$role = "";
$success = True;

if (!empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
} else {
    echo '<script>alert("User ID is not set!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}

if (!empty($_POST['last_name'])) {
    $last_name = $_POST['last_name'];
} else {
    echo '<script>alert("Last Name is empty!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    echo '<script>alert("Email is empty!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}

if (!empty($_POST['role'])) {
    $role = $_POST['role'];
} else {
    echo '<script>alert("Role is not set!")</script>';
    echo '<script>history.back();</script>';
    $success = False;
}

if ($success == True) {
    //"UPDATE `best`.`products` SET `product_name` = '$productName' WHERE (`product_id` = '$productID')";
    //$sql1 = "UPDATE products SET product_name='$productName' ,product_price='$productPrice', description='$description' WHERE product_id='$productID'";
    $sql1 = "UPDATE user_accounts SET first_name='$first_name' , last_name='$last_name', email='$email', role='$role' WHERE user_id='$user_id'";

    //echo $sql1;
    if ($conn->query($sql1) === true) {
        echo '<script>alert("User Particulars updated successfully. Redirecting you back...")</script>';
        header("refresh:0;url=user_accounts.php");
    } else {
        echo '<script>alert("A Database Error occured.")</script>';
        echo '<script>history.back(-2);</script>';
        //echo "Error updating record: " . $conn->error;
    }
} else {
    echo '<script>alert("A Database Error occured.")</script>';
    echo '<script>history.back(-2);</script>';
}
?>