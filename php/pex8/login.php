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
            session_start();

            include('connect.inc.php');

            if ($_POST['login']) {
                $username = $_POST['user'];
                $password = $_POST['password'];

                $query = "SELECT * FROM users WHERE users.username = '$username' AND users.password = '$password'";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("cannot processed login query");
                }
    
                $num = mysqli_num_rows($result);

                if ($num == 1) {
                    $row = mysqli_fetch_assoc($result);

                    $_SESSION['logABC'] = 'APPLE';
    
                    $_SESSION['lastName'] = $row['last_name'];
    
                    echo '<meta http-equiv="refresh" content="0; url=detail.php">';
                } else {
                    echo 'Invalid username/password!';
                }
            }
        ?>
    </body>
</html>
