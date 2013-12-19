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

<p><b>Effect of Tutoring on Student Performance</b></p>        
<br /><br />

<?php 

	  /*mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
    mysql_select_db($database) or die( "Unable to select database");

    $report_query = "SELECT section.Course_Title, course_code.Code, AVG(GPA)
                    FROM registers INNER JOIN section ON section.CRN=registers.CRN INNER JOIN 
                    GradeConversion ON registers.Grade_Received=GradeConversion.Grade INNER JOIN 
                    course_code ON course_code.Course_Title=section.Course_Title
                    GROUP BY section.Course_Title";

   	$report = mysql_query($report_query);

   	$numReports = mysql_num_rows($report);*/

   	?>

<table border=1 cellspacing=2 cellpadding=2>
<tr>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Course Code </font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Course Name  </font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>No. of Meetings With Tutors  </font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Average Grade of Students </font></th>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>ECE2000</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Signal Processing</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif> > 3</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>3.80</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>ECE2000</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Signal Processing</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif> 1 - 3 </font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>2.81</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>ECE2000</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Signal Processing</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>None</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>1.80</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>CS4400</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Intro to Databases</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif> > 3</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>3.50</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>CS4400</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Intro to Databases</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif> 1 - 3 </font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>2.60</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>CS4400</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Intro to Databases</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>None</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>1.50</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>BIO2000</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Ecology</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif> > 3</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>3.80</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>BIO2000</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Ecology</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif> 1 - 3 </font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>3.14</font></td>
</tr>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>BIO2000</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>Ecology</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>None</font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif>2.69</font></td>
</tr>

</table>

<br><br>
<form action="homePage.php" method="POST">
<input type="submit" name="home" value="Home" />
</form>

<form action="logout.php" method="POST">
<input type="submit" name="home" value="Logout" />
</form>