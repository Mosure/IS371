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
                        <li><a class="current" href="my-apps.php">My Appointments</a></li>

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
					<h2>My Appointments</h2>

					<?php
                        session_start();
                        include('connect.inc.php');

                        $id = $_GET['student_id'];

                        echo "
                        <form>
                            <input name='student_id' type='text' id='student_id' value='$id'>
                            <input type='submit' name='getStudent' value='View'>
                        </form>
                        <br/>
                        <br/>
                        ";

                        $query = "SELECT *, DATE_FORMAT(appointments.end, '%Y-%m-%dT%H:%i') AS end_mod, DATE_FORMAT(appointments.start, '%Y-%m-%dT%H:%i') AS start_mod FROM appointments, faculty, users WHERE student_id = '$id' AND appointments.fac_id = faculty.fac_id AND faculty.uid = users.user_id ORDER BY appointments.start";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("cannot processed select query");
                        }

                        $num = mysqli_num_rows($result);

                        if ($num > 0) {
                            echo "
                                <table style='width: 100%;' cellspacing='0'>
                            ";

                            $i = 0;

                            echo "
                            <tr>
                                <td>
                                    Faculty
                                </td>
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
                                $prefix = $row["prefix"];
                                $first_name = $row["first_name"];
                                $last_name = $row["last_name"];
                                $start = $row["start_mod"];
                                $end = $row["end_mod"];

                                echo "
                                <td>
                                    $prefix $first_name $last_name
                                </td>
                                <td>
                                    <input type='datetime-local' id='start' name='start' value='$start' readonly>
                                </td>
                                <td align='right'>
                                    <input type='datetime-local' id='start' name='start' value='$end' readonly>
                                </td>
                                <td>
                                    <form action='my-apps.php?student_id=$id' method='post'>
                                        <input name='appointment_id' type='hidden' id='appointment_id' value='$app_id'>
                                        <input type='submit' name='deleteApp' value='Delete'>
                                    </form>
                                </td>
                                ";

                                echo "</tr>";

                                $i++;
                            }

                            echo "
                                </table>
                                <br/>
                                <input type='submit' name='updatePost' value='Update'>
                            </form>";
                        }
                        else {
                            echo "No rows found";
                        }
                    ?>

                    <?php
                        session_start();
                        include('connect.inc.php');

                        if ($_POST["deleteApp"]) {
                            $app_id = $_POST["appointment_id"];

                            $update1 = "UPDATE appointments SET student_id=NULL, appointments.student_name=NULL WHERE id = '$app_id'";                                
                            $result = mysqli_query($conn, $update1);

                            if (!$result) {
                                die("cannot processed update query");
                            }
                        
                            echo "Appointment Deleted!";
                            header('Refresh: 0.2');
                        } elseif ($_POST["getStudent"]) {
                            $student_id = $_POST["student_id"];

                            echo "<meta http-equiv='refresh' content='0; url=my-apps.php?id=$student_id'>";
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
