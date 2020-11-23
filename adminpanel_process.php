<!DOCTYPE html>
<html>
    <body>

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

        $sql = "SELECT * FROM user_accounts where role ='member'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<br> id: " . $row["user_id"] . " - Name: " . $row["username"] . " " . $row["lastname"] . "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>

    </body>
</html>