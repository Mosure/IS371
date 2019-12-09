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
                    <h2>Edit Appointments</h2>

					<?php
                        session_start();
                        include('connect.inc.php');

                        if ($_SESSION['logABC'] != 'APPLE') {
                            echo '<p>Access Denied. You will now be redirected to the login page.</p>';
                            echo '<meta http-equiv="refresh" content="2; url=login.php">';
                            exit;
                        }

                        $id = $_GET['id'];

                        $query = "SELECT * FROM faculty, users WHERE faculty.fac_id = '$id' AND faculty.uid = users.user_id";
                        $result = mysqli_query($conn, $query);

                        $query_apps = "SELECT * FROM appointments WHERE fac_id = '$id' ORDER BY appointments.start";
                        $result_apps = mysqli_query($conn, $query_apps);

                        if (!$result) {
                            die("cannot processed select query");
                        }

                        if (!$result_apps) {
                            die("cannot processed result_apps query");
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

                                if ($_SESSION['username'] != $row["username"] && $_SESSION["admin"] != "YES") {
                                    echo '<p>Access Denied. You will now be redirected to the login page.</p>';
                                    echo '<meta http-equiv="refresh" content="2; url=login.php">';
                                    exit;
                                }

                                echo "
                                <form action='edit-apps.php?id=$id' method='post'>
                                    <input type='submit' name='addApp' value='New'>
                                </form>
                                <br/>
                                ";

                                echo" 
                                <table style='width: 100%;' cellspacing='0'>
                                    <tr>
                                        <td>
                                            Start
                                        </td>
                                        <td>
                                            End
                                        </td>
                                        <td>
                                            Name
                                        </td>
                                        <td>
                                            ID
                                        </td>
                                        <td/>
                                    </tr>
                                ";

                                while ($row_app = mysqli_fetch_assoc($result_apps)) {
                                    $app_id = $row_app["id"];
                                    $start = $row_app["start"];
                                    $end = $row_app["end"];
                                    $student_id = $row_app["student_id"];
                                    $student_name = $row_app["student_name"];

                                    echo "$start";

                                    echo "<form action='edit-apps.php?id=$id&appointment_id=$app_id' method='post'>";

                                    echo "
                                    <tr>
                                        <td>
                                            <input type='datetime-local' id='start' name='start' value='$start'>
                                        </td>
                                        <td>
                                            <input type='datetime-local' id='end' name='end' value='$end'>
                                        </td>
                                        <td>
                                            $student_name
                                        </td>
                                        <td>
                                            $student_id
                                        </td>
                                        <td>
                                    ";

                                    if (!($student_id && $student_name)) {
                                        echo "
                                            <input type='submit' name='updateApp' value='Update'>
                                            <input type='submit' name='deleteApp' value='Delete'>
                                        ";
                                    }

                                    echo "
                                        </td>
                                    </tr>
                                    </form>
                                    ";
                                }

                                echo "
                                </table>
                                ";

                                echo "<div><a href='individual.php?id=$fac_id'>Go Back</a></div>";
                            }
                        }
                        else {
                            echo "No rows found";
                        }
                    ?>

                    <?php
                        session_start();
                        include('connect.inc.php');

                        $id = $_GET['id'];
                        $app_id = $_GET['appointment_id'];

                        if ($_POST["addApp"]) {
                            $start = date_default_timezone_get();
                            $end = date_default_timezone_get();

                            $sql_add = "INSERT INTO appointments (fac_id, appointments.start, appointments.end) VALUES ('$id', '$start', '$end')";

                            $result = mysqli_query($conn, $sql_add);

                            if (!$result) {
                                die("cannot processed insert query");
                            }
                            
                            header('Refresh: 0.2');
                        } else {
                            if ($app_id) {
                                if ($_POST["deleteApp"]) {
                                    $sql_del = "DELETE FROM appointments WHERE id = '$app_id'";
    
                                    $result = mysqli_query($conn, $sql_del);
                                    if (!$result) {
                                        die("cannot processed delete query");
                                    }
                            
                                    header('Refresh: 0.2');
                                } elseif ($_POST["updateApp"]) {
                                    $start = $_POST["start"];
                                    $end = $_POST["end"];

                                    $sql_update = "UPDATE appointments SET appointments.start='$start', appointments.end='$end' WHERE id = '$app_id'";

                                    $result = mysqli_query($conn, $sql_update);
    
                                    if (!$result) {
                                        die("cannot processed update query");
                                    }
                            
                                    header('Refresh: 0.2');
                                }
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
