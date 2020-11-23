<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                    <?php session_start();
                    ?>
                    <h2><?php echo $_SESSION['username']. "'s Profile Page"; 
                    echo '<br/><a href="edit_account.php"><span class ="material-icons md-light" style="font-size:1em">edit</span></a>';?></h2>
                     
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <?php
                        session_start();
                        
                        $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $validUser = $_SESSION['username'];
                        $sql = 'SELECT * FROM user_accounts WHERE username = "'.$validUser.'"';
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo "<p>Welcome back, " . $_SESSION['last_name'] . ", you are a " .$row["role"]. " with us.</p>";
                        //$servername = "best";
                        //$username = "username";
                        //$password = "password";
                        //$dbname = "best";
                        // Create connection$servername
                        
                        // Check connection
                        
                        //$validUser = mysql_real_escape_string($_SESSION['username']);
                        
                        $sql = 'SELECT SUM(paid_amount) FROM transaction_history WHERE username = "'.$validUser.'"';
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $amount = $row['SUM(paid_amount)'] + 0;

                            echo "<p>Amount Contributed " .$amount. ".</p>";
                            
                            if($amount > 10000){
                                echo "<p>You are a Premium spender.</p>";
                            }
                            else if ($amount > 5000){
                                echo "<p>You are a Advanced spender.</p>";
                            }
                            else {
                                echo "<p>You are a basic spender.</p>";
                            }
                            
                        } else {
                            echo "0 results";
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