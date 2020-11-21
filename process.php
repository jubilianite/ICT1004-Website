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
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $transaction_id = $_POST['transaction_id'];
    $paid_amount = $_POST['paid_amount'];
    $package = $_POST['package'];
    $payment_method = $_POST['payment_method'];

    $mysqli->query("INSERT into user_account (user_id) VALUES('$user_id')") or die($mysqli->error());
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM user_account, transaction_history WHERE id=$id") or die($mysqli->error());
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM user_accounts WHERE id=$id") or die($mysqli->error());
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $username = $_POST['username'];
        $email = $_POST['email'];
        $transaction_id = $_POST['transaction_id'];
        $paid_amount = $_POST['paid_amount'];
        $package = $_POST['package'];
        $payment_method = $_POST['payment_method'];
    }
}