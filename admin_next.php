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
            <?php session_start(); ?>
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h2>Login</h2>
                    <p>Not a member with us yet? Head to the <a href="signup.php">Sign Up </a>page now!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php

                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        function authenticate($username, $password) {
                            global $username, $password, $email, $errorMsg, $success;
                            // Create database connection.
                            $config = parse_ini_file('../../private/db-config.ini');
                            //$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                            $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                // Prepare the statement:
                                $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE role=?");
                                // Bind & execute the query statement:
                                $stmt->bind_param("s", $username);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                // Note that email field is unique, so should only have
                                // one row in the result set.
                                    $row = $result->fetch_assoc();
                                    $username = $row["username"];
                                    $email = $row["email"];
                                    $hashed_password = $row["password"];
                                    // Check if the password matches:
                                    if (!password_verify($_POST["password"], $hashed_password)) { //Enhancement: Change post to $password after sanitized.
                                        $errorMsg = "User not found or password doesn't match...";
                                        $success = false;
                                    } else {
                                        echo "<h4>Password login accepted. Redirecting you to our home page...</h4>";
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['email'] = $row['email'];
                                        $_SESSION['logged_in'] = true;
                                        $success = true;
                                    }
                                } else {
                                    $errorMsg = "Email not found or password doesn't match...";
                                    $success = false;
                                }
                                $stmt->close();
                            }
                            $conn->close();
                        }

                        $username = sanitize_input($_POST["username"]);
                        $password = sanitize_input($_POST["password"]);
                        authenticate($email, $password);
                        
                                                if ($success) {
                            echo "<p>Welcome back, " . $_SESSION['username'] . "</p>";
                            echo '<a href="index.php" class="button">Home</a>';
                            header( "refresh:5;url=adminpanel.php" );
                        } else {
                            echo "<h2><strong>Oops!</strong></h2>";
                            echo "<h3>The following input errors were detected:</h3>";
                            echo "<p>" . $errorMsg . "</p>";
                            echo '<button onclick="history.go(-1);">BACK</button>';
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