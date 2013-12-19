<?php
session_start();
//$user = $_SESSION['user'];
$user = 'vikram1';
//$id = $_SESSION['id'];
$id = '2';
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

<p><b>Logbook Updated Successfully!</b></p>        
<br /><br />

<?php

	if (isset($_POST['studentID']) && isset($_POST['studentName'])) {

		$studentID = $_POST['studentID'];
		$studentName = $_POST['studentName'];
		$courseCode = $_POST['courseCode'];

		mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
        mysql_select_db($database) or die( "Unable to select database");

        $student_check_query = "SELECT student.Student_ID, Regular_User.Name, registers.CRN
        						FROM student INNER JOIN registers ON student.Student_ID=registers.student_ID 
        						INNER JOIN section ON section.CRN = registers.CRN INNER JOIN Regular_User 
        						ON student.Username = Regular_User.Username INNER JOIN course_code ON course_code.Course_Title = section.Course_Title 
								WHERE student.Student_ID = '$id' AND course_code.Code = '$courseCode'";

		$student_check = mysql_query($student_check_query);

		if (mysql_num_rows($student_check) > 0) {


		}




    }