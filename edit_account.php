<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <?php include "if_loggedin.php"; ?>
    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>
            <?php session_start(); ?>
            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-envelope"></span>
                    <h2><?php echo "Edit your account";
                                echo '<p>Here are your details, '. $_SESSION['username'].'</p>';?></h2>   
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <form action="" method="post">
                            <?php
                        session_start();
                        
                        $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $validUser = $_SESSION['username'];
                        $sql = 'SELECT * FROM user_accounts WHERE username = "'.$validUser.'"';
                        $result = $conn->query($sql);
                        if ($result > 0){
                            $row = $result->fetch_assoc();
                        }
                        ?>
                            <div class="row gtr-50">
                                <div class="col-6 col-12-mobile">
                                    <input type="text" name="username" value="<?php echo $row['username']; ?>" />
                                </div>
                                <div class="col-6 col-12-mobile">
                                    <input type="email" name="email" value="<?php echo $row['email'];?>" />
                                </div>
                                <div class="col-6 col-12-mobile">
                                    <input type="password" name="password" required minlength="8" id="password" placeholder="Your New Password" />
                                </div>
                                <div class="col-6 col-12-mobile">
                                    <input type="password" name="confirm_password" required minlength="8" id="confirm_password" placeholder="Confirm your New Password" />
                                </div>
                                <div class="col-12">
                                    <ul class="buttons">
                                        <li><input type="submit" name="submit_edit" class="special" value="Submit" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['submit_edit']))
                        {
                        session_start();
                        //ini_set('display_errors', 1);
                        //ini_set('display_startup_errors', 1);
                        //error_reporting(E_ALL);
                        $success = false; //By default: false   
                        $errorMsg = ""; //By default: Empty

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

                        //Check Email
                        if (!check_email($_POST["email"])) {
                            $errorMsg .= "<p>Please input a valid email address.</p>";
                            $success = false;
                        }

                        //Check Password // Temporarily disabled for convenience
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
                        function updateMemberToDB() {
                            global $username, $email, $hashed_password, $errorMsg, $success;
                            $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                            
                            $validUser = $_SESSION['username'];
                            $sql = 'SELECT * FROM user_accounts WHERE username = "' . $validUser . '"';
                            $result = $conn->query($sql);
                            if ($result > 0) {
                            $row = $result->fetch_assoc();}
                                // Create database connection.
                            
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                $sql = "UPDATE user_accounts SET username = '$username' , email = '$email' , password = '$hashed_password'"
                                        . "WHERE user_id = ".$row["user_id"];
                               
                                //$sql = "INSERT INTO user_accounts (username, first_name, last_name, email, password, membership)";
                                //$sql .= " VALUES ('$username', '$first_name', '$last_name', '$email', '$hashed_password', '$member')";
                                // Execute the query
                                if (mysqli_query($conn,$sql)) {
                                    $success = true;
                                    echo "<h4>Your details have been updated, " . $username . "</54>";
                                    
                                    
                                }
                                else {
                                    $errorMsg = "Database error: " . $conn->error;
                                    $errorMsg = "Execute failed: (" . $sql->errno . ") " . $sql->error;
                                    $success = false;   
                                }
                                $sql->close();
                            }
                            $conn->close();
                        }

                        $email = sanitize_input($_POST["email"]);
                        $username = sanitize_input($_POST["username"]);
                        $password = sanitize_input($_POST["password"]);
                        $confirm_password = sanitize_input($_POST["confirm_password"]);
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        updateMemberToDB();
                        
                        header("Location: /ICT1004/logout.php");
                        }
                        else{
                            echo 'Not working';
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