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

<p><b>Find Tutors</b></p>        
<br /><br />

<?php

		$courseCodeSearch = $_POST['courseCodeSearch'];
		$keywordSearch = $_POST['keywordSearch'];

		$numResults = 0;

		//Connect to db
		mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
        mysql_select_db($database) or die( "Unable to select database");

        if (strlen($courseCodeSearch) > 0) {

        	$search_query = "SELECT course_code.Code, tutors_for.Course_Title, Regular_User.Name,
									Regular_User.Email_ID

							FROM course_code INNER JOIN tutors_for ON
								course_code.Course_Title=tutors_for.Course_Title INNER JOIN student ON
								tutors_for.Tutor_Student_ID = student.Student_ID INNER JOIN Regular_User ON student.Username=Regular_User.username

							WHERE course_code.Code = '$courseCodeSearch'";

		$results = mysql_query($search_query) or die(mysql_error());

        $numResults = mysql_num_rows($results);
        }

        elseif (strlen($keywordSearch) > 0) {

        	$search_query = "SELECT course_code.Code, tutors_for.Course_Title, Regular_User.Name,
									Regular_User.Email_ID

							FROM course_code INNER JOIN tutors_for ON
								course_code.Course_Title=tutors_for.Course_Title INNER JOIN student ON
								tutors_for.Tutor_Student_ID = student.Student_ID INNER JOIN Regular_User ON student.Username=Regular_User.username

							WHERE course_code.Course_Title LIKE '%$keywordSearch%'";

		$results = mysql_query($search_query) or die(mysql_error());

        $numResults = mysql_num_rows($results);
        }

        

?>


<form action="searchForTutors.php" method="POST">
<p>Course code: 
<input name="courseCodeSearch" />
</p>
OR
<p>Enter Keyword: 
<input name="keywordSearch" />
</p>
<input type="submit" name="Search" value="Search" />
</form>

<?php

if ($numResults > 0) {

?>

<table border=1 cellspacing=2 cellpadding=2>
<tr>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Course Code  </font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Course Name  </font></th>
<th><<font color=#ffffff face=Arial, Helvetica, sans-serif>Tutor Name</font></th>
<th><font color=#ffffff face=Arial, Helvetica, sans-serif>Tutor Email Address</font></th>
</tr>
          <?php

         $i=0;
          while ($i < $numResults) {


           $code = mysql_result($results,$i,"Code");
           $courseName  = mysql_result($results,$i,"Course_Title");
           $tutorName = mysql_result($results,$i,"Name");
           $tutorEmail = mysql_result($results,$i,"Email_ID");

           ?>

<tr>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $code; ?></font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $courseName; ?></font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $tutorName; ?></font></td>
<td><font color=#ffffff face=Arial, Helvetica, sans-serif><?php echo $tutorEmail; ?></font></td>

<?php
             $i++;
          }

 ?>

</tr>
</table>

<?php

}

?>

<br><br>
<form action="homePage.php" method="POST">
<input type="submit" name="home" value="Home" />
</form>

<form action="logout.php" method="POST">
<input type="submit" name="home" value="Logout" />
</form>
