<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BEST</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <?php include "if_admin.php"; ?>
    </head>
    <body>

        <div class="container" role="banner">
            <h1>BEST Products & Services</h1>
            <p>Hello Admin, please update your product details accordingly.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>
            <p></p>
            <?php
            $config = parse_ini_file('./../private/dbconfig.ini');
            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (!empty($_POST["productid"])) {
                $id = $_POST["productid"];
                $sql = "SELECT * FROM products WHERE product_id = '$id'";

                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row["product_id"];
                        $product_name = $row["product_name"];
                        $product_price = $row["product_price"];
                        $description = $row["description"];
                    }
                } else {
                    echo '<script>alert("0 Results Retrieved!")</script>';
                }
            }
            ?>


            <form action="edit_products_next.php" method="post">
                
                    <input type="hidden" aria-label="Product ID" class="form-control" id="ProductID"
                           name="ProductID" value="<?php echo $product_id; ?>">

                <div class="form-group" role="main">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="ProductName"
                           name="ProductName" aria-label="Product Name" value="<?php echo $product_name; ?>">

                    <label>Product Price</label>
                    <input type="number" class="form-control" id="ProductPrice" name="ProductPrice" aria-label="Product Price" value="<?php echo $product_price; ?>">

                    <label>Description</label>
                    <textarea class="form-control" id="ProductDescription"
                              name="ProductDescription" aria-label="Description" rows="3"><?php echo $description; ?></textarea>
                    <br>
                    <button class="btn btn-success" value="submit" type="submit">Submit</button>
                </div>
            </form>

                <a href="products.php"><button class="btn btn-primary">Back</button></a>


        </div>

    </body>
</html>