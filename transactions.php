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
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
    </style>
    <body>

        <div class="container">
            <h2>BEST Transactions</h2>
            <p>Hello Admin, here your transactions.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>
            <p></p>

            <?php
            $config = parse_ini_file('./../private/dbconfig.ini');
            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            ?>

            <table class = "table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date & Time</th>
                        <th>Username</th>
                        <th>User Email</th>
                        <th>Product/Service Name</th>
                        <th>Paid Amount (SGD)</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'SELECT * '
                            . 'FROM user_accounts, transaction_history '
                            . 'WHERE role ="member" AND user_accounts.user_id = transaction_history.user_id';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $transaction_id = $row["transaction_id"];
                            $date_and_time = $row["date_and_time"];
                            $username = $row["username"];
                            $email = $row["email"];
                            $product_name = $row['product_name'];
                            $paid_amount = $row["paid_amount"];
                            $payment_method = $row["payment_method"];
                            $status = $row["status"];

                            echo '<tr>
                    <td>' . $transaction_id . '</td>
                    <td>' . $date_and_time . '</td>
                    <td>' . $username . '</td>
                    <td>' . $email . '</td>  
                    <td>' . $product_name . '</td> 
                    <td>' . $paid_amount . '</td> 
                    <td>' . $payment_method . '</td> 
                    <td>' . $status . '</td> 
                    <td>
                            <form action = "edit_transactions.php" method = "POST">
                            <button class="btn btn-success" name = "transaction_id" value = "' . $transaction_id . '"> Edit </button>
                            </form>
                    </td>
                        </tr>';
                        }
                    } else {
                        echo '<script>alert("0 Results Retrieved!")</script>';
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </body>
</html>
