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

                <div>
                    <table class="table"> 

                        <thead>
                            <tr>
                                <td> Product ID </td>
                                <td> Product Name </td>
                                <td> Product Type </td>
                                <td> Product Price  </td>
                                <td> Description </td> 
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $sql = 'SELECT * FROM products';
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                    $product_id = $row["product_id"];
                                    $product_name = $row["product_name"];
                                    $product_type = $row["product_type"];
                                    $product_price = $row["product_price"];
                                    $description = $row["description"];

                                    echo '<tr>
                    <td>' . $product_id . '</td>
                    <td>' . $product_name . '</td>
                    <td>' . $product_type . '</td>
                    <td>' . $product_price . '</td>
                    <td>' . $description . '</td>  
                    <td>
                    <td>
                    <form action="edit.php" method="POST">
                          <button name="productid" value="'.$product_id.'"> Edit </button> 
                    </form> 
                    </td>
                    <td>
                    <form action ="" method="POST">
                        <button id="delete" name="delete" onclick="deleteAjax('.$product_id.')"> Delete </button> 
                    </form>
                    
                   
                    </td>
                    </td>
                    </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                            
                             <script type="text/javascript">
        //function to delete row
        function deleteAjax(id) {
            $.ajax({
                type: 'post',

                //call delete php file 
                url: 'edit_product.php',
                
                //post to delete php called $delete_id
                data: {delete: id},
                success: function (data) {
                    //hide the row after delete
                    $('#delete' + id).hide('slow');
                }
            });
        }
    </script>
                        </tbody> 
                    </table>
                </div>


                <?php
                if (isset($_POST['delete'])) {

                    $id = $_POST['delete'];

                    $mysql = "DELETE FROM products WHERE product_id='$id'";
                    //echo $mysql;
                    if ($conn->query($mysql) === true) {
                        echo "Product Deleted";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                    ?>

                    <?php
                } else {
                    //echo "Unable to delete product";
                }
                ?>
                <input type ="button" value="Add Product" onclick="window.location.href = 'http://54.157.165.148/AddProduct.php'">

            </article>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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