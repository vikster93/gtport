<?php
//retrieve session data    
  session_start();  
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $manager = $_SESSION['manager'];  
?>



<?php
include 'dbinfo.php' ; 
?>  

<html>
<head>
<title> Faculty Info Updated  </title>
</head>


<body bgcolor="#000000">
<center>
<font color="#ffffff">
<p> Faculty Personal Information Has Been Successfully Updated! </p>
<br /><br />

<?php

      mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
    mysql_select_db($database) or die( "Unable to select database");

$letter = $_POST['letter'];
$courseName = $_SESSION['courseName'];
$id = $_SESSION['id'];

$get_crn = "SELECT CRN FROM section WHERE (Letter = '$letter' AND Course_Title = '$courseName')";
$crn_result = mysql_query ($get_crn)  or die(mysql_error());
$crn = mysql_result($crn_result, 0);

$updateSection = "UPDATE `cs4400_Group22`.`section` SET `Instructor_ID` = '$id' WHERE (CRN = '$crn')";
mysql_query($updateSection);
  
  
?>
  

<form action="homePage.php" method="post">
  <input type="submit" value="Return to Home Page" name="submit">
</form>

