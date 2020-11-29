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
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>                    
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php
                        $success = true;
                        $errorMsg = "";

                        $email = sanitize_input($_POST["email"]);
                        $username = sanitize_input($_POST["username"]);
                        $password_raw = $_POST["password"];
                        $password = sanitize_input($_POST["password"]);
                        $confirm_password = sanitize_input($_POST["confirm_password"]);
                        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                        //Function to ensure that password meets our requirements
                        function check_password($text) {
                            if (isset($text)) {
                                if (empty($text)) {
                                    return FALSE;
                                }
                                if (preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/", $text) == 0) { //Password must be at least 8 characters and must contain at least one alphabet and one digit
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
                            $errorMsg .= "<p>Please input a valid username</p>";
                            //echo '<script>alert("Please input a valid username.")</script>';
                            //echo '<script>history.back();</script>';
                            $success = false;
                        }

                        //Check Email
                        if (!check_email($_POST["email"])) {
                            $errorMsg .= "<p>Please input a valid email address</p>";
                            //echo '<script>alert("Please input a valid email address.")</script>';
                            //echo '<script>history.back();</script>';
                            $success = false;
                        }

                        //Check Password //
                        if (!check_password($_POST["password"])) {
                            $errorMsg .= "<p>Your new password do not meet our requirements. Please choose a different password.</p>";
                            //echo '<script>alert("Your new password do not meet our requirements. Please choose a different password.")</script>';
                            //echo '<script>history.back();</script>';
                            $success = false;
                        }

                        //Check if passwords match
                        if ($_POST["password"] != $_POST["confirm_password"]) {
                            $errorMsg .= "<p>Your passwords do not match.</p>";
                            //echo '<script>alert("Your passwords do not match.")</script>';
                            //echo '<script>history.back();</script>';
                            $success = false;
                        }

                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        // Create database connection.
                        $config = parse_ini_file('./../private/dbconfig.ini');
                        $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                        // Check connection
                        if ($conn->connect_error) {
                            //$errorMsg .= "<p>Connection failed: " . $conn->connect_error . "</p>";
                            //$errorMsg .= "Execute failed: ( " . $conn->errno . " ) " . $conn->error;
                            echo '<script>alert("A Database Error occured.")</script>';
                            echo '<script>history.back();</script>';
                        } else if ($success == false) {
                            echo "<h2><strong>Oops!</strong></h2>";
                            echo $errorMsg;
                            echo '<button onclick="history.go(-1);">BACK</button>';
                        } else if ($success == true) {

                            // Prepare the statement:
                            $username = $_POST['username'];
                            $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username=?");
                            // Bind & execute the query statement:
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $dbemail = $row['email'];
                                compareEmail();
                                $stmt->close();
                            } else {
                                $errorMsg .= "<p>Your Email or Username is wrong or non existent</p>";
                                //echo '<script>alert("Your Email or Username is wrong or non existent")</script>';
                                //echo '<script>history.back();</script>';
                                $success = false;
                                echo "<h2><strong>Oops!</strong></h2>";
                                echo $errorMsg;
                                echo '<button onclick="history.go(-1);">BACK</button>';
                            }
                            $conn->close();
                        }

                        function compareEmail() {
                            global $dbemail;
                            if ($_POST["email"] != $dbemail) {
                                $errorMsg .= "<p>Your Email or Username is wrong or non existent</p>";
                                //echo '<script>alert("Your Email or Username is wrong or non existent")</script>';
                                //echo '<script>history.back();</script>';
                                $success = false;
                                echo "<h2><strong>Oops!</strong></h2>";
                                echo $errorMsg;
                                echo '<button onclick="history.go(-1);">BACK</button>';
                            } else {
                                $success = true;
                                updateMemberToDB();
                            }
                        }

                        //Function to write user account credentials to DB
                        function updateMemberToDB() {
                            global $errorMsg, $success, $username, $password, $confirm_password, $hashed_password;
                            $config = parse_ini_file('./../private/dbconfig.ini');
                            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

                            // Create database connection.
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg .= "Connection failed: " . $conn->connect_error;
                                $success = false;
                            }
                            if ($success == false) {
                                echo "<h2><strong>Oops!</strong></h2>";
                                echo $errorMsg;
                                echo '<button onclick="history.go(-1);">BACK</button>';
                            } else if ($success == true) {
                                $sql1 = "UPDATE user_accounts SET password='$hashed_password' WHERE username='$username'";

                                if (mysqli_query($conn, $sql1)) {
                                    echo '<script>alert("Your details have been updated successfully.")</script>';
                                    header("refresh:0;url=login.php");
                                    

//Logging
date_default_timezone_set('Asia/Singapore');
$date = date('Y-m-d H:i:s');
$user = $_SESSION['username'];
$data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully reset her/her password! [" . $_SERVER['REMOTE_ADDR'] . "]";
error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/edit.log");

                                } else {
                                    $errorMsg2 .= "Database error: " . $conn->error;
                                    $errorMsg2 .= "Execute failed: (" . $sql1->errno . ") " . $sql1->error;
                                    echo '<script>alert("An error occured.")</script>';
                                    echo '<script>console.log("' . $errorMsg2 . '")</script>';
                                    echo $errorMsg;
                                }
                                $sql1->close();
                            }
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