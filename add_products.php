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
            <p>Hello Admin, please key in the details for your new product/service.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>

            <form action="add_products_next.php" method="post">
                <div class="form-group" role="main">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="productN"
                           name="productN" aria-label="Product Name" placeholder="Product Name">
                    
                    <label>Product Price</label>
                    <input type="number" class="form-control" id="productP"
                           name="productP" aria-label="Product Price" placeholder="$$$">

                    <label>Description</label>
                    <textarea class="form-control" id="productD"
                              name="productD" aria-label="Product Description"rows="3"></textarea>
                    <br>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>

                <a href="products.php"><button class="btn btn-primary">Back</button></a>


        </div>

    </body>
</html>
