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
                    <span class="icon solid fa-user-alt"></span>
                    <h2>SIGN UP</h2>
                    <p>Already a member with us? Head to the <a href="login.php">Login </a>page now!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php
                        $success = true; //By default: True   
                        $errorMsg = ""; //By default: Empty

                        //Function to ensure that input contains only alphabets and spaces (if any)
                        function check_firstname($text) {
                            if (isset($text)) {
                                if (!empty($text) && preg_match("/^([A-Za-z ])*$/", $text)) { //a-z A-Z and spaces only
                                    return TRUE;
                                }
                                return FALSE;
                            }
                        }

                        //Function to ensure that input contains only alphabets and spaces (if any)
                        function check_lastname($text) {
                            if (isset($text)) {
                                if (!empty($text) && preg_match("/^([A-Za-z ])*$/", $text)) { //a-z A-Z and spaces only
                                    return TRUE;
                                }
                                return FALSE;
                            }
                        }

                        //Function to ensure that password meets our requirements
                        function check_password($text) {
                            if (isset($text)) {
                                if (empty($text)) {
                                    return FALSE;
                                }
                                if (preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/", $text) === 0) { //Password must be at least 8 characters and must contain at least one alphabet and one digit
                                    return FALSE;
                                }
                                return TRUE;
                            }
                        }

                        //Function to ensure that username contains 8 characters and above
                        function check_username($text) {
                            if (isset($text)) {
                                if (!empty($text) && preg_match("/^[a-zA-Z0-9 ]{8,}/", $text)) { //check username 8 character & above
                                    return TRUE;
                                }
                                return FALSE;
                            }
                        }

                        //Function to ensure that email is in the correct syntax
                        function check_email($text) {
                            if (isset($text)) {
                                if (!empty($text) && preg_match("/[a-zA-Z0-9_\-]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}/", $text)) { //check email if it is in the correct syntax
                                    return TRUE;
                                }
                                return FALSE;
                            }
                        }

                        //Check Username
                        if (!check_username($_POST["username"])) {
                            $errorMsg .= "<p>Please input a valid username. A valid username must be at least 8 characters and only contain alphanumeric characters only.</p>";
                            $success = false;
                        }

                        //Check First Name
                        if (!check_firstname($_POST["first_name"])) {
                            $errorMsg .= "<p>Please input a valid first name. A valid name only contain alphabetic letter and spaces.</p>";
                            $success = false;
                        }

                        //Check Last Name
                        if (!check_lastname($_POST["last_name"])) {
                            $errorMsg .= "<p>Please input a valid last name. A valid name only contain alphabetic letter and spaces.</p>";
                            $success = false;
                        }

                        //Check Email
                        if (!check_email($_POST["email"])) {
                            $errorMsg .= "<p>Please input a valid email address.</p>";
                            $success = false;
                        }

                        //Check Password
                        //if (!check_password($_POST["password"])) {
                        //    $errorMsg .= "<p>Please input a valid password that contains at least 8 characters, one lower case letter, one upper case letter and one digit.</p>";
                        //    $success = false;
                        //}
                        
                        //Check if passwords match
                        if ($_POST["password"] != $_POST["confirm_password"]) {
                            $errorMsg .= "<p>Your passwords do not match.</p>";
                            $success = false;
                        }

                        //Helper function that checks input for malicious or unwanted content.
                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        //Function to write user account credentials to DB
                        function saveMemberToDB() {
                            global $username, $first_name, $last_name, $email, $hashed_password, $errorMsg, $member, $success;
                            // Create database connection.
                            $config = parse_ini_file('/../../private/dbconfig.ini');
                            //$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                            $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best'); 
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                $sql = $conn->prepare("INSERT INTO user_accounts (username, first_name, last_name, email, password, membership) VALUES (?,?,?,?,?,?)");
                                $sql->bind_param("ssssss", $username, $first_name, $last_name, $email, $hashed_password, $member);
                                //$sql = "INSERT INTO user_accounts (username, first_name, last_name, email, password, membership)";
                                //$sql .= " VALUES ('$username', '$first_name', '$last_name', '$email', '$hashed_password', '$member')";
                                // Execute the query
                                if (!$sql->execute()) {
                                    $errorMsg = "Database error: " . $conn->error;
                                    $errorMsg = "Execute failed: (" . $sql->errno . ") " . $sql->error;
                                    $success = false;
                                    echo $errorMsg;
                                }
                                $sql->close();
                            }
                            $conn->close();
                        }

                        $email = sanitize_input($_POST["email"]);
                        $username = sanitize_input($_POST["username"]);
                        $first_name = sanitize_input($_POST["first_name"]);
                        $last_name = sanitize_input($_POST["last_name"]);
                        $password = sanitize_input($_POST["password"]);
                        $confirm_password = sanitize_input($_POST["confirm_password"]);
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $member = "member";

                        if ($success) {
                            echo "<h4>Thank you for signing up, " . $first_name . "</h4>";
                            echo "<p>Your username is: " . $username . "</p>";
                            echo '<a href="login.php" class="button">Login</a>';
                            saveMemberToDB(); //Enhancement: Should finish this function before success.
                            echo "<p>" . $errorMsg . "</p>"; //Change all to console.log afterwards
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