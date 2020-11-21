<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h2>Admin Panel</h2>
                </header>

                    <!-- Content -->
<!--                    <div class="content">
                        <form action="login_next.php" method="post">
                            <div class="row gtr-50">
                        </form>
                    </div>-->

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
                    ?>

                    <div>
                        <table class="table"> 

                            <thead>
                                <tr>
                                    <td> Username </td>
                                    <td> Email </td>
                                    <td> Transaction ID </td>
                                    <td> Product Type </td>
                                    <td> Paid Amount  </td>
                                    <td> Payment Method </td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = 'SELECT * '
                                        . 'FROM user_accounts, transaction_history '
                                        . 'WHERE role ="member" AND user_accounts.user_id = transaction_history.user_id';
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $username = $row["username"];
                                        $email = $row["email"];
                                        $transaction_id = $row["transaction_id"];
                                        $product_type = $row['product_type'];
                                        $paid_amount = $row["paid_amount"];
                                        $payment_method = $row["payment_method"];



                                        echo '<tr>
                    <td>' . $username . '</td>
                    <td>' . $email . '</td>
                    <td>' . $transaction_id . '</td>
                    <td>' . $product_type . '</td>
                    <td>' . $paid_amount . '</td>
                    <td>' . $payment_method . '</td>
                    <td>
                    <td>
                    </tr>';
                                    }
                                } else {
                                    echo "0 results";
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
            </article>

            <!-- Footer -->
            <?php include "footer.inc.php"; ?>

        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/jquery.scrollgress.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>