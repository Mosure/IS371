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
					<h2>Faculty</h2>
					<?php
                        include('connect.inc.php');

                        $query = "SELECT * FROM faculty, users WHERE active = 'YES' AND faculty.uid = users.user_id ORDER BY last_name";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("cannot processed select query");
                        }

                        $num = mysqli_num_rows($result);

                        if ($num > 0) {
                            echo "<table style='width: 100%;'>";

                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                if (($i % 2) == 0) {
                                    echo "<tr style='border-bottom: 1px solid #ccc;'>";
                                } else {
                                    echo "<tr bgcolor='#ddd' style='border-bottom: 1px solid #ccc;'>";
                                }

                                $fac_id = $row["fac_id"];
                                $position = $row["position"];
                                $prefix = $row["prefix"];
                                $first_name = $row["first_name"];
                                $last_name = $row["last_name"];
                                $email = $row["email"];
                                $phone = $row["phone"];

                                echo "
                                <td>
                                    <div>
                                        <h4>
                                            <a href='individual.php?id=$fac_id'>
                                                $prefix $first_name $last_name
                                            </a>
                                        </h4>
                                        <div>
                                            $position
                                        </div>
                                    </div>
                                </td>
                                <td align='right'>
                                    <h6>
                                        <a href='$email'>
                                            $email
                                        </a>
                                    </h6>
                                    <div>
                                        $phone
                                    </div>
                                </td>
                                ";

                                echo "</tr>";

                                $i++;
                            }

                            echo "</table>";
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
