<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>

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
                        $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        //$validUser = mysql_real_escape_string($_SESSION['username']);
                        $validUser = $_SESSION['username'];
                        $sql = 'SELECT * FROM transaction_history WHERE username = "'.$validUser.'"';
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table><tr><th>ID</th><th>Name</th><th>Package</th><th>Service</th><th>Paid Amount</th></tr>";
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["transaction_id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["package"] . "</td><td>" . $row["service"] ."</td><td>" . $row["paid_amount"] . "</td></tr>";
                            }
                            echo "</table>";
                            
    
                        } else {
                            echo "0 results";
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