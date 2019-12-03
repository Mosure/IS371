<html>
    <head>
        <title>IS371 - pex7</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php
            include('auth.inc.php');
            include('connect.inc.php');

            $query = "SELECT * FROM alumni ORDER BY last_name";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("cannot processed select query");
            }

            $num = mysqli_num_rows($result);

            if ($num > 0) {
                echo "<table border=1>";

                echo "<tr>";

                echo "<td>ID</td>";
                echo "<td>Prefix</td>";
                echo "<td>First Name</td>";
                echo "<td>Last Name</td>";
                echo "<td>Target</td>";
                echo "<td>Active</td>";
                echo "<td></td>";
                echo "<td></td>";

                echo "</tr>";

                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    if (($i % 2) == 0) {
                        echo "<tr>";
                    } else {
                        echo "<tr bgcolor='#bbb'>";
                    }

                    echo "<td>".$row["alum_id"]."</td>";
                    echo "<td>".$row["prefix"]."</td>";
                    echo "<td>".$row["first_name"]."</td>";
                    echo "<td>".$row["last_name"]."</td>";
                    echo "<td>".$row["target"]."</td>";
                    echo "<td>".$row["active"]."</td>";

                    $id = $row["alum_id"];

                    echo "<td><a href=moreinfo.php?key=$id>Details</a></td>";
                    echo "<td><a href=update.php?key=$id>Update</a></td>";

                    echo "</tr>";

                    $i++;
                }

                echo "</table>";
            }
            else {
                echo "No rows found";
            }
        ?>
    </body>
</html>
