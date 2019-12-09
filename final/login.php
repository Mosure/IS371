<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="Mitchell Mosure" />
		<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" type="text/css" href="origo.css" title="Origo" media="all"/>
		<title>IS371 - Final Project</title>
	</head>

	<body class="light blue smaller freestyle01">
		<div id="layout">
		
			<div class="row">
				<div class="col c12 aligncenter">
					<img src="images/front.png" width="960" height="240" alt="" />
				</div>
			</div>
		
			<div class="row" style="min-height: 600px;">
				<div class="col c2 alignleft">
					<ul class="menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="career.php">Career</a></li>
						<li><a href="faculty.php">Faculty</a></li>
						<li><a href="my-apps.php">My Appointments</a></li>
						<li><a class="current" href="login.php">Login</a></li>
					</ul>
				</div>
		
				<div class="col c8">
					<h2>Login</h2>
					<form name="pageForm" method="post">
						Username:
						<input type="text" name="user" value="" size=20/>
						<br/>
						<br/>
						Password :
						<input type="password" name="password" value="" size=20/>
						<br/>
						<br/>
						<input type="submit" name="login" value="Login"/>
					</form>

					<?php
						session_start();

						if ($_SESSION['logABC'] == 'APPLE') {
							echo '<p>You are already logged in! Redirecting to home.</p>';
        					echo '<meta http-equiv="refresh" content="2; url=index.php">';
						}
					?>

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
				
								$_SESSION['username'] = $row['username'];
								$_SESSION['admin'] = $row['admin'];
				
								echo '<meta http-equiv="refresh" content="0; url=index.php">';
							} else {
								echo 'Invalid username/password!';
							}
						}
					?>
				</div>
			</div>
		
			<div id="footer" class="row">
				<div class="col c12 aligncenter">
					<h3>&copy; <a href="https://mitchell.mosure.me" target="_blank">2019 Mitchell Mosure</a></h3>
				</div>
			</div>
		</div>
	</body>
</html>
