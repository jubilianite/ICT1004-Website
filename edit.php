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
                    <h2>Edit Product Page</h2>

                </header>

<!--                <div class="container">-->
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
                        <main class="container">
                            <h1> Edit Product </h1>

                            <form action="" method="post">


                                <?php
                                if (!empty($_POST["productid"])) {
                                    echo "<label for='Product'> Product</label>";
                                    $id = $_POST["productid"];
                                    //echo $id;
                                    $sql = "SELECT * FROM products WHERE product_id = '$id'";

                                    if ($result = $conn->query($sql)) {
                                        while ($row = $result->fetch_assoc()) {
                                            $product_id = $row["product_id"];
                                            $product_name = $row["product_name"];
                                            $product_type = $row["product_type"];
                                            $product_price = $row["product_price"];
                                            $description = $row["description"];

                                            echo '<input type="hidden" id="productid" name="ProductID" value="' . $product_id . '" >';
                                            echo '<input type="text" id="productN" name="ProductName" value="' . $product_name . '" >';
                                            echo '<input type="text" id="productT" name="ProductType" value="' . $product_type . '" >';
                                            echo '<input type="text" id="productP" name="ProductPrice" value="' . $product_price . '" >';
                                            echo '<input type="text" id="productD" name="ProductDescription" value="' . $description. '" >';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    //$conn->close();
                                    ?>
                                
                                    <input type="submit" name="submit">
                                    <br>
                                    <?php
                                } else {
                                    //echo "no id found";
                                }
                                ?>
                                <input type ="button" value="Back" onclick="window.location.href = 'http://54.157.165.148/edit_product.php'">
                                </article>
                            </form>

                            <?php
                            $productID = "";
                            $productName = "";
                            $productType = "";
                            $productPrice = "";
                            $description = "";
                            $success = True;
                            if (isset($_POST['submit'])) {
                                $productID = $_POST['ProductID'];
                                if (!empty($_POST['ProductName'])) {
                                    $productName = $_POST['ProductName'];
                                } else {
                                    echo "product name is empty";
                                    $success = False;
                                }
                                if (!empty($_POST['ProductType'])) {
                                    $productType = $_POST['ProductType'];
                                } else {
                                    echo "product type is empty";
                                    $success = False;
                                }
                                if (!empty($_POST['ProductPrice'])) {
                                    $productPrice = $_POST['ProductPrice'];
                                } else {
                                    echo "product price is empty";
                                    $success = False;
                                }
                                 if (!empty($_POST['ProductDescription'])) {
                                    $description = $_POST['ProductDescription'];
                                } else {
                                    echo "product description is empty";
                                    $success = False;
                                }
                                if ($success == True) {
                                    //"UPDATE `best`.`products` SET `product_name` = '$productName' WHERE (`product_id` = '$productID')";
                                    $sql1 = "UPDATE products SET product_name='$productName' ,product_type='$productType' ,product_price='$productPrice', description='$description' WHERE product_id='$productID'";

                                    //$sql2 = "UPDATE best.products SET product_name='$productName' WHERE product_id ='$productID'";
                                    //echo $sql1;
                                    if ($conn->query($sql1) === true) {
                                        echo "Product has been updated";
                                        //echo $p;
                                    } else {
                                        echo "Product is empty1";
                                        //echo "Error updating record: " . $conn->error;
                                    }
                                } else {
                                    echo "Product is empty2";
                                }
                            }
                            ?>

                        </main>
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
    </div>
</body>
</html>