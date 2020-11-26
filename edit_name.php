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

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-envelope"></span>
                    <h2><?php echo $_SESSION['username'] . "'s Profile Page"; ?></h2>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
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

                                <div class="col-6 col-12-mobile">
                                    <strong>First Name:</strong>
                                    <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" />
                                </div>
                                <div class="col-6 col-12-mobile">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="last_name" required  value="<?php echo $row['last_name']; ?>"/>
                                </div>

                                <div class="col-12">
                                    <ul class="buttons">
                                        <li><input type="submit" name="submit_edit" class="special" value="Change Name" /></li>
                                    </ul>
                                </div>                                
                            </div>
                        </form>
                    </div>

                    <?php
                    if (isset($_POST['submit_edit'])) {
                        $success = false; //By default: false   
                        $errorMsg = ""; //By default: Empty

                        //Function to ensure that username contains 8 characters and above
                        function check_last_name($text) {
                            if (isset($text)) {
                                if (!empty($text) && preg_match("/^[a-zA-Z]{1,}/", $text)) {
                                    return TRUE;
                                }
                                return FALSE;
                            }
                        }

                        //Check Username
                        if (!check_last_name($_POST["last_name"])) {
                            $errorMsg .= "<p>Please input a valid last name. </p>";
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
                            global $errorMsg, $success, $first_name, $last_name;
                            $config = parse_ini_file('./../private/dbconfig.ini');
                            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

                            // Create database connection.
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                $sql1 = "UPDATE user_accounts SET first_name = '$first_name' , last_name = '$last_name'"
                                        . "WHERE user_id = " . $_SESSION["user_id"];

                                if (mysqli_query($conn, $sql1)) {
                                    $success = true;
                                    echo '<script>alert("Your details have been updated successfully.")</script>';
                                    $_SESSION['first_name'] = $first_name;
                                    $_SESSION['last_name'] = $last_name;
                                    header("refresh:0;url=profile.php");
                                } else {
                                    $errorMsg = "Database error: " . $conn->error;
                                    $errorMsg = "Execute failed: (" . $sql1->errno . ") " . $sql1->error;
                                    echo '<script>alert("An error occured.")</script>';
                                    echo '<script>console.log("' . $errorMsg . '")</script>';
                                    header("refresh:0;url=profile.php");
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