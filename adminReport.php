<?php
session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];
ob_start();
?>

<?php
include 'dbinfo.php';
?>

<html>
<head>
	<title>GT Port </title>
	<body bgcolor="#000000">
		<center>
			<font color="#ffffff">
			
</head>
	
<body>

<p><b>Administrative Report</b></p>        
<br /><br />

<?php 

	  mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
    mysql_select_db($database) or die( "Unable to select database");

    $report_query = "SELECT section.Course_Title, course_code.Code, AVG(GPA)
                    FROM registers INNER JOIN section ON section.CRN=registers.CRN INNER JOIN 
                    GradeConversion ON registers.Grade_Received=GradeConversion.Grade INNER JOIN 
                    course_code ON course_code.Course_Title=section.Course_Title
                    GROUP BY section.Course_Title";

   	$report = mysql_query($report_query);

   	$numReports = mysql_num_rows($report);

   	?>

<table border=1 cellspacing=2 cellpadding=2>
<tr>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Course Code </font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Course Name  </font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Average Grade </font></th>
</tr>
          <?php

         $i=0;
          while ($i < $numReports) {

           $courseCode  = mysql_result($report,$i,"Code");
           $courseName = mysql_result($report,$i,"Course_Title");
           $average = mysql_result($report,$i,"AVG(GPA)");

           ?>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $courseCode; ?></font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $courseName; ?></font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $average; ?></font></td>

<?php
             $i++;
          }

 ?>

</tr>
</table>

<br><br>
<form action="homePage.php" method="POST">
<input type="submit" name="home" value="Home" />
</form>

<form action="logout.php" method="POST">
<input type="submit" name="home" value="Logout" />
</form>