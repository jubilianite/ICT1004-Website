<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BEST</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <?php include "if_admin.php"; ?>
    </head>
    <body>

        <div class="container">
            <h2>BEST Transactions</h2>
            <p>Hello Admin, please update your transaction details accordingly.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>
            <p></p>
            <?php
            $config = parse_ini_file('./../private/dbconfig.ini');
            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (!empty($_POST["transaction_id"])) {
                $id = $_POST["transaction_id"];
                $sql = "SELECT * FROM transaction_history WHERE transaction_id = '$id'";

                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $transaction_id = $row["transaction_id"];
                        $date_and_time = $row["date_and_time"];
                        $username = $row["username"];
                        $product_name = $row['product_name'];
                        $paid_amount = $row["paid_amount"];
                        $payment_method = $row["payment_method"];
                        $status = $row["status"];
                    }
                } else {
                    echo '<script>alert("0 Results Retrieved!")</script>';
                }
            }
            ?>


            <form action="edit_transactions_next.php" method="post">

                <input type="hidden" class="form-control" id="ProductID"
                       name="ProductID" value="<?php echo $product_id; ?>">

                <div class="form-group">
                    <label>Transaction ID</label>
                    <input readonly type="text" class="form-control" id="transaction_id"
                           name="transaction_id" value="<?php echo $transaction_id; ?>">
                </div>
                <div class="form-group">
                    <label>Date & Time</label>
                    <input readonly type="text" class="form-control" id="date_and_time"
                           name="date_and_time" value="<?php echo $date_and_time; ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input readonly type="text" class="form-control" id="username"
                           name="username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input readonly type="text" class="form-control" id="product_name"
                           name="product_name" value="<?php echo $product_name; ?>">
                </div>
                <div class="form-group">
                    <label>Paid Amount (SGD)</label>
                    <input readonly type="text" class="form-control" id="paid_amount"
                           name="paid_amount" value="<?php echo $paid_amount; ?>">
                </div>
                <div class="form-group">
                    <label>Payment Method</label>
                    <input readonly type="text" class="form-control" id="payment_method"
                           name="payment_method" value="<?php echo $payment_method; ?>">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="status" name="status">
                        <option>In Progress</option>
                        <option>Completed/Delivered</option>
                        <option>Refunded</option>
                        <option>Exchanged</option>
                        <option>Others</option>
                    </select>
                </div>


                <div class="form-group">
                    <button class="btn btn-success" value="submit" type="submit">Submit</button>
                </div>
            </form>
            <div class="form-group">
                <a href="transactions.php"><button class="btn btn-primary">Back</button></a>
            </div>

        </div>

    </body>
</html>