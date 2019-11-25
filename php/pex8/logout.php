<?php
    session_start();
    session_destroy();

    echo 'You have been successfully logged out. <br/><br/> You will now be returned to the login page. <meta http-equiv="refresh" content="2; url=login.php">';
?>
