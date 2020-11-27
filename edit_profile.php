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
                        global $first_name, $last_name, $username, $email, $user_id;
                        // Create database connection.
                        $config = parse_ini_file('./../private/dbconfig.ini');
                        $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                        // Check connection
                        if ($conn->connect_error) {
                            //$errorMsg .= "<p>Connection failed: " . $conn->connect_error . "</p>";
                            //$errorMsg .= "Execute failed: ( " . $conn->errno . " ) " . $conn->error;
                            echo '<script>alert("A Database Error occured.")</script>';
                        } else {
                            // Prepare the statement:
                            $username = $_SESSION['username'];
                            $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username=?");
                            // Bind & execute the query statement:
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                $email = $row['email'];
                                $username = $row['username'];
                                $user_id = $row['user_id'];
                                $stmt->close();
                            }
                            $conn->close();
                        }
                        ?>
                        <div class="row justify-content-center">
                            <table class="table"> 
                                <tr> 
                                    <th> First Name: </th>
                                    <th> <?php echo $first_name; ?> </th>
                                    <th> <a href ="edit_name.php">Edit</a> </th>
                                </tr>
                                <tr> 
                                    <th> Last Name: </th>
                                    <th> <?php echo $last_name; ?> </th>
                                    <th> <a href ="edit_name.php">Edit</a> </th>
                                </tr>
                                <tr> 
                                    <th> Email: </th>
                                    <th> <?php echo $email; ?> </th>
                                    <th> <a href ="edit_email.php">Edit</a> </th>
                                </tr>  
                                <tr> 
                                    <th> Password: </th>
                                    <th>********</th>
                                    <th> <a href ="edit_password.php">Edit</a> </th>
                                </tr>  
                            </table>                                

                        </div>

                    </div>
                </section>

                        <!--Footer-->
                        <?php include "footer.inc.php"; ?>

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