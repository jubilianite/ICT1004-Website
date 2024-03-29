<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <?php include "if_loggedin.php"; ?>
    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main" role="main">

                <header class="special container">
                    <span class="icon solid fa-heart"></span>
                    <h1>THANK YOU!</h1>
                    <p>We have received your payment. We will contact you via your registered email soon to discuss about the specific requirements!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content" aria-level="1"> 
                        <?php
                        $transaction_id = $_REQUEST['tx']; // Paypal Transaction ID
                        $price = $_REQUEST['amt']; // Paypal Received Amount
                        $currency = $_REQUEST['cc']; // Paypal Currency Type
                        $payment_method = "Paypal";
                        $username = $_SESSION['username'];
                        $user_id = $_SESSION['user_id'];
                        date_default_timezone_set('Asia/Singapore');
                        $date = date('Y-m-d H:i:s');
                        $item_name = $_SESSION['product_name']; // E.g. Video Editing Basic Package
                        $errorMsg = "";

                        $config = parse_ini_file('./../private/dbconfig.ini');
                        $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

                        $stmt = $conn->prepare("INSERT INTO `transaction_history` (`transaction_id`, `date_and_time`, `user_id`, `username`, `paid_amount`, `product_name`, `currency`, `payment_method`) VALUES (?,?,?,?,?,?,?,?)");
                        $stmt->bind_param('ssisisss', $transaction_id, $date, $user_id, $username, $price, $item_name, $currency, $payment_method);
                        //$stmt->execute(); //For troubleshooting purposes.
                        if ($conn->connect_error) {
                            //$errorMsg .= "<p>Connection failed: " . $conn->connect_error . "</p>"; //Reserved for troubleshooting purposes
                            //echo $errorMsg; //Reserved for troubleshooting purposes
                            echo "A Database error occured. We will seek to rectify this as soon as possible.";
                        } else {
                            // Execute the query
                            if ($stmt->execute()) {
                                echo "<p><strong>Transaction ID: </strong>" . $transaction_id . "</p>";
                                echo "<p><strong>Product/Service: </strong>" . $item_name . "</p>";
                                echo "<p><strong>Date & Time: </strong>" . $date . "</p>";
                                echo "<p><strong>Amount Paid: </strong>" . $price . " " . $currency . "</p>";
                            } else {
                                //$errorMsg .= "Database error: " . $conn->error . "<br/>";
                                //$errorMsg .= "Execute failed: " . $conn->errno . "<br/>";
                                //echo $errorMsg;
                                echo "A Database error occured. We will seek to rectify this as soon as possible.";
                            }
                            $stmt->close();
                            $conn->close();
                        }
                        ?>
                    </div>

                </section>

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

<?php
//Logging
date_default_timezone_set('Asia/Singapore');
$date = date('Y-m-d H:i:s');
$user = $_SESSION['username'];
$item_name = $_SESSION['product_name'];
$data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully made a purchase for " . $item_name . " [" . $_SERVER['REMOTE_ADDR'] . "]";
error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/transaction.log");
?>