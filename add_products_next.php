<?php include "if_admin.php"; ?>
<?php

$config = parse_ini_file('./../private/dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo '<script>alert("Database Connection Failed")</script>';
}

$productN = "";
$productP = "";
$productD = "";
$success = true;


if (!empty($_POST["productN"])) {
    $productN = $_POST['productN'];
    $productN = sanitize_input($_POST["productN"]);
} else {
    echo '<script>alert("Product Name is empty!")</script>';
    $success = False;
}

if (!empty($_POST["productP"])) {
    $productP = $_POST['productP'];
    $productP = sanitize_input($_POST["productP"]);
} else {
    echo '<script>alert("Product Price is empty!")</script>';
    $success = False;
}

if (!empty($_POST["productD"])) {
    $productD = $_POST['productD'];
    $productD = sanitize_input($_POST["productD"]);
} else {
    echo '<script>alert("Product Description is empty!")</script>';
    $success = False;
}

if ($success) {
    //saveMemberToDB();
    //echo "<h4>Product added successfully!</h4>";
    $sql = "INSERT INTO products (product_name, product_price, description) VALUES ('$productN', '$productP', '$productD')";
    //echo $sql; //For Troubleshooting purposes
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Product/Service added successfully. Redirecting you back...")</script>';

        //Logging
        date_default_timezone_set('Asia/Singapore');
        $date = date('Y-m-d H:i:s');
        $user = $_SESSION['username'];
        $data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully added a new product: " . $_POST["productN"] . "" . " [" . $_SERVER['REMOTE_ADDR'] . "]";
        error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/admin_edit.log");

        echo '<script>history.back();</script>';
    } else {
        echo '<script>alert("A Database Error occured.")</script>';
        echo '<script>history.back();</script>';
    }
} else {
    echo '<script>alert("An error occured.")</script>';
    echo '<script>history.back();</script>';
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>