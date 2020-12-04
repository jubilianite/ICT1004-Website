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
                    <span class="icon solid fa-envelope"></span>
                    <h1><?php echo $_SESSION['username'] . "'s Profile Page"; ?></h1>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content" aria-level="1">
                        <form action= "" method="post">
                            <?php
                            $config = parse_ini_file('./../private/dbconfig.ini');
                            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $validUser = $_SESSION['username'];
                            $sql = 'SELECT * FROM user_accounts WHERE username = "' . $validUser . '"';
                            $result = $conn->query($sql);
                            if ($result > 0) {
                                $row = $result->fetch_assoc();
                            }
                            ?>
                            <div class="row gtr-50">
                                <div class="col-12">
                                    <strong>Email:</strong>
                                    <input type="email" name="email" aria-label="Email" required value="<?php echo $row['email']; ?>"/>
                                </div>

                                <div class="col-12">
                                    <ul class="buttons">
                                        <li><input type="submit" name="submit_edit" class="special" value="Change Email" /></li>
                                    </ul>
                                </div>                                
                            </div>
                        </form>
                    </div>

                    <?php
                    if (isset($_POST['submit_edit'])) {
                        $success = false; //By default: false   
                        $errorMsg = ""; //By default: Empty

                        //Function to ensure that email is in the correct syntax
                        function check_email($text) {
                            if (isset($text)) {
                                if (!empty($text) && preg_match("/[a-zA-Z0-9_\-]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}/", $text)) { //check email if it is in the correct syntax
                                    return TRUE;
                                }
                                return FALSE;
                            }
                        }

                        //Check Email
                        if (!check_email($_POST["email"])) {
                            echo '<script>alert("Please input a valid email.")</script>';
                            $success = false;
                        } else {
                            $success = true;
                        }

                        //Helper function that checks input for malicious or unwanted content.
                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        //Function to write user account credentials to DB
                        function updateMemberToDB() {
                            global $errorMsg, $success, $email;
                            $config = parse_ini_file('./../private/dbconfig.ini');
                            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

                            // Create database connection.
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            }
                            if ($success == false) {
                                header("refresh:0;url=edit_profile.php");
                            } else if ($success == true) {
                                $sql1 = "UPDATE user_accounts SET email = '$email'"
                                        . "WHERE user_id = " . $_SESSION["user_id"];

                                if (mysqli_query($conn, $sql1)) {
                                    echo '<script>alert("Your details have been updated successfully.")</script>';
                                    $_SESSION['email'] = $email;
                                    header("refresh:0;url=edit_profile.php");
                                    
                                    //Logging
                                    date_default_timezone_set('Asia/Singapore');
                                    $date = date('Y-m-d H:i:s');
                                    $user = $_SESSION['username'];
                                    $data = "\n" . $date . ": " . $user . " (" . $_SESSION['role'] . ") " . "has successfully changed her/her email! [" . $_SERVER['REMOTE_ADDR'] . "]";
                                    error_log(print_r($data, true), 3, $_SERVER['DOCUMENT_ROOT'] . "/edit.log");
                                } else {
                                    $errorMsg = "Database error: " . $conn->error;
                                    $errorMsg = "Execute failed: (" . $sql1->errno . ") " . $sql1->error;
                                    echo '<script>alert("An error occured.")</script>';
                                    echo '<script>console.log("' . $errorMsg . '")</script>';
                                    header("refresh:0;url=edit_profile.php");
                                }
                                $sql1->close();
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

                        updateMemberToDB();
                    }
                    ?>


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