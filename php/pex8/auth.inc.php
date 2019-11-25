<?php
    session_start();

    if ($_SESSION['logABC'] != 'APPLE') {
        echo '<p>Access Denied. You will now be redirected to the login page.</p>';
        echo '<meta http-equiv="refresh" content="2; url=login.php">';
        exit;
    }
?>
