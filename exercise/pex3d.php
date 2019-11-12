<?php
    $num = trim($_POST['txtNum']);

    if (is_numeric($num)) {
        for ($i = 0; $i < $num; $i++) {
            echo "<div>Hello World!</div>";
        }
    } else {
        echo "Invalid input.";
    }
?>
