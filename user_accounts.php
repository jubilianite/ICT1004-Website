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
            <h2>BEST User Accounts</h2>
            <p>Hello Admin, here are the list of your registered users.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>
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
                        <th>User ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    $sql = 'SELECT * FROM user_accounts';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $user_id = $row["user_id"];
                            $username = $row["username"];
                            $first_name = $row["first_name"];
                            $last_name = $row["last_name"];
                            $email = $row["email"];
                            $role = $row["role"];

                            echo '<tr>
                    <td>' . $user_id . '</td>
                    <td>' . $username . '</td>
                    <td>' . $first_name . '</td>
                    <td>' . $last_name . '</td>
                    <td>' . $email . '</td> 
                    <td>' . $role . '</td> 
                    <td>
                            <form action = "edit_user_accounts.php" method = "POST">
                            <button class="btn btn-success" name = "user_id" value = "' . $user_id . '"> Edit </button>
                            </form>
                    </td>
                        </tr>';
                        }
                    } else {
                        echo '<script>alert("0 Results Retrieved!")</script>';
                    }
                    ?>
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
