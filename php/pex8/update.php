<html>
    <head>
        <title>IS371 - pex7</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php
            include('auth.inc.php');
            include('connect.inc.php');

            $id = $_GET['key'];

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

                            echo "<div style='margin-left: 3em;'>$title</div>";
                        }
                    } else {
                        echo "<div style='margin-left: 3em;'>None</div>";
                    }

                    echo "<form action='update.php?key=$id' method='post'>";

                    echo "Street: <input name='street' type='text' id='street' value='$home_address' size='20'><br/>";
                    echo "City: <input name='city' type='text' id='city' value='$home_city' size='20'><br/>";
                    echo "State: <input name='state' type='text' id='state' value='$home_state' size='20'><br/>";
                    echo "Zip: <input name='zip' type='text' id='zip' value='$home_zip' size='20'><br/>";
                    echo "Email: <input name='email' type='text' id='email' value='$email' size='20'><br/>";

                    echo "<br/><select name='add_major'><option value='' selected>None</option>";

                    $major_query = "SELECT * from major";
                    $result_majors = mysqli_query($conn, $major_query);
                    $num_majors = mysqli_num_rows($result_majors);

                    while ($major_row = mysqli_fetch_assoc($result_majors)) {
                        $title = $major_row['title'];
                        $majorId = $major_row['major_id'];

                        echo "<option value='$majorId'>$title</option><br/>";
                    }

                    echo "</select><input type='submit' name='add_major_post' value='Add'><input type='submit' name='delete_major_post' value='Delete'><br/>";

                    echo '</select><input type="submit" name="updatePost" value="Update"></form>';
                }
            }
            else {
                echo "No rows found";
            }
        ?>

        <?php
            include('connect.inc.php');
            
            $id = $_GET['key'];

            if ($_POST['updatePost']) {
                $new_street = $_POST['street'];
                $new_city = $_POST['city'];
                $new_state = $_POST['state'];
                $new_zip = $_POST['zip'];
                $new_email = $_POST['email'];

                $query = "UPDATE alumni SET home_address='$new_street', home_city='$new_city', home_state='$new_state', home_zip='$new_zip', email='$new_email' WHERE alum_id='$id'";

                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("cannot processed update query");
                }
            }

            if ($_POST['add_major_post']) {
                $maj_id = $_POST['add_major'];

                $sql_addMaj = "INSERT INTO alum_major VALUES ('$id', '$maj_id')";

                $result = mysqli_query($conn, $sql_addMaj);

                if (!$result) {
                    die("cannot processed insert query");
                }
            }

            if ($_POST['delete_major_post']) {
                $maj_id = $_POST['add_major'];

                $sql_delMaj = "DELETE FROM alum_major WHERE alum_id='$id' AND major_id='$maj_id'";

                $result = mysqli_query($conn, $sql_delMaj);

                if (!$result) {
                    die("cannot processed delete query");
                }
            }
        ?>

        <a href="detail.php">Back to Alumni Management</a>
    </body>
</html>
