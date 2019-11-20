<html>
    <head>
        <title>IS371 - pex6</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <form action="search.php" method="post">
            First Name :
            <input name="first" type="text" id="first" size="20">
            <br />
            Last Name :
            <input name="last" type="text" id="last" size="20">
            <input type="submit" name="submit1" value="Search">
            <input type="submit" name="submit2" value="Select All">
        </form>

        <?php
            if ($_POST['submit1'] || $_POST['submit2'] ) {
                // Pull from conf
                $myUserName = getenv("DB_USER");
                $myPassword = getenv("DB_PASSWORD");
                $myLocalHost = getenv("DB_HOST");
                $myDB = getenv("DB_NAME");

                $conn = mysqli_connect($myLocalHost, $myUserName, $myPassword, $myDB);

                if (!$conn) {
                    die("Connection failed!");
                }

                $query = "SELECT * FROM alumni WHERE 1";

                if ($_POST['submit1']) {
                    $search_f_name = trim($_POST['first']);
                    $search_l_name = trim($_POST['last']);

                    if ($search_f_name !== '') {
                        $query = $query." AND first_name = '$search_f_name'";
                    }

                    if ($search_f_name !== '') {
                        $query = $query." AND last_name = '$search_l_name'";
                    }
                }

                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("cannot processed select query");
                }

                $num = mysqli_num_rows($result);

                if ($num > 0) {
                    echo "<table border=1>";

                    echo "<tr>";

                    echo "<td>Last Name</td>";
                    echo "<td>Prefix</td>";
                    echo "<td>First Name</td>";
                    echo "<td>MI</td>";
                    echo "<td>Target</td>";
                    echo "<td>Active</td>";
                    echo "<td></td>";

                    echo "</tr>";

                    $i = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        if (($i % 2) == 0) {
                            echo "<tr>";
                        } else {
                            echo "<tr bgcolor='#bbb'>";
                        }

                        echo "<td>".$row["last_name"]."</td>";
                        echo "<td>".$row["prefix"]."</td>";
                        echo "<td>".$row["first_name"]."</td>";
                        echo "<td>".$row["middle_name"]."</td>";
                        echo "<td>".$row["target"]."</td>";
                        echo "<td>".$row["active"]."</td>";

                        $id = $row["alum_id"];

                        echo "<td><a href=moreinfo.php?key=$id>Details</a></td>";

                        echo "</tr>";

                        $i++;
                    }

                    echo "</table>";
                }
                else {
                    echo "No rows found";
                }
            }
        ?>
    </body>
</html>
