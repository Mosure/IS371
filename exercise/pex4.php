<html>
    <head>
        <title>Accessing the Users table for Alumni</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <h1>This is the list of users in the table</h1><br/>
        <?php
            // Pull from conf
            $myUserName = getenv("DB_USER");
            $myPassword = getenv("DB_PASSWORD");
            $myLocalHost = getenv("DB_HOST");
            $myDB = getenv("DB_NAME");

            $conn = mysqli_connect($myLocalHost, $myUserName, $myPassword, $myDB);

            if (!$conn) {
                die("Connection failed: $myUserName @ $myLocalHost DB = $myDB ERR = ".mysqli_connect_error()." ERRNUM = ".mysqli_connect_errno());
            }

            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("cannot processed select query");
            }

            $num = mysqli_num_rows($result);

            if ($num > 0) {
                echo "<table border=1>";

                echo "<tr>";

                echo "<td>Last Name</td>";
                echo "<td>First Name</td>";
                echo "<td>Admin</td>";
                echo "<td>Phone</td>";
                echo "<td>Cell</td>";
                echo "<td>Email</td>";

                echo "</tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";

                    echo "<td>".$row["last_name"]."</td>";
                    echo "<td>".$row["first_name"]."</td>";
                    echo "<td>".$row["admin"]."</td>";
                    echo "<td>".$row["phone"]."</td>";
                    echo "<td>".$row["cell"]."</td>";
                    echo "<td>".$row["email"]."</td>";

                    echo "</tr>";
                }

                echo "</table>";
            }
            else {
                echo "No rows found";
            }
        ?>
    </body>
</html>
