<?php
    $myUserName = getenv("DB_USER");
    $myPassword = getenv("DB_PASSWORD");
    $myLocalHost = getenv("DB_HOST");
    $myDB = getenv("DB_NAME");

    $conn = mysqli_connect($myLocalHost, $myUserName, $myPassword, $myDB);

    if (!$conn) {
        die("Connection failed!");
    }
?>
