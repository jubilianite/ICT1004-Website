<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-heart"></span>
                    <h2>THANK YOU!</h2>
                    <p>We will contact you via your registered email soon to discuss about the specific requirements!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php
                        $transaction_id = $_REQUEST['tx']; // Paypal Transaction ID
                        $price = $_REQUEST['amt']; // Paypal Received Amount
                        $currency = $_REQUEST['cc']; // Paypal Currency Type
                        $payment_method = "Paypal";
                        $username = $_SESSION['username'];
                        $date = date('Y-m-d H:i:s');
                        $service = $_SESSION['service']; // E.g. Video Editing
                        $package = $_SESSION['package']; // E.g. Premium
                        $item_name = $_SESSION['item_name']; // E.g. BEST Video Editing Basic Package
                        $errorMsg = "";

                        $config = parse_ini_file('/../../private/dbconfig.ini');
                        //$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                        $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');

                        $stmt = $conn->prepare("INSERT INTO `transaction_history` (`transaction_id`, `date_and_time`, `username`, `service`, `package`, `paid_amount`, `currency`, `payment_method`) VALUES (?,?,?,?,?,?,?,?)");
                        $stmt->bind_param('sssssiss', $transaction_id, $date, $username, $service, $package, $price, $currency, $payment_method);
                        //$stmt->execute();
                        if ($conn->connect_error) {
                            $errorMsg = "Connection failed: " . $conn->connect_error;
                        } else {
                            //$stmt = $conn->prepare("INSERT INTO 'transaction_history' ('transaction_id', 'date_and_time', 'username', 'service', 'package', 'paid_amount', 'currency', 'payment_method') VALUES (?,?,?,?,?,?,?,?)");
                            //$stmt->bind_param('sssssiss', $transaction_id, $date, $username, $service, $package, $price, $currency, $payment_method);
                            // Execute the query
                            if ($stmt->execute()) {
                                echo "<h3><strong>Transaction ID: </strong>" . $transaction_id . "</h3>";
                            } else {
                                $errorMsg = "Database error: " . $conn->error;
                                $errorMsg = "Execute failed: (" . $sql->errno . ") " . $sql->error;
                                echo $errorMsg;
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