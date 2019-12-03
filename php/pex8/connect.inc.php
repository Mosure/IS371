<?php
    $myUserName = getenv("DB_USER");
    $myPassword = getenv("DB_PASSWORD");
    $myLocalHost = getenv("DB_HOST");
    $myDB = getenv("DB_NAME");

    $conn = mysqli_connect($myLocalHost, $myUserName, $myPassword, $myDB);

    if (!$conn) {
        die("Connection failed!");
    }

    if ($_POST['submit1']) {
        $sql_update = "UPDATE alumni SET home_address='$street', home_city='$city', home_state='$state', home_zip='$zip', email='$email' WHERE alum_id='$id'";

        result = mysqli_query($conn, $sql_update);
    }

    if ($_POST['submit2']) {
        if (isset($_POST['add_major'])) {
            $id = $_POST['id'];
            $maj_id = $_POST['add_major'];
            $sql_addMaj = "INSERT INTO alum_majors VALUES ('$id', '$maj_id')";

            result = mysqli_query($conn, $sql_addMaj);
        }
    }

    if ($_POST['submit3']) {
        $sql_delete = "DELETE ...";
    }
?>
