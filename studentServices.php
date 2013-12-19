<?php
session_start();
ob_start();
?>

<?php
include 'dbinfo.php';
?>



<html>
<head>
	<title> Student Services </title>
	<body bgcolor="#000000">
		<center>
			<font color="#ffffff">
			
</head>
<body>

<?php

$user = $_SESSION['user'];
$id = $_SESSION['id'];

mysql_connect($host,$username,$password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

$tutorQuery = "SELECT Course_Title FROM tutors_for WHERE (Tutor_Student_ID = '$id')";
$tutor_result = mysql_query($tutorQuery);
$numTutors = mysql_num_rows($tutor_result);

?>

<p><b>Student Services</b></p>        
<br /><br />

<form action="registration.php">
	<input type="submit" value="Register For Courses" name="Register">
</form>

<form action="studentInfo.php">
	<input type="submit" value="Update Personal Information" name="personal_info">
</form>

<form action="searchForTutors.php">
	<input type="submit" value="Find Tutors" name="searchTutors">
</form>

<?php

if($numTutors != 0){
	echo "<form action=\"tutorLogbook.php\" method=\"POST\">"; 
	echo "<input type=\"submit\" name=\"tutorLogbook\" value=\"Tutor Logbook\" />"; 
	echo "</form>";	
}

?>

<form action="studentReport.php">
	<input type="submit" value="View Grading Pattern" name="searchTutors">
</form>

<form action="logout.php" method="POST">
<input type="submit" name="home" value="Logout" />
</form>