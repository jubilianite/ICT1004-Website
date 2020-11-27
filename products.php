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
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
    </style>
    <body>

        <div class="container">
            <h2>BEST Products & Services</h2>
            <p>Hello Admin, here are the list of your products.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>
            <a class="btn btn-primary" href="add_products.php" role="button">Add Products</a>
            <p></p>


            <?php
            $config = parse_ini_file('./../private/dbconfig.ini');
            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            ?>

            <!-- Search Bar -->
            <div class="md-form active-pink active-pink-2 mb-3 mt-0">
                <input class="form-control" id="search" type="text" placeholder="Search here"> 
            </div>
            <br>

            <table class = "table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    $sql = 'SELECT * FROM products';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $product_id = $row["product_id"];
                            $product_name = $row["product_name"];
                            $product_price = $row["product_price"];
                            $description = $row["description"];

                            echo '<tr>
                    <td>' . $product_id . '</td>
                    <td>' . $product_name . '</td>
                    <td>' . $product_price . '</td>
                    <td>' . $description . '</td>  
                    <td>
                            <form action = "edit_products.php" method = "POST">
                            <button class="btn btn-success" name = "productid" value = "' . $product_id . '"> Edit </button>
                            </form>
                    </td>
                    <td>
                            <form method = "POST">
                            <button class="btn btn-danger" name = "delete" onclick = "deleteAjax(' . $product_id . ')"> Delete </button>
                            </form>
                    </td>
                        </tr>';
                        }
                    } else {
                        echo '<script>alert("0 Results Retrieved!")</script>';
                    }
                    ?>

                <script type="text/javascript">
                    //function to delete row
                    function deleteAjax(id) {
                        $.ajax({
                            type: 'post',

                            //call delete php file 
                            url: 'delete_products.php',

                            //post to delete php called $delete_id
                            data: {delete: id},
                            success: function (data) {
                                //hide the row after delete
                                $('#delete' + id).hide('slow');
                            }
                        });
                    }
                </script>
                <script>
                    $(document).ready(function () {
                        $("#search").on("keyup", function () {
                            var value = $(this).val().toLowerCase();
                            $("#table tr").filter(function () {
                                $(this).toggle($(this).text()
                                        .toLowerCase().indexOf(value) > -1)
                            });
                        });
                    });
                </script> 

                </tbody>
            </table>
        </div>

    </body>
</html>
