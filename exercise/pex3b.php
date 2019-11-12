<?php
    $f_name = trim($_POST['txtFirstName']);
    $l_name = trim($_POST['txtLastName']);

    if (strlen($f_name) > 0 && strlen($l_name) > 0) {
        echo "Hello, ".$f_name." ".$l_name."!";
    }

    echo "Invalid input.";
?>
