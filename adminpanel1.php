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
        
            <!-- Header -->
            <?php include "header.inc.php"; ?>
            
<!--            <div class="row justify-content-center">
                <form action ="process.php" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="name" class="form-control" value="Edit your username">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="save">Update</button>
                    </div>
                </form>
            </div>-->
            
            <div class="container">
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

            $sql = 'SELECT * '
            . 'FROM user_accounts, transaction_history '
            . 'WHERE role ="member" AND user_accounts.user_id = transaction_history.user_id';
            $result = $conn->query($sql);
            ?>
            
            <div class="row justify-content-center">
                <table class="table"> 
                    <thead>
                        <tr> 
                            <th> Username </th>
                            <th> Email </th>
                            <th> Transaction ID </th>
                            <th> Paid Amount  </th>
                            <th> Package </th>
                            <th> Payment Method </th>
                        </tr>
                    </thead>

                    <?php
                    // output data of each row
                    while ($row = $result->fetch_assoc()) :
                    ?>
                    <tr>
                        <td> <?php echo $row["username"]; ?> </td>
                        <td> <?php echo $row["email"]; ?> </td>
                        <td> <?php echo $row["transaction_id"]; ?> </td>
                        <td> <?php echo $row["paid_amount"]; ?> </td>
                        <td> <?php echo $row["package"]; ?> </td>
                        <td> <?php echo $row["payment_method"]; ?> </td>
                        <td>
                            <a href ="process.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info">Edit</a>
                               <a href ="process.php?delete=<?php echo $row['id']; ?>"
                               class="btn btn-info">Delete</a>    
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    }  

                    $conn->close();
                    ?>
                </table>
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