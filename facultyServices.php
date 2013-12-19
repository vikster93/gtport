<?php
session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];
$_SESSION['tutorList'] = array();
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

<p><b>Faculty Services</b></p>        
<br /><br />

<form action="facultyInfo.php">
	<input type="submit" value="Update Personal Information" name="submit">
</form>

<form action="assignTutors.php">
	<input type="submit" value="Assign Tutors" name="submit">
</form>

<form action="facultyReport.php">
	<input type="submit" value="View Student Performance" name="submit">
</form>

<form action="logout.php" method="POST">
<input type="submit" name="home" value="Logout" />
</form>