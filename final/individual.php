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
                        
                        <?php
							session_start();

							if ($_SESSION['logABC'] != 'APPLE') {
								echo "<li><a href=\"login.php\">Login</a></li>";
							} else {
								echo "<li><a href=\"logout.php\">Logout</a></li>";
							}
						?>

						<li><a class="current" href="faculty.php">Faculty</a></li>
						<li><a href="appointments.php">Appointments</a></li>
					</ul>
				</div>
		
				<div class="col c8">
					<?php
                        include('connect.inc.php');

                        $id = $_GET['id'];

                        $query = "SELECT * FROM faculty, users WHERE faculty.fac_id = '$id' AND faculty.uid = users.user_id";
                        $result = mysqli_query($conn, $query);

                        $query_courses = "SELECT * FROM fac_courses WHERE fac_id = '$id' ORDER BY index";
                        $result_courses = mysqli_query($conn, $query_courses);

                        $query_degrees = "SELECT * FROM fac_degrees WHERE fac_id = '$id' ORDER BY index";
                        $result_degrees = mysqli_query($conn, $query_degrees);

                        $query_publications = "SELECT * FROM fac_publications WHERE fac_id = '$id' ORDER BY index";
                        $result_publications = mysqli_query($conn, $query_publications);

                        if (!$result) {
                            die("cannot processed select query");
                        }

                        if (!$result_courses) {
                            die("cannot processed result_courses query");
                        }

                        if (!$result_degrees) {
                            die("cannot processed result_degrees query");
                        }

                        if (!$result_publications) {
                            die("cannot processed result_publications query");
                        }

                        $num = mysqli_num_rows($result);

                        if ($num > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $fac_id = $row["fac_id"];
                                $position = $row["position"];
                                $prefix = $row["prefix"];
                                $first_name = $row["first_name"];
                                $last_name = $row["last_name"];
                                $email = $row["email"];
                                $phone = $row["phone"];
                                $street = $row["street"];
                                $city = $row["city"];
                                $state = $row["state"];
                                $zip = $row["zip"];

                                echo "<h2>$prefix $first_name $last_name</h2>";

                                echo "<div>Position: $position</div>";
                                echo "<div>Email: $email</div>";
                                echo "<div>Phone: $phone</div>";
                                echo "<div>Address:</div>";
                                echo "<div>$street</div>";
                                echo "<div>$city, $state $zip</div>";

                                echo "<br/>";
                                echo "<br/>";

                                echo "<h3>Degrees</h3>";

                                while ($row_degree = mysqli_fetch_assoc($result_degrees)) {
                                    $name = $row_degree["name"];
                                    echo "<h4>$name</h4>";
                                }

                                echo "<br/>";
                                echo "<br/>";

                                echo "<h3>Publications</h3>";

                                while ($row_publications = mysqli_fetch_assoc($result_publications)) {
                                    $name = $row_publications["name"];
                                    echo "<h4>$name</h4>";
                                }

                                echo "<br/>";
                                echo "<br/>";

                                echo "<h3>Courses</h3>";

                                while ($row_courses = mysqli_fetch_assoc($result_courses)) {
                                    $name = $row_courses["name"];
                                    echo "<h4>$name</h4>";
                                }

                                echo "<br/>";
                                echo "<br/>";

                                echo "<div><a href='edit-fac.php?id=$fac_id'>Edit Info</a></div>";
                                echo "<div><a href='schedule.php?id=$fac_id'>Schedule an Appointment</a></div>";
                            }
                        }
                        else {
                            echo "No rows found";
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
