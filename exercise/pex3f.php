<?php
    $rows = $_POST['txtRows'];
    $columns = $_POST['txtColumns'];

    if (is_numeric($rows) && is_numeric($columns)) {
        echo "<table border=1>";

        for ($i = 0; $i < $rows; $i++) {
            echo "<tr>";

            for ($j = 0; $j < $columns; $j++) {
                echo "<td/>";
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Invalid input.";
    }
?>
