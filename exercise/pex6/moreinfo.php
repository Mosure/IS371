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
            $majors_query = "SELECT major.title FROM alumni, alum_major, major WHERE alumni.alum_id='$id' AND alum_major.alum_id = alumni.alum_id AND alum_major.major_id = major.major_id";

            $result = mysqli_query($conn, $query);
            $majors_result = mysqli_query($conn, $majors_query);

            if (!$result) {
                die("cannot processed select query");
            }

            if (!$majors_result) {
                die("Cannot process majors query.");
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

                    $major_num = mysqli_num_rows($majors_result);

                    if ($major_num > 0) {
                        while ($major_row = mysqli_fetch_assoc($majors_result)) {
                            $title = $major_row["title"];

                            echo "<div style='margin-left: 5em;'>$title</div>";
                        }
                    } else {
                        echo "<div>None</div>";
                    }
                }
            }
            else {
                echo "No rows found";
            }
        ?>
        <br><a href="detail.php">Back to Alumni Details</a>
    </body>
</html>
