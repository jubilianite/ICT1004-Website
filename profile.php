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
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h2><?php echo $_SESSION['username'] . "'s Profile Page"; ?></h2>

                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php
                        $config = parse_ini_file('./../private/dbconfig.ini');
                        $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $validUser = $_SESSION['username'];
                        $sql = 'SELECT * FROM user_accounts WHERE username = "' . $validUser . '"';
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo "<p>Hello! " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . ", thanks for staying as a " . $row["role"] . " with us!</p>";

                        $sql = 'SELECT SUM(paid_amount) FROM transaction_history WHERE username = "' . $validUser . '"';
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $amount = $row['SUM(paid_amount)'] + 0;

                            echo "<p>Amount Contributed: $" . $amount . ".</p>";

                            if ($amount > 10000) {
                                echo "<p>Wow! You are a Premium spender with us!</p>";
                            } else if ($amount > 5000) {
                                echo "<p>Wow! You are a Faithful spender with us!</p>";
                            } else {
                                echo "<p>You are a Basic spender with us.</p>";
                            }
                        } else {
                            //echo "0 results";
                        }
                        $conn->close();
                        ?>
                        <ul class="buttons"><li><a href="edit_profile.php" class="button primary">Edit Profile</a></li></ul>

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