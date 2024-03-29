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
            <h1>BEST User Accounts</h1>
            <p>Hello Admin, please update your user's details accordingly.</p>
            <a class="btn btn-success" href="index.php" role="button">Return to Homepage</a>
            <p></p>
            <?php
            $config = parse_ini_file('./../private/dbconfig.ini');
            $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (!empty($_POST["user_id"])) {
                $id = $_POST["user_id"];
                $sql = "SELECT * FROM user_accounts WHERE user_id = '$id'";

                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $user_id = $row["user_id"];
                        $username = $row["username"];
                        $first_name = $row["first_name"];
                        $last_name = $row["last_name"];
                        $email = $row["email"];
                        $role = $row["role"];
                    }
                } else {
                    echo '<script>alert("0 Results Retrieved!")</script>';
                }
            }
            ?>


            <form action="edit_user_accounts_next.php" method="post">

                <input type="hidden" class="form-control" id="user_id"
                       name="user_id" aria-label="User ID" value="<?php echo $user_id; ?>">

                <div class="form-group" role="main">
                    <label>Username</label>
                    <input readonly type="text" class="form-control" id="username"
                           name="username" aria-label="Username" value="<?php echo $username; ?>">

                    <label>First Name</label>
                    <input type="text" class="form-control" id="first_name"
                           name="first_name" aria-label="First Name" value="<?php echo $first_name; ?>">

                    <label>Last Name</label>
                    <input type="text" class="form-control" id="last_name"
                           name="last_name" aria-label="Last Name" value="<?php echo $last_name; ?>">

                    <label>Email</label>
                    <input type="email" class="form-control" id="email"
                           name="email" aria-label="Email" value="<?php echo $email; ?>">

                    <label>Role</label>
                    <select class="form-control" aria-label="Role" id="role" name="role">
                        <!--<option value="" selected disabled hidden>Choose here</option>-->
                        <option>Member</option>
                        <!--<option>Admin</option>-->
                        <option>Banned</option>
                    </select>
                    <br>
                    <button class="btn btn-success" value="submit" type="submit">Submit</button>
                </div>
            </form>

                <a href="user_accounts.php"><button class="btn btn-primary">Back</button></a>


        </div>

    </body>
</html>