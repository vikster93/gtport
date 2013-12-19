<?php
session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];
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

<p><b>Tutor Logbook</b></p>        
<br /><br />

<?php

		date_default_timezone_set('America/New_York'); 
		$date = date('Y-m-d H:i:s');

		mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
        mysql_select_db($database) or die( "Unable to select database");

        //Obtain courses that user tutors for
        $course_query = "SELECT course_code.Code
						FROM course_code INNER JOIN tutors_for ON
						tutors_for.Course_Title = course_code.Course_Title
						WHERE tutors_for.Tutor_Student_ID= '$id'";

		$courses = mysql_query($course_query);

		//Obtain tutor's name
		$name_query = 	"SELECT Regular_User.Name
						FROM Regular_User
						WHERE Regular_User.Username = '$user'";


		$name = mysql_query($name_query);

		if (isset($_POST['studentID'])) {

		$studentID = $_POST['studentID'];
		$courseCode = $_POST['courseCodes'];

        $student_check_query = "SELECT student.Student_ID, Regular_User.Name, registers.CRN
        						FROM student INNER JOIN registers ON student.Student_ID=registers.student_ID 
        						INNER JOIN section ON section.CRN = registers.CRN INNER JOIN Regular_User 
        						ON student.Username = Regular_User.Username INNER JOIN course_code ON course_code.Course_Title = section.Course_Title 
								WHERE student.Student_ID = '$studentID' AND course_code.Code = '$courseCode'";

		$student_check = mysql_query($student_check_query);

		if (mysql_num_rows($student_check) != 0) {

			$CRN = mysql_result($student_check, 0, "CRN");

			$insert_query = "INSERT INTO logs_visit(Tutor_Student_ID, Student_ID, CRN, DateTime)
							VALUES ('$id', '$studentID', '$CRN', '$date')";


			$studentName = mysql_result($student_check, 0, "Name");

			mysql_query($insert_query);

			echo "Logbook Updated!";
			echo "<br><br>";
			echo "Student ID: ".$studentID."     Student Name: ".$studentName."     Course tutored for: ".$CRN."     Time: ".$date." ";
			echo "<br><br><br><br>";


		} else {

			$err = "Student is not registered for course!";
			echo $err;
			echo "<br><br>";
		}
	}



echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 
echo $date;

echo "<form action=\"\" method=\"POST\">";
echo "<p>Tutor Name: ";
echo "".mysql_result($name,0)."";
echo "</p>";
echo "<p>Student ID: ";
echo "<input name=\"studentID\" value=$studentID>";
echo "</p>";
echo "<p>Student Name: ";
echo "$studentName";
echo "<p>Course Code: ";
echo "<select name=\"courseCodes\" >";

for ($i=0; $i<mysql_num_rows($courses); $i++) {

	$courseCodeName = mysql_result($courses, $i);
	echo "<option value=\"$courseCodeName\">".$courseCodeName."</option>";

}

echo "</p>";
echo "<br>";
echo "<input type=\"submit\" name=\"Done\" value=\"Done\" />";
echo "</form>";
echo "<br><br>";
echo "<form action=\"homePage.php\" method=\"POST\">";
echo "<input type=\"submit\" name=\"home\" value=\"Home\" />";
echo "</form>";
echo "<form action=\"logout.php\" method=\"POST\">";
echo "<input type=\"submit\" name=\"home\" value=\"Logout\" />";
echo "</form>";
echo "</body>"; 
echo "</html>";

?>

</font>
</center>
</body>
</html>