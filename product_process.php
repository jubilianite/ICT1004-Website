<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save'])) {
    $user_id = $_POST['product_id'];
    $username = $_POST['product_name'];
    $email = $_POST['product_type'];
    $transaction_id = $_POST['product_price'];

    $mysqli->query("INSERT into products (product_id) VALUES('$product_id')") or die($mysqli->error());
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM products WHERE id=$id") or die($mysqli->error());
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM products WHERE id=$id") or die($mysqli->error());
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $username = $_POST['product_id'];
        $email = $_POST['product_name'];
        $transaction_id = $_POST['product_type'];
        $paid_amount = $_POST['product_price'];
    }
}