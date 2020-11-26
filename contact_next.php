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
            <?php include "header.inc.php"; ?> 
            <article id="main">
                
                                <header class="special container">
                    <span class="icon solid fa-envelope"></span>
                    <h2>Get In Touch</h2>
                    <p>Want to get in touch? We'd love to hear from you. Here's how you can reach us...</p>
                </header>
                <section class="wrapper style4 special container medium">
                    <div class="content">
                        <?php

                        function savecontactToDB() {
                            global $name, $email, $subject, $Division, $message, $errorMsg, $success;
                            // Create database connection.
                            //config = parse_ini_file('../../private/db-config.ini');
                            //$conn = new mysqli($config['servername'], $config['username'],
                            //        $config['password'], $config['dbname']);
                            $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                // Prepare the statement:

                                $stmt = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");
                                // Bind & execute the query statement:
                                $stmt->bind_param("sssss", $name, $email, $subject, $message);
                                if (!$stmt->execute()) {
                                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                                    $success = false;
                                    //echo"<br>failed";
                                }
                                $stmt->close();
                            }
                            $conn->close();
                        }

                        //Helper function that checks input for malicious or unwanted content.
                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $subject = $_POST["subject"];
                        $message = $_POST["message"];
                        $errorMsg = "";
                        $emailmsg = "";
                        $success = true;

                        if (empty($_POST["name"])) {
                            $errorMsg .= "A Name is required.<br>";
                            $success = false;
                        } else {
                            $name = sanitize_input($_POST["name"]);
                        }

                        if (empty($_POST["email"])) {
                            $errorMsg .= "A Contact Email is required.<br>";
                            $success = false;
                        } else {
                            $email = sanitize_input($_POST["email"]);
                            // Additional check to make sure e-mail address is well-formed.
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $errorMsg .= "Invalid email format.<br>";
                                $success = false;
                            }
                        }

                        if (empty($_POST["subject"])) {
                            $errorMsg .= "A Subject is required.<br>";
                            $success = false;
                        } else {
                            $subject = sanitize_input($_POST["subject"]);
                        }

                        if (empty($_POST["message"])) {
                            $errorMsg .= "A Message is required.<br>";
                            $success = false;
                        } else {
                            $message = sanitize_input($_POST["message"]);
                        }

                        if ($success) {
                            savecontactToDB();
                            echo "<p>Thank you for contacting us, $name</p>";
                            echo "<p>We will get back to you as soon as possible via the email you have provided</p>";
                            echo "<p>Your Email: " . $email . "</p>";
                            //echo '<button onclick="history.go(-1);">BACK</button>';
                            //echo '<button onclick=<a href="index.php"</a>">BACK</button>';
                            echo '<ul class="buttons"><li><a href="index.php" type="submit" class="special">Home</a></li></ul>';
                        } else {
                            echo "<h1> Oops!</h1>";
                            echo "<h4>An error has occured :</h4>";
                            echo "<p>" . $errorMsg . "</p>";
                            echo '<ul class="buttons"><li><a href="contact.php" type="submit" class="special">Contact Us Again</a></li></ul>';
                        }
                        ?>
                    </div>    
                </section>    
            </article>
                        <?php include "footer.inc.php"; ?>
        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>