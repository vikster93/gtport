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
<title> Registration  </title>
</head>


<body bgcolor="#000000">
<center>
<font color="#ffffff">
<p> Course Selection </p>
<br /><br />


<!-- Manager SSN is   <?php echo $_SESSION['manager'] ?>  --> 

<?php

$id = $_SESSION['id'];

mysql_connect($host,$username,$password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

$departmentQuery = "SELECT Major FROM student WHERE (Student_ID = '$id')"; 
$departmentResult = mysql_query($departmentQuery);
$major = mysql_result($departmentResult, 0);

$dept_id_query = "SELECT Dept_ID FROM department WHERE (Dept_Name = '$major')";
$deptResult = mysql_query($dept_id_query);
$dept_id = mysql_result($deptResult, 0);

$offers_query = "SELECT Course_Title FROM offers WHERE (Dept_ID = '$dept_id')";
$offers_result = mysql_query($offers_query);


?>  


<b> Term: Spring 2013 </b><br>  
<b> Department: <?php echo $major ?></b>
<br><br>  


<table border="1" cellspacing="2" cellpadding="2">
<tr>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Select  </font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">CRN  </font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Title</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Course Code</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Section</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Instructor</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Days</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Time</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Location</font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Mode of Grading</font></th>
</tr>

<form action="registrationSubmit.php" method="post">

<?php   

          $courses_query2 = " SELECT      section.CRN, section.Course_Title, course_code.Code, section.Letter, Regular_User.Name, 
                                          section.Day, section.Time, section.Location 
                              FROM          section INNER JOIN course_code ON course_code.Course_Title=section.Course_Title 
                                          INNER JOIN faculty ON section.Instructor_ID=faculty.Instructor_ID INNER JOIN 
                                          Regular_User ON faculty.Username=Regular_User.Username WHERE (Dept_ID = '$dept_id') ";

          $courses_result = mysql_query($courses_query2);
          $_SESSION['possibleCourses'] = $courses_result;
          $numOffers = mysql_num_rows($courses_result);

          while ($i < $numOffers) {

          $title = mysql_result($courses_result,$i, "Course_Title");
          $crn = mysql_result($courses_result, $i,"CRN");
          $section = mysql_result($courses_result, $i,"Letter");
          $days = mysql_result($courses_result, $i,"Day");
          $time = mysql_result($courses_result, $i,"Time");
          $location = mysql_result($courses_result, $i,"Location");
          $courseCode = mysql_result($courses_result, $i,"Code");
          $instructor = mysql_result($courses_result, $i,"Name");

 ?>

<tr>
<?php echo "<td> <input type=\"checkbox\" name=\"'$i'\" value=\"selected\"></td>" ?>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $crn; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $title; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $courseCode; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $section; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $instructor; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $days; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $time; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $location; ?></font></td>
<td>

<?php
echo "<select name=\"mode\" >";
echo "<option value=\"Letter\"> Letter </option>";
echo "<option value=\"PassFail\"> Pass Fail </option>";
echo "<option value=\"Audit\"> Audit </option></select>";
echo "</p>";
?>

</td>

</tr>


<?php
             $i++;
          }

 ?>

</table>   

<br><br>    


  <input type="submit" value="Register" name="register">
</form>

<?php
echo "<br><br>";
echo "<form action=\"homePage.php\" method=\"POST\">";
echo "<input type=\"submit\" name=\"home\" value=\"Home\" />";
echo "</form>";

echo "<form action=\"logout.php\" method=\"POST\">";
echo "<input type=\"submit\" name=\"home\" value=\"Logout\" />";
echo "</form>";

?>

