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

                        $query_courses = "SELECT * FROM fac_courses WHERE fac_id = '$id' ORDER BY fac_courses.index";
                        $result_courses = mysqli_query($conn, $query_courses);

                        $query_degrees = "SELECT * FROM fac_degrees WHERE fac_id = '$id' ORDER BY fac_degrees.index";
                        $result_degrees = mysqli_query($conn, $query_degrees);

                        $query_publications = "SELECT * FROM fac_publications WHERE fac_id = '$id' ORDER BY fac_publications.index";
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

                                if ($_SESSION['username'] != $row["username"] && $_SESSION["admin"] != "YES") {
                                    echo '<p>Access Denied. You will now be redirected to the login page.</p>';
                                    echo '<meta http-equiv="refresh" content="2; url=login.php">';
                                    exit;
                                }

                                echo "
                                <form action='edit-fac.php?id=$id' method='post'>
                                    First Name: <input name='first_name' type='text' id='first_name' value='$first_name' size='20'><br/>
                                    Last Name: <input name='last_name' type='text' id='last_name' value='$last_name' size='20'><br/>
                                    Position: <input name='position' type='text' id='position' value='$position' size='20'><br/>
                                    Street: <input name='street' type='text' id='street' value='$home_address' size='20'><br/>
                                    City: <input name='city' type='text' id='city' value='$home_city' size='20'><br/>
                                    State: <input name='state' type='text' id='state' value='$home_state' size='20'><br/>
                                    Zip: <input name='zip' type='text' id='zip' value='$home_zip' size='20'><br/>
                                    Email: <input name='email' type='text' id='email' value='$email' size='20'><br/>
                                    Phone: <input name='phone' type='text' id='phone' value='$phone' size='20'><br/>
                                    <input type='submit' name='updatePost' value='Update'>
                                </form>
                                ";

                                echo "<br/>";
                                echo "<br/>";

                                echo "<h3>Degrees</h3>";

                                echo "<form action='edit-fac.php?id=$id' method='post'>
                                    <input type='submit' name='addDegree' value='New'>
                                </form>";

                                while ($row_degree = mysqli_fetch_assoc($result_degrees)) {
                                    $item_id = $row_degree["id"];
                                    $index = $row_degree["index"];
                                    $name = $row_degree["name"];

                                    echo "
                                    <form action='edit-fac.php?id=$id&degree=$item_id' method='post'>
                                        Index: <input name='index' type='text' id='index' value='$index' size='20'><br/>
                                        Name: <input name='name' type='text' id='name' value='$name' size='20'><br/>
                                        <input type='submit' name='updateDegree' value='Update'>
                                        <input type='submit' name='deleteDegree' value='Delete'>
                                    </form>
                                    ";
                                }

                                echo "<br/>";
                                echo "<br/>";

                                echo "<h3>Publications</h3>";

                                echo "<form action='edit-fac.php?id=$id' method='post'>
                                    <input type='submit' name='addPublication' value='New'>
                                </form>";

                                while ($row_publication = mysqli_fetch_assoc($result_publications)) {
                                    $item_id = $row_publication["id"];
                                    $index = $row_publication["index"];
                                    $name = $row_publication["name"];

                                    echo "
                                    <form action='edit-fac.php?id=$id&publication=$item_id' method='post'>
                                        Index: <input name='index' type='text' id='index' value='$index' size='20'><br/>
                                        Name: <input name='name' type='text' id='name' value='$name' size='20'><br/>
                                        <input type='submit' name='updatePublication' value='Update'>
                                        <input type='submit' name='deletePublication' value='Delete'>
                                    </form>
                                    ";
                                }

                                echo "<br/>";
                                echo "<br/>";

                                echo "<h3>Courses</h3>";

                                echo "<form action='edit-fac.php?id=$id' method='post'>
                                    <input type='submit' name='addCourse' value='New'>
                                </form>";

                                while ($row_course = mysqli_fetch_assoc($result_courses)) {
                                    $item_id = $row_course["id"];
                                    $index = $row_course["index"];
                                    $name = $row_course["name"];

                                    echo "
                                    <form action='edit-fac.php?id=$id&course=$item_id' method='post'>
                                        Index: <input name='index' type='text' id='index' value='$index' size='20'><br/>
                                        Name: <input name='name' type='text' id='name' value='$name' size='20'><br/>
                                        <input type='submit' name='updateCourse' value='Update'>
                                        <input type='submit' name='deleteCourse' value='Delete'>
                                    </form>
                                    ";
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

                    <?php
                        session_start();
                        include('connect.inc.php');

                        $id = $_GET['id'];
                        $degree_id = $_GET['degree'];
                        $publication_id = $_GET['publication'];
                        $course_id = $_GET['course'];

                        if ($_POST["addDegree"]) {
                            $sql_add = "INSERT INTO fac_degrees (fac_id, fac_degrees.name) VALUES ('$id', 'New Item')";

                            $result = mysqli_query($conn, $sql_add);

                            if (!$result) {
                                die("cannot processed insert query");
                            }
                        } elseif ($_POST["addPublication"]) {
                            $sql_add = "INSERT INTO fac_publications (fac_id, fac_publications.name) VALUES ('$id', 'New Item')";

                            $result = mysqli_query($conn, $sql_add);

                            if (!$result) {
                                die("cannot processed insert query");
                            }
                        } elseif ($_POST["addCourse"]) {
                            $sql_add = "INSERT INTO fac_courses (fac_id, fac_courses.name) VALUES ('$id', 'New Item')";

                            $result = mysqli_query($conn, $sql_add);

                            if (!$result) {
                                die("cannot processed insert query");
                            }
                        } else {
                            if ($degree_id) {
                                if ($_POST["deleteDegree"]) {
                                    $sql_del = "DELETE FROM fac_degrees WHERE fac_id = '$id' AND id = '$degree_id'";
    
                                    $result = mysqli_query($conn, $sql_del);
    
                                    if (!$result) {
                                        die("cannot processed delete query");
                                    }
                                } elseif ($_POST["updateDegree"]) {
                                    $index = $_POST['index'];
                                    $name = $_POST['name'];

                                    $sql_update = "UPDATE fac_degrees SET fac_degrees.index='$index', fac_degrees.name='$name' WHERE id = '$degree_id'";

                                    $result = mysqli_query($conn, $sql_update);
    
                                    if (!$result) {
                                        die("cannot processed update query");
                                    }
                                }
                            } elseif ($publication_id) {
                                if ($_POST["deletePublication"]) {
                                    $sql_del = "DELETE FROM fac_publications WHERE fac_id = '$id' AND id = '$publication_id'";
    
                                    $result = mysqli_query($conn, $sql_del);
    
                                    if (!$result) {
                                        die("cannot processed delete query");
                                    }
                                } elseif ($_POST["updatePublication"]) {
                                    $index = $_POST['index'];
                                    $name = $_POST['name'];

                                    $sql_update = "UPDATE fac_publications SET fac_publications.index='$index', fac_publications.name='$name' WHERE id = '$publication_id'";

                                    $result = mysqli_query($conn, $sql_update);
    
                                    if (!$result) {
                                        die("cannot processed update query");
                                    }
                                }
                            } elseif ($course_id) {
                                if ($_POST["deleteCourse"]) {
                                    $sql_del = "DELETE FROM fac_courses WHERE fac_id = '$id' AND id = '$course_id'";
    
                                    $result = mysqli_query($conn, $sql_del);
    
                                    if (!$result) {
                                        die("cannot processed delete query");
                                    }
                                } elseif ($_POST["updateCourse"]) {
                                    $index = $_POST['index'];
                                    $name = $_POST['name'];

                                    $sql_update = "UPDATE fac_courses SET fac_courses.index='$index', fac_courses.name='$name' WHERE id = '$course_id'";

                                    $result = mysqli_query($conn, $sql_update);
    
                                    if (!$result) {
                                        die("cannot processed update query");
                                    }
                                }
                            } else {
                                $get_user_id = "SELECT * FROM faculty WHERE fac_id = '$id'";
                                $get_result = mysqli_query($conn, $get_user_id);
                                $row = mysqli_fetch_assoc($get_result)
                                $user_id = $row["uid"];

                                $position = $_POST['position'];
                                
                                $update1 = "UPDATE faculty SET position='$position' WHERE fac_id = '$id'";                                
                                $result = mysqli_query($conn, $update1);

                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];
                                $phone = $_POST['phone'];
                                $new_street = $_POST['street'];
                                $new_city = $_POST['city'];
                                $new_state = $_POST['state'];
                                $new_zip = $_POST['zip'];
                                $new_email = $_POST['email'];
    
                                $query = "UPDATE users SET street='$new_street', city='$new_city', users.state='$new_state', zip='$new_zip', email='$new_email', phone='$phone', first_name='$first_name', last_name='$last_name' WHERE users.user_id='$user_id'";
                                $result = mysqli_query($conn, $query);
    
                                if (!$result) {
                                    die("cannot processed update query");
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
