<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>
<HEAD>
     <TITLE>KEYES UNIVERSITY: HOME</TITLE>
     
<link rel="stylesheet" type="text/css" href="andreas01.css" />

<SCRIPT language=JavaScript>

</script>
</HEAD>

<body><div id="wrap">

<img id="frontphoto" src="pics/keyes_university.jpg" width="750" height="150" alt="" />

<div id="avmenu">
<h2 class="hide">Menu:</h2>

<H4>Students</h4>
<ul>
<LI>Log in to:</li>
<li> &middot <a HREF="students.html"/> Check class schedule</a> </li>
<LI> &middot <a HREF="students.html"/> Transcripts</a> </LI>
<LI> &middot <a HREF="students.html"/>Add/Remove Classes </a></LI>
</ul>

<H4>Instructors</h4>
<UL>
<LI>Log in to:</li>
<LI> &middot <A href="instructors.html"/> Assign Grades </a></LI>
<LI> &middot <A href="instructors.html"/> class rosters </a></LI>
</UL>

<H4>Administrators </h4>
<UL>
<LI>Log in to:</li>
<LI> &middot <A href="admin.html"/>Remove Departments</a></LI>
<LI> &middot <A href="admin.html"/>Remove Students </a></LI>
<LI> &middot <A href="admin.html"/>Remove Instructors</a></li>
<LI> &middot <A href="admin.html"/>Remove Classes</a></LI>
</UL>

</div>

<div id="extras" class="announce">

<h3>Latest news:</h3>
<p><strong>February 25, 2008:</strong><br />
</p>  Keyes Law School hosts conference on services for children with special needs.

</div>

<div id="content">

<?php
            // Pull from conf
            $myUserName = getenv("DB_USER");
            $myPassword = getenv("DB_PASSWORD");
            $myLocalHost = getenv("DB_HOST");
            $myDB = getenv("DB_NAME");

            $conn = mysqli_connect($myLocalHost, $myUserName, $myPassword, $myDB);

            if (!$conn) {
                die("Connection failed!");
            }

            $query = "SELECT * FROM alumni";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("cannot processed select query");
            }

            $num = mysqli_num_rows($result);

            if ($num > 0) {
                echo "<table border=1>";

                echo "<tr>";

                echo "<td>ID</td>";
                echo "<td>Prefix</td>";
                echo "<td>First Name</td>";
                echo "<td>Last Name</td>";
                echo "<td>Target</td>";
                echo "<td>Active</td>";

                echo "</tr>";

                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    if (($i % 2) == 0) {
                        echo "<tr>";
                    } else {
                        echo "<tr bgcolor='#bbb'>";
                    }

                    echo "<td>".$row["alum_id"]."</td>";
                    echo "<td>".$row["prefix"]."</td>";
                    echo "<td>".$row["first_name"]."</td>";
                    echo "<td>".$row["last_name"]."</td>";
                    echo "<td>".$row["target"]."</td>";
                    echo "<td>".$row["active"]."</td>";

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

<div id="footer">
Copyright &copy; 2005 Missy Kessler. Design by <a href="http://andreasviklund.com">Andreas Viklund</a>.
</div>

</div>
</body>
</html>

