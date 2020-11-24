<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>
    </head>

    <body>
        <?php include "header.inc.php"; ?>

        <main class="container">
            <article id="main">
                <h1>Add New Product</h1>

                <form action="process_addproduct.php" method="post">
                    <div class="form-group">
                        <label for="productN">Product Name: </label>
                        <input class="form-control" type="text" id="productN"
                               name="productN" placeholder="Enter the new product">
                    </div>
                    <div class="form-group">
                        <label for="productT">Product Type: </label>
                        <input class="form-control" type="text" id="productT"
                               name="productT" placeholder="Enter the product type">
                    </div>
                    <div class="form-group">
                        <label for="productP">Product Price: </label>
                        <input class="form-control" type="text" id="productP"
                               name="productP" placeholder="Enter the product price">
                    </div>
                    
                      <div class="form-group">
                        <label for="productD">Product Description: </label>
                        <input class="form-control" type="text" id="productD"
                               name="productD" placeholder="Enter the product description">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                <button class="btn btn-primary" type="back" onclick="window.location.href = 'http://54.157.165.148/edit_product.php'">Back</button>
            </article>
        </main>
    </body>
</html>
