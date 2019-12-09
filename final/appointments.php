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
                        
						<li><a class="current" href="faculty.php">Faculty</a></li>
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
					<h2>Schedule an Appointment</h2>
					<?php
                        session_start();
                        include('connect.inc.php');

                        $id = $_GET['id'];

                        $query = "SELECT *, DATE_FORMAT(appointments.end, '%Y-%m-%dT%H:%i') AS end_mod, DATE_FORMAT(appointments.start, '%Y-%m-%dT%H:%i') AS start_mod FROM appointments WHERE fac_id = '$id' AND (student_id IS NULL OR student_name IS NULL) ORDER BY appointments.start";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("cannot processed select query");
                        }

                        $num = mysqli_num_rows($result);

                        if ($num > 0) {
                            echo "
                            <form action='appointments.php?id=$id' method='post'>
                                Name
                                <input name='name' type='text' id='name' size='20'><br/><br/>
                                Last 5 Digits of Student ID
                                <input name='student_id' type='text' id='student_id' size='20'><br/></br>

                                <table style='width: 100%;' cellspacing='0'>
                            ";

                            $i = 0;

                            echo "
                            <tr>
                                <td>
                                    Start
                                </td>
                                <td>
                                    End
                                </td>
                                <td/>
                            </tr>
                            ";

                            while ($row = mysqli_fetch_assoc($result)) {
                                if (($i % 2) == 0) {
                                    echo "<tr style='border-bottom: 1px solid #ccc;'>";
                                } else {
                                    echo "<tr bgcolor='#ddd' style='border-bottom: 1px solid #ccc;'>";
                                }

                                $app_id = $row["id"];
                                $start = $row["start_mod"];
                                $end = $row["end_mod"];

                                echo "
                                <td>
                                    <input type='datetime-local' id='start' name='start' value='$start' readonly>
                                </td>
                                <td align='right'>
                                    <input type='datetime-local' id='start' name='start' value='$end' readonly>
                                </td>
                                <td>
                                    <input type='radio' name='appointment_id' value='$app_id'>
                                </td>
                                ";

                                echo "</tr>";

                                $i++;
                            }

                            echo "
                                </table>
                                <br/>
                                <input type='submit' name='updatePost' value='Schedule'>
                            </form>";
                        }
                        else {
                            echo "No rows found";
                        }
                    ?>

                    <?php
                        session_start();
                        include('connect.inc.php');

                        $id = $_GET['id'];

                        if ($_POST["updatePost"]) {
                            $app_id = $_POST["appointment_id"];
                            $student_id = $_POST["student_id"];
                            $name = $_POST["name"];

                            $update1 = "UPDATE appointments SET student_id='$student_id', appointments.student_name='$name' WHERE id = '$app_id'";                                
                            $result = mysqli_query($conn, $update1);

                            if (!$result) {
                                die("cannot processed update query");
                            }
                        
                            echo "Scheduled appointment! Redirecting";
                            echo "<meta http-equiv='refresh' content='0.5; url=my-apps.php?student_id=$student_id'>";
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
