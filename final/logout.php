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
						<li><a href="index.html">Home</a></li>
						<li><a class="current" href="login.php">Login</a></li>
						<li><a href="faculty.php">Faculty</a></li>
						<li><a href="appointments.php">Appointments</a></li>
					</ul>
				</div>
		
				<div class="col c8">
					<h2>Logout</h2>
					<?php
                        session_start();
                        session_destroy();

                        echo 'You have been successfully logged out. <br/><br/> You will now be returned to the login page. <meta http-equiv="refresh" content="2; url=login.php">';
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

