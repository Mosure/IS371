<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Login:</h1>
        <form name="pageForm" method="post">
            Username: <input type="text" name="user" id="user" value="">
            <br>
            Password: <input type="password" name="password" id="password" value="">
            <br>
            <input type="submit" name="login" value="Login">
        </form>

        <?php
            if ($num == 1) {
                $_SESSION['loginID'] = $_POST['loginID'];
                $_SESSION['logABC'] = 'APPLE';

                $_SESSION['lastName'] = $row['lastName'];

                echo '<meta http-equiv="refresh" content="0; url=detail.php">';
            } else {
                echo 'Invalid username/password!';
            }

            mysqli_close($conn);
        ?>
    </body>
</html>
