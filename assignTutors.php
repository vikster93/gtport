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

<p><b>Tutor Assignments</b></p>        
<br /><br />

<?php


		$selectedTutor = $_POST['tutors'];

		$tutorList = $_SESSION['tutorList'];

		if (empty($tutorList) || (!empty($_SESSION['tutorList']) && !(in_array($_POST['tutors'], $tutorList)))) {
			$tutorList[] = $_POST['tutors'];
		}

		$_SESSION['tutorList'] = $tutorList;



		//Connect to db
		mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
        mysql_select_db($database) or die( "Unable to select database");

        $tutors_query = "SELECT
						Regular_User.Name
						FROM
						section INNER JOIN application_for_tutoring ON section.Course_Title =
						application_for_tutoring.Course_Title INNER JOIN student ON
						application_for_tutoring.Student_ID=student.Student_ID INNER JOIN Regular_User ON Regular_User.username = student.username
						WHERE
						(section.Instructor_ID='$id')
						GROUP BY Regular_User.Name";

		$tutors = mysql_query ($tutors_query)  or die(mysql_error());
		$numTutors = mysql_num_rows($tutors);

echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

echo "<form action=\"\" method=\"POST\">"; 
echo "<p> Students: ";
echo "<select name=\"tutors\" >";
	
	for ($i=0; $i < $numTutors; $i++) {

		$tutorName = mysql_result($tutors, $i);

		echo "<option value=\"$tutorName\">".$tutorName."</option>";

	}
echo "</p>";
echo "<input type=\"submit\" name=\"Assign Tutor\" value=\">>\" />"; 
echo "</form>";

	for ($i=0; $i<count($tutorList); $i++) {

		echo " ".$tutorList[$i]."";
	}
echo "<form action=\"tutorsAdded.php\" method=\"POST\">"; 
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