<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>
        <?php include "if_loggedin.php"; ?>
    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php session_start(); ?>
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h2>Transaction History</h2>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php
                        session_start();
                        echo "<p>Welcome back, " . $_SESSION['username'] . ", here are your transactions: " . "</p>";
                        //$servername = "best";
                        //$username = "username";
                        //$password = "password";
                        //$dbname = "best";
                        // Create connection$servername
                        $config = parse_ini_file('./../private/dbconfig.ini');
                        $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        //$validUser = mysql_real_escape_string($_SESSION['username']);
                        $validUser = $_SESSION['username'];
                        $sql = 'SELECT * FROM transaction_history WHERE username = "' . $validUser . '"';
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table><tr><th>ID / Product</th><th>Date & Time</th><th>Paid Amount</th></tr>";
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo
                                "<tr>"
                                . "<td>"
                                . $row["transaction_id"]
                                . "</td>"
                                . '<td rowspan="2">'
                                . $row["date_and_time"]
                                . '</td><td rowspan="2">'
                                . $row["paid_amount"]
                                . "</td></tr>"
                                . "<tr><td>"
                                . $row["product_name"]
                                . "</td></tr>"
                                . "<tr><td>&nbsp;</td></tr>"; //1 Empty Row
                            }
                            echo "</table>";
                        } else {
                            echo "You have no transactions with us at the moment";
                        }

                        $conn->close();
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