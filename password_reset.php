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
                        $passsuc = true;
                        $errorMsg = ""; 

                        function sanitize_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }
                        

                        function authenticate($email, $username) {
                            global $email, $username, $errorMsg, $success;
                            //Create database connection.
                            //$config = parse_ini_file('./../private/dbconfig.ini');
                            //$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                            // Check connection
                            $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                            if ($conn->connect_error) {                                
                                $errorMsg .= "<p>Connection failed: " . $conn->connect_error . "</p>";
                                $errorMsg .= "please check your internet connection";
                                $errorMsg .= "Execute failed: ( " . $conn->errno . " ) " . $conn->error;
                                $success = false;
                            } 
                            else 
                            {
                                // Prepare the statement:
                                $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username=?");
                                // Bind & execute the query statement:
                                $stmt->bind_param("s", $username);
                                $stmt->execute();                                
                                $user_result = $stmt->get_result();
                                if ($user_result->num_rows > 0) 
                                {   
                                    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE email=?");
                                    // Bind & execute the query statement:
                                    $stmt->bind_param("s", $email);
                                    $stmt->execute();                                
                                    $email_results = $stmt->get_result();
                                    if($email_results->num_rows > 0)
                                    {                                        
                                        $success = true;
                                    }
                                    else
                                    {
                                        //$errorMsg .= "Username or Email doesn't match...<br>";
                                        $success = false;
                                    }                                    
                                }    
                                else 
                                {
                                    //$errorMsg .= "Username or Email doesn't match...<br>";
                                    $success = false;
                                }
                                $stmt->close();
                            }
                            $conn->close();
                        }
                        
                        function update($Npassword,$username)
                        {                            
                            //global $password, $username, $errorMsg, $success;
                            //$connection = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best')or die("cannot connect");
                            $connection = mysqli_connect('localhost', 'sqldev', 'P@ssw0rd123!', 'best')or die("cannot connect");
                            $query = $connection->prepare("update user_accounts set password=? where username=?");
                            $query->bind_param('ss', $Npassword, $username);//bind the parameters
                            if ($query->execute())
                            {
                                $success = true;
                            }
                            else
                            {
                                $success = false;
                                $errorMsg .= "Password failed to change";
                            }
                        }
                        
                        
                      
                        $email = sanitize_input($_POST["email"]);                                         
                        $username = sanitize_input($_POST["username"]);
                        authenticate($email, $username);
                        $Npassword = sanitize_input($_POST["password"]);
                        $NN = sanitize_input($_POST["cfmpassword"]);
                       
                                 
                        if ($success == true) 
                        {
                            if($Npassword == $NN)
                            {   
                                $hashed_password = password_hash($Npassword, PASSWORD_DEFAULT);
                                update($hashed_password,$username);
                                echo "<h4>Your Password has been succesfully changed!</h4>";
                                echo '<ul class="buttons"><li><a href="login.php" class="button primary">Login</a></li></ul>';
                                echo '<ul class="buttons"><li><a href="index.php" class="button primary">Home</a></li></ul>';                                
                            }
                            else
                            {
                                echo "<h2><strong>Oops!</strong></h2>";
                                echo "<p>Password did not match</p>";
                                //echo "<a href=\"login.php\"button type=\"button\" class=\"btn btn-danger\">Login</button></a>";
                                echo '<ul class="buttons"><li><a href="login.php" class="button primary">Return to Login</a></li></ul>';
                            }
                        } 
                        else 
                        {
                            echo "<h2><strong>Oops!</strong></h2>";
                            echo "<p>Email or Username is wrong</p>";                            
                            echo '<ul class="buttons"><li><a href="login.php" class="button primary">Return to Login</a></li></ul>';
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