<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>
    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php session_start(); ?>
            <?php include "header.inc.php"; ?>
            <?php
            if (isset($_SESSION['logged_in'])) {
                header('Location: index.php');
                //If not logged in, redirect to index.php
            }
            ?>

            <!-- Main -->
            <article id="main" role="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h1>Login</h1>
                    <p>Not a member with us yet? Head to the <a href="signup.php">Sign Up </a>page now!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content" aria-level="1">
                        <?php
                        $success = false; //By default: false   
                        $errorMsg = ""; //By default: Empty

                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        function authenticate($username, $password) {
                            global $first_name, $last_name, $username, $email, $password, $errorMsg, $success;
                            // Create database connection.
                            $config = parse_ini_file('./../private/dbconfig.ini');
                            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                            // Check connection
                            if ($conn->connect_error) {
                                //$errorMsg .= "<p>Connection failed: " . $conn->connect_error . "</p>";
                                //$errorMsg .= "Execute failed: ( " . $conn->errno . " ) " . $conn->error;
                                $success = false;
                            } else {
                                // Prepare the statement:
                                $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username=?");
                                // Bind & execute the query statement:
                                $stmt->bind_param("s", $username);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $hashed_password = $row["password"];
                                    // Check if the password matches:
                                    if (!password_verify($password, $hashed_password)) {
                                        $errorMsg .= "User not found or password doesn't match...";
                                        $success = false;
                                    } else {
                                        echo "<h2>Password login accepted. Redirecting you to our home page...</h2>";
                                        $_SESSION['first_name'] = $row['first_name'];
                                        $_SESSION['last_name'] = $row['last_name'];
                                        $_SESSION['email'] = $row['email'];
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['role'] = $row['role'];
                                        $_SESSION['user_id'] = $row['user_id'];
                                        $_SESSION['logged_in'] = true;
                                        $success = true;

                                        //Logging
                                        date_default_timezone_set('Asia/Singapore');
                                        $date = date('Y-m-d H:i:s');
                                        $user = $_SESSION['username'];
                                        $data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully logged in with the IP address: " . $_SERVER['REMOTE_ADDR'];
                                        error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/access.log");
                                    }
                                } else {
                                    $errorMsg .= "Email not found or password doesn't match...";
                                    $success = false;
                                }
                                $stmt->close();
                            }
                            $conn->close();
                        }

                        $username = sanitize_input($_POST["username"]);
                        $password = sanitize_input($_POST["password"]);

                        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                            $secret = '6Lc8AOIZAAAAADqbS8qZqk6BZlc_kz-nzbKL8INw';
                            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                            $responseData = json_decode($verifyResponse);
                            if ($responseData->success) {
                                authenticate($username, $password);
                            }
                        } else {
                            $errorMsg .= "CAPTCHA verification failed, please try again.";
                            $success = false;
                        }

                        if ($success) {
                            echo "<p>Welcome back, " . $_SESSION['username'] . "</p>";
                            echo '<a href="index.php" class="button">Home</a>';
                            header("refresh:5;url=index.php");
                        } else {
                            echo "<h2><strong>Oops!</strong></h2>";
                            echo "<h3>Login failed for some reason.</h3>";
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