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

						<li><a class="current" href="career.php">Career</a></li>
						<li><a href="faculty.php">Faculty</a></li>
						<li><a href="my-apps.php">My Appointments</a></li>

						<?php
							session_start();

							if ($_SESSION['logABC'] != 'APPLE') {
								echo "<li><a href=\"login.php\">Login</a></li>";
							} else {
								echo "<li><a href=\"logout.php\">Logout</a></li>";
							}
						?>
					</ul>
				</div>
		
				<div class="col c8">
					<h2>Career Center</h2>
					<p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tortor sapien, pulvinar eget neque a, ultrices tristique nisi. Aenean ultrices cursus enim et imperdiet. Nam nec velit ut magna elementum viverra. Proin hendrerit felis nec iaculis congue. Praesent congue, massa sed hendrerit convallis, neque elit fermentum nisi, non volutpat leo quam at nisi. Phasellus congue lacus venenatis, viverra eros ac, pellentesque velit. Aliquam erat volutpat. Mauris vitae ligula nec ipsum congue egestas id feugiat enim. Sed fringilla quis neque eget laoreet. Sed at lorem et odio posuere blandit eget ut augue. Proin ante neque, molestie eu ullamcorper dignissim, aliquet vitae nunc. Praesent pulvinar luctus auctor. Proin ante magna, laoreet sed molestie eget, placerat quis nisl.
                    </p>

                    <p>
                        Quisque non ligula augue. Maecenas aliquet sapien ac maximus commodo. Mauris felis lacus, pharetra id nulla eget, commodo lobortis magna. Nulla in facilisis purus. Nulla rhoncus dui et placerat finibus. Sed sollicitudin venenatis ligula nec mattis. Integer at nisi ut tortor hendrerit varius. Pellentesque feugiat ex eu sapien elementum tristique nec sed orci. Cras vel pulvinar nibh, vel fermentum erat. In hac habitasse platea dictumst.
                    </p>
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
