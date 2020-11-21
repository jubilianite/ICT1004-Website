<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>

    <body class="index is-preload">
        <div id="page-wrapper">
            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <article id="main">
                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h2>Add New Product</h2>

                </header>


                <?php
                $servername = "localhost";
                $username = "username";
                $password = "password";
                $dbname = "myDB";


// Create connection
                $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd123!', 'best');
// Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                ?>
                <!--                </head>-->
                <main class="container">
                    <hr>
                    <br> <br>

                    <?php
                    $productID = "";
                    $productN = "";
                    $productT = "";
                    $productP = "";
                    $success = true;

                    if (!empty($_POST["productID"])) {
                        $productID = $_POST['productID'];
                        $productID = sanitize_input($_POST["productID"]);
                    } else {
                        echo "Product ID is empty";
                        $success = False;
                    }

                    if (!empty($_POST["productN"])) {
                        $productN = $_POST['productN'];
                        $productN = sanitize_input($_POST["productN"]);
                    } else {
                        echo "Product Name is empty";
                        $success = False;
                    }

                    if (!empty($_POST["productT"])) {
                        $productT = $_POST['productT'];
                        $productT = sanitize_input($_POST["productT"]);
                    } else {
                        echo "Product Type is empty";
                        $success = False;
                    }

                    if (!empty($_POST["productP"])) {
                        $productP = $_POST['productP'];
                        $productP = sanitize_input($_POST["productP"]);
                    } else {
                        echo "Product Price is empty";
                        $success = False;
                    }

                    if ($success) {
                        saveMemberToDB();
                        echo "<h4>Product added successfully!</h4>";
//              first character of input will be caps
                        echo "<p>Redirecting back" . ".";
                        header("refresh:5;url=edit_product.php");
                        echo "<p> </p>";
                    } else {
                        echo "<h4>Oops!</h4>";
                        echo "<h4>The following input errors were detected:</h4>";
                        echo "<p>" . $errorMsg . "</p>";
                        echo '<button class="btn btnlor"> <a href="register.php">Return to Sign Up </a> </button>';
                    }

                    function sanitize_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    function saveMemberToDB() {
                        global $productN, $productT, $productP, $success;
                        // Create database connection.
                        $config = parse_ini_file('../../private/db-config.ini');
                        $conn = new mysqli($config['servername'], $config['username'],
                                $config['password'], $config['dbname']);
                        // Check connection
                        if ($conn->connect_error) {
                            $errorMsg = "Connection failed: " . $conn->connect_error;
                            $success = false;
                        } else {
                            // Prepare the statement:
                            $stmt = $conn->prepare("INSERT INTO products (product_id, product_name, product_type, product_price) VALUES (?,?, ?, ?)");
                            // Bind & execute the query statement:
                            $stmt->bind_param("issi", $productID, $productN, $productP, $productT, $pwd_hashed);
                            if (!$stmt->execute()) {
                                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                                $success = false;
                            }
                            $stmt->close();
                        }
                        $conn->close();
                    }
                    ?>
                    <br> <br>
                </main>
            </article>
    </body>
</html>