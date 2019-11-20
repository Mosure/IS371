<html>
    <head>
        <title>IS371 - pex6</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php
            $id = $_GET['key'];

            // Pull from conf
            $myUserName = getenv("DB_USER");
            $myPassword = getenv("DB_PASSWORD");
            $myLocalHost = getenv("DB_HOST");
            $myDB = getenv("DB_NAME");

            $conn = mysqli_connect($myLocalHost, $myUserName, $myPassword, $myDB);

            if (!$conn) {
                die("Connection failed!");
            }

            $query = "SELECT * FROM alumni WHERE alum_id='$id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("cannot processed select query");
            }

            $num = mysqli_num_rows($result);

            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $alum_id = $row["alum_id"];
                    $prefix = $row["prefix"];
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $gradyear = $row["gradyear"];
                    $home_address = $row["home_address"];
                    $home_city = $row["home_city"];
                    $home_state = $row["home_state"];
                    $home_zip = $row["home_zip"];
                    $home_phone = $row["home_phone"];
                    $cell_phone = $row["cell_phone"];
                    $email = $row["email"];
                    $target = $row["target"];
                    $active = $row["active"];
                    $comments = $row["comments"];

                    echo "<div style='font-weight: bold;'>$prefix $first_name $last_name</div>";
                    echo "<div>Address: $home_address</div>";
                    echo "<div>$home_city, $home_state $home_zip</div>";
                    echo "<div>Home Phone: $home_phone</div>";
                    echo "<div>Cell Phone: $cell_phone</div>";
                    echo "<div>Email: $email</div>";
                    echo "<div>Comments: $comments</div>";
                    echo "<div>Target Sponsor: $target</div>";
                    echo "<div>Active: $active</div>";

                    echo "<div>Majors:</div>";

                }
            }
            else {
                echo "No rows found";
            }
        ?>
        <br><a href="detail.php">Back to Alumni Details</a>
    </body>
</html>
