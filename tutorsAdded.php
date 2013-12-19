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
       
<br /><br />

<?php

//Connect to db
		mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
        mysql_select_db($database) or die( "Unable to select database");

        if (count($_SESSION['tutorList'])==1 && $_SESSION['tutorList'][0]=="") {
                echo "No tutors added!";
        }

        else {

        echo "Tutors added successfully!";
        echo "<br>";

        for ($i=0; $i<count($_SESSION['tutorList']); $i++) {

        	$tutorList = $_SESSION['tutorList'];
        	$current = $tutorList[$i];

                if ($current!="") {
                        echo "Added ".$current." ";
                }

        	if (strlen($current)>0) {

        	$tutor_query = "INSERT INTO tutors_for(Tutor_Student_ID, Course_Title)
        				SELECT student.Student_ID, application_for_tutoring.Course_Title
        				FROM application_for_tutoring INNER JOIN student ON application_for_tutoring.Student_ID = student.Student_ID 
        				INNER JOIN Regular_User ON Regular_User.Username = student.Username INNER JOIN section ON 
        				application_for_tutoring.Course_Title = section.Course_Title
        				WHERE (Regular_User.Name = '$current') AND (section.Instructor_ID = '$id')";

        	$tutor = mysql_query($tutor_query);

        	$select_query = "SELECT student.Student_ID, application_for_tutoring.Course_Title
        				FROM application_for_tutoring INNER JOIN student ON application_for_tutoring.Student_ID = student.Student_ID 
        				INNER JOIN Regular_User ON Regular_User.Username = student.Username INNER JOIN section ON 
        				application_for_tutoring.Course_Title = section.Course_Title
        				WHERE (Regular_User.Name = '$current') AND (section.Instructor_ID = '$id')";

        	$selected = mysql_query($select_query);

        	$selectedID = mysql_result($selected, 0, "Student_ID");
        	$selectedTitle = mysql_result($selected, 0, "Course_Title");



        	$delete_query = "DELETE FROM application_for_tutoring
        					WHERE Student_ID = '$selectedID' AND Course_Title = '$selectedTitle'";

        	$delete = mysql_query($delete_query);

        	}
        }
}

echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>";

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